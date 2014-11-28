<?php
Class ShopController extends Controller{

protected $auth_actions=array('order','purchase');

protected function editAction(){
  $amount=$this->request->getPost('amount');
  $product_id=$this->request->getPost('product_id');
  $cart=$this->session->get('cart');
  $item=$cart->getItem($product_id);
  $item->amount=$amount;
  }

  protected function deleteAction($route){
    $uri=$this->request->getReferer();
    if(!$product_id=$this->request->getGet('product_id')){
      $this->redirect("/shop/index");
      return null;
    }else{
      $cart=$this->session->get('cart');
      $cart->deleteItem($product_id);
      $items=$cart->getItems();
      $this->session->set('cart',$cart);
      $this->redirect("/shop/cart");
      return null;
    }
  }

  protected function indexAction($route){
    $product=new Product();
    $products=$product->findAll();
    $argument=compact('products');
    $authenticated=$this->session->isAuthenticated();
    $view=new View();
    $view->setLayoutVar('authenticated',$authenticated);
    return $view->render($route,$argument,true);
  }

  protected function showAction($route){
    if(!$id=$this->request->getGet('id')){
      $this->redirect('/shop/index');
      return null;
    }
    $product=new Product();
    $item=$product->findOne($id);
    $argument=compact('item');
    $authenticated=$this->session->isAuthenticated();
    $view=new View();
    $view->setLayoutVar('authenticated',$authenticated);
    return $view->render($route,$argument,true);
  }

  protected function cartAction($route){
    if(!$cart=$this->session->get('cart')){
        $cart=new Cart();
    }
    if($this->request->isPost()){

    if($item=$cart->getItem($this->request->getPost('product_id'))){
      $item->amount+=$this->request->getPost('amount');
    }else{
      $item=new Item();
      $item->product_id=$this->request->getPost('product_id');
      $item->name=$this->request->getPost('name');
      $item->price=$this->request->getPost('price');
      $item->category_id=$this->request->getPost('category_id');
      $item->amount=$this->request->getPost('amount');
      $cart->addItem($item);
    }
  }
    $items=$cart->getItems();
    $this->session->set('cart',$cart);
    $argument=compact('items');
    $authenticated=$this->session->isAuthenticated();
    $view=new View();
    $view->setLayoutVar('authenticated',$authenticated);
    return $view->render($route,$argument,true);
  }

    protected function orderAction($route){
      if(empty($cart=$this->session->get('cart'))||empty($items=$cart->getItems())){
      $this->redirect('/shop/index');
      return null;
    }
    $argument=compact('items');
    $_token=$this->generateCsrfToken('shop/purchase');
    $argument+=compact('_token');
    $authenticated=$this->session->isAuthenticated();
    $view=new View();
    $view->setLayoutVar('authenticated',$authenticated);
    return $view->render($route,$argument,true);
  }

    protected function purchaseAction($route){
      if($this->request->isPost()){
      if(!$token=$this->request->getPost('_token')||!$this->checkCsrfToken('shop/purchase',$token)){
        $this->redirect('/shop/index');
        return null;
        }
        if(!$this->session->get('cart')){
          $this->redirect('/shop/index');
          return null;
        }
        $total_price=$this->request->getPost('total_price');
        $user=$this->session->get('user');
        $order=new Order();
        $order->setValues(array($user['id'],$total_price));
        $order->save();
        $order_id=$order->getLastInsertId();
        $cart=$this->session->get('cart');
        $items=$cart->getItems();
        foreach($items as $item){
            $d_order=new D_order();
            $d_order->setValues(array($order_id,$item->product_id,$item->amount,$item->price));
            $d_order->save();
            }
      $this->session->remove('cart');
      $d_orders=$d_order->findBy('order_id',$order_id);
      $count=0;
      for($i=0;$i<count($items);$i++){
        if($items[$i]->product_id==$d_orders[$i]['product_id']&&$items[$i]->price==$d_orders[$i]['p_price']&&$items[$i]->amount==$d_orders[$i]['piece']){
          $count++;
        }
      }
      if($count===$i){
        $comment='正常に購入処理が終了しました。';
      }else{
        $comment='購入処理が正常に完了しませんでした。';
        $items=array();
        $total_price=0;
      }
      $argument=compact('comment');
      $argument+=compact('items');
      $argument+=compact('order_id');
      $argument+=compact('total_price');
      $authenticated=$this->session->isAuthenticated();
      $view=new View();
      $view->setLayoutVar('authenticated',$authenticated);
      return $view->render($route,$argument,true);
      }else{
        $this->redirect('/shop/index');
        return null;
      }
  }
}
?>
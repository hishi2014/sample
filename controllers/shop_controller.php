<?php
Class ShopController extends Controller{

protected $auth_actions=array('order','purchase');

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
    $id=$this->request->getGet('id');
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
      $cart->addItems($item);
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
    $cart=$this->session->get('cart');
    $items=$cart->getItems();
    $argument=compact('items');
    $authenticated=$this->session->isAuthenticated();
    $view=new View();
    $view->setLayoutVar('authenticated',$authenticated);
    return $view->render($route,$argument,true);
  }

    protected function purchaseAction($route){
      if($this->request->isPost()){
        if(!$this->session->get('cart')){
          $this->response->redirect('/shop/index');
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
      $argument=compact('items');
      $argument+=compact('order_id');
      $argument+=compact('total_price');
      $authenticated=$this->session->isAuthenticated();
      $view=new View();
      $view->setLayoutVar('authenticated',$authenticated);
      return $view->render($route,$argument,true);
      }
  }
}
?>
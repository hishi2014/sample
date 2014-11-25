<?php
Class ProductController extends Controller{
  protected function indexAction($route){
    $product=new Product();
    $products=$product->findAll();
    $argument=compact('products');
    $view=new View();
    return $view->render($route,$argument);
  }
  protected function showAction($route){
    $id=filter_input ( INPUT_GET , 'id' ,FILTER_SANITIZE_NUMBER_INT);
    $product=new Product();
    $item=$product->findOne($id);
    $argument=compact('item');
    $view=new View();
    return $view->render($route,$argument);
  }
}
?>
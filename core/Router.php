<?php
Class Router{

  public function resolve($pathinfo){
    $param=explode('/',$pathinfo);
    return $param;
  }
}
?>
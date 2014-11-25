<?php
Class Cart{
  protected $items=array();

  public function addItems(Item $item){
    $this->items[]=$item;
  }
  public function getItems(){
    return $this->items;
  }
  public function getItem($id){
    foreach($this->items as $item){
      if($item->product_id==$id){
        return $item;
      }
    }
    return null;
  }
}
?>
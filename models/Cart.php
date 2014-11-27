<?php
Class Cart{
  protected $items=array();

  public function addItem(Item $item){
    $this->items[]=$item;
  }
  public function getItems(){
    return $this->items;
  }
  public function deleteItem($id){
    foreach($this->items as $key=>$item){
      if($item->product_id==$id){
        unset($this->items[$key]);
        $this->items=array_values($this->items);
      }
    }
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
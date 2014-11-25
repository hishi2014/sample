<?php
Class Prototype{

  public function __get($property){

    if(self::checkExist($property)){
    return $this->$property;
  }else{
    throw new Exception('no property.');
  }
  }

  public function __set($property,$value){

    if(self::checkExist($property)){
    $this->$property=$value;
  }else{
    throw new Exception('no property.');
  }
  }
  protected function checkExist($property){

    $vars=get_class_vars(get_class($this));
    return array_key_exists($property,$vars);
  }

}
?>
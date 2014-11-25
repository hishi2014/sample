<?php
Class View{

  protected $layout_variables=array();

  public function render($file,$argument=array(),$_layout=false){
    extract($argument);
    ob_start();
    ob_implicit_flush(0);
    require $file;
    $content=ob_get_clean();
    if($_layout){
    $content=$this->render('views/layout.php',array_merge($this->layout_variables,array('_content'=>$content,)));
  }
    return $content;
  }
  public function setLayoutVar($name,$value){
    $this->layout_variables[$name]=$value;
  }
}
?>
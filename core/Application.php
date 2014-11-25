<?php
Class Application{

  protected $request;
  protected $response;
  protected $router;
  protected $session;

  function __construct(){
    $this->request=new Request();
    $this->response=new Response();
    $this->router=new Router();
    $this->session= new Session();
  }

  public function run(){
    $route=$this->router->resolve($this->request->getPathinfo());
    $controller=$this->findController($route[1]);
    $action=$route[2];
    $content=$controller->run($action);
    $this->response->setContent($content);
    $this->response->send();
  }

  protected function findController($route){
    require_once "controllers/{$route}_controller.php";
    $class_name=ucfirst($route).'Controller';
    return new $class_name($this);
  }

  public function getRequest(){
    return $this->request;
  }
  public function getResponse(){
    return $this->response;
  }
  public function getSession(){
    return $this->session;
  }

}
?>
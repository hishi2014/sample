<?php
Class Controller{
  protected $controller_name;
  protected $action_name;
  protected $application;
  protected $request;
  protected $response;
  protected $session;
  protected $auth_actions=array();

  public function __construct($application){
    $this->controller_name=strtolower(substr(get_class($this),0,-10));
    $this->application=$application;
    $this->request=$application->getRequest();
    $this->response=$application->getResponse();
    $this->session=$application->getSession();
  }
  public function run($action){
    $this->action_name=$action;
    $action_method=$this->action_name.'Action';
    if($this->needsAuthentication($action)&&!$this->session->isAuthenticated()){
        $this->redirect('/auth/login');
        return null;
    }
    $file="views/{$this->controller_name}/{$this->action_name}.php";
    $content=$this->$action_method($file);
    return $content;
  }

  protected function redirect($url){
    $this->response->setStatusCode(302,'Found');
    $this->response->setHttpHeader('Location',$url);
  }

  protected function generateCsrfToken($form){
    $key='csrf_tokens/'.$form;
    $tokens=$this->session->get($key,array());
    if(count($tokens)>=10){
      array_shift($tokens);
    }
    $token=sha1($form.session_id().microtime());
    $tokens[]=$token;
    $this->session->set($key,$tokens);
    return $token;
  }
  protected function checkCsrfToken($form,$token){
    $key='csrf_tokens/'.$form;
    $tokens=$this->session->get($key,array());

    if(false!==($pos=array_search($token,$tokens,true))){
      unset($tokens[$pos]);
      $this->session->set($key,$tokens);
      return true;
    }
    return false;
  }
  public function needsAuthentication($action){
    if($this->auth_actions===true||(is_array($this->auth_actions)&&in_array($action,$this->auth_actions))){
      return true;
    }
    return false;
  }
}
?>
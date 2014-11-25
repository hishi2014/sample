<?php
Class AuthController extends Controller{

  protected function loginAction($route){

    if($this->session->get('user')){
      $this->redirect('/shop/index');
    }

    if($this->request->isPost()&&$record=$this->authenticate()){
        $this->session->regenerate();
        $this->session->setAuthenticated(true);
        $this->session->set('user',$record);
        $before_auth_uri=$this->session->get('before_auth_uri');
        $this->session->remove('before_auth_uri');
        $this->redirect($before_auth_uri);
        return null;
    }

    if(empty($this->session->get('before_auth_uri'))){
      $this->session->set('before_auth_uri',$this->request->getReferer());
      }

    $view=new View($route);
    return $view->render($route,array('_token'=>$this->generateCsrfToken('auth/login')));
  }

  protected function logoutAction($route){
        $this->session->setAuthenticated(false);
    $this->session->remove('user');
    $view=new View($route);
    return $view->render($route);

  }

  protected function signupAction($route){

    if($this->request->isPost()){
    $token=$this->request->getPost('_token');
    if(!$this->checkCsrfToken('auth/signup',$token)){
      $this->redirect('/auth/signup');
      return null;
    }

    $user=new User();
    $name=filter_input ( INPUT_POST , 'name' ,FILTER_SANITIZE_SPECIAL_CHARS);
    $password =filter_input ( INPUT_POST , 'password' ,FILTER_SANITIZE_SPECIAL_CHARS);
    $user->saveUser($name,$password);
    $this->redirect('/auth/login');
    return null;
    }

    $view=new View($route);
    return $view->render($route,array('_token'=>$this->generateCsrfToken('auth/signup')));

  }

  protected function authenticate(){
    $token=$this->request->getPost('_token');
    if(!$this->checkCsrfToken('auth/login',$token)){
      $this->redirect('/auth/login');
      return null;
    }
      $name=$this->request->getPost('name');
      $password=$this->request->getPost('password');
      $user=new User();
      $record=$user->findUser($name,$password);
      return $record;
  }

}
?>
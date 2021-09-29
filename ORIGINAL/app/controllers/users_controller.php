<?php
class UsersController extends AppController {
  var $name = 'Users'; 
  var $helpers = array('Html', 'Form');
  var $components = array('Auth');
     
  function beforeFilter() {
//    $this->Auth->loginRedirect = array('controller' => 'activities', 'action' => 'index');
//    $this->Auth->loginError = 'You must be logged in to use this service.  Invalid username/password entered.';
    parent::beforeFilter();
    $this->Auth->authError = " ";
    $this->Auth->allow('register');
  }

  function login() {
    // blank -- provided in AuthComponent
  }
  
  function logout() {
    $this->redirect($this->Auth->logout());
  }
  
  function register() {
    if (!empty($this->data)) {
      if ($this->data['User']['password'] == $this->Auth->password($this->data['User']['password_confirm'])) {
        $this->User->create();
        if ($this->User->save($this->data)) {
          $this->Session->setFlash("You are now registered for this site.");
          $this->redirect('/');
        } //else {
          //$this->flash("There was a problem with your registration.", '/users/register');
//        }
      } else {
        $this->Session->setFlash("Your passwords did not match.  Please try again.");
      }
    }
  }
  
  function listusers() {
    $user = $this->Auth->user();
    debug($user);
    if($user['User']['is_admin'] != 1) {
      $this->cakeError("notAuthorized");
    }
    $this->set('users', $this->User->find("all"));
  }
}
?>
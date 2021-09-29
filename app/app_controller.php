<?php
class AppController extends Controller {
  function beforeFilter() {
    $this->set('user',$this->Auth->user());
    if (isset($this->Auth)) { 
      $this->Auth->authError = "";
    }
  }
}
?>
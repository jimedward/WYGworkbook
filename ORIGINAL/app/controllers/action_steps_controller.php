<?php
class ActionStepsController extends AppController {
  var $name = "ActionSteps";
  var $components = array('Auth');
  var $uses = array('User', 'ActionSteps');
  
  function index() {
    $this->set('action_steps', $this->ActionSteps->find('all', array('order' => 'order_id')));
    $user = $this->Auth->user();
    $thisuser = $this->User->read(null, $user['User']['id']);
    $steps = array();
    foreach ($thisuser['completedSteps'] as $step) {
      $steps[$step['action_step_id']] = $step;
    }
    $this->set('completed',$steps);
  }
}
?>
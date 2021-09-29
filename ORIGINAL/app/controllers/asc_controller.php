<?php

class AscController extends AppController {
  var $uses = array('AscTest', 'AscQuestion', 'AscResponse');
  var $components = array('Auth');
  var $helpers = array('Javascript');
  
  
  function index() {
    $this->set('title', "Weekly Authenticity Self Checkup");
    $questions = $this->AscQuestion->find('all', array('order' => '`order`'));
    $this->set('questions', $questions);
    $results = $this->_report();
    $this->set('results',$results);
  }
  
  function complete() {
    //TODO: this is duplicated code from PsaTest -- factor into one codebase
    if (!$this->_is_input_valid()) {
      $this->Session->setFlash("Please select a response for each question.");
      $this->redirect('index');
    } else {
      //response is valid, store it and display updated graphs
      $user = $this->Auth->user();
      $user_id = $user['User']['id'];
            
      $this->data = array('AscTest' => 
        array('user_id' => $user_id)
      );
      
      $questions = $this->AscQuestion->find('all');
      $responses = array();
      foreach($questions as $question) {
        array_push($responses, array(
          'response' => $_POST['q' . $question['AscQuestion']['id']],
          'asc_question_id' => $question['AscQuestion']['id'],
          ));
      }
      $this->data['AscResponse'] = $responses;
      //debug($this->data);
      $this->AscTest->saveall($this->data);
      $this->redirect('report');
    }
  }
  
  function report() {
    $this->set('title', "Weekly Authenticity Self Checkup");
    
    $this->set('results',$this->_report());
  }
  
  function graphdata() {
    Configure::write('debug', 0);
    
    $this->layout = 'xml';
    $results = $this->_report();
    $this->set('results',$results);
  }
  
  function _report() {
    $user = $this->Auth->user();
    $user_id = $user['User']['id'];
    
    $tests = $this->AscTest->find('all', array('conditions' => array('user_id' => $user_id), 'recursive' => 3));
    $results = array();
    foreach($tests as $test) {
      $results[] = $this->_test_results($test);
    }
    return $results;
  }
  
  /**
   * Take a AscTest array of the format returned by find with recursion level 3 (down through Questions 
   * and their categories) and calculate the average response for each category as a floating point number.
   * Returns an associative array mapping from each category to the score in that category.
   */
  function _test_results($test) {
    $results = array();
    $counts = array();
    foreach ($test['AscResponse'] as $response) {
      $cat = $response['AscQuestion']['category'];
      if (!array_key_exists($cat, $results)) {
        $counts[$cat] = 1;
        $results[$cat] = $response['response'];
      } else {
        $counts[$cat]++;
        $results[$cat] += $response['response'];
      }
    }
    foreach (array_keys($results) as $cat) {
      $results[$cat] /= $counts[$cat];
    }
    $results['completed'] = $test['AscTest']['created'];
  
    return $results;
  }
  
  /**
   * Answer true if each asc_question has a response in the POST and its value is 
   * in the range 1-7.
   */
  function _is_input_valid() {
    $questions = $this->AscQuestion->find('all');
    foreach ($questions as $question) {
      if(!isset($_POST['q' . $question['AscQuestion']['id']])) {
        return false; 
      }
      if(!in_array($_POST['q' . $question['AscQuestion']['id']],array(1,2,3,4,5,6,7))) {
        return false;
      }
    }
    return true;
  }
}

?>
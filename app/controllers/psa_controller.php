<?
class PsaController extends AppController {
  var $name = 'Psa';
  var $components = array('Auth');
  var $uses = array('User', 'PsaTest', 'PsaCategory', 'PsaResponse', 'PsaQuestion', 'CompletedStep');
  var $helpers = array('Javascript');
  
  function index() {
    $this->set('title', "Problem Self-Assessment");
    $this->layout = 'psa';
  }
  
  function evaluation() {
    $this->set('title', "Problem Self-Assessment");
    $this->layout = 'psa';
    
    $this->set('categories',$this->PsaCategory->find('all'), array('recursive' => true));
  }
  
  function pre() {
    //TODO(yinon): add notation that this is the pre assessment
    $this->redirect('index');
  }
  
  function post() {
    
  }
  
  /** 
   * Answer true iff each question specified in the database
   * is answered on a scale of 1 to 5 in the _POST values
   */
  function _is_input_valid() {
    $questions = $this->PsaQuestion->find('all');
    foreach($questions as $question) {
      if(!isset($_POST['q' . $question['PsaQuestion']['id']])) {
        return false; 
      }
      if(!in_array($_POST['q' . $question['PsaQuestion']['id']],array(1,2,3,4,5))) {
        return false;
      }
    }
    return true;
  }
  
  function complete() {
    $this->layout = 'psa';
    
    if (!$this->_is_input_valid()) {
      $this->Session->setFlash("Please select a response for each question.");
      $this->redirect('evaluation');
    } else {
      $user = $this->Auth->user();
      $user_id = $user['User']['id'];
      
      $this->data = array('PsaTest' => 
        array('user_id' => $user_id,
              'test_type' => 'pre'
        )
      );
      $questions = $this->PsaQuestion->find('all');
      $responses = array();
      foreach($questions as $question) {
        array_push($responses, array(
          'response' => $_POST['q' . $question['PsaQuestion']['id']],
          'psa_question_id' => $question['PsaQuestion']['id'],
          ));
      }
      $this->data['PsaResponse'] = $responses;
      //debug($this->data);
      $this->PsaTest->saveall($this->data);
      $this->CompletedStep->save(array('CompletedStep' => array(
              'user_id' => $user_id,
              'action_step_id' => 1, //TODO: set to 7 if post psa
              'report_id' => $this->PsaTest->id
              )));
      $this->redirect('report/' . $this->PsaTest->id);
    }
  }
  
  function testpdf() {
    Configure::write('debug', 0);
    $scores = array(1, 3.2, 4, 5, 3, 5, 2, 1.5);
    $this->set('scores', $scores);
    $this->layout = 'pdf';
    $this->render();
  }
  
  function listall() {
    $user = $this->Auth->user();
    if (!$user['User']['is_admin']) {
      $this->cakeError("notAuthorized");
    }
    $this->layout = 'psa';
    $tests = $this->PsaTest->find('all', array('recursive' => 0));
    $this->set('tests', $tests);
  }
  
  function report($id) {
    $this->set('title', "Problem Self-Assessment");    
    $user = $this->Auth->user();
    $this->layout = 'psa';
    $test = $this->PsaTest->find('first', array('conditions'=>array("PsaTest.id" => $id), 'recursive' => 2));
    if($test['PsaTest']['user_id'] != $user['User']['id'] && !$user['User']['is_admin']) {
      $this->cakeError("notAuthorized");
    }
    $sums = array();
    //calculate averages for each category
    foreach($test['PsaResponse'] as $response) {
      $key = $response['PsaQuestion']['psa_category_id'];
      if(!array_key_exists($key,$sums)) { $sums[$key] = 0; }
      $sums[$key] += $response['response'] / 5;
    }
    
    $questions_responses = array();
    foreach($test['PsaResponse'] as $response) {
      $key = $response['PsaQuestion']['psa_category_id'];
      
      if(!array_key_exists($key,$questions_responses)) { $questions_responses[$key] = array(); }
      array_push($questions_responses[$key], array($response['PsaQuestion']['order'], $response['PsaQuestion']['question'], $response['response']));
    
    }
    $category_names = array();
    foreach(array_keys($sums) as $category_id) {
      $cat = $this->PsaCategory->find('first', array('conditions'=>array("PsaCategory.id" => $category_id), 'recursive' => 0));
      $category_names[] = $cat['PsaCategory']['name'];
    }
    
    $category_results = array_map(create_function('$n','return sprintf("%0.1f",$n);'),array_values($sums));
    $serial =  base64_encode(serialize(array_map(create_function('$n','return sprintf("%0.1f",$n);'),$category_results)));
    
    $this->set('serial', $serial);
    $this->set('category_names', $category_names);
    $this->set('scores', $sums);
    $this->set('responses', $questions_responses);
  }
}
?>
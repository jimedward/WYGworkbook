<?
class GpeController extends AppController {
  var $name = 'Gpe';
  var $components = array('Auth', 'SwiftMailer');
  var $uses = array('User', 'CompletedStep');
  var $helpers = array('Javascript');
  
  function index() {
    $this->set('title', "Genius Profile Request");
    $user = $this->Auth->user();
    $thisuser = $this->User->read(null, $user['User']['id']);
    $this->set('fullname', $thisuser['User']['full_name']);
    $this->set('email', $thisuser['User']['email']);
  }
  
  function request() {
    if (!$this->_is_input_valid()) {
      $this->Session->setFlash("Please verify your responses and try again.");
      $this->redirect('index');
    } else {    
      $name = $this->data['full_name'];
      
      $msg = "A new WYG Genius Profile request has arrived:<br><br>\n\n";
      $msg .= "Full name: " . $this->data['full_name'] . "<br>\n";
      $msg .= "E-mail: " . $this->data['email'] . "<br>\n";
      $msg .= "Gender: " . $this->data['gender'] . "<br>\n";
      
      $this->SwiftMailer->smtpType = 'tls'; 
      $this->SwiftMailer->smtpHost = 'smtp.gmail.com'; 
      $this->SwiftMailer->smtpPort = 465; 
      $this->SwiftMailer->smtpUsername = 'customerservice@innermetrix.com'; 
      $this->SwiftMailer->smtpPassword = 'imx4444'; 
      
      $this->SwiftMailer->sendAs = 'html'; 
      $this->SwiftMailer->from = 'customerservice@innermetrix.com'; 
      $this->SwiftMailer->fromName = 'WYG Genius Profile Request'; 
      $this->SwiftMailer->to = 'jayn@innermetrix.com';
      $this->SwiftMailer->cc = 'innermetrix@gmail.com';
      $this->set('message', $msg);
      
      try { 
          if(!$this->SwiftMailer->send('wyg_notify', "WYG Genius Profile Request: $name")) { 
              $this->log("Error sending email"); 
          } 
      } 
      catch(Exception $e) { 
            $this->log("Failed to send email: ".$e->getMessage()); 
      }

         
      /*$this->Email->from = "WYG Genius Profile Request <jayn@innermetrix.com>";
      $this->Email->to = "Jay Niblick <jayn@innermetrix.com>";
      $this->Email->subject = "WYG Genius Profile Request: $name";
      $this->Email->sendAs = 'text';
      $this->Email->send($msg);*/
    }
  }
  
  
  function _is_input_valid() {
    $result = true;
    $result &= strpos($this->data['email'], "@") !== 0;
    $result &= in_array($this->data['gender'], array('m', 'f'));
    return $result;
  }
}
?>

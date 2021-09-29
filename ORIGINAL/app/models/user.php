<?php
class User extends AppModel {
  var $name = 'User';
  var $useTable = 'users';
  
  var $hasMany = 'completedSteps';
  
  var $validate = array(
    'username' => array(
      'minLength' => array(
        'rule'=>array('minLength', 3),
        'message' => "Minimum length is 3 letters"
      ),
      'unique' => array(
        'rule'=>'isUnique',
        'message' => "This username is already taken.  Please select another one."
      )
    ),
    'password_confirm' => array(
      'rule'=>array('minLength', 4)
    ),
    'email' => array(
      'rule' => 'email',
      'message' => 'Please enter a valid e-mail address.'
    )
  );
}
?>
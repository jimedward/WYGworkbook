<h1>Register an Account</h1>

<?php
if ($session->check('Message.auth')) {
 $session->flash('auth'); 
} 
if ($session->check('Message.flash')) {
	$session->flash();
}
echo $form->create('User', array('action' => 'register'));
echo $form->input('full_name', array('label' => 'Name', 'size' => 20));
echo $form->input('email', array('size'=>20));
echo $form->input('username', array('label' => 'Desired Username'));
echo $form->input('password', array('value' => ''));
echo $form->input('password_confirm', array('type' => 'password', 'label' => 'Confirm Password', 'value' => ''));
echo $form->submit('Register');
echo $form->end();
?>
<div class="welcome">
<p>
Welcome to the <strong>What’s Your Genius Workbook</strong>. This site contains all the exercises and activities you will need to make the most out of the book, What’s Your Genius, or the 5th Level Coaching Program. By using this workbook, you will learn how to make the lessons in the book practical and actually integrate them into you own life.</p><p> To access your workbook, simply create a new account by following the instructions below. Once you have logged in simply follow the instructions and complete the appropriate Genius Action Step. <strong>Print your results out and save them</strong> as you will need them throughout the different evolutions of the book or coaching program. </p>
<ul>
<li>This workbook is complimentary with either the book or the coaching program</li>
<li>Your workbook is secured and only you will have access to it</li>
<li>Even if you are working with a coach, only you will have this access</li>
<li>We will never use or release any of your information to anyone, period</li>
</ul>
<p>Enjoy and remember – Just Do You!<br/ >
-Jay Niblick
</p>
</div>

<h2>Sign In:</h2>
 <form action="register" method="post" style="display: inline;"><input style="display: inline; background-color: #f1c808" type="submit" value="New User? Sign Up Here"></form></h4>
<?php
//if ($session->check('Message.auth')) {
// $session->flash('auth'); 
//}
echo $form->create('User', array('action' => 'login'));
echo $form->input('username', array('length' => 10));
echo $form->input('password');
echo $form->end('Login');

if ($session->check('Message.flash')) {
	$session->flash();
}
if ($session->check('Message.auth')) {
	$session->flash('auth');
}

?>
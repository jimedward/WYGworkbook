<?php echo $html->css('gpe_style'); ?>
<?php echo $javascript->link('/vendors/js/prototype');?>
<?php echo $javascript->link('/vendors/js/effects');?>
<h2>Request a Genius Profile</h2>

<p class='instructions'>Please verify and complete the information below and we will e-mail you instructions to complete the <em>What's Your Genius</em> Genius Profile within 24 hours.</p>

<div id='submit' class='page'>

<?php echo $form->create(false, array('url' => array('action'=>'request','controller' => 'gpe')))?>
<?
echo $form->input('full_name', array('label' => 'Name', 'size' => 20, 'value'=>$fullname));
echo $form->input('email', array('size'=>20, 'value'=>$email));
echo $form->radio('gender', array('m' => 'Male', 'f' => 'Female'), array('label'=>'Gender'));
?>
<?= $form->end('Submit Request'); ?>
</div>

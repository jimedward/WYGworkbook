<?php echo $html->css('asc_style'); ?>
<?php echo $javascript->link('/vendors/js/prototype');?>
<?php echo $javascript->link('/vendors/js/effects');?>
<?php echo $javascript->link('/vendors/js/FusionCharts');?>
<?php echo $javascript->includeScript('asc_actions');?>
<h2>Weekly Authenticity Self Checkup</h2>
<p class='instructions'>At least once a week, complete the following self-quiz regarding how authentic you were.  The trend graph at the bottom will help you link your level of authenticity with your level of satisfaction and performance. Each of these items represents one of the three classes of talent (Head, Hand or Heart)</p>

<h3>This week I was more or less of the following:</h3>
<p class='tip'>Tip: Complete this in rapid fire mode, by going with your first thought or gut reaction to the selection</p>
<div id='submit'>

<?php echo $form->create('AscTest', array('url' => array('action'=>'complete','controller' => 'asc'), 'onsubmit'=>'return checkform();'))?>

<table class='asc_instrument'>
  <tr>
    <th></th>
    <th>1</th>
    <th>2</th>
    <th>3</th>
    <th>4</th>    
    <th>5</th>
    <th>6</th>    
    <th>7</th>
    <th></th>
    <th></th>
  </tr>
  <?
  foreach ($questions as $question) {
    $question = $question['AscQuestion'];
  ?>
  <tr id='row_for_q<?=$question['id']?>' >
    <th class='low'><?=$question['low_response']?></th>
    <? foreach (array(1,2,3,4,5,6,7) as $i) { ?>
    <td><input type='radio' value='<?=$i?>' name='q<?=$question['id']?>' /></td>
    <? } ?>
    <th class='high'><?=$question['high_response']?></th>
    <th id='status_for_q<?=$question['id']?>'></th>
  </tr>
  <? } ?>
</table>
  <div id="errorplaceholder" style="display: none;">Please make sure you complete each item on this form.  Incomplete items are highlighted in red.</div>

<?= $form->end('Submit'); ?>
</div>

  <h2>Previous Results</h2>
<?=$this->renderElement('asc_report')?>
</div>
<?php echo $html->css('psa_style'); ?>
<style>
body {
  font-size: 90%;
}
</style>
<?php echo $javascript->link('/vendors/js/prototype');?>
<?php echo $javascript->link('/vendors/js/effects');?>
<?php echo $javascript->includeScript('psa_actions');?>
<?php echo $form->create('PsaTest', array('url' => array('action'=>'complete','controller' => 'psa'), 'onsubmit'=>'return checkform();'))?>

<h1>Problem Self Assessment</h1>

<? for ($i = 1; $i <= count($categories); $i++) { 
     $category=$categories[$i-1]['PsaCategory'];
     $questions=$categories[$i-1]['PsaQuestion'];
?>
  <h3><?=$category['name']?></h3>
  <table>
    <? for ($j = 1; $j <= count($questions); $j++) {
    $question = $questions[$j-1]['question'];
    $question_id = $questions[$j-1]['id'];
    $qname = 'c' . $i . 'q' . $j;

 ?>
      <tr id="<?=$question_id . "-tr"?>">
       <td><?=$j?>.</td>
       <td class='questioncell'><?=$question?></td>
       <td>1</td>
      <? for ($k = 1; $k <= 5; $k++) { ?>
        <td><input type="radio" onclick='updatestatus("q<?=$question_id?>");' id="q<?=$question_id . "-" . "$k"?>" name="q<?= $question_id ?>" value='<?=$k?>' /></td>
      <? } ?>
       <td>5</td>
       <td class="selectionverify" id="statusq<?=$question_id?>"></td>
      </tr>
    <? }?>
  </table>
<? } ?>
<div id="submit">
<div id="errorplaceholder" style="display: none;">Please make sure you complete each item on this form.  Incomplete items are highlighted in red.</div>
<input type='submit' value="Submit" />
</div>
</form>

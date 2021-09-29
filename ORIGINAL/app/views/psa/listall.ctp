<?php echo $html->css('psa_style'); ?>

<table border=1>
  <tr>
    <th>User</th>
    <th>Full Name</th>
    <th>Test Type</th>
    <th>Date</th>
    <th>Report Id</th>
  </tr>
  <?foreach($tests as $test) {?>
  
  <tr>
      <td><?=$test['User']['username']?></td>
      <td><?=$test['User']['full_name']?></td>
      <td><?=$test['PsaTest']['test_type']?></td>
      <td><?=$test['PsaTest']['created']?></td>
      <td><?=$html->link($test['PsaTest']['id'], array('action' => 'report', $test["PsaTest"]['id']))?></td>
  </tr>
  <? } ?>
</table>
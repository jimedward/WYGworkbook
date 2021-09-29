<h2>Genius Action Steps</h2>
<div class="welcome">
<p>Welcome to your <strong>What's Your Genius Workbook</strong>. The Genius Action Steps below are your secret to making the lessons in the book, What’s Your Genius, go to work for you. They are listed below in the order they appear in the book (or the 5th Level Coaching Program). While you can complete any of them at any time, I strongly recommend that you only complete the actions steps one at a time and when instructed to do so in the book or by your coach, because each one ties into a key part of the personal evolution program. To complete an action step simply click on the item below.</p>
</div>
<br />
<table>
  <tr>
    <th>Step</th>
    <th>Action Step</th>
  </tr>
  <?php foreach ($action_steps as $action_step) { ?>
  <tr>
    <td><?= $action_step['ActionSteps']['display_step']?></td>
    <td><?php
      if($action_step['ActionSteps']['url']) {
        if(array_key_exists($action_step['ActionSteps']['id'],$completed)) {
          if($action_step['ActionSteps']['report_url']) {
            echo $html->link($action_step['ActionSteps']['title'], $action_step['ActionSteps']['report_url'] . $completed[$action_step['ActionSteps']['id']]['report_id']);
          } else {
            //Figure out what to do here
          }
        } else {
          echo $html->link($action_step['ActionSteps']['title'], $action_step['ActionSteps']['url']); 
          if ($action_step['ActionSteps']['comment']) {
            echo " <font color='red'>" . $action_step['ActionSteps']['comment'] . "</font>";
          }
        }
      } else {
        echo $action_step['ActionSteps']['title'];
      }
      ?></td>
  </tr>
  <?php } ?>
</table>

<p style="margin-left: 2em"><font color="red">*Note: The Genius Profiles are individually evaluated by
  Jay Niblick. You will receive your results as soon as possible via email.</font></p>

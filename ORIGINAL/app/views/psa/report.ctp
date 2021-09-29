<?php echo $html->css('psa_style'); ?>
<?php echo $html->css('report_style'); ?>
<div class="limitwidth">
<h1>The Problem Self-Assessment Report</h1>
<p>
Welcome to The Problem Pre-Assessment, a diagnostic tool created in conjunction with Innermetrix, Inc. and What's Your Genius.  Innermetrix creates diagnostic tools for business and personal use that help individuals and organizations measure intangibles that might be affecting performance.</p>

<p>Your Pre-Assessment will play a crucial role in your making the most out of the lessons contained in the book, What's Your Genius.  This assessment looks at eight core areas of your life that may or may not be contributing to The Problem (as defined in the opening chapters of What's Your Genius). This holistic approach serves as the first step in identifying specific areas that might require your attention as you work through the book or coaching program.</p>

<p>
<h2>The eight categories are:</h2>
<ul>
<li>Self-Awareness         </li>
<li>Authenticity           </li>
<li>Level of Performance   </li>
<li>Self-Direction         </li>
<li>Role Awareness         </li>
<li>Self-Belief            </li>
<li>Effort/Ease            </li>
<li>Level of Satisfaction  </li>
</ul>
</p>

<p>Each category receives its own total score. Print this report out and use it as you work through the rest of the book or coaching program, giving priority attention to those categories with the lowest overall score.</p>

<h2>Legend</h2>
<ul class='nobullet'>
<li><span class='legendcategory'>0.0 - 1.5</span> = Below Average (immediate attention required)</li>
<li><span class='legendcategory'>1.5 - 2.5</span> = Average (urgent attention should be given)</li>
<li><span class='legendcategory'>2.5 - 3.5</span> = Above Average (investigation recommended)</li>
<li><span class='legendcategory'>3.5 - 4.5</span> = Excellent (areas that you can leverage for greater performance)</li>
<li><span class='legendcategory'>4.5 - 5.0</span> = Genius (a significant advantage for you – protect and reinforce)</li>
</ul>
<p>
If you scored less than four in any single category than that category should become a primary focus in the exercises in the book. Print a copy of this self-assessment out so you can refer back to it from time to time as we discuss each individual category throughout the rest of this book. 
</p>
</div>
<div class='center'>
  <table>
    <tr>
      <td>
<img src="/workbook/radar/radar.php?q=<?=$serial?>">
</td><td>
<table>
  <tr>
    <th>Category</th><th>Score</th>
  </tr>
  <? for ($i = 0; $i < count($scores) ; $i++) { ?>
    <tr>
      <td><?=$category_names[$i]?></td><td><?=sprintf("%1.1f",$scores[$i+1])?></td>
    </tr>
  <? } ?> 
</table>
</tr>
</table>
</div>
<div class='limitwidth'>
<?$i=0?>
<?foreach($responses as $category_responses) {
  ?>
  <table class='breakdown'>
    <tr>
    <th class='categoryname' colspan="2">
      <?=$category_names[$i]?>

    </th>
    </tr>
    <?foreach($category_responses as $response) {?>
    <tr>
      <td class='question'>
        <?= $response[0] //order?>.
        <?= $response[1] //question?>
      </td>
      <td class='qaverage'>
        <?= $response[2] //response?>
      </td>
    </tr>
    <? } ?>
    <tr class='categorysummary'>
      <td class='subtotal'>Category average:</td>
      <td class='qaverage'><?=sprintf("%1.1f",$scores[$i+1])?></td>
    </tr>
  </table>
  
<?  $i++; 
}?>
</div>


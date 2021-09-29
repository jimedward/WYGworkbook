<?if(count($results) > 0) {?>

<div id='chartdiv' align="center"></div>
<script type="text/javascript">
    var myChart = new FusionCharts("/workbook/files/charts/FCF_MSLine.swf", "myChartId", "800", "350");
    myChart.setDataURL("/workbook/asc/graphdata");
    myChart.render("chartdiv");
</script>
<div id='results'>


<table>
  <tr>
    <th>Take</th><th>Date</th><th>Authenticity Score</th><th>Satisfaction Score</th><th>Performance Score</th>
  </tr>
  <? $i=0;
    foreach($results as $result) {
      $i++;?>
    <tr>
      <td><?=$i?></td>
      <td><?=date('F j, Y',strtotime($result['completed']))?></td>
      <td><?=sprintf("%0.1f",$result['Authenticity'])?></td>
      <td><?=sprintf("%0.1f",$result['Satisfaction'])?></td>
      <td><?=sprintf("%0.1f",$result['Performance'])?></td>
    </tr>
  <? } ?>
</table>
<?} else { //no results?>
  <div class='noresults'>
  Please check here for results after you have completed the Authenticity Self Checkup.
  </div>
<?}?>
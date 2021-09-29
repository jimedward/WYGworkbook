<graph caption='Weekly Authenticity Self Checkup' xAxisName='Take' yAxisName='Score' showNames='1' decimalPrecision='1' formatNumberScale='0' numdivlines='5' numVdivlines='<?=max(count($results)-2,0)?>' yaxisminvalue='1' yaxismaxvalue='7' showLegend='1' animation='1' chartLeftMargin='25' chartRightMargin='25' chartTopMargin='0' chartBottomMargin='0' canvasBgColor='CFE1FB' canvasBgAlpha='50' lineThickness='3' anchorRadius='5' anchorSides='10'>
  <categories>
    <?foreach ($results as $result) {?>
    <category name='<?=date('M j, Y',strtotime($result['completed']))?>' />
    <?}?>
  </categories>
  <dataSet seriesName='Authenticity' color='DA262A' anchorBgColor='DA262A' anchorBorderColor='000000'>
    <?foreach ($results as $result) {?>
    <set value='<?=sprintf('%0.1f',$result['Authenticity'])?>' />
    <?}?>
  </dataSet>
  <dataSet seriesName='Satisfaction' color='2A61B2' anchorBgColor='2A61B2' anchorBorderColor='000000'>
    <?foreach ($results as $result) {?>
    <set value='<?=sprintf('%0.1f',$result['Satisfaction'])?>' />
    <?}?>
  </dataSet>
  <dataSet seriesName='Performace' color='BFBF1D' anchorBgColor='BFBF1D' anchorBorderColor='000000'>
    <?foreach ($results as $result) {?>
    <set value='<?=sprintf('%0.1f',$result['Performance'])?>' />
    <?}?>
  </dataSet>
</graph>
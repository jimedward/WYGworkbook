<?php echo $html->css('asc_style'); ?>
<?php echo $javascript->link('/vendors/js/prototype');?>
<?php echo $javascript->link('/vendors/js/effects');?>
<?php echo $javascript->link('/vendors/js/FusionCharts');?>
<h2>Weekly Authenticity Self Checkup : View Report</h2>
<?=$this->renderElement('asc_report')?>

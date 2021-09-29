<?php
class AscTest extends AppModel {
  var $hasMany = 'AscResponse';
  var $belongsTo = 'User';
}
?>
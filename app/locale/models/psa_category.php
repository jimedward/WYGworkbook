<?php

class PsaCategory extends AppModel {
  var $name = 'PsaCategory';
  var $hasMany = array(
    'PsaQuestion' => array(
      'order' => "`order` ASC"));
  
}

?>
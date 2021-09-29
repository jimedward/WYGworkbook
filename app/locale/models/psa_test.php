<?php

class PsaTest extends AppModel {
  var $hasMany = 'PsaResponse';
  var $belongsTo = 'User';
}

?>
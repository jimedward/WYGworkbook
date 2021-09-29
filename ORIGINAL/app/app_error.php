<?php

class AppError extends ErrorHandler {
  function notAuthorized() {
    $this->__outputMessage('not_authorized');
  }
}
?>
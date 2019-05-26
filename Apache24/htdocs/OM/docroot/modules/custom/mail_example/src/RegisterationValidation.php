<?php

namespace Drupal\mail_example;

class RegisterationValidation {

  public function productTitleValidate($prodtitle) {
    if(!preg_match("/^[a-zA-Z'-]+$/",$prodtitle)) {
      $this->messenger()->addMessage($this->t('Invalid title successfully'));
    }
  }
}
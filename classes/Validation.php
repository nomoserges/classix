<?php

/**
 * Class Validation: Validation du contenu des formulaires
 */
class Validation {
  
  public function check_empty($data, $fields) {
    $msg = null;
    foreach ($fields as $value) {
      if (empty($data[$value])) { $msg .= "$value field empty <br />"; }
    } 
    return $msg;
  }
    
  public function is_email_valid($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {    
      return true;  
    }
    return false;
  }
}
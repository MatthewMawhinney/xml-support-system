<?php
Class Validate
{
  public function emptyString($value){
    if($value == ''){
        return true;
    }
    else {
        return false;
    }
  }
  public function nameCheck($value){
    $namePattern = "/^[A-Za-z0-9 ]{6,20}$/";
    if(!preg_match($namePattern, $value)){
        return true;
    }
    else {
        return false;
    }
  }
  public function passCheck($value){
    $passPattern = "/^[A-Za-z0-9!@#$%^&*_- ]{8,20}$/";
    if(!preg_match($passPattern, $value)){
        return true;
    }
    else {
        return false;
    }
  }
}


?>

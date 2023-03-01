<?php
//This is responsible for user-form validations
class Forms{
  public $first_name="";
  public $last_name="";
  public $fullName="";
  public $fnameError="";
  public $lnameError="";
  public $invalid_fname=false;
  public $invalid_lname=false;
  //public $status=false;

  /**
   * Undocumented function
   *
   * @param [string] $firstName : User first name
   * @param [string] $lastName : User last name
   * This function is used for form validation. If input feild will be invalid then it will show error message and return false,
   * And if input feild will be valid then it will show welcome message and return true value.
   * @return boolean
   */
  function validForm($firstName, $lastName){
    if($firstName === "" && $lastName === ""){
      $this->fnameError = "Enter First Name";
      $this->lnameError = "Enter Last Name";
      $this->invalid_fname=true;
      $this->invalid_lname=true;
      return null;
    }else if($firstName === ""){
      $this->fnameError = "Enter First Name";
      $this->invalid_fname=true;
      $this->last_name = $lastName;
      if (!preg_match("/^[a-zA-Z]*$/",$lastName)){
          $this->lnameError = "Only letters allowed";
          $this->invalid_lname=true;
          return null;
      }
    }else if($lastName === ""){
      $this->fnameError = "Enter last Name";
      $this->invalid_lname = true;
      $this->first_name = $firstName;
      if (!preg_match("/^[a-zA-Z]*$/",$firstName)){
          $fnameError = "Only letters allowed";
          $this->invalid_fname = true;
          return null;
      }
    }else{
      $this->first_name = $firstName;
      $this->last_name = $lastName;
      if (!preg_match("/^[a-zA-Z]*$/",$firstName)){
          $this->fnameError = "Only letters allowed";
          $this->invalid_fname=true;
          return null;
      }
      else if (!preg_match("/^[a-zA-Z]*$/",$lastName)){
          $this->lnameError = "Only letters allowed";
          $this->invalid_lname = true;
          return null;
      }else{
        $this->fullName = $firstName." ".$lastName;
        //$this->status=true;
        return $this->fullName;
      }
    }

  }

}
?>
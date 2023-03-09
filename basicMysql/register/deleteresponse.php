<?php
  session_start();
  require '../mysqlClass.php';

  if(isset($_POST['sendOtp'])){
    $delete_obj = new MysqlMethods();

    $_SESSION['del_name'] = $_POST['username'];
    $_SESSION['del_pwd'] = $_POST['userpwd'];
    if($delete_obj->getLogin($_POST['username'], $_POST['userpwd'])){
      $confirm = $delete_obj->otpSend($_POST['username']);
      $getOtp = $delete_obj->otpValue;
      $_SESSION['otp_validation'] = $delete_obj->validUser;
      $_SESSION['cotp_name'] = $_POST['username'];
      $_SESSION['get_otp'] = $getOtp;

    if($confirm){
      header("location: deleteotp.php");
    }
    else{
      header("location: delete.php");
    }
    }
    else{
      $_SESSION['del_status'] = $delete_obj->statusName;
      $_SESSION['del_status'] = $delete_obj->statusPwd;
      header("location: delete.php");
    }
  }
  else if(isset($_POST['delete'])){
    $cnf_user = new MysqlMethods();

    if(number_format($_SESSION['get_otp']) == number_format($_POST['otp'])){
      if(isset($_SESSION['del_name']) && isset($_SESSION['del_pwd'])){
        $cnf_status = $cnf_user->deleteUser($_SESSION['del_name'], $_SESSION['del_pwd']);
        if($cnf_status){
          session_unset();
          header("location: deleteotp.php");
          //echo "Success!!!";
        }
      }
     else{
      //echo "Error";
      header("location: delete.php");
     }
    }
    else{
      echo "Invalid OTP";
      $_SESSION['otp_status'] = true;
      header("location: deleteotp.php");
    }
  }
  else{
    header("location: delete.php");
  }
?>
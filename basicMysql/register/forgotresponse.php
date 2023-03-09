<?php
  session_start();

  require '../mysqlClass.php';

  if(isset($_POST['submitBtn'])){
    $forgot_obj = new MysqlMethods();

    $_SESSION['cotp_npassword'] = $_POST['npassword'];
    if(isset($_SESSION['cotp_username'])){
      if(number_format($_SESSION['get_otp']) == number_format($_POST['otp'])){
        $_SESSION['otp_status'] = false;

        $forgot_status = $forgot_obj->confirmPwd($_SESSION['cotp_username'], $_POST['npassword']);
        $_SESSION['valid_user'] = $forgot_obj->validUser;

        if($forgot_status){
          //echo "Chnaged";
          session_unset();
          header("location: ../login/login.php");
        }
        else{
          //echo "Error in fotgotStatus";
          header("location: forgot.php");
        }
      }
      else{
        $_SESSION['otp_status'] = true;
        header("location: otpresponse.php");
      }
    }
    else{
      header("location: forgot.php");
    }
  }
  else if(isset($_POST['otpSubmit'])){
    $otp_obj = new MysqlMethods();

    $forgot_status = $otp_obj->otpSend($_POST['name']);
    $getOtp = $otp_obj->otpValue;

    $_SESSION['valid_user'] = $otp_obj->validUser;
    $_SESSION['cotp_username'] = $_POST['name'];
    $_SESSION['get_otp'] = $getOtp;

    if($forgot_status){
      header("location: otpresponse.php");
    }
    else{
      header("location: forgot.php");
    }
  }
  else{
    //echo "Error in fetching the method";
    header("location: forgot.php");
  }
?>
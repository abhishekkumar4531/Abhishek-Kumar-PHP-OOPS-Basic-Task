<?php
  session_start();

  require("../rootClass.php");

  if(isset($_POST['submitBtn'])){
    $foObj = new RootClass();

    $_SESSION['cotp_npassword'] = $_POST['npassword'];
    if(isset($_SESSION['cotp_username'])){
      if(number_format($_SESSION['get_otp']) == number_format($_POST['otp'])){
        $_SESSION['otp_status'] = false;

        $forgotSatus = $foObj->confirmPwd($_SESSION['cotp_username'], $_POST['npassword']);
        $_SESSION['valid_user'] = $foObj->valid_user;

        if($forgotSatus){
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
    $otpObj = new RootClass();

    $forgotSatus = $otpObj->otpSend($_POST['name']);
    $getOtp = $otpObj->otpStatus;

    $_SESSION['valid_user'] = $otpObj->valid_user;
    $_SESSION['cotp_username'] = $_POST['name'];
    $_SESSION['get_otp'] = $getOtp;

    if($forgotSatus){
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
<?php
  session_start();
  require("../mysqlClass.php");

  if(isset($_POST['sendOtp'])){
    echo "Step-1<br>";
    $delObj = new MysqlMethods();

    $_SESSION['del_name'] = $_POST['username'];
    $_SESSION['del_pwd'] = $_POST['userpwd'];
    if($delObj->getLogin($_POST['username'], $_POST['userpwd'])){
      echo "Step-2<br>";
      $confirm = $delObj->otpSend($_POST['username']);
      $getOtp = $delObj->otpStatus;
      $_SESSION['otp_validation'] = $otpObj->valid_user;
      $_SESSION['cotp_name'] = $_POST['username'];
      $_SESSION['get_otp'] = $getOtp;

    if($confirm){
      header("location: deleteotp.php");
    }
    else{
      echo "Error";
      header("location: delete.php");
    }
    }
    else{
      $_SESSION['del_status'] = $delObj->status_name;
      $_SESSION['del_status'] = $delObj->status_pwd;
      // header("location: delete.php");
      echo "Error";
    }
  }
  else if(isset($_POST['delete'])){
    $cnfUser = new MysqlMethods();

    if(number_format($_SESSION['get_otp']) == number_format($_POST['otp'])){
      if(isset($_SESSION['del_name']) && isset($_SESSION['del_pwd'])){
        $cnfStatus = $cnfUser->deleteUser($_SESSION['del_name'], $_SESSION['del_pwd']);
        session_unset();
        header("location: deleteotp.php");
        //echo "Success!!!";
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
<?php
  session_start();

  require '../mysqlClass.php';

  if(isset($_POST['submitBtn'])){
    $forgot_obj = new MysqlMethods();

    $forgot_status = $forgot_obj->forgotPwd($_POST['name'], $_POST['cpassword'], $_POST['npassword']);

    $_SESSION['valid_user'] = $forgot_obj->validUser;
    $_SESSION['for_username'] = $_POST['name'];
    $_SESSION['for_cpassword'] = $_POST['cpassword'];
    $_SESSION['for_npassword'] = $_POST['npassword'];

    if($forgot_status){
      session_unset();
      header("location: ../login/login.php");
    }
    else{
      header("location: change.php");
    }
  }
  else{
    header("location: change.php");
  }
?>
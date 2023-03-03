<?php
  session_start();

  require("../rootClass.php");

  if(isset($_POST['submitBtn'])){
    $foObj = new RootClass();

    $forgotSatus = $foObj->forgotPwd($_POST['name'], $_POST['cpassword'], $_POST['npassword']);

    $_SESSION['valid_user'] = $foObj->valid_user;
    $_SESSION['for_username'] = $_POST['name'];
    $_SESSION['for_cpassword'] = $_POST['cpassword'];
    $_SESSION['for_npassword'] = $_POST['npassword'];

    if($forgotSatus){
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
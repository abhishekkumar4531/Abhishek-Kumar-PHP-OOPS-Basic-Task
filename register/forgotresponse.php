<?php
  session_start();

  require("../rootClass.php");

  $foObj = new RootClass();

  $forgotSatus = $foObj->forgotPwd($_POST['name'], $_POST['cpassword'], $_POST['npassword']);

  if($forgotSatus){
    header("location: ../login/login.php");
  }
  else{
    header("location: forgot.php");
  }
?>
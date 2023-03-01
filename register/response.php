<?php
  session_start();

  require("../rootClass.php");

  $regObj = new RootClass();

  $regStatus = $regObj->getRegister($_POST['name'], $_POST['pwd'], $_POST['mobile'], $_POST['email']);

  if($regStatus){
    header("location: ../login/login.php");
  }else{
    header("location; register.php");
  }
?>
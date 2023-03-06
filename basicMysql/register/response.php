<?php
  session_start();
  require("../mysqlClass.php");

  if(isset($_POST['submitBtn'])){
    $regObj = new MysqlMethods();

    $regStatus = $regObj->getRegister($_POST['name'], $_POST['pwd'], $_POST['mobile'], $_POST['email']);

    $_SESSION['unique_status'] = $regObj->unique_status;
    $_SESSION['reg_name'] = $_POST['name'];
    $_SESSION['reg_pwd'] = $_POST['pwd'];
    $_SESSION['reg_mobile'] = $_POST['mobile'];
    $_SESSION['reg_email'] = $_POST['email'];

    if($regStatus){
      session_unset();
      header("location: ../login/login.php");
    }
    else{
      header("location: register.php");
    }
  }
  else{
    header("location: register.php");
  }
?>
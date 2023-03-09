<?php
  session_start();
  require '../mysqlClass.php';

  if(isset($_POST['submitBtn'])){
    $reg_obj = new MysqlMethods();

    $reg_status = $reg_obj->getRegister($_POST['name'], $_POST['pwd'], $_POST['mobile'], $_POST['email']);

    $_SESSION['unique_status'] = $reg_obj->uniqueStatus;
    $_SESSION['reg_name'] = $_POST['name'];
    $_SESSION['reg_pwd'] = $_POST['pwd'];
    $_SESSION['reg_mobile'] = $_POST['mobile'];
    $_SESSION['reg_email'] = $_POST['email'];

    if($reg_status){
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
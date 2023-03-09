<?php
  session_start();
  require '../mysqlClass.php';
  if(isset($_POST['submitBtn'])){
    $login_obj = new MysqlMethods();

    $_SESSION['logged_user'] = $_POST['username'];
    $_SESSION['logged_pwd'] = $_POST['userpwd'];
    if($login_obj->getLogin($_POST['username'], $_POST['userpwd'])){
      $_SESSION['login_user'] = $login_obj->getName;
      header("location: ../../phoneForm/task4.php");
    }
    else{
      $_SESSION['logged_nstatus'] = $login_obj->statusName;
      $_SESSION['logged_pstatus'] = $login_obj->statusPwd;
      header("location: login.php");
    }
  }
  else{
    header("location: login.php");
  }
?>
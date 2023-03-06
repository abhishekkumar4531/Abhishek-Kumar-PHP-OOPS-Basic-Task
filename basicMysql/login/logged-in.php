<?php
  session_start();
  require("../mysqlClass.php");
  if(isset($_POST['submitBtn'])){
    $loginObj = new MysqlMethods();

    $_SESSION['logged_user'] = $_POST['username'];
    $_SESSION['logged_pwd'] = $_POST['userpwd'];
    if($loginObj->getLogin($_POST['username'], $_POST['userpwd'])){
      $_SESSION['login_user'] = $loginObj->getname;
      header("location: ../../phoneForm/task4.php");
    }
    else{
      $_SESSION['logged_nstatus'] = $loginObj->status_name;
      $_SESSION['logged_pstatus'] = $loginObj->status_pwd;
      header("location: login.php");
    }
  }
  else{
    header("location: login.php");
  }
?>
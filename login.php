<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User-Login</title>
  <style>
    body{
     font-family: Arial;
     margin: 0 auto;
     width: 1200px;
  }
  span{
    color: red;
  }
  input{
    padding: 5px;
  }
  </style>
</head>
<body>

  <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
      $getname = $_POST['username'];
      $getpwd = $_POST['userpwd'];
      $_SESSION['login_user']=$getname;
      global $status;
      $status=false;
      if($getname==="Abhi" && $getpwd==="abhi@45"){
        header("location: phoneForm/task4.php");
      }else{
        if($getname!="Abhi" && $getpwd!="abhi@45"){
          $status_name=true;
          $status_pwd=true;
        }else if($getname!="Abhi"){
          $status_name=true;
        }else if($getpwd!="abhi@45"){
          $status_pwd=true;
        }
      }
    }
  ?>

  <h1>Login-Page</h1>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="username">Enter User-Name</label><br>
    <input type="text" name="username" placeholder="Enter : Abhi" value="<?php echo $getname ?>">
    <span>
      <?php
        if($status_name){
          echo "Enter valid user-name : Abhi";
        }
      ?>
    </span>
    <br><br>
    <label for="username">Enter User-Password</label><br>
    <input type="text" name="userpwd" placeholder="Enter:abhi@45" value="<?php echo $getpwd ?>">
    <span>
      <?php
        if($status_pwd){
          echo "Enter valid user-pwd:abhi@45";
        }
      ?>
    </span>
    <br><br>
    <input type="submit">
  </form>
</body>
</html>
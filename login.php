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
    if(isset($_SESSION['login_user'])){
      header("location: index.php");
    }
    require("rootClass.php");
    $loginObj = new RootClass();

    if($_SERVER["REQUEST_METHOD"]=="POST"){
      if($loginObj->getLogin($_POST['username'], $_POST['userpwd'])){
        $_SESSION['login_user'] = $loginObj->getname;
        header("location: phoneForm/task4.php");
      }
    }
  ?>

  <h1>Login-Page</h1>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    <label for="username">Enter User-Name</label><br>
    <input type="text" name="username" placeholder="Enter : Abhi" value="<?php echo $loginObj->getname; ?>">
    <span>
      <?php
        if($loginObj->status_name){
          echo "Enter valid user-name : Abhi";
        }
      ?>
    </span>
    <br><br>

    <label for="username">Enter User-Password</label><br>
    <input type="text" name="userpwd" placeholder="Enter:abhi@45" value="<?php echo $loginObj->getpwd; ?>">
    <span>
      <?php
        if($loginObj->status_pwd){
          echo "Enter valid user-pwd:abhi@45";
        }
      ?>
    </span>
    <br><br>

    <input type="submit">

  </form>
</body>
</html>
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
    div{
      margin-top: 10px;
    }
  </style>
</head>
<body>

  <?php
    if(isset($_SESSION['login_user'])){
      header("location: ../index.php");
    }

    //require("rootClass.php");
    //$loginObj = new RootClass();
  ?>

  <h1>Login-Page</h1>

  <form action="logged-in.php" method="post">

    <label for="username">Enter User-Name</label><br>
    <input type="text" name="username" placeholder="Enter : Abhi" value="<?php if(isset($_SESSION['logged_user'])){echo $_SESSION['logged_user'];} ?>" required>
    <span>
      <?php
        if(isset($_SESSION['logged_nstatus']) && $_SESSION['logged_nstatus']){
          echo "Enter valid user-name : Abhi";
        }
      ?>
    </span>
    <br><br>

    <label for="username">Enter User-Password</label><br>
    <input type="text" name="userpwd" placeholder="Enter:abhi@45" value="<?php if(isset($_SESSION['logged_pwd'])){echo $_SESSION['logged_pwd'];} ?>" required>
    <span>
      <?php
        if(isset($_SESSION['logged_pstatus']) && $_SESSION['logged_pstatus']){
          echo "Enter valid user-pwd:abhi@45";
        }
      ?>
    </span>
    <div>
      <a href="/register/forgot.php">Forgot password!</a>
    </div>
    <br><br>

    <input type="submit">

  </form>
  <div>
      <a href="/register/register.php">New user?</a>
  </div>
</body>
</html>
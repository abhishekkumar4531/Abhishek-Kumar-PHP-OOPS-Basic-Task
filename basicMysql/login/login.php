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
    <?php include "../../style.css" ?>
  </style>
</head>
<body>
  <?php
    if(isset($_SESSION['login_user'])){
      header("location: ../../index.php");
    }

    //require("rootClass.php");
    //$loginObj = new RootClass();
  ?>

  <h1>Login-Page</h1>
  <form action="logged-in.php" method="post">
    <dl>
      <dt><label for="username">Enter User-Name</label></dt>
      <dd>
        <input type="text" name="username" placeholder="Enter user-name" value="<?php if(isset($_SESSION['logged_user'])){echo $_SESSION['logged_user'];} ?>" required>
        <span>
          <?php if(isset($_SESSION['logged_nstatus']) && $_SESSION['logged_nstatus']){ echo "Enter valid user-name!!!"; } ?>
        </span>
      </dd>

      <dt><label for="username">Enter User-Password</label></dt>
      <dd>
        <input type="text" name="userpwd" placeholder="Enter user-password" value="<?php if(isset($_SESSION['logged_pwd'])){echo $_SESSION['logged_pwd'];} ?>" required>
        <span>
          <?php if(isset($_SESSION['logged_pstatus']) && $_SESSION['logged_pstatus']){ echo "Enter valid user-password!!!"; } ?>
        </span>
        <ol>
          <li>
            <a href="/basicMysql/register/change.php">Change password!</a>
          </li>
          <li>
            <a href="/basicMysql/register/forgot.php">Forgot password!</a>
          </li>
        </ol>
      </dd>

      <dd>
        <input type="submit" name="submitBtn">
      </dd>
    </dl>
  </form>
  <div>
      <a href="/basicMysql/register/register.php">New user?</a>
  </div>
</body>
</html>
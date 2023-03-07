<?php
  session_start();
  if(isset($_SESSION['login_user'])){
    header("location: ../../index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User-Registration</title>
  <style>
    <?php include "../../style.css" ?>
  </style>

  <script src="../../validity.js?newversion"></script>
  <script type="text/javascript">
    reg_obj = new Validity();
    function checkUname(){
      var user_name = document.getElementById('name').value;
      reg_obj.checkName(user_name, "invalid_name", "submitBtn", "red");
    }
    function checkPhoneNo(){
      var user_mobile = document.getElementById('mobile').value;
      reg_obj.checkPhone(user_mobile, "invalid_mobile", "submitBtn", "red");
    }
    function checkEmailStatus(){
      var user_email = document.getElementById('email').value;
      reg_obj.checkEmail(user_email, "email_status", "submitBtn");
    }
    function checkPasswordStatus(){
      var user_pwd = document.getElementById('pwd').value;
      reg_obj.checkPasswords(user_pwd, "pwd_status", "submitBtn");
    }
  </script>
</head>
<body>
  <h1>Registration-Page</h1>
  <form action="response.php" method="post">
    <dl>
      <dt><label for="name">Enter your name</label></dt>
      <dd>
        <input type="text" name="name" id="name" required onblur="checkUname()" placeholder="Enter your name"
        value="<?php if(isset($_SESSION['reg_name'])){echo $_SESSION['reg_name'];} ?>"
        >
        <span id="invalid_name"></span>
      </dd>
      <dd>
        <span>
          <?php if(isset($_SESSION['unique_status']) && $_SESSION['unique_status']){ echo "Please Enter Unique Name"; } ?>
        </span>
      </dd>

      <dt><label for="pwd">Enter your password</label></dt>
      <dd>
        <input type="text" name="pwd" id="pwd" required onblur="checkPasswordStatus()" placeholder="Enter your password"
        value="<?php if(isset($_SESSION['reg_pwd'])){echo $_SESSION['reg_pwd'];} ?>"
        >
        <span id="pwd_status"></span>
      </dd>
      <dd>
        <span>
          <?php if(isset($_SESSION['unique_status']) && $_SESSION['unique_status']){ echo " Please Enter Unique Password"; } ?>
        </span>
      </dd>

      <dt><label for="mobile">Enter your mobile</label></dt>
      <dd>
        <input type="text" name="mobile" id="mobile" required onblur="checkPhoneNo()" placeholder="Enter your mobile no"
        value="<?php if(isset($_SESSION['reg_mobile'])){echo $_SESSION['reg_mobile'];} ?>"
        >
        <span id="invalid_mobile"></span>
      </dd>

      <dt><label for="email">Enter your email</label></dt>
      <dd>
        <input type="text" name="email" id="email" required onblur="checkEmailStatus()" placeholder="Enter your email"
        value="<?php if(isset($_SESSION['reg_email'])){echo $_SESSION['reg_email'];} ?>"
        >
        <span id="email_status"></span>
      </dd>

      <dd><input type="submit" name="submitBtn" id="submitBtn"></dd>
    </dl>
  </form>

  <div>
    <a href="/basicMysql/login/login.php">Exiting user?</a>
  </div>
</body>
</html>
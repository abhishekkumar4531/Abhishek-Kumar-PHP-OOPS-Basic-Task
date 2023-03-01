<?php
  session_start();
  if(isset($_SESSION['login_user'])){
    header("location: ../index.php");
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
    body{
      width: 1200px;
      margin: 0 auto;
      font-family: Arial;
    }
    input{
      padding: 7px 10px;
      margin-bottom: 15px;
    }
  </style>

  <script src="../validity.js"></script>
  <script type="text/javascript">
    reg_obj = new Validity();
    function checkUname(){
      var user_name = document.getElementById('name').value;
      reg_obj.checkName(user_name, "invalid_name", "submitBtn", "red");
    }
    function checkPhoneNo(){
      var user_mobile = document.getElementById('mobile').value;
      reg_obj.checkPhone(user_phone, "invalid_mobile", "submitBtn", "red");
    }
    function checkEmailStatus(){
      var user_email = document.getElementById('user_email').value;
      reg_obj.checkEmail(user_email, "email_status", "submitBtn");
    }
  </script>
</head>
<body>
  <h1>Registration-Page</h1>
  <form action="response.php" method="post">
    <dl>
      <dt><label for="name">Enter your name</label></dt>
      <dd>
        <input type="text" name="name" id="name" required onblur="checkUname()">
        <span id="invalid_name"></span>
      </dd>

      <dt><label for="pwd">Enter your password</label></dt>
      <dd>
        <input type="text" name="pwd" id="pwd" required>
      </dd>

      <dt><label for="mobile">Enter your mobile</label></dt>
      <dd>
        <input type="text" name="mobile" id="mobile" required onblur="checkPhoneNo()">
        <span id="invalid_mobile"></span>
      </dd>

      <dt><label for="email">Enter your email</label></dt>
      <dd>
        <input type="text" name="email" id="email" required onblur="checkEmailStatus()">
        <span id="email_status"></span>
      </dd>

      <dd><input type="submit" name="submitBtn"></dd>
    </dl>
  </form>

  <div>
    <a href="/login/login.php">Exiting user?</a>
  </div>
</body>
</html>
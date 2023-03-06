<?php
  session_start();
  if(!isset($_SESSION['login_user'])){
    header("location: ../login/login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User-Delete</title>
  <style>
    <?php include "../style.css" ?>
  </style>

  <script src="../validity.js?newversion"></script>
  <script type="text/javascript">
    reg_obj = new Validity();
    function checkUname(){
      var user_name = document.getElementById('name').value;
      reg_obj.checkName(user_name, "invalid_name", "submitBtn", "red");
    }
    function checkPasswordStatus(){
      var user_pwd = document.getElementById('pwd').value;
      reg_obj.checkPasswords(user_pwd, "pwd_status", "submitBtn");
    }
  </script>
</head>
<body>
  <h1>Registration-Page</h1>
  <form action="deleteresponse.php" method="post">
    <dl>
      <dt><label for="username">Enter your name</label></dt>
      <dd>
        <input type="text" name="username" id="name" required onblur="checkUname()" placeholder="Enter your name"
        value="<?php if(isset($_SESSION['del_name'])){echo $_SESSION['del_name'];} ?>"
        >
        <span id="invalid_name"></span>
      </dd>
      <dd>
        <span>
          <?php
            if(isset($_SESSION['del_status']) && $_SESSION['del_status']){
              echo "Please Enter Valid Name";
            }
          ?>
        </span>
      </dd>

      <dt><label for="userpwd">Enter your password</label></dt>
      <dd>
        <input type="text" name="userpwd" id="pwd" required onblur="checkPasswordStatus()" placeholder="Enter your password"
        value="<?php if(isset($_SESSION['del_pwd'])){echo $_SESSION['del_pwd'];} ?>"
        >
        <span id="pwd_status"></span>
      </dd>
      <dd>
        <span>
          <?php
            if(isset($_SESSION['del_status']) && $_SESSION['del_status']){
              echo " Please Enter Valid Password";
            }
          ?>
        </span>
      </dd>

      <dd>
        <button name="sendOtp" id="sendOtp">Send OTP</button>
      </dd>
    </dl>
  </form>

  <div>
    <a href="/login/login.php">Go back</a>
  </div>
</body>
</html>
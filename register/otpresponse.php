<?php
	session_start();
  if(isset($_SESSION['login_user'])){
	  header("location: ../index.php");
  }
  if(!isset($_SESSION['cotp_username'])){
    header("location: forgot.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Forgot-User</title>
	<style>
		<?php include "../style.css" ?>
	</style>

  <script src="../validity.js?newversion"></script>
  <script type="text/javascript">
    reg_obj = new Validity();
    function newPassword(){
      var new_pwd = document.getElementById('npassword').value;
      reg_obj.checkPasswords(new_pwd, "new_status", "submitBtn");
    }
    function rePassword(){
      var re_pwd = document.getElementById('rpassword').value;
      reg_obj.checkPasswords(re_pwd, "re_status", "submitBtn");
    }
    function confirmPassword(){
      var new_pass = document.getElementById('npassword').value;
      var re_pass = document.getElementById('rpassword').value;
      var status = reg_obj.comparePasswords(new_pass, re_pass, 're_status', false);
    }
  </script>
</head>
<body>
	<h1>Forgot your password</h1>
	<form action="forgotresponse.php" method="post">
		<dl>
      <dd>
        <input type="text" name="name" id="name" readonly
        value="<?php if(isset($_SESSION['cotp_username'])){echo $_SESSION['cotp_username'];} ?>"
        >
      </dd>

      <dt><label for="otp">Enter OTP</label></dt>
			<dd>
        <input type="text" name="otp" id="otp" required placeholder="Enter OTP">
        <span>
          <?php
            if(isset($_SESSION['otp_status']) && $_SESSION['otp_status']){
              echo "Invalid OTP!!!";
            }
          ?>
        </span>
      </dd>

			<dt><label for="npassword">Enter new pwd</label></dt>
			<dd>
        <input type="text" name="npassword" id="npassword" required onblur="newPassword()" placeholder="Enter new password"
        value="<?php if(isset($_SESSION['cotp_npassword'])){echo $_SESSION['cotp_npassword'];} ?>"
        >
        <span id="new_status"></span>
      </dd>

			<dt><label for="rpassword">Confirm new pwd</label></dt>
			<dd>
        <input type="text" name="rpassword" id="rpassword" required onblur="rePassword()" onkeyup="confirmPassword()" placeholder="Confirm password"
        value="<?php if(isset($_SESSION['cotp_npassword'])){echo $_SESSION['cotp_npassword'];} ?>"
        >
        <span id="re_status"></span>
      </dd>

			<dd><input type="submit" name="submitBtn"></dd>
		</dl>
	</form>
</body>
</html>
<?php
  session_unset();
?>
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
	<title>Forgot-User</title>
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
    function currentPassword(){
      var current_pwd = document.getElementById('cpassword').value;
      reg_obj.checkPasswords(current_pwd, "invalid_password", "submitBtn");
    }
    function newPassword(){
      var new_pwd = document.getElementById('npassword').value;
      reg_obj.checkPasswords(new_pwd, "invalid_newpassword", "submitBtn");
    }
    function reenterPassword(){
      var re_pwd = document.getElementById('rpassword').value;
      reg_obj.checkPasswords(re_pwd, "invalid_repassword", "submitBtn");
    }
    function comparePassword(){
      var current_pass = document.getElementById('cpassword').value;
      var new_pass = document.getElementById('npassword').value;
      reg_obj.diffPasswords(current_pass, new_pass, 'new_status', 'submitBtn');
    }
    function confirmPassword(){
      var new_pass = document.getElementById('npassword').value;
      var re_pass = document.getElementById('rpassword').value;
      reg_obj.samePasswords(new_pass, re_pass, 're_status', 'submitBtn');
    }
  </script>
</head>
<body>
	<h1>Change your password</h1>
	<form action="changeresponse.php" method="post">
		<dl>
			<dt><label for="name">Enter user name</label></dt>
			<dd>
        <input type="text" name="name" id="name" required onblur="checkUname()" placeholder="Enter user name"
        value="<?php if(isset($_SESSION['for_username'])){echo $_SESSION['for_username'];} ?>"
        >
        <span id="invalid_name"></span>
      </dd>
      <dd>
        <span>
          <?php if(isset($_SESSION['valid_user']) && $_SESSION['valid_user']){ echo " Please Enter Valid User-Name"; } ?>
        </span>
      </dd>

			<dt><label for="cpassword">Enter current password</label></dt>
			<dd>
        <input type="text" name="cpassword" id="cpassword" required onblur="currentPassword()" placeholder="Enter current password"
        value="<?php if(isset($_SESSION['for_cpassword'])){echo $_SESSION['for_cpassword'];} ?>"
        >
        <span id="invalid_password"></span>
      </dd>
      <dd>
        <span id="current_status"></span>
      </dd>
      <dd>
        <span>
          <?php if(isset($_SESSION['valid_user']) && $_SESSION['valid_user']){ echo " Please Enter Valid User-Current-Password"; } ?>
        </span>
      </dd>

			<dt><label for="npassword">Enter new password</label></dt>
			<dd>
        <input type="text" name="npassword" id="npassword" required onblur="newPassword();comparePassword();" placeholder="Enter new password"
        value="<?php if(isset($_SESSION['for_npassword'])){echo $_SESSION['for_npassword'];} ?>"
        >
        <span id="invalid_newpassword"></span>
      </dd>
      <dd>
        <span id="new_status"></span>
      </dd>

			<dt><label for="rpassword">Confirm new password</label></dt>
			<dd>
        <input type="text" name="rpassword" id="rpassword" required onblur="reenterPassword();confirmPassword();" placeholder="Confirm password"
        value="<?php if(isset($_SESSION['for_npassword'])){echo $_SESSION['for_npassword'];} ?>"
        >
        <span id="invalid_repassword"></span>
      </dd>
      <dd>
        <span id="re_status"></span>
      </dd>

			<dd><input type="submit" name="submitBtn" id="submitBtn"></dd>
		</dl>
	</form>
</body>
</html>
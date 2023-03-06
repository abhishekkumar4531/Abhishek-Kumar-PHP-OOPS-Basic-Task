<?php
	session_start();
  if(isset($_SESSION['login_user'])){
	header("location: ../index.php");
  }
  else{
    session_unset();
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
    function checkUname(){
      var user_name = document.getElementById('name').value;
      reg_obj.checkName(user_name, "invalid_name", "otpSubmit", "red");
    }
  </script>
</head>
<body>
	<h1>Send OTP for forgot password</h1>
	<form action="forgotresponse.php" method="post">
		<dl>
			<dt><label for="name">Enter user name</label></dt>
			<dd>
        <input type="text" name="name" id="name" required onblur="checkUname()" placeholder="Enter user name"
        value="<?php if(isset($_SESSION['cotp_username'])){echo $_SESSION['cotp_username'];} ?>"
        >
        <span id="invalid_name"></span>
      </dd>
      <dd>
        <span>
          <?php
            if(isset($_SESSION['valid_user']) && $_SESSION['valid_user']){
              echo " Please Enter Valid User-Name";
            }
          ?>
        </span>
      </dd>
    	<dd><input type="submit" name="otpSubmit" id="otpSubmit"></dd>
		</dl>
	</form>
</body>
</html>
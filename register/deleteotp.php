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
	<title>Forgot-User</title>
	<style>
		<?php include "../style.css" ?>
	</style>
</head>
<body>
	<h1>User-Verification</h1>
	<form action="deleteresponse.php" method="post">
		<dl>
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

			<dd>
        <button name="delete" id="delete">Delete</button>
      </dd>
		</dl>
	</form>
</body>
</html>
<?php
  // if(!isset($_SESSION['login_user'])){
  //   session_unset();
  // }
?>
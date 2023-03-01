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
	<title>Forgot-User</title>
	<style>
		body{
			width: 1200px;
			margin: 0 auto;
			font-family: Arial;
		}
		input{
			padding: 7px 10px;
			margin-bottom: 10px;
		}
	</style>
</head>
<body>
	<h1>Forgot your password</h1>
	<form action="forgotresponse.php" method="post">
		<dl>
			<dt><label for="name">Enter user name</label></dt>
			<dd><input type="text" name="name" required></dd>

			<dt><label for="cpassword">Enter current pwd</label></dt>
			<dd><input type="text" name="cpassword" required></dd>

			<dt><label for="npassword">Enter new pwd</label></dt>
			<dd><input type="text" name="npassword" required></dd>

			<dt><label for="rpassword">Re-Enter new pwd</label></dt>
			<dd><input type="text" name="rpassword" required></dd>

			<dd><input type="submit"></dd>
		</dl>
	</form>
</body>
</html>
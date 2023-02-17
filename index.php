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
		.col-red{
			color: red;
		}
		.col-green{
			color: green;
		}
		li{
			margin-bottom: 10px;
		}
		div a{
			font-size: 18px;
			text-decoration: none;
		}
	</style>
</head>
<body>
	<?php
	global $status;
	$status=false;
	$user_profile = $_SESSION['login_user'];
    if($user_profile==true){
      $status=true;
    }else{
		$status=false;
	}
	if($_GET['q']==1){
		header("location: validForm/task1.php");
	}else if($_GET['q']==2){
		header("location: imageForm/task2.php");
	}else if($_GET['q']==3){
		header("location: subForm/task3.php");
	}else if($_GET['q']==4){
		header("location: phoneForm/task4.php");
	}else if($_GET['q']==5){
		header("location: emailForm/task5.php");
	}else if($_GET['q']==6){
		header("location: printForm/task6.php");
	}else if($_GET['q']==7){
		header("location: index.php");
	}
	?>
	<h1>These all are basic PHP task</h1>
	<?php
	if($status){
		echo "<p class='col-green'>". $_SESSION['login_user'] ." thanks for visiting..</p>";
		echo "<a href='logout.php'>Click here for logout</a>";
	}else{
		echo "<p class='col-red'>*you have to log-in before visiting on tasks</p>";
		echo "<a href='login.php'>Click here for login</a>";
	}
	?>
	<ul>
		<li><a href="validForm/task1.php">Task1</a></li>
		<li><a href="imageForm/task2.php">Task2</a></li>
		<li><a href="subForm/task3.php">Task3</a></li>
		<li><a href="phoneForm/task4.php">Task4</a></li>
		<li><a href="emailForm/task5.php">Task5</a></li>
		<li><a href="printForm/task6.php">Task6</a></li>
	</ul>
</body>
</html>
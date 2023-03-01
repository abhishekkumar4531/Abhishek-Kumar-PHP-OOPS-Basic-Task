<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User-Welcome</title>
  <style>
    body{
      width: 1200px;
      margin: 100px auto;
      color: green;
      font-family: Arial;
      text-align: center;
    }
  </style>
</head>
<body>
  <h1><?php echo "Welcome ". $_SESSION['full_name'] ."!!!";?></h1>
</body>
</html>
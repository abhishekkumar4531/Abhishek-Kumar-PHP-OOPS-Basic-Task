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
  //Link the rootClass.php file where RootClass is available.
  require("rootClass.php");

  //This varible is checking the current status of a user like user log-in or log-out.
  global $status;
  //If $status = false that's mean user is log-out and true means log-in.
  $status=false;
  if(isset($_SESSION['login_user'])){
    $status=true;
  }
  else{
    $status=false;
  }

  if(isset($_GET['q'])){
    //Create the object for RootClass.
    $obj_index = new RootClass();

    //Calling the getUrl function with parameter of GET value from url.
    $obj_index->getUrl($_GET['q']);
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
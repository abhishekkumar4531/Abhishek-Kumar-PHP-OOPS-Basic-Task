<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Phone-Uploaded</title>
  <style>
    body{
      font-family: Arial;
      text-align: center;
    }
    h3{
      font-size: 25px;
      color: green;
    }
    table{
      margin: 0 auto;
      width: 350px;
    }
    table th,td{
      padding: 7px;
    }
    img{
      width: 150px;
      height: 150px;
    }
  </style>
</head>
<body>
  <?php
  require("../rootClass.php");
  echo "<h1>";
  echo $_POST['fname'];
  echo " you logged-in welcome!!!</h1>";
  $task3_obj = new RootClass();
  if(isset($_FILES['user_img'])){
    echo "<div>";
    $task3_obj->loadImage($_FILES['user_img']);
    echo "<h3>". $_POST['fname'] ." ". $_POST['lname'] ."</h3>";
		echo "<h3>Phone's Number : ". $_POST['phone'] ."</h3>";
		echo "</div>";
  }
  if(isset($_POST['sub_details'])){
    $task3_obj->loadSubject($_POST['sub_details']);
  }
  ?>
</body>
</html>
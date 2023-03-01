<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Image-Uploaded</title>
  <style>
    body{
      font-family: Arial;
      text-align: center;
    }
    h3{
      font-size: 18px;
      color: green;
    }
  </style>
</head>
<body>
  <?php
  require("../rootClass.php");
  echo "<h1>";
  echo $_POST['fname'];
  echo " you logged-in welcome!!!</h1>";
  $task2_obj = new RootClass();
  if(isset($_FILES['user_img'])){
    echo "<div>";
    $task2_obj->loadImage($_FILES['user_img']);
    echo "<h3>". $_POST['fname'] ." ". $_POST['lname'] ."</h3>";
		echo "</div>";
  }
  //}
  ?>
</body>
</html>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Download-Here</title>
  <style>
    body{
      font-family: Arial;
      text-align: center;
    }
    h3{
      font-size: 21px;
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
    h6{
      color: pink;
    }
    h5{
      color: red;
    }
    div{
      margin-top: 100px;
    }
    div button{
      padding: 10px 12px;
      font-size: 17px;
    }
  </style>
</head>
<body>
  <?php
    global $status;
    require("../rootClass.php");
    $task5_obj = new RootClass();
    global $status;
    if($task5_obj->checkEmail($_POST['user_email'])){
      $status = true;
      echo "<h1>";
      echo $_POST['fname'];
      echo " you logged-in welcome!!!</h1>";
      if(isset($_FILES['user_img'])){
        $_SESSION['user_name'] = $_POST['fname'] ." ". $_POST['lname'];
        $_SESSION['user_email'] = $_POST['user_email'];
        $_SESSION['user_phone'] = $_POST['phone'];
        echo "<div>";
        $task5_obj->loadImage($_FILES['user_img']);
        echo "<h3>". $_POST['fname'] ." ". $_POST['lname'] ."</h3>";
        echo "<h3>Phone's Number : ". $_POST['phone'] ."</h3>";
        echo "<h3>Verified-email : ". $_POST['user_email'] ."</h3>";
        echo "</div>";
      }
      if(isset($_POST['sub_details'])){
        $task5_obj->loadSubject($_POST['sub_details']);
      }
    }else{
      $status = false;
      echo "<h5>". $_POST['user_email'] ." OOPS! please check your email..</h5>";
    }
  ?>


  <div>
  <form action="print.php" method="post">
    <?php
      if($status==true){
        echo "<button>Download</button>";
      }
    ?>
  </form>
  </div>
</body>
</html>
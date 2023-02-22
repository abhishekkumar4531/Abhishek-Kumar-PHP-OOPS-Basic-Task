<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Image-Form</title>
  <style>
    body{
      margin: 100px auto;
      font-family: Arial;
      font-size: 18px;
      width: 1200px;
    }
    input{
      padding: 7px;
    }
    button{
      padding: 7px 25px;
      font-size: 17px;
    }
  </style>
  <script src="../validity.js"></script>
  <script type="text/javascript">
    obj = new Validity();
    function checkFname(){
      var f_name = document.getElementById('fname').value;
      obj.checkName(f_name, "invalid_fname", "submitBtn", "red");
    }
    function checkLname(){
      var l_name = document.getElementById('lname').value;
      obj.checkName(l_name, "invalid_lname", "submitBtn", "red");
    }
  </script>
</head>
<body>
  <?php
  $user_profile = $_SESSION['login_user'];
  if($user_profile==false){
    header("location: ../login.php");
  }
  ?>
  <form action="image.php" method="post" enctype="multipart/form-data">
    <h1>User log-in page</h1>

    Enter your first-name : <input type="text" name="fname" id="fname" onblur="checkFname()" required><span id="invalid_fname"></span><br><br>

    Enter your last-name : <input type="text" name="lname" id="lname" onblur="checkLname()" required><span id="invalid_lname"></span><br><br>

    Upload your img : <input type="file" name="user_img" id="user_img" required><br><br>

    <button id="submitBtn">Submit</button>
  </form>
</body>
</html>
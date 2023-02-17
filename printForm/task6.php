<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Print-Form</title>
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
    task5_obj = new Validity();
    function checkFname(){
      var f_name = document.getElementById('fname').value;
      task5_obj.checkName(f_name, "invalid_fname", "submitBtn", "red");
    }
    function checkLname(){
      var l_name = document.getElementById('lname').value;
      task5_obj.checkName(l_name, "invalid_lname", "submitBtn", "red");
    }
    function checkPhoneNo(){
      var phone_no = document.getElementById('phone').value;
      task5_obj.checkPhone(phone_no, "invalid_phone", "submitBtn", "red");
    }
    function checkEmailStatus(){
      var get_email = document.getElementById('user_email').value;
      task5_obj.checkEmail(get_email, "email_status", "submitBtn");
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
  <form action="display.php" method="post" enctype="multipart/form-data">
    <h1>Student log-in page</h1>
    Enter your first-name : <input type="text" name="fname" id="fname" onblur="checkFname()" required><span id="invalid_fname"></span><br><br>
    Enter your last-name : <input type="text" name="lname" id="lname" onblur="checkLname()" required><span id="invalid_lname"></span><br><br>
    Enter your phone-number : <input type="text" name="phone" id="phone" onblur="checkPhoneNo()" placeholder="Enter like : +919876543210" required><span id="invalid_phone"></span><br><br>
    Enter your email-address : <input type="text" name="user_email" id="user_email" onblur="checkEmailStatus()" placeholder="Enter a valid email" required><span id="email_status"></span><br><br>
    Upload your img : <input type="file" name="user_img" id="user_img" required><br><br>
    Enter your subject-name and subject-marks in below text-area : <br>
    <textarea name="sub_details" id="sub_details" cols="30" rows="5" placeholder="Enter like Sub_Name|Sub_Marks.." required></textarea><br><br>
    <button id="submitBtn">Submit</button>
  </form>
</body>
</html>
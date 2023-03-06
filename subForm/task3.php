<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sub-Form</title>
	<style>
    <?php include "../style.css" ?>
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
    header("location: ../basicMysql/login/login.php");
  }
  ?>
  <form action="subject.php" method="post" enctype="multipart/form-data">
    <h1>Student log-in page</h1>
    <dl>
      <dt>Enter your first-name</dt>
      <dd>
        <input type="text" name="fname" id="fname" onblur="checkFname()" required><span id="invalid_fname"></span>
      </dd>

      <dt>Enter your last-name</dt>
      <dd>
        <input type="text" name="lname" id="lname" onblur="checkLname()" required><span id="invalid_lname"></span>
      </dd>

      <dt>Upload your img</dt>
      <dd>
        <input type="file" name="user_img" id="user_img" required>
      </dd>

      <dt>Enter your SUBJECT'S NAME|MARKS in text-area</dt>
      <dd>
        <textarea name="sub_details" id="sub_details" cols="30" rows="5" placeholder="Enter like Sub_Name|Sub_Marks.." required></textarea>
      </dd>

      <dd>
        <button id="submitBtn">Submit</button>
      </dd>
    </dl>
  </form>
</body>
</html>
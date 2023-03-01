<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User-Form</title>
  <style>
      label{
        font-size: 16px;
        font-weight: bold;
      }
      input{
        width: 200px;
        padding: 10px;
      }
      body{
        width: 1200px;
        margin: 0 auto;
        font-family: Arial;
      }
      span{
        color: red;
      }
      h2{
        margin-top:100px;
      }
  </style>
</head>
<body>
  <?php
    require("taskClass.php");
    $user_profile = $_SESSION['login_user'];
    if(!$user_profile){
      header("location: ../login/login.php");
    }

    $obj = new FORMS();
    if($_SERVER['REQUEST_METHOD']=="POST"){
      $userName = $obj->validForm($_POST['fname'], $_POST['lname']);
      if($userName!=null){
        $_SESSION['full_name'] = $userName;
        header("location: welcome.php");
      }
    }
  ?>

  <div class="ctn-center">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <h1>User's Login-Page</h1>

      <label for="fname">Enter First Name : </label>
      <input type="text" name="fname" placeholder="First Name" value="<?php echo $obj->first_name; ?>">
      <span>*
        <?php
        if($obj->invalid_fname){
          echo $obj->fnameError;
        }
        ?>
      </span></br></br>

      <label for="lname">Enter Last Name : </label>
      <input type="text" name="lname" placeholder="Last Name" value="<?php echo $obj->last_name; ?>">
      <span>*
        <?php
          if($obj->invalid_lname){echo $obj->lnameError;}
        ?>
      </span></br></br>

      <label for="full-name">User Full Name : </label>
      <input type="text" name="full-name" placeholder="Full Name" readonly value="<?php echo $obj->fullName; ?>"><br><br>

      <input type="submit">
    </form>
  </div>

  <!--<div>
    <h2>
      <?php
      /*if(true){
        echo "Welcome : ". $userName ."!!!";
      }*/
      ?>
    </h2>
  </div>-->
</body>
</html>
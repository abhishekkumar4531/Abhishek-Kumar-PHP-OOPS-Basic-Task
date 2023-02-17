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
      body div:last-child{
        color: green;
      }
  </style>
</head>
<body>
  <?php
    $user_profile = $_SESSION['login_user'];
    if($user_profile==false){
      header("location: ../login.php");
    }
    class Forms{
      public $name1="";
      public $name2="";
      public $fullName="";
      public $nameErr1="";
      public $nameErr2="";
      public $invalid_fname=false;
      public $invalid_laname=false;
      public $status=false;

      function validForm($firstName, $lastName){
        if($firstName==="" && $lastName===""){
          $this->nameErr1 = "Enter First Name";
          $this->nameErr2 = "Enter Last Name";
          $this->invalid_fname=true;
          $this->invalid_lname=true;
        }else if($firstName===""){
          $this->nameErr1 = "Enter First Name";
          $this->invalid_fname=true;
          $this->name2 = $lastName;
          if (!preg_match("/^[a-zA-Z]*$/",$lastName)){
              $this->nameErr2 = "Only letters allowed";
              $this->invalid_lname=true;
          }
        }else if($lastName===""){
          $this->nameErr2 = "Enter last Name";
          $this->invalid_lname=true;
          $this->name1 = $firstName;
          if (!preg_match("/^[a-zA-Z]*$/",$firstName)){
              $nameErr1 = "Only letters allowed";
              $this->invalid_fname=true;
          }
        }else{
          $this->name1 = $firstName;
          $this->name2 = $lastName;
          if (!preg_match("/^[a-zA-Z]*$/",$firstName)){
              $this->nameErr1 = "Only letters allowed";
              $this->invalid_fname=true;
          }
          else if (!preg_match("/^[a-zA-Z]*$/",$lastName)){
              $this->nameErr2 = "Only letters allowed";
              $this->invalid_lname=true;
          }else{
            $this->fullName = $firstName." ".$lastName;
            $this->status=true;
          }
        }

      }

    }


    if($_SERVER['REQUEST_METHOD']=="POST"){
      $obj = new FORMS();
      $obj->validForm($_POST['fname'], $_POST['lname']);
    }
  ?>

  <div class="ctn-center">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <h1>User's Login-Page</h1>
      <label for="fname">Enter First Name : </label>
      <input type="text" name="fname" placeholder="First Name" value="<?php echo $obj->name1; ?>">
      <span>* <?php if($obj->invalid_fname){echo $obj->nameErr1;} ?></span></br></br>
      <label for="lname">Enter Last Name : </label>
      <input type="text" name="lname" placeholder="Last Name" value="<?php echo $obj->name2; ?>">
      <span>* <?php if($obj->invalid_lname){echo $obj->nameErr2;} ?></span></br></br>
      <label for="full-name">User Full Name : </label>
      <input type="text" name="full-name" placeholder="Full Name" readonly value="<?php echo $obj->fullName; ?>"><br><br>
      <input type="submit">
    </form>
  </div>
  <div>
    <h2>
      <?php
      if($obj->status){
        echo "Welcome : ". $obj->fullName ."!!!";
      }
      ?>
    </h2>
  </div>
</body>
</html>
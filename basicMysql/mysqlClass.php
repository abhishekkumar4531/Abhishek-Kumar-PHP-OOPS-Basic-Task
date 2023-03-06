<?php
  //vendor is folder realted to composer and here used for 'Guzzle'
  //require("../vendor/autoload.php");
  use PHPMailer\PHPMailer\PHPMailer;

  //Client is a class which coming from GuzzleHttp and Guzzle used it for email validation.
  use GuzzleHttp\Client;
  class MysqlMethods
  {
    //Login user-name
    public $getname;
    //Login user-password
    public $getpwd;
    //Login user-name error message
    public $status_name = false;
    //Login user-password error message
    public $status_pwd = false;

    /**
    * function getLogin($username, $userpwd)
    *
    * @param [string] $username : This contains the user-name.
    * @param [string] $userpwd : It contains user-password.
    * This function first check user-name and password from database and then, if data are valid then return true otherwise return false.
    *
    * @return boolean
    */
    function getLogin($username, $userpwd){
      $this->getname = $username;
      $this->getpwd = $userpwd;

      $conn = new mysqli("localhost", 'root', 'Abhi4531@my', 'User_DB');
      //$sql = "SELECT userName, userPwd FROM User WHERE userName = '$username' AND userPwd = '$userpwd'";
      $sql = "SELECT userName, userPwd FROM User WHERE userName = '$username'";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          if($userpwd === $row["userPwd"]){
            return true;
          }
        }
        $this->status_pwd = true;
        return false;
      }
      else {
        $this->status_name = true;
        return false;
      }
      $conn->close();
      /*if($username === "Abhi" && $userpwd === "abhi@45"){
        return true;
      }else{
        if($username!="Abhi" && $userpwd!="abhi@45"){
          $this->status_name=true;
          $this->status_pwd=true;
          return false;
        }
        else if($username!="Abhi"){
          $this->status_name=true;
          return false;
        }
        else if($userpwd!="abhi@45"){
          $this->status_pwd=true;
          return false;
        }
      }*/
    }

    /**
     * function getRegister($username, $userpwd, $usermobile, $useremail)
     * @param [string] $username : It contains user-name
     * @param [string] $userpwd : It contains user-password
     * @param [string] $usermobile : It contains user-mobile number
     * @param [string] $useremail : It contains user-email
     * This function first get the data from 'FORM' and then check the username and user-password already exist or not,
     * if exist then it will not store the data into database or if username or user-password does't exist then this
     * function will store the data into database.
     * @var boolean
     */
    public $unique_status = false;
    function getRegister($username, $userpwd, $usermobile, $useremail){
      $conn = new mysqli("localhost", 'root', 'Abhi4531@my', 'User_DB');
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $check_sql = "SELECT userName FROM User WHERE userName = '$username'";

      $result = $conn->query($check_sql);

      if ($result->num_rows > 0) {
        $this->unique_status = true;
        return false;
      }
      else{
        $sql = "INSERT INTO User (userName, userPwd, userMobile, userEmail)
        VALUES ('$username', '$userpwd', '$usermobile', '$useremail')";

        if($conn->query($sql) === TRUE) {
          //echo "New record created successfully";
          $this->unique_status = false;
          return true;
        }
        else{
          //echo "Error: " . $sql . "<br>" . $conn->error;
          return false;
        }
      }

      /*$sql = "INSERT INTO User (userName, userPwd, userMobile, userEmail)
      VALUES ('$username', '$userpwd', '$usermobile', '$useremail')";

      if($conn->query($sql) === TRUE) {
        //echo "New record created successfully";
        return true;
      }
      else{
        //echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
      }*/

      $conn->close();
    }

    /**
     * function forgotPwd($name, $cpwd, $newpwd)
     *
     * @param [string] $name : It contains user-name
     * @param [string] $cpwd : It contains user current-password
     * @param [string] $newpwd : It contains user new-password
     * This function first check the user-name and current password is aviallable or not,
     * if not available the it return false, if available then it updated the user new-password.
     * @return boolean
     */
    public $valid_user = false;
    function forgotPwd($name, $cpwd, $newpwd){
      $conn = new mysqli("localhost", 'root', 'Abhi4531@my', 'User_DB');
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $get = "SELECT userName FROM User WHERE UserPwd = '$cpwd'";
      $result = $conn->query($get);

      if ($result->num_rows > 0) {
        /*while($row = $result->fetch_assoc()) {
          if($name === $row["userName"] && $cpwd === $row["userPwd"]){
            $status = true;
            break;
          }
        }*/
        $post = "UPDATE User SET userPwd = '$newpwd' WHERE userName = '$name' AND userPwd = '$cpwd'";
        if ($conn->query($post) === TRUE) {
          //echo "Record updated successfully";
          $this->valid_user = false;
          return true;
        }
        else {
          //echo "Error updating record: " . $conn->error;
          $this->valid_user = true;
          return false;
        }
      }
      else {
        $this->valid_user = true;
        return false;
      }
      $conn->close();
    }

    public $otpStatus;
    function otpSend($name){
      $conn = new mysqli("localhost", 'root', 'Abhi4531@my', 'User_DB');
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $get = "SELECT userName, userEmail FROM User WHERE UserName = '$name'";
      $result = $conn->query($get);
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if($name === $row["userName"]){
          $email = $row["userEmail"];
          $otp = rand(100000, 999999);
          $this->otpStatus = $otp;

          $mail = new PHPMailer();
          $mail->isSMTP();
          //$mail->SMTPDebug=2;

          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = "abhi31kr45@gmail.com";
          $mail->Password = "ylagckqsadjtgigz";
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port = 587;

          $mail->setFrom("abhi31kr45@gmail.com");
          $mail->addAddress($email);
          $mail->Subject = "Form submission!!!";
          $mail->isHTML(TRUE);
          $mail->Body = "<b>Mail content:</b> Your OTP => $otp";
          $mail->send();
          if($mail->send()){
            //echo "<h3>MESSAGE SENT!!!</h3>";
          }
          else{
            //echo "Error!!!";
          }



          $this->valid_user = false;
          return true;
        }
      }
      else {
        $this->valid_user = true;
        return false;
      }
      $conn->close();
    }

    public $otpVerify = false;
    function confirmPwd($name, $newpwd){
      $conn = new mysqli("localhost", 'root', 'Abhi4531@my', 'User_DB');
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $get = "SELECT userName FROM User WHERE UserName = '$name'";
      $result = $conn->query($get);

      if ($result->num_rows > 0) {
        /*while($row = $result->fetch_assoc()) {
          if($name === $row["userName"] && $cpwd === $row["userPwd"]){
            $status = true;
            break;
          }
        }*/
        $post = "UPDATE User SET userPwd = '$newpwd' WHERE userName = '$name'";
        if ($conn->query($post) === TRUE) {
          //echo "Record updated successfully";
          $this->valid_user = false;
          return true;
        }
        else {
          //echo "Error updating record: " . $conn->error;
          $this->valid_user = true;
          return false;
        }
      }
      else {
        $this->valid_user = true;
        return false;
      }
      $conn->close();
    }

    function deleteUser($name, $pwd){
      $conn = new mysqli("localhost", 'root', 'Abhi4531@my', 'User_DB');
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $delete = "DELETE FROM User WHERE userName = '$name' AND userPwd = '$pwd'";

      if ($conn->query($delete) === TRUE) {
        //echo "Record deleted successfully";
        return true;
      } else {
        //echo "Error deleting record: " . $conn->error;
        return false;
      }
      $conn->close();
    }
  }
?>
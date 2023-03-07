<?php
  //vendor is folder realted to composer and here used for 'Guzzle'
  require '../../vendor/autoload.php';
  use PHPMailer\PHPMailer\PHPMailer;

  //Client is a class which coming from GuzzleHttp and Guzzle used it for email validation.
  use GuzzleHttp\Client;
  class MysqlMethods
  {
    //Login user-name
    public $getName;
    //Login user-password
    public $getPwd;
    //It is checking the user-name is valid or not, if valid then false otherwise true
    public $statusName = false;
    //It is checking the user-password is valid or not, if valid then false otherwise true
    public $statusPwd = false;
    //It checking the user-entered values are valid or not, if valid then false otherwise true
    public $uniqueStatus = false;
    //It checking the user valid or not, if valid then false otherwise true
    public $validUser = false;
    //It is store the OTP which send to user via user-email
    public $otpValue;
    //It checking the status of OTP is correct or not
    public $otpVerify = false;
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
      $this->getName = $username;
      $this->getPwd = $userpwd;

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
        $this->statusPwd = true;
        return false;
      }
      else {
        $this->statusName = true;
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
     * @return boolean
     */
    function getRegister($username, $userpwd, $usermobile, $useremail){
      $conn = new mysqli("localhost", 'root', 'Abhi4531@my', 'User_DB');
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $check_sql = "SELECT userName FROM User WHERE userName = '$username'";

      $result = $conn->query($check_sql);

      if ($result->num_rows > 0) {
        $this->uniqueStatus = true;
        return false;
      }
      else{
        $sql = "INSERT INTO User (userName, userPwd, userMobile, userEmail)
        VALUES ('$username', '$userpwd', '$usermobile', '$useremail')";

        if($conn->query($sql) === TRUE) {
          //echo "New record created successfully";
          $this->uniqueStatus = false;
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
    function forgotPwd($name, $currentpwd, $newpwd){
      $conn = new mysqli("localhost", 'root', 'Abhi4531@my', 'User_DB');
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $get = "SELECT userName FROM User WHERE UserPwd = '$currentpwd'";
      $result = $conn->query($get);

      if ($result->num_rows > 0) {
        /*while($row = $result->fetch_assoc()) {
          if($name === $row["userName"] && $cpwd === $row["userPwd"]){
            $status = true;
            break;
          }
        }*/
        $post = "UPDATE User SET userPwd = '$newpwd' WHERE userName = '$name' AND userPwd = '$currentpwd'";
        if ($conn->query($post) === TRUE) {
          //echo "Record updated successfully";
          $this->validUser = false;
          return true;
        }
        else {
          //echo "Error updating record: " . $conn->error;
          $this->validUser = true;
          return false;
        }
      }
      else {
        $this->validUser = true;
        return false;
      }
      $conn->close();
    }

    /**
     * function otpSend($name)
     *
     * @param [string] $name
     * @return boolean
     */
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
          $this->otpValue = $otp;

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

          $this->validUser = false;
          return true;
        }
      }
      else {
        $this->validUser = true;
        return false;
      }
      $conn->close();
    }

    /**
     * function confirmPwd($name, $newpwd)
     *
     * @param [string] $name
     * @param [string] $newpwd
     * @return boolean
     */
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
          $this->validUser = false;
          return true;
        }
        else {
          //echo "Error updating record: " . $conn->error;
          $this->validUser = true;
          return false;
        }
      }
      else {
        $this->validUser = true;
        return false;
      }
      $conn->close();
    }

    /**
     * function deleteUser($name, $pwd)
     *
     * @param [string] $name
     * @param [string] $pwd
     * @return boolean
     */
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
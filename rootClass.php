<?php
//vendor is folder realted to composer and here used for 'Guzzle'
require("vendor/autoload.php");
//Client is a class which coming from GuzzleHttp and Guzzle used it for email validation.
use GuzzleHttp\Client;

//'RootClass' is a PHP class which is generate response on each request which is comming from other PHP files.
class RootClass{
  /**
  * function loadImage($imgFile)
  *
  * @param [Array] $imgFile:This is array type variable and holds the information about image.
  * First access all the image property and moved to a folder where image data will be store.
  * After storing the image file then display using <img> tag.
  *
  * @return void
  */
  //This is a string type which will be store image name.
  public $img_name;
  function loadImage($imgFile){
    //if(isset($_FILES['user_img'])){
      /*echo "Welcome";
      echo "<pre>";
      print_r ($_FILES);
      echo "</pre>";*/

      $this->img_name = $imgFile['name'];
      $img_size = $imgFile['size'];
      $img_tmp = $imgFile['tmp_name'];
      $img_type = $imgFile['type'];

      if($img_type == "image/png" || $img_type == "image/jpeg" || $img_type == "image/jpg"){
        move_uploaded_file($img_tmp, "../uploaded/".$this->img_name);
        echo '<img src="../uploaded/'.$this->img_name.'">';
      }else{
        echo "Check your image file type!!!";
      }
    //}
  }


  /**
  * function loadSubject($subValue)
  *
  * @param [String] $subValue:This is a string type variable which holds all the subject name and marks with '|'.
  * At first we have to divide the $subValue string with respect to line using explode method and then
  * again divide each divided string with respect to '|' and store the sub data in associative array format like array[sub_name]=sub_marks.
  * After these step create a dynamic table and display the data in table format.
  *
  * @return void
  */
  //This is an associative array type which store subject name as key and subject marks as value.
  public $sub_info = Array();
  function loadSubject($subValue){
    //if(isset($_POST['sub_details'])){
      $line_change = explode("\n", $subValue);
      foreach($line_change as $info){
        if(strlen($info) >= 3){
          $line = explode("|", $info);
          if($line[0]!=""){
            if($line[1]>=0 && $line[1]<=100){
              $this->sub_info[$line[0]] = $line[1];
            }
            else{
              $this->sub_info[$line[0]] = "NAN";
            }
          }
        }
      }

      echo "<table border='1'>";
      echo "<tr><th>Subjects</th><th>Marks</th></tr>";
      foreach($this->sub_info as $sub_name => $sub_marks){
        if(strlen($sub_name) != 0 && strlen($sub_marks) != 0){
          echo "<tr><td>". $sub_name ."</td>";
          echo "<td>". $sub_marks . "</td></tr>";
        }
      }
      echo "</table>";
    //}
  }


  /**
  * function checkEmail($user_email)
  *
  * @param [String] $user_email:This is a string type variable which holds email of user
  * Here email is verified with the help of 'apilayer' API.
  * is email valid or not for this we check two condition first one is 'format_valid' and another is 'smtp_check' :
  * If both are true then email is valid otherwise invalid.
  *
  * @return boolean
  */
  function checkEmail($user_email){

    //Email verification using 'Guzzle'
    $client = new Client([
    'base_uri' => 'https://api.apilayer.com/'
    ]);

    $response = $client->request('GET', 'email_verification/check?email='. $user_email,
    ['headers' => [
    'Content-Type' => 'text/plain',
    'apikey' => '3ti1A2XST7POC3bhKnPwNaCYsRSfLsOf']
    ]);

    $verified_data = $response->getBody();

    $check_validity= json_decode($verified_data, true);
    if($check_validity['format_valid'] && $check_validity['smtp_check']){
      return true;
    }
    else{
      return false;
    }

    //Email verification using 'cURL'
    /*$curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=$user_email",
    CURLOPT_HTTPHEADER => array(
    "Content-Type: text/plain",
    "apikey: 3ti1A2XST7POC3bhKnPwNaCYsRSfLsOf"
    ),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET"
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $check_validity= json_decode($response, true);
    if($check_validity['format_valid'] && $check_validity['smtp_check']){
      return true;
    }
    else{
      return false;
    }*/
  }


  /**
  * function getUrl($qVal)
  *
  * @param [Int] $qVal is a int type varaible which hold the value which is getting from url.
  * According to $qVal value page will be navigate.
  *
  * @return void
  */
  function getUrl($qVal){
    if($qVal==1){
      header("location: validForm/task1.php");
    }
    else if($qVal==2){
      header("location: imageForm/task2.php");
    }
    else if($qVal==3){
      header("location: subForm/task3.php");
    }
    else if($qVal==4){
      header("location: phoneForm/task4.php");
    }
    else if($qVal==5){
      header("location: emailForm/task5.php");
    }
    else if($qVal==6){
      header("location: printForm/task6.php");
    }
    else if($qVal==7){
      header("location: index.php");
    }
  }

  //Login user-name
  public $getname;
  //Login user-password
  public $getpwd;
  //Login user-name error message
  public $status_name=false;
  //Login user-password error message
  public $status_pwd=false;

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

    $check_sql = "SELECT userName, userPwd FROM User WHERE userName = '$username' AND userPwd = '$userpwd'";

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
}
?>
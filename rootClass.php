<?php
//start the session.
session_start();

//'RootClass' is a PHP class which is generate response on each request which is comming from other PHP files.
class RootClass{
  /**
   * function loadImage($imgFile)
   *
   * @param [Array type] $imgFile:This is array type variable and holds the information about image.
   * First access all the image property and moved to a folder where image data will be store.
   * After storing the image file then display using <img> tag.
   *
   * @return void
   */
  function loadImage($imgFile){
    //if(isset($_FILES['user_img'])){
      /*echo "Welcome";
      echo "<pre>";
      print_r ($_FILES);
      echo "</pre>";*/

      $img_name = $imgFile['name'];
      $img_size = $imgFile['size'];
      $img_tmp = $imgFile['tmp_name'];
      $img_type = $imgFile['type'];

      move_uploaded_file($img_tmp, "../uploaded/".$img_name);
      echo '<img src="../uploaded/'.$img_name.'">';

      $_SESSION['user_image'] = "../uploaded/".$img_name;
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
  function loadSubject($subValue){
    //if(isset($_POST['sub_details'])){
      $sub_info = Array();
      $line_change = explode("\n", $subValue);
      foreach($line_change as $info){
        $line = explode("|", $info);
        if($line[0]!=""){
          if($line[1]>=0 && $line[1]<=100){
            $sub_info[$line[0]] = $line[1];
          }else{
            $sub_info[$line[0]] = "NAN";
          }
        }
      }

      $_SESSION['sub_data'] = $sub_info;

      echo "<table border='1'>";
      echo "<tr><th>Subjects</th><th>Marks</th></tr>";
      foreach($sub_info as $sub_name => $sub_marks){
        echo "<tr><td>". $sub_name ."</td>";
        echo "<td>". $sub_marks . "</td></tr>";
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
    $curl = curl_init();

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
    }else{
      return false;
    }
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
    }else if($qVal==2){
      header("location: imageForm/task2.php");
    }else if($qVal==3){
      header("location: subForm/task3.php");
    }else if($qVal==4){
      header("location: phoneForm/task4.php");
    }else if($qVal==5){
      header("location: emailForm/task5.php");
    }else if($qVal==6){
      header("location: printForm/task6.php");
    }else if($qVal==7){
      header("location: index.php");
    }
  }
}
?>
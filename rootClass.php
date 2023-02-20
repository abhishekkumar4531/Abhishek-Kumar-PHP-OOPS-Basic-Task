<?php
session_start();
class RootClass{
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

      $_SESSION['user_image'] = "uploaded/".$img_name;
		//}
	}

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
}
?>
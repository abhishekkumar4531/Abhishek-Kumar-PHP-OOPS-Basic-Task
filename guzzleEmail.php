<?php
  require("vendor/autoload.php");

  use GuzzleHttp\Client;

  $client = new Client([
    'base_uri' => 'https://api.apilayer.com/'
  ]);

  $response = $client->request('GET', 'email_verification/check?email=abhikrjha45@gmail.com',
  ['headers' => [
  'Content-Type' => 'text/plain',
  'apikey' => '3ti1A2XST7POC3bhKnPwNaCYsRSfLsOf'
  ]]);

  echo "<pre>";
  print_r($response);
  echo "</pre>";

  $data = $response->getBody();

  $check_validity= json_decode($data, true);
  if($check_validity['format_valid'] && $check_validity['smtp_check']){
    echo "Valid";
  }else{
    echo "Invalid";
  }
?>
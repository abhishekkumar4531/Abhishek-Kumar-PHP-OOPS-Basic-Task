<?php
  require("vendor/autoload.php");

  use GuzzleHttp\Client;

  $client = new Client();
  $response = $client->request('GET', 'https://api.github.com/repos/guzzle/guzzle');

  echo $response->getStatusCode();
  echo "<br>";
  echo $response->getHeaderLine('content-type');
  echo "<br>";
  echo $response->getBody();

?>
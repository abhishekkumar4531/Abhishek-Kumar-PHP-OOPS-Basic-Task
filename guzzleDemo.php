<?php
  require("vendor/autoload.php");

  use GuzzleHttp\Client;
  use GuzzleHttp\Psr7\Request;

  $client = new Client();
  $response = $client->request('GET', 'https://api.github.com/repos/guzzle/guzzle');

  echo $response->getStatusCode(); // 200
  echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
  echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'

  // Send an asynchronous request.
  /*$request = new Request('GET', 'http://httpbin.org');
  $promise = $client->sendAsync($request)->then(function ($response) {
      echo 'I completed! ' . $response->getBody();
  });*/

  //$promise->wait();
?>
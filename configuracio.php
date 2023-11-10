<?php
//David Buesa

  require_once 'vendor/autoload.php';

  $clientID = '438353549877-4os1vlr206tq2hk0v9v8vq16e0f1ke1q.apps.googleusercontent.com';
  $clientSecret = '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';
  $redirectUri = 'http://localhost/Pr%c3%a0ctiques%20BackEnd/UF2/Pr%c3%a0ctica5/Controlador/controlarGoogle.php';

  // create Client Request to access Google API
  $client = new Google_Client();
  $client->setClientId($clientID);
  $client->setClientSecret($clientSecret);
  $client->setRedirectUri($redirectUri);
  $client->addScope("email");
  $client->addScope("profile");

?>
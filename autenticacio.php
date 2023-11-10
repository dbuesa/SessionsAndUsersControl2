<?php
//David Buesa

  require_once 'configuracio.php';

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);
  $token = $client->getAccessToken(); 
  
  
  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email; //user email
  $name =  $google_account_info->name; //user name
 
  // now you can use this profile info to create account in your website and make user logged in.
}
?>
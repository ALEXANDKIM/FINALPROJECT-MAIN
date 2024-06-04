<?php
/**
 * File Name: facebook_login.php
 * Purpose: Handle Facebook login and retrieve user information.
 * Author: Kim Andrie Mancera
 * Contact: kimandriemancera@gmail.com
 * Date of Creation: 2024-05-23
 * Last Modified: 2024-05-23
 * Brief Overview: This file integrates Facebook login functionality using the Facebook SDK and retrieves user information after successful authentication.
 */

 
require_once 'vendor/autoload.php';

$fb = new \Facebook\Facebook([
  'app_id' => 'YOUR_FACEBOOK_APP_ID',
  'app_secret' => 'YOUR_FACEBOOK_APP_SECRET',
  'default_graph_version' => 'v12.0',
]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
  if (isset($accessToken)) {
    $response = $fb->get('/me?fields=id,name,email', $accessToken);
    $user = $response->getGraphUser();
    $email = $user['email'];
    $name = $user['name'];

    // Save user details to your database and start a session
    // Redirect user to the home page
  }
} catch(\Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
?>

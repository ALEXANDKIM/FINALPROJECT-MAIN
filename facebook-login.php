  <?php
/**
 * File Name: facebook_login_redirect.php
 * Purpose: Redirect users to the Facebook login page.
 * Author: Kim Andrie Mancera
 * Contact: kimandriemancera@gmail.com
 * Date of Creation: 2024-05-23
 * Last Modified: 2024-05-23
 * Brief Overview: This file initializes the Facebook SDK, sets the required permissions, and redirects users to the Facebook login page.
 */

require_once 'vendor/autoload.php'; // Include Facebook SDK

$fb = new \Facebook\Facebook([
  'app_id' => 'YOUR_FACEBOOK_APP_ID',
  'app_secret' => 'YOUR_FACEBOOK_APP_SECRET',
  'default_graph_version' => 'v12.0',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email'];
$loginUrl = $helper->getLoginUrl('http://localhost/facebook-callback.php', $permissions);

header('Location: ' . $loginUrl);
?>

<?php
/**
 * File Name: google_login_redirect.php
 * Purpose: Redirect users to the Google login page.
 * Author: Kim Andrie Mancera
 * Contact: kimandriemancera@gmail.com
 * Date of Creation: 2024-05-23
 * Last Modified: 2024-05-23
 * Brief Overview: This file initializes the Google client, sets the required scopes, and redirects users to the Google login page.
 */

require_once 'vendor/autoload.php';
session_start();

$client = new Google_Client();
$client->setClientId('181313285960-ekskeegkooorgpi5i2js67d0tsfk5dcs.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/ipt101/google-callback.php'); 
$client->addScope('email');
$client->addScope('profile');

$authUrl = $client->createAuthUrl();
header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
exit();
?>

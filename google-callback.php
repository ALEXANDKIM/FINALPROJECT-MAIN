<?php
/**
 * File Name: google_login.php
 * Purpose: Handle Google login and retrieve user information.
 * Author: Kim Andrie Mancera
 * Contact: kimandriemancera@gmail.com
 * Date of Creation: 2024-05-23
 * Last Modified: 2024-05-23
 * Brief Overview: This file integrates Google login functionality using the Google API client and retrieves user information after successful authentication.
 */

require_once 'vendor/autoload.php';
session_start();
include "db_conn.php";

$client = new Google_Client();
$client->setClientId('181313285960-ekskeegkooorgpi5i2js67d0tsfk5dcs.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/ipt101/google-callback.php');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    $oauth2 = new Google_Service_Oauth2($client);
    $userInfo = $oauth2->userinfo->get();

    $email = $userInfo->email;
    $name = $userInfo->name;

    // Check if user already exists in database
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['user_id'] = $row['user_id'];

        // Update Active status to 'online'
        $update_sql = "UPDATE user SET Active = 'Online' WHERE user_id = ?";
        $update_stmt = mysqli_prepare($conn, $update_sql);
        mysqli_stmt_bind_param($update_stmt, "i", $row['user_id']);
        mysqli_stmt_execute($update_stmt);
    } else {
        // Register the user
        $insert_sql = "INSERT INTO user (username, name, email, Active) VALUES (?, ?, ?, 'Online')";
        $insert_stmt = mysqli_prepare($conn, $insert_sql);
        $username = strtolower(str_replace(' ', '_', $name));
        mysqli_stmt_bind_param($insert_stmt, "sss", $username, $name, $email);
        mysqli_stmt_execute($insert_stmt);

        $user_id = mysqli_insert_id($conn);
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $name;
        $_SESSION['user_id'] = $user_id;
    }

    header('Location: dashboard.php');
    exit();
} else {
    header('Location: loginform.php?error=Google login failed');
    exit();
}
?>
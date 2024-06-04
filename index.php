<?php
/**
 * File Name: login.php
 * Purpose: Handle user login and manage session data.
 * Author: Kim Andrie Mancera
 * Contact: kimandriemancera@gmail.com
 * Date of Creation: 2024-05-23
 * Last Modified: 2024-05-23
 * Brief Overview: This file processes the login form submission, validates user credentials, and manages user session data.
 */

// Start session to manage user session data
session_start();

// To connect with the database connection file
include "db_conn.php";

// Check if form fields are set and not empty
if (isset($_POST['username']) && isset($_POST['password'])) { 
    
    // Function to filter the input data
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Validate and filter the username and password inputs
    $username = validate($_POST['username']);   
    $password = validate($_POST['password']);

    // To check if the username is empty
    if (empty($username)) {
        header("Location: loginform.php?error=Username is required");
        exit();
    }
    // To check if the password is empty
    else if (empty($password)){
        header("Location: loginform.php?error=password is required");
        exit();
    }
    // Proceed with authentication
    else {
        // Prepare SQL statement to check if username and password match in database
        $sql = "SELECT * FROM user WHERE username = ? AND password = ?";
        $stmt = mysqli_prepare($conn, $sql);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);

        // Execute statement
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        // To check if there is a matching user record
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            // To check if the email is verified
            if ($row['verified'] == 0) {
                // Redirect user to a verification page or display a message
                header("Location: loginform.php?error=Please verify your email first. Check your email for the verification link");
                exit();
            }

            // To check if username and password match
            if ($row['username'] === $username && $row['password'] === $password) {
                echo "Logged in!";
                
                // Set session variables for user
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['user_id'] = $row['user_id'];

                // Update Active status to 'online'
                $update_sql = "UPDATE user SET Active = 'Online' WHERE user_id = ?";
                $update_stmt = mysqli_prepare($conn, $update_sql);
                mysqli_stmt_bind_param($update_stmt, "i", $row['user_id']);
                mysqli_stmt_execute($update_stmt);

                // Redirect user to home firstpage
                header("Location: firstpage.php");
                exit();
            }
            // To send the user if the credentials are incorrect
            else {
                header("Location: loginform.php?error=Incorrect Username or password");
                exit();
            }
        }
        // To send the user if the credentials are incorrect
        else {
            header("Location: loginform.php?error=Incorrect Username or password");
            exit();
        }
    }
}
// To send the user to login form if the data is not set
else {
    header("Location: loginform.php");
    exit();
}
?>

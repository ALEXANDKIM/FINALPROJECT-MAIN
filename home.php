<?php
/**
 * File Name: home.php
 * Purpose: Display the home page for logged-in users.
 * Author: Kim Andrie Mancera
 * Contact: kimandriemancera@gmail.com
 * Date of Creation: 2024-05-23
 * Last Modified: 2024-05-23
 * Brief Overview: This file checks if a user is logged in, displays a personalized welcome message, and provides a logout option.
 */

session_start();
require_once("db_conn.php");


// Check if the user is not logged in, then redirect to login page
if (!isset($_SESSION['username'])) {
    header('Location: loginform.php');
    exit;
}

// User's username for a personalized message (optional)
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-6 shadow-lg p-5 bg-white rounded text-center">
            <h1 class="mb-4">Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
            <p class="lead mb-4">This is your home page.</p>
            <!-- Logout Button -->
            <a href="logout.php" class="btn btn-danger btn-lg">Logout</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Include database connection file
include "db_conn.php";

// Start the session
session_start();

// Retrieve email and verification code from URL parameters
$email = $_GET['email'] ?? '';
$verification_code = $_GET['code'] ?? '';

// Decode URL-encoded email and verification code
$email = urldecode($email);
$verification_code = urldecode($verification_code);

// Check if email and verification code are not empty
if (!empty($email) && !empty($verification_code)) {
    // Prepare SQL query to select user with the given email and verification code
    $sql = "SELECT * FROM user WHERE Email=? AND verification_code=?";
    $stmt = mysqli_stmt_init($conn);
    
    // Check if the SQL statement can be prepared
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL statement failed";
    } else {
        // Bind parameters to the SQL query
        mysqli_stmt_bind_param($stmt, "ss", $email, $verification_code);
        // Execute the SQL query
        mysqli_stmt_execute($stmt);
        // Get the result of the query
        $result = mysqli_stmt_get_result($stmt);
        
        // Check if any rows are returned (user exists with the given email and verification code)
        if (mysqli_num_rows($result) > 0) {
            // Prepare SQL query to update user as verified
            $sql_update = "UPDATE user SET verified = 1 WHERE Email=? AND verification_code=?";
            $stmt_update = mysqli_stmt_init($conn);
            
            // Check if the update SQL statement can be prepared
            if (!mysqli_stmt_prepare($stmt_update, $sql_update)) {
                echo "SQL statement failed";
            } else {
                // Bind parameters to the update SQL query
                mysqli_stmt_bind_param($stmt_update, "ss", $email, $verification_code);
                // Execute the update SQL query
                mysqli_stmt_execute($stmt_update);
                ?>
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Email Verified</title>
                    <!-- Include Bootstrap CSS -->
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
                </head>
                <body class="d-flex justify-content-center align-items-center vh-100 bg-light">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card shadow">
                                    <div class="card-header text-center">
                                        <h1 class="h4">Email Verification</h1>
                                    </div>
                                    <div class="card-body text-center">
                                        <div class="alert alert-success" role="alert">
                                            Your email has been successfully verified.
                                        </div>
                                        <a href="index.php" class="btn btn-primary w-100">Login</a>
                                    </div>
                                    <div class="card-footer text-center text-muted">
                                        &copy; 2024 Kim Andrie Mancera. All rights reserved.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Include Bootstrap JS -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
                    <script>
                    // Remove email and code parameters from the URL to avoid resubmission
                    if (window.history.replaceState) {
                        const url = new URL(window.location);
                        url.searchParams.delete('email');
                        url.searchParams.delete('code');
                        window.history.replaceState({ path: url.href }, '', url.href);
                    }
                    </script>
                </body>
                </html>
                <?php
                // Exit the script to avoid further processing
                exit;
            }
        } else {
            // If no user is found with the given email and verification code, display an error message
            echo "Invalid verification code.";
        }
    }
} else {
    // If email or verification code is missing, display an error message
    echo "Email or verification code is missing.";
}

// Close the database connection
mysqli_close($conn);
?>

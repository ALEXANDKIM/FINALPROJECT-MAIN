<?php
// Start session management
session_start();

// Include database connection
include "db_conn.php";

// Import necessary PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPmailer/src/Exception.php';
require 'PHPmailer/src/PHPMailer.php';
require 'PHPmailer/src/SMTP.php';

// Create a new instance of PHPMailer
$mail = new PHPMailer(true);

// Retrieve form data
$firstname = $_POST['First_name'];
$middlename = $_POST['Middle_name'];
$lastname = $_POST['Lastname'];
$username = $_POST['username'];
$email = $_POST['Email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$status = $_POST['Status'];
$verification_code = bin2hex(random_bytes(16)); // Generate a random verification code

// Function to validate password format
function validatePassword($password) {
    // Password must contain at least one letter and one special character or digit
    return preg_match('/^(?=.*[A-Za-z])(?=.*[\d@#$*])[A-Za-z\d@#$*]+$/', $password);
}

// Function to validate names containing only letters
function validateLetters($input) {
    // Check if the input contains only letters and spaces
    return preg_match('/^[A-Za-z ]+$/', $input);
}

// Function to validate email format
function validateEmail($email) {
    // Use PHP's filter_var function to validate email format
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Check if required fields are empty
if (empty($username) || empty($email) || empty($password) || empty($status)) {
    // Redirect to registration form with error message if any required field is empty
    header("Location: registrationform.php?error=Please fill in all fields");
    exit();
} else if ($password !== $confirm_password) {
    // Redirect to registration form with error message if passwords do not match
    header("Location: registrationform.php?error=Passwords do not match");
    exit();
} else {
    // Check if username or email already exists in the database
    $sql = "SELECT * FROM user WHERE username='$username' OR Email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // Redirect to registration form with error message if username or email already exists
        header("Location: registrationform.php?error=Username or Email already exists");
        exit();
    }

    // Validate last name
    if (!validateLetters($lastname)) {
        // Redirect to registration form with error message if last name contains invalid characters
        header("Location: registrationform.php?error=Last name should contain only letters");
        exit();
    }

    // Validate first name
    if (!validateLetters($firstname)) {
        // Redirect to registration form with error message if first name contains invalid characters
        header("Location: registrationform.php?error=First name should contain only letters");
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into database
    $sql = "INSERT INTO user (First_name, Middle_name, Lastname, username, Email, password, verification_code, Status) 
            VALUES ('$firstname', '$middlename', '$lastname', '$username', '$email', '$hashed_password', '$verification_code', '$status')";

    if (mysqli_query($conn, $sql)) {
        try {
            // Get the user ID of the newly inserted user
            $user_id = mysqli_insert_id($conn);
            $full_name = $firstname . ' ' . $middlename . ' ' . $lastname;

            // Insert user profile data into the user_profile table
            $profile_sql = "INSERT INTO user_profile (user_id, full_name) VALUES ('$user_id', '$full_name')";
            if (mysqli_query($conn, $profile_sql)) {
                echo "User and profile inserted successfully.";
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            // Configure PHPMailer to send a verification email
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  
            $mail->SMTPAuth = true;
            $mail->Username = 'kimandriemancera@gmail.com';  // Your Gmail address
            $mail->Password = 'oaydmfuyxcujdbau';  // Your Gmail app password
            $mail->SMTPSecure = 'tls';          
            $mail->Port = 587;                  

            $mail->setFrom('kimandriemancera@gmail.com');  // Sender email
            $mail->addAddress($email);  // Recipient email
            $mail->isHTML(true);
            $mail->Subject = 'Email Verification';  // Email subject
            $mail->Body = 'Please click the "verify" link to verify your email: <a href="http://localhost/finalproject-main/verified.php?email='.$email.'&code='.$verification_code.'">Verify</a>';  // Email body

            $mail->send();  // Send the email
            // Redirect to a notice page with success message
            header("Location: sent_notice.php?message=Verification email sent. Please check your email to verify your account.");
        } catch (Exception $e) {
            // Redirect to registration form with error message if email sending fails
            header("Location: registrationform.php?error=Failed to send verification email. Please try again later.");
        }
    } else {
        // Display error if SQL query fails
        echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);
?>

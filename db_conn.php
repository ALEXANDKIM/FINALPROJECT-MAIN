<?php
/**
 * File Name: db_connection.php
 * Purpose: Establish a connection to the MySQL database.
 * Author: Kim Andrie Mancera
 * Contact: kimandriemancera@gmail.com
 * Date of Creation: 2024-05-23
 * Last Modified: 2024-05-23
 * Brief Overview: This file contains the parameters and code required to establish a connection to the MySQL database for the final project.
 */

 
//Database connection parameters
$sname = "localhost: 3307"; // Server name and port
$uname = "root"; // Database username
$password = ""; // Database password
$db_name = "finalproject"; // Database name

//To establish a connection to the database
$conn = mysqli_connect($sname, $uname, $password, $db_name);

//To heck if the connection is successful
if (!$conn) {
    echo "Failed to connect to the database"; //To display message if connection fails
} else {
    //echo "Connection success"; //To display message if connection is successful
}
?>          
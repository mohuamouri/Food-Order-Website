<?php
    //start Session
    session_start();

// Define constants to store non-repeated values
define('SITEURL', 'http://localhost/food-order/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food-order');
define('DB_PORT', '3307'); // Define the custom port number

// Establish MySQL connection
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT) or die(mysqli_error()); 

// Select the database
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());  // Selecting database
?>

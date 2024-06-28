<?php
// Database configuration
$servername = "localhost"; // or your server name
$username = "root"; // or your database username
$password = ""; // or your database password
$dbname = "hng11"; // your database name

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>

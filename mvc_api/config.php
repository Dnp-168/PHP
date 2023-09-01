<?php
// Replace with your actual database credentials
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'login_api';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

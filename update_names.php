<?php
// Force PHP to show ALL errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$servername = "localhost";
$username   = "oyschste_oyschstdb";
$password   = "oyschst2023";
$dbname     = "oyschste_cgpa";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "✅ Connected successfully.<br>";
}


?>

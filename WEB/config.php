<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";
session_start();

// Plz do not touch below thanks <3

$loggedIn = false; // Touch this then i kill you (it breaks it all cause I am really shit at making anything lmfao)
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
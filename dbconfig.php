<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stmix";

$dbError = FALSE;
$dbErrorMsg = "";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    $dbError = TRUE;
    $dbErrorMsg = $conn->connect_error;
} 

?>
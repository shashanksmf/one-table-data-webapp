<?php
$servername = "mysql://b76cbf400956e9:a0107278@us-cdbr-iron-east-05.cleardb.net/heroku_f1331253e1e8450";
$username = "b76cbf400956e9";
$password = "a0107278";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>

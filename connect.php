<?php
$servername = "localhost";
$username = "xncmlcxb_root";
$password = "panda2612";
$dbname = "xncmlcxb_nursingService";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
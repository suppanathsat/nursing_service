# nursingHome
1 SET WAMP STACK
2 import nursing_service.sql to mysql database and name it nursing_service
3 set file connect.php 
 <?php
$servername = "localhost";
$username = "your_user";
$password = "your_password";
$dbname = "nursing_service";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>

![image](https://user-images.githubusercontent.com/80107228/110134568-1c032500-7e00-11eb-9949-7bbff769d92a.png)



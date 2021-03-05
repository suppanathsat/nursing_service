# nursingHome
1 SET WAMP STACK <br>
2 import nursing_service.sql to mysql database and name it nursing_service <br>
3 set file connect.php <br>

$servername = "localhost";<br>
$username = "your_user";<br>
$password = "your_password";<br>
$dbname = "nursing_service";<br>
<br>
// Create connection<br>
$conn = new mysqli($servername, $username, $password, $dbname);<br>
mysqli_set_charset($conn, "utf8");<br>
// Check connection<br>
if ($conn->connect_error) {<br>
    die("Connection failed: " . $conn->connect_error);<br>
}<br>



![image](https://user-images.githubusercontent.com/80107228/110134568-1c032500-7e00-11eb-9949-7bbff769d92a.png)



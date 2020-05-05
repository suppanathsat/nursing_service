<?php
include '../connect.php';
$user_id = $_POST['id'];

//อ่านค่าลูกค้า
$result = $conn->query("SELECT * FROM user WHERE user_id = $user_id");

// array ตั้งต้น
$data = array();
//ดึงค่า
  while ( $row = $result->fetch_assoc())  {
	$data['staff']=$row;
  }


    
    echo json_encode($data);
?>
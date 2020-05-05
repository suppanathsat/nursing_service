<?php
include_once '../connect.php';
print_r($_POST);
extract($_POST);
//เพิ่มทุกอย่างลงใน user
$username = mysqli_real_escape_string($conn,$_POST['username']);
$password1 = mysqli_real_escape_string($conn,$_POST['password1']);
$password2 = mysqli_real_escape_string($conn,$_POST['password2']);
$fname = mysqli_real_escape_string($conn,$_POST['fname']);
$lname = mysqli_real_escape_string($conn,$_POST['lname']);
$auth = mysqli_real_escape_string($conn,$_POST['auth']);
$idcard = mysqli_real_escape_string($conn,$_POST['idcard']);
$phone = mysqli_real_escape_string($conn,$_POST['phone']);
$birthday = mysqli_real_escape_string($conn,$_POST['birthday']);
$location = mysqli_real_escape_string($conn,$_POST['location']);

$sql = "SHOW TABLE STATUS LIKE 'user'";
$result = $conn->query($sql);
$id = 0;

if ($result->num_rows == 1) {
    while($row = $result->fetch_assoc()) {
        $id = $row['Auto_increment'];
    }
} 

echo $id;
$pic = $id."-".$_FILES['fileimg']['name'];

$sql = "INSERT INTO user";
$sql .= "(username,password,fname,lname,auth,idcard,phone,birthday,location,pic) ";
$sql .= "values('$username','$password1','$fname','$lname','$auth','$idcard','$phone','$birthday','$location','$pic');";
if ($conn->query($sql) === TRUE) {
    if(!empty($_FILES['fileimg']['tmp_name'])){
        $img = ($_FILES['fileimg']['tmp_name']);
        $check = getimagesize($img);
        if($check == false) {
        die($_FILES['fileimg']['name'] . " is not a valid image file.");
        }else{
            echo 'is img';
        }
    }
    $img = $id."-".$_FILES['fileimg']['name'];
    $temppath= $_FILES['fileimg']['tmp_name'];
    move_uploaded_file($temppath,"../upload/$img");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

echo "<script type='text/javascript'>alert('$msg');window.location.href = '../staff.php';</script>"; 
?>
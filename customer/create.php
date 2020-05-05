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
$idcard = mysqli_real_escape_string($conn,$_POST['idcard']);
$phone = mysqli_real_escape_string($conn,$_POST['phone']);
$birthday = mysqli_real_escape_string($conn,$_POST['birthday']);
$location = mysqli_real_escape_string($conn,$_POST['location']);

$efname = mysqli_real_escape_string($conn,$_POST['efname']);
$elname = mysqli_real_escape_string($conn,$_POST['elname']);
$enname = mysqli_real_escape_string($conn,$_POST['enname']);
$bed = mysqli_real_escape_string($conn,$_POST['bed']);
$ebirthday = mysqli_real_escape_string($conn,$_POST['ebirthday']);

$sql = "SHOW TABLE STATUS LIKE 'user'";
$result = $conn->query($sql);
$id = 0;

if ($result->num_rows == 1) {
    while($row = $result->fetch_assoc()) {
        $id = $row['Auto_increment'];
    }
} 

echo $id;
$newUserID = $id;
$pic = $id."-".$_FILES['fileimg']['name'];

$sql = "INSERT INTO user";
$sql .= "(username,password,fname,lname,auth,idcard,phone,birthday,location,pic) ";
$sql .= "values('$username','$password1','$fname','$lname','ลูกค้า','$idcard','$phone','$birthday','$location','$pic');";
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


// ผู้สูงอายุ
$sql = "SHOW TABLE STATUS LIKE 'elder'";
$result = $conn->query($sql);
$id = 0;

if ($result->num_rows == 1) {
    while($row = $result->fetch_assoc()) {
        $id = $row['Auto_increment'];
    }
} 

echo $id;

$pic = "e".$id."-".$_FILES['fileimg2']['name'];


$sql = "INSERT INTO elder";
$sql .= "(pic,fname,lname,nname,bed,birthday,user_id) ";
$sql .= "values('$pic','$efname','$elname','$enname','$bed','$ebirthday',$newUserID);";
if ($conn->query($sql) === TRUE) {
    if(!empty($_FILES['fileimg2']['tmp_name'])){
        $img = ($_FILES['fileimg2']['tmp_name']);
        $check = getimagesize($img);
        if($check == false) {
        die($_FILES['fileimg2']['name'] . " is not a valid image file.");
        }else{
            echo 'is img';
        }
    }
    $temppath= $_FILES['fileimg2']['tmp_name'];
    move_uploaded_file($temppath,"../upload/$pic");

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

echo "<script type='text/javascript'>alert('$msg');window.location.href = '../customer.php';</script>"; 
?>
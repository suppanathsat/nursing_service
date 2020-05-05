<?php
include_once '../connect.php';
$fname = mysqli_real_escape_string($conn,$_POST['fname']);
$lname = mysqli_real_escape_string($conn,$_POST['lname']);
$nname = mysqli_real_escape_string($conn,$_POST['nname']);
$birthday = mysqli_real_escape_string($conn,$_POST['birthday']);
$bed = mysqli_real_escape_string($conn,$_POST['bed']);
$user_id = mysqli_real_escape_string($conn,$_POST['user_id']);

// ตั้งชื่อรูปภาพ
$pic = "e".$id."-".$_FILES['fileimg2']['name'];

$sql = "INSERT INTO elder";
$sql .= "(pic,fname,lname,nname,bed,birthday,user_id) ";
$sql .= "values('$pic','$fname','$lname','$nname','$bed','$birthday',$user_id);";
if ($conn->query($sql) === TRUE) {
    if(!empty($_FILES['fileimg2']['tmp_name'])){
        $img = ($_FILES['fileimg2']['tmp_name']);
        $check = getimagesize($img);
        if($check == false) {
        die($_FILES['fileimg2']['name'] . " is not a valid image file.");
        }else{
            echo 'is img';
            $temppath= $_FILES['fileimg2']['tmp_name'];
            move_uploaded_file($temppath,"../upload/$pic");
        }
    }

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

echo "<script type='text/javascript'>alert('$msg');window.location.href = '../customer.php';</script>"; 
?>
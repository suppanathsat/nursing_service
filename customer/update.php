<?php
include '../connect.php';
$username = mysqli_real_escape_string($conn,$_POST['username']);
$password1 = mysqli_real_escape_string($conn,$_POST['password1']);
$password2 = mysqli_real_escape_string($conn,$_POST['password2']);
$fname = mysqli_real_escape_string($conn,$_POST['fname']);
$lname = mysqli_real_escape_string($conn,$_POST['lname']);
$idcard = mysqli_real_escape_string($conn,$_POST['idcard']);
$phone = mysqli_real_escape_string($conn,$_POST['phone']);
$birthday = mysqli_real_escape_string($conn,$_POST['birthday']);
$location = mysqli_real_escape_string($conn,$_POST['location']);
$user_id = mysqli_real_escape_string($conn,$_POST['user_id']);
$old_pic = $_POST['uoldpic'];
if($_FILES['fileimg']['name'] != ""){
    $pic = $user_id."-".$_FILES['fileimg']['name'];
}

//กรณี ไม่เปลี่ยนรูป
if($pic == ""){
    $sql = "UPDATE user ";
    $sql .= "SET fname='$fname', ";
    $sql .= "lname='$lname', ";
    $sql .= "username='$username', ";
    $sql .= "password='$password1', ";
    $sql .= "idcard='$idcard', ";
    $sql .= "phone='$phone', ";
    $sql .= "birthday='$birthday', ";
    $sql .= "location='$location' ";
    $sql .= "WHERE user_id= $user_id;";
    echo $sql;
    if ($conn->query($sql) === TRUE) {
        $msg = "แก้ไขข้อมูลเรียบร้อย1";
        echo "<script type='text/javascript'>alert('$msg');window.location.href = '../customer.php';</script>"; 
    }else{
        $msg = "แก้ไขข้อมูลไม่สำเร็จ";
        echo "<script type='text/javascript'>alert('$msg');window.location.href = '../customer.php';</script>";  
    }
}else{//กรณี เปลี่ยนรูป
    $sql = "UPDATE user ";
    $sql .= "SET fname='$fname', ";
    $sql .= "lname='$lname', ";
    $sql .= "username='$username', ";
    $sql .= "password='$password1', ";
    $sql .= "idcard='$idcard', ";
    $sql .= "phone='$phone', ";
    $sql .= "birthday='$birthday', ";
    $sql .= "location='$location', ";
    $sql .= "pic='$pic' ";
    $sql .= "WHERE user_id= $user_id;";
    echo $sql;
    if ($conn->query($sql) === TRUE) {
        $msg = "แก้ไขข้อมูลเรียบร้อย2";
        //ลบรูปเก่า
        chdir('../upload');
        unlink($old_pic);
        //เพิ่มรูปใหม่
        $temppath= $_FILES['fileimg']['tmp_name'];
        move_uploaded_file($temppath,"../upload/$pic");
        //กลับไปหน้าลูกค้า
        echo "<script type='text/javascript'>alert('$msg');window.location.href = '../customer.php';</script>"; 
    }else{
        $msg = "แก้ไขข้อมูลไม่สำเร็จ";
        echo "<script type='text/javascript'>alert('$msg');window.location.href = '../customer.php';</script>";  
    }

}

?> 
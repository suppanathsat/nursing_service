<?php
include '../connect.php';
print_r($_POST);
//รับค่า
extract($_POST);
if($_FILES['fileimg1']['name'] != ""){
    $pic = "e".$elder_id."-".$_FILES['fileimg1']['name'];
}

//กรณี ไม่เปลี่ยนรูป
if($pic == ""){
    $sql = "UPDATE elder ";
    $sql .= "SET fname='$fname', ";
    $sql .= "lname='$lname', ";
    $sql .= "nname='$nname', ";
    $sql .= "bed='$bed', ";
    $sql .= "birthday='$birthday' ";
    $sql .= "WHERE elder_id= $elder_id;";
    if ($conn->query($sql) === TRUE) {
        $msg = "แก้ไขข้อมูลเรียบร้อย1";
        echo "<script type='text/javascript'>alert('$msg');window.location.href = '../manage.php';</script>"; 
    }
}else{//กรณี เปลี่ยนรูป
    $sql = "UPDATE elder ";
    $sql .= "SET fname='$fname', ";
    $sql .= "lname='$lname', ";
    $sql .= "nname='$nname', ";
    $sql .= "bed='$bed', ";
    $sql .= "birthday='$birthday', ";
    $sql .= "pic='$pic' ";
    $sql .= "WHERE elder_id= $elder_id;";
    echo $sql;
    if ($conn->query($sql) === TRUE) {
        $msg = "แก้ไขข้อมูลเรียบร้อย2";
        echo "<script type='text/javascript'>alert('$msg');window.location.href = '../manage.php';</script>"; 
    }
    //ลบรูปเก่า
    chdir('../upload');
    unlink($old_pic);
    //เพิ่มรูปใหม่
    $temppath= $_FILES['fileimg1']['tmp_name'];
    move_uploaded_file($temppath,"../upload/$pic");
}

?>
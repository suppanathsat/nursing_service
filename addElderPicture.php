<?php
include 'connect.php';
 print_r($_POST);
 extract($_POST);

 //รับชื่อรูปเก่าเพื่อใช้เวลาลบ
$sql = "SELECT first_pic,second_pic,third_pic FROM elder where elder_id = $elder_id ;";
echo $sql;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        extract($row);
        echo $first_pic." ".$second_pic." ".$third_pic;
    }
}

$date = date('Y-m-d H:i:s');
echo $date;
 // ถ้าไม่เป็น "" ให้อัพเดท elder
 if($_FILES['first_pic']['name'] != ""){
    $pic = $elder_id."-".$date."-".$_FILES['first_pic']['name'];
    //update elder 
    $sql = "UPDATE elder ";
    $sql .= "SET first_pic='$pic' ";
    $sql .= "where elder_id = $elder_id ";
    if ($conn->query($sql) === TRUE) {
        $msg = "แก้ไขข้อมูลเรียบร้อย";
        
        //เพิ่มรูปใหม่
         $temppath= $_FILES['first_pic']['tmp_name'];
         echo $temppath;
         $destination_path = getcwd().DIRECTORY_SEPARATOR;
         $target_path = $destination_path . 'dailypic\\'. $pic;
         move_uploaded_file($temppath,$target_path);
        
         /*ลบรูปเก่า
        if($first_pic != ""){
            chdir('dailypic');
            unlink($first_pic);
        }
        */
    }
 }

 if($_FILES['second_pic']['name'] != ""){
    $pic = $elder_id."-".$date."-".$_FILES['second_pic']['name'];
    //update elder 
    $sql = "UPDATE elder ";
    $sql .= "SET second_pic='$pic' ";
    $sql .= "where elder_id = $elder_id ";
    if ($conn->query($sql) === TRUE) {
        $msg = "แก้ไขข้อมูลเรียบร้อย";
        //เพิ่มรูปใหม่
         $temppath_sec= $_FILES['second_pic']['tmp_name'];
         move_uploaded_file($temppath_sec,"dailypic/$pic");
        //ลบรูปเก่า
        if($second_pic != ""){
            chdir('dailypic');
            unlink($second_pic);
        }
    }
 }

 if($_FILES['third_pic']['name'] != ""){
    $pic = $elder_id."-".$date."-".$_FILES['third_pic']['name'];
    //update elder 
    $sql = "UPDATE elder ";
    $sql .= "SET third_pic = '$pic' ";
    $sql .= "where elder_id = $elder_id ";
    if ($conn->query($sql) === TRUE) {
        $msg = "แก้ไขข้อมูลเรียบร้อย";
        //เพิ่มรูปใหม่
         $temppath_third= $_FILES['third_pic']['tmp_name'];
         move_uploaded_file($temppath_third,"dailypic/$pic");
        //ลบรูปเก่า
        if($third_pic != ""){
            chdir('dailypic');
            unlink($third_pic);
        }
    }
 }
 
 // echo "<script type='text/javascript'>alert('$msg');window.location.href = 'nurseNote.php?elder_id=$elder_id';</script>";  
?>
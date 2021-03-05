<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php
    include_once '../connect.php';
    session_start();
    print_r($_POST);
    $temp = mysqli_real_escape_string($conn,$_POST['temp']);
    $pleasuer1 = mysqli_real_escape_string($conn,$_POST['pleasuer1']);
    $pleasuer2 = mysqli_real_escape_string($conn,$_POST['pleasuer2']);
    $hart = mysqli_real_escape_string($conn,$_POST['hart']); //O2
    $p = mysqli_real_escape_string($conn,$_POST['p']);
    $r = mysqli_real_escape_string($conn,$_POST['r']);
    $user_id = $_SESSION['user_id'];
    $elder_id = mysqli_real_escape_string($conn,$_POST['elder_id']);
    
    $sql = "INSERT INTO nursenote";
    $sql .= "(user_id,temp,pleasuerup,pleasuerdown,hart,p,r,elder_id) ";
    $sql .= "values($user_id,'$temp','$pleasuer1','$pleasuer2','$hart','$p','$r','$elder_id');";
    echo $sql;
    if ($conn->query($sql) === TRUE) {
        $msg = 'เพิ่มข้อมูลสำเร็จ';
    } else {
        $msg = 'กรุณากรอกข้อมูลให้ครบ';
    }

    $conn->close();
    echo "<script type='text/javascript'>alert('$msg');window.location.href = '../manage.php';</script>"; 
?>

</body>
</html>
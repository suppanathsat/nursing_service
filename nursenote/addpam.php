<?php
    include_once '../connect.php';
    print_r($_GET);
    $elder_id = mysqli_real_escape_string($conn,$_GET['elder_id']);
    session_start();
    
    $user_id = $_SESSION['user_id'];
    $sql = "INSERT INTO nursenote";
    $sql .= "(user_id,pam,elder_id) ";
    $sql .= "values($user_id,1,$elder_id);";

    if ($conn->query($sql) === TRUE) {
        $msg = 'เพิ่มข้อมูลสำเร็จ';
    } else {
        $msg = 'เกิดข้อผิดพลาด';
    }

    $conn->close();
    echo "<script type='text/javascript'>alert('$msg');window.location.href = '../manage.php';</script>"; 
?>
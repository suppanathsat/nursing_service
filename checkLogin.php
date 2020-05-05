<?php
    include_once 'connect.php';
    print_r($_POST);
    session_start();
    // ดึงค่าจากตาราง user มาดูว่ามีหรือเปล่า
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $sql = "SELECT user_id,username,password,auth FROM user WHERE username = '$username' AND password = '$password';";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        // ถ้ามีและเป็น customer ไปหน้า nurseNote.php
        while($row = $result->fetch_assoc()) {
            print_r($row);
            $_SESSION["auth"] = $row['auth'];
            $_SESSION["user_id"] = $row['user_id'];
           if($row['auth']=='ลูกค้า'){
                $conn->close();
                header( "Location: customerNote.php" );
           }else{
                $conn->close();
                header( "Location: manage.php" );
           }
        }
    } else {
        echo "0 results";
        $conn->close();
        header( "Location: login.html" );
    }
    $conn->close();
?>
<?php
include 'connect.php';
include 'checkAuth.php';

    //รับค่าจากตาราง user
    $elder_id = mysqli_real_escape_string($conn,$_GET['elder_id']);
    $sql = "SELECT * FROM elder WHERE elder_id = $elder_id;";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        while($row = $result->fetch_assoc()) {
           $fname = $row['fname'];
           $lname = $row['lname'];
           $nname = $row['nname'];
           $bed = $row['bed'];
           $birthday = $row['birthday'];
           $pic = $row['pic'];
           $user_id = $row['user_id'];
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style>
        .rounded{
        object-fit: cover;
        border-radius: 70%;
        height: 50px;
        width: 50px;
        }

        .critical{
        background-color: red;
        color: white;
        }

        .normal{
        background-color: white;
        color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 style="margin-top:30px">แก้ไขข้อมูลผู้สูงอายุ</h3>
        <form action="elder/update.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="form-group input-group col-md-4" style="margin-top:15px;">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="fileimg1" id="pic" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="pic">รูปภาพผู้สูงอายุ</label>
                        <input type="text" class="form-control" value="<?php echo $_GET['elder_id']; ?>" name="elder_id"  hidden>
                        <input type="text" class="form-control" value="<?php echo $pic; ?>" name="old_pic"  hidden>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="efname">ชื่อจริง</label>
                    <input type="text" class="form-control" value="<?php echo $fname; ?>" name="fname" id="efname">
                </div>
                <div class="form-group col-md-4">
                    <label for="elname">นามสกุล</label>
                    <input type="text" class="form-control" value="<?php echo $lname; ?>" name="lname" id="elname">
                </div>
                <div class="form-group col-md-4">
                    <label for="enname">ชื่อเล่น</label>
                    <input type="text" class="form-control" value="<?php echo $nname; ?>" name="nname" id="enname">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="ebirthday">วันเกิด</label>
                    <input type="date" class="form-control" value="<?php echo $birthday; ?>" name="birthday" id="ebirthday">
                </div>
                <div class="form-group col-md-3">
                    <label for="bed">เลขเตียงนอน</label>
                    <input type="text" class="form-control" value="<?php echo $bed; ?>" name="bed" id="bed">
                </div>
            </div>
            <button type="submit" type="button" class="btn btn-primary">แก้ไขข้อมูล</button>
            <a class="btn btn-danger" href="manage.php" role="button">ยกเลิก</a>
        </form>
    </div>

    <script src="bootstrap/js/jquery-3.4.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
     
</body>
</html>
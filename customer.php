<?php
include 'connect.php';
include 'checkAuth.php';

    //รับค่าจากตาราง user
    $user_id = mysqli_real_escape_string($conn,$_SESSION['user_id']);
    $sql = "SELECT fname,lname,auth,pic FROM user WHERE user_id = $user_id;";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // ถ้ามีและเป็น customer ไปหน้า nurseNote.php
        while($row = $result->fetch_assoc()) {
           $imgURL = $row['pic'];
           $name = $row['fname']." ".$row['lname'];
           $auth = $row['auth'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <style>
        .rounded{
        object-fit: cover;
        border-radius: 70%;
        height: 50px;
        width: 50px;
        }
    </style>
</head>
<body>
    <div class="row bg-primary text-white" style="padding:15px">
        <div class="col-md-10 col-6" >
            <img src="<?php echo 'upload/'.$imgURL?>" style="height:30px" alt="" srcset="">
            <?php echo $name."&nbsp(".$auth.")"?>
        </div>
        <div class="col-md-2 col-6" >
           <a href="logout.php" style="color:white;">ออกจากระบบ</a>
        </div>
  
    </div>
    
    <ul class="nav nav-tabs" style="margin-top:5px">
        <li class="nav-item">
            <a class="nav-link " href="manage.php">ผู้สูงอายุ</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="customer.php">ลูกค้า</a>
        </li>

    <?php
       if($auth==="admin"){
    ?> 
        <li class="nav-item">
            <a class="nav-link" href="staff.php">บุคลากร</a>
        </li>
    <?php
       }
    ?>  
    </ul>

     <!-- ตาราง --> 
   <div class="container">
        <h3 class="text-center" style="margin:15px" >ข้อมูลลูกค้า</h3>
        <div class="row">
            <div class="col-md-12 ">
                <button type="button" class="btn btn-outline-success" style="margin-bottom:15px" data-toggle="modal" data-target="#addUser">+เพิ่มลูกค้า</button>
            </div>
        </div>
        <table id="table_id" class="table">
                <thead>
                    <tr>
                        
                        <th>รูปภาพ</th>
                        <th>ชื่อลูกค้า</th>
                        <th>เบอร์โทร</th>
                        <th>username</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                        $sql = "SELECT user_id,pic,fname,lname,auth,phone,username FROM user WHERE auth = 'ลูกค้า' ;";
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                            $show = '';
                            while($row = $result->fetch_assoc()) {
                                $show .= '<tr>';
                                    $show .= '<td>';
                                    $show .= '<img class="rounded" src="upload/'.$row['pic'].'" alt="" srcset="">';
                                    $show .= '</td>';
                                    $show .= '<td>';
                                    $show .= $row['fname']." ".$row['lname'];
                                    $show .= '</td>';
                                    $show .= '<td>';
                                    $show .= $row['phone'];
                                    $show .= '</td>';
                                    $show .= '<td>';
                                    $show .= $row['username'];
                                    $show .= '</td>';
                                    $show .= '<td>';
                                    $show .= '<button type="button" style="margin:3px" class="btn btn-success" onclick="readCus('.$row['user_id'].')">ดูข้อมูล</button>';
                                    $show .= '<a class="btn btn-warning" style="margin:3px" href="#" role="button" onclick="updateCus('.$row['user_id'].')">แก้ไขข้อมูล</a>';
                                    $show .= '<a class="btn btn-primary" style="margin:3px" href="#" role="button" onclick="createElder('.$row['user_id'].')" >เพิ่มผู้สูงอายุ</a>';
                                    $show .= '</td>';
                                $show .= '</tr>';
                            }
                        }
                        echo $show;
                   ?>
                </tbody>
        </table>
   </div>

   <!-- เพิ่ม user -->
   <div class="modal fade " id="addUser" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">เพิ่มลูกค้า และ ผู้สูงอายุ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="customer/create.php" method="post" enctype="multipart/form-data">
                        <h4 class="text-center" style="margin-bottom: 20px;">ข้อมูลลูกค้า</h4>
                        <div class="row">
                            <div class="form-group input-group col-md-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="fileimg" id="pic" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="pic">รูปภาพลูกค้า</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="username">username</label>
                                <input type="text" class="form-control" name="username" id="username">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="password">password</label>
                                <input type="password" class="form-control" name="password1" id="password">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="password">confirm password</label>
                                <input type="password" class="form-control" name="password2" id="password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="fname">ชื่อจริง</label>
                                <input type="text" class="form-control" name="fname" id="fname">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lname">นามสกุล</label>
                                <input type="text" class="form-control" name="lname" id="lname">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="idcard">บัตรประชาชน</label>
                                <input type="text" class="form-control" name="idcard" id="idcard">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="phone">โทรศัพท์</label>
                                <input type="text" class="form-control" name="phone" id="phone">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="birthday">วันเกิด</label>
                                <input type="date" class="form-control" name="birthday" id="birthday">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="location">ที่อยู่</label>
                                <textarea class="form-control" name="location" id="location" rows="2"></textarea>
                            </div>
                        </div>
                        <hr>
                        <h4 class="text-center" style="margin-bottom: 20px;">ข้อมูลผู้สูงอายุ</h4>
                        <div class="row">
                            <div class="form-group input-group col-md-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="fileimg2" id="pic" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="pic">รูปภาพผู้สูงอายุ</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="efname">ชื่อจริง</label>
                                <input type="text" class="form-control" name="efname" id="efname">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="elname">นามสกุล</label>
                                <input type="text" class="form-control" name="elname" id="elname">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="enname">ชื่อเล่น</label>
                                <input type="text" class="form-control" name="enname" id="enname">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="ebirthday">วันเกิด</label>
                                <input type="date" class="form-control" name="ebirthday" id="ebirthday">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="bed">เลขเตียงนอน</label>
                                <input type="text" class="form-control" name="bed" id="bed">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">เพิ่ม</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- อ่าน user -->
    <div class="modal fade " id="readUser" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">ข้อมูลลูกค้า</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="" class="" style="height:100px" id="rpic" alt="" srcset=""> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="rname">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="ruser">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="ruser">
                                
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <!-- แก้ไขข้อมูล user -->
    <div class="modal fade " id="updateCus" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">แก้ไขข้อมูลลูกค้า</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="customer/update.php" method="post" enctype="multipart/form-data">
                        <h4 class="text-center" style="margin-bottom: 20px;">ข้อมูลลูกค้า</h4>
                        <div class="row">
                            <div class="form-group input-group col-md-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="fileimg" id="upic" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="pic">รูปภาพลูกค้า</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="username">username</label>
                                <input type="text" class="form-control" name="username" id="uusername">
                                <input type="text" class="form-control" name="user_id" id="uuser_id" hidden>
                                <input type="text" class="form-control" name="uoldpic" id="uoldpic" hidden>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="password">password</label>
                                <input type="password" class="form-control" name="password1" id="upassword1">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="password">confirm password</label>
                                <input type="password" class="form-control" name="password2" id="upassword2">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="fname">ชื่อจริง</label>
                                <input type="text" class="form-control" name="fname" id="ufname">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lname">นามสกุล</label>
                                <input type="text" class="form-control" name="lname" id="ulname">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="idcard">บัตรประชาชน</label>
                                <input type="text" class="form-control" name="idcard" id="uidcard">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="phone">โทรศัพท์</label>
                                <input type="text" class="form-control" name="phone" id="uphone">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="birthday">วันเกิด</label>
                                <input type="date" class="form-control" name="birthday" id="ubirthday">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="location">ที่อยู่</label>
                                <textarea class="form-control" name="location" id="ulocation" rows="2"></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- เพิ่มผู้สูงอายุ -->
    <div class="modal fade " id="createElder" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">เพิ่มผู้สูงอายุ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="elder/create.php" method="post" enctype="multipart/form-data">
                        <h4 class="text-center" style="margin-bottom: 20px;">ข้อมูลผู้สูงอายุ</h4>
                        <div class="row">
                            <div class="form-group input-group col-md-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="fileimg2" id="epic" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="pic">รูปภาพผู้สูงอายุ</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="efname">ชื่อจริง</label>
                                <input type="text" class="form-control" name="fname" id="efname">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="elname">นามสกุล</label>
                                <input type="text" class="form-control" name="lname" id="elname">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="enname">ชื่อเล่น</label>
                                <input type="text" class="form-control" name="nname" id="enname">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="ebirthday">วันเกิด</label>
                                <input type="date" class="form-control" name="birthday" id="ebirthday">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="bed">เลขเตียงนอน</label>
                                <input type="text" class="form-control" name="bed" id="ebed">
                                <input type="text" class="form-control" name="user_id" id="euser_id" hidden>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">เพิ่มผู้สูงอายุ</button>
                  </form>
                </div>
            </div>
        </div>
    </div>

    <!-- แก้ไขข้อมูล user -->
    <div class="modal fade " id="updateCus" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">แก้ไขข้อมูลลูกค้า</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="customer/update.php" method="post" enctype="multipart/form-data">
                        <h4 class="text-center" style="margin-bottom: 20px;">ข้อมูลลูกค้า</h4>
                        <div class="row">
                            <div class="form-group input-group col-md-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="fileimg" id="upic" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="pic">รูปภาพลูกค้า</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="username">username</label>
                                <input type="text" class="form-control" name="username" id="uusername">
                                <input type="text" class="form-control" name="user_id" id="uuser_id" hidden>
                                <input type="text" class="form-control" name="uoldpic" id="uoldpic" hidden>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="password">password</label>
                                <input type="password" class="form-control" name="password1" id="upassword1">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="password">confirm password</label>
                                <input type="password" class="form-control" name="password2" id="upassword2">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="fname">ชื่อจริง</label>
                                <input type="text" class="form-control" name="fname" id="ufname">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lname">นามสกุล</label>
                                <input type="text" class="form-control" name="lname" id="ulname">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="idcard">บัตรประชาชน</label>
                                <input type="text" class="form-control" name="idcard" id="uidcard">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="phone">โทรศัพท์</label>
                                <input type="text" class="form-control" name="phone" id="uphone">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="birthday">วันเกิด</label>
                                <input type="date" class="form-control" name="birthday" id="ubirthday">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="location">ที่อยู่</label>
                                <textarea class="form-control" name="location" id="ulocation" rows="2"></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>                    
    <script src="bootstrap/js/jquery-3.4.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    
     <script>
         $(document).ready(function() {
            $('#table_id').dataTable( {
                                "oLanguage": {
                                "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
                                "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
                                "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
                                "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
                                "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
                                "sSearch": "ค้นหา :"
                        }
            } );

            $('#table_id').DataTable();

            
        } );

        function readCus(id){
                $.ajax({
                    url:"customer/read.php",
                    method:"POST",
                    data:{id:id},
                    success:function(data){
                        var obj = jQuery.parseJSON(data);
                        $('#readUser').modal('show');
                        $('#rname').html("");
                        $('#ruser').html("");
                        $('#rpic').attr("src",'upload/'+obj.customer.pic);
                        $('#rname').append(" "+obj.customer.fname+" "+obj.customer.lname);
                        $('#ruser').append("user : "+obj.customer.username+" <br>password : "+obj.customer.password);
                        $('#ruser').append("<br>เบอร์โทร : "+obj.customer.phone);
                        $('#ruser').append("<br>idcard : "+obj.customer.idcard+" <br>ที่อยู่ : "+obj.customer.location);
                       
                        console.log(obj);
                    }
                });
        }
        
        function updateCus(id){
            $.ajax({
                url:"customer/read.php",
                method:"POST",
                data:{id:id},
                success:function(data){
                    var obj = jQuery.parseJSON(data);
                    $('#updateCus').modal('show');
                    $('#uuser_id').val(id);
                    $('#uoldpic').val(obj.customer.pic);
                    $('#uusername').val(obj.customer.username);
                    $('#upassword').val(obj.customer.password);
                    $('#upassword1').val(obj.customer.password);
                    $('#upassword2').val(obj.customer.password);
                    $('#ufname').val(obj.customer.fname);
                    $('#ulname').val(obj.customer.lname);
                    $('#uphone').val(obj.customer.phone);
                    $('#uidcard').val(obj.customer.idcard);
                    $('#ubirthday').val(obj.customer.birthday);
                    $('#ulocation').val(obj.customer.location);
                    console.log(obj);
                }
            });
        }

        function createElder(id){
            $('#createElder').modal('show');
            $('#euser_id').val(id);
        }
     </script>  
</body>
</html>
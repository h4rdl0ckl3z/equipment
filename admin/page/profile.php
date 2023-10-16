<?php
    if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
        header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
        exit;
    }
    include_once("./src/connect.php");
    $objCon = connectDB();
    $account_id = $_GET['account_id'];
    $strSQL = "SELECT * FROM accounts WHERE account_id = $account_id";
    $objQuery = mysqli_query($objCon, $strSQL);
    $row = mysqli_num_rows($objQuery);
    if($row) {
        $res = mysqli_fetch_assoc($objQuery);
    }
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">แก้ไขผู้ใช้งาน</h3>
                        </div>
                        <form method="post" action="?account_id=<?=$res['account_id'];?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">ชื่อ-สกุล</label>
                                            <input type="text" class="form-control" name="fullname" id="fullname" value="<?=$res['fullname'];?>"
                                                placeholder="ชื่อ-สกุล" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">เบอร์โทร</label>
                                            <input type="text" class="form-control" name="phone" id="phone" value="<?=$res['phone'];?>"
                                                placeholder="เบอร์โทร" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ที่อยู่</label>
                                    <textarea class="form-control" name="address" id="address"
                                        placeholder="ที่อยู่" required><?=$res['address'];?></textarea>
                                </div>  
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ชื่อผู้ใช้งาน</label>
                                    <input type="text" class="form-control" name="username" id="username" value="<?=$res['username'];?>"
                                        placeholder="ชื่อผู้ใช้งาน" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">รหัสผ่าน</label>
                                    <input type="password" class="form-control" name="passwd" id="passwd"
                                        placeholder="รหัสผ่าน" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ยืนยันรหัสผ่าน</label>
                                    <input type="password" class="form-control" name="passwd2" id="passwd2"
                                        placeholder="กรอกรหัสผ่านอีกครั้ง" required>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                    if (isset($_POST['username']) && isset($_POST['passwd']) && isset($_POST['passwd2']) && isset($_POST['address']) && isset($_POST['fullname']) && isset($_POST['phone'])) {
                        $username = $_POST['username'];
                        $password = $_POST['passwd'];
                        $password2 = $_POST['passwd2'];
                        $address = $_POST['address'];
                        $fullname = $_POST['fullname'];
                        $phone = $_POST['phone'];
                        if ($password <> $password2) {
                            echo "
                            <script src='./dist/js/sweetalert2.all.min.js'></script>
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เกิดข้อผิดพลาด',
                                    text: 'Password ไม่ถูกต้อง!',
                                    timer: 1200,
                                    showConfirmButton: false
                                })
                            </script>";
                        } else {
                            $passwd = md5($password);
                            $strSQL = "UPDATE accounts SET username='$username', passwd='$passwd', address='$address', fullname='$fullname', phone='$phone' WHERE account_id = $account_id";
                            $stmt = $objCon->prepare($strSQL);
                            $stmt->execute(); 
                            echo "
                            <script src='./dist/js/sweetalert2.all.min.js'></script>
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'ดำเดินการสำเร็จ',
                                    text: 'ทำการบันทึกเรียบร้อย',
                                    timer: 1200,
                                    showConfirmButton: false
                                })
                            </script>";
                        }                    
                    }

                ?>
                <div class="col-sm-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">อัพโหลด</h3>
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <input type="hidden" name="account_id" id="account_id" value="<?=$res['account_id'];?>">
                                <div class="form-group">
                                    <label for="exampleInputFile">เลือกรูปภาพ</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="profile_img" id="profile_img" accept="image/*" required>
                                            <label class="custom-file-label" for="exampleInputFile">เลือกไฟล์</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">อัพโหลด</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">บันทึกรูปภาพ</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                    if (isset($_FILES["profile_img"])) {
                        $profile_img = $_FILES["profile_img"]["name"];
                        $temp_file = $_FILES["profile_img"]["tmp_name"];
                        $file_str = date("Ymd") . "_" . uniqid();
                        $dotfile = explode(".",$profile_img);
                        $profile_new = $file_str . "." . $dotfile[1];
                        if (!isset($profile_img)) {
                            echo "
                            <script src='./dist/js/sweetalert2.all.min.js'></script>
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เกิดข้อผิดพลาด',
                                    text: 'ไม่สามารถอัพโหลดรูปภาพได้!',
                                    timer: 1200,
                                    showConfirmButton: false
                                }).then((result) => {
                                    window.location = './profile.php?account_id=$account_id'
                                })
                            </script>";
                        } else {
                            move_uploaded_file($temp_file, "../upload/profile/" . $profile_new);
                            $strSQL = "UPDATE accounts SET profile_img='$profile_new' WHERE account_id = $account_id";
                            $stmt = $objCon->prepare($strSQL);
                            $stmt->execute(); 
                            echo "
                            <script src='./dist/js/sweetalert2.all.min.js'></script>
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'ดำเดินการสำเร็จ',
                                    text: 'ทำการบันทึกเรียบร้อย',
                                    timer: 1200,
                                    showConfirmButton: false
                                }).then((result) => {
                                    window.location = '../index.php'
                                })
                            </script>";
                        }                    
                    }

                ?>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
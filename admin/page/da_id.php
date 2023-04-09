<?php
if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
    header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
    exit;
}
include_once("./src/connect.php");
$objCon = connectDB();
$da_id = $_GET['da_id'];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">DA Upload</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                        <li class="breadcrumb-item active">DA Upload</li>
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
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">อัพโหลด</h3>
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <input type="hidden" name="da_id" id="da_id" value="<?= $da_id ?>">
                                <div class="form-group">
                                    <label for="exampleInputFile">เลือกรูปภาพ</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="da_img" id="da_img"
                                                accept="image/*" required>
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
            </div>
            <?php
            if (isset($_FILES["da_img"])) {
                $da_img = $_FILES["da_img"]["name"];
                $temp_file = $_FILES["da_img"]["tmp_name"];
                $file_str = date("Ymd") . "_" . uniqid();
                $dotfile = explode(".", $da_img);
                $da_new = $file_str . "." . $dotfile[1];
                if (!isset($da_img)) {
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
                                window.location = './da_id.php?da_id=$da_id'
                            })
                        </script>";
                } else {
                    move_uploaded_file($temp_file, "../upload/da/" . $da_new);
                    $strSQL = "UPDATE da_items SET da_img='$da_new' WHERE da_id ='" . $da_id . "'";
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
                                window.location = './da_item.php'
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
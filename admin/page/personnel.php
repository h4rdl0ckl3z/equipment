<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Personnel</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                        <li class="breadcrumb-item active">Personnel</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">ผู้ใช้งาน</h3>
                        </div>
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <table id="PersonTable" class="table table-bordered dataTable dtr-inline"
                                    aria-describedby="example1_info">
                                    <thead class="text-center">
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อ-สกุล</th>
                                            <th>ที่อยู่</th>
                                            <th>เบอร์โทร</th>
                                            <th>แผนก</th>
                                            <th>สาขา</th>
                                            <th>ระดับผู้ใช้งาน</th>
                                            <th>แก้ไข</th>
                                            <th>ลบ</th>
                                            <th>เพิ่มเติม</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center" id="tbody">

                                    </tbody>
                                    <!-- <tfoot class="text-center">
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อ-สกุล</th>
                                            <th>ที่อยู่</th>
                                            <th>เบอร์โทร</th>
                                            <th>แผนก</th>
                                            <th>ระดับผู้ใช้งาน</th>
                                            <th>แก้ไข</th>
                                            <th>ลบ</th>
                                            <th>เพิ่มเติม</th>
                                        </tr>
                                    </tfoot> -->
                                </table>
                            </div>
                            <!-- Button trigger modal -->
                            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#person_add"
                                title="เพิ่มข้อมูล" onclick="person_add_data()">
                                <i class="fas fa-user-plus"></i> เพิ่มข้อมูล
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
    $agency_id = $row['agency_id'];
    $access_level = $row['access_level'];
?>

<input type="hidden" name="access_level" id="access_level" value="<?= $row["access_level"] ?>">
<input type="hidden" name="agency_id" id="agency_id" value="<?= $row["agency_id"] ?>">

<!-- Modal Add $Edit-->
<div class="modal fade" id="person_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form method="post" id="insert_person_form">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="hidden" name="account_id" id="account_id">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ชื่อ-สกุล</label>
                                        <input type="text" class="form-control" name="fullname" id="fullname"
                                            placeholder="ชื่อ-สกุล" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">เบอร์โทร</label>
                                        <input type="text" class="form-control" name="phone" id="phone"
                                            placeholder="เบอร์โทร" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">ที่อยู่</label>
                                <textarea class="form-control" name="address" id="address" required></textarea>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ชื่อผู้ใช้งาน</label>
                                        <input type="text" class="form-control" name="username" id="username"
                                            placeholder="ชื่อผู้ใช้งาน" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ระดับผู้ใช้งาน</label>
                                        <select class="form-control" name="access_level" id="access_level" required>
                                            <?php
                                                if ($row['access_level'] == 0)
                                                echo '
                                                <option value="0">ผู้ดูแลระบบ</option>
                                                <option value="2">เจ้าหน้าที่</option>
                                                ';
                                            ?>
                                            <option value="1">ผู้บริหาร</option>
                                            <option value="3" selected>ผู้ใช้งาน</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">รหัสผ่าน</label>
                                        <input type="password" class="form-control" name="passwd" id="passwd"
                                            placeholder="รหัสผ่าน" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ยืนยันรหัสผ่าน</label>
                                        <input type="password" class="form-control" name="passwd2" id="passwd2"
                                            placeholder="รหัสผ่าน" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">แผนก</label>
                                <select class="form-control" name="section_id" id="section_id" required>
                                    <?php
                                    include_once("./src/connect.php");
                                    $conn = connectDB();
                                    $sql = "SELECT * FROM sections";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["section_id"] . '">' . $row["section_name"] . '</option>';
                                        }
                                    }
                                    $conn->close();
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">สาขา</label>
                                <select class="form-control" name="agency_id" id="agency_id">
                                    <?php
                                    include_once("./src/connect.php");
                                    $conn = connectDB();
                                    if ($access_level == 0) {
                                        $sql = "SELECT * FROM agencys";
                                    } else {
                                        $sql = "SELECT * FROM agencys WHERE agency_id = '$agency_id'";
                                    }
                                    
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["agency_id"] . '">' . $row["agency_name"] . '</option>';
                                        }
                                    }
                                    $conn->close();
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="locat_insert" class="btn btn-success">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"
                                onclick="clear_modal()">Cancel</button>
                            <button type="button" class="btn btn-primary" onclick="clear_modal()">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal View -->
<div class="modal fade" id="person_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">
                    ข้อมูลผู้ใช้งาน
                </h5>
            </div>
            <div class="modal-body" id="detail">
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="person_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">
                    ลบข้อมูลผู้ใช้งาน
                </h5>
            </div>
            <div class="modal-body">
                <span>ต้องการลบข้อมูลผู้ใช้งานหรือไม่</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info person_confirm_delete">ลบข้อมูล</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
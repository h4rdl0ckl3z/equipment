<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Durable Articles (Borrow)</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                        <li class="breadcrumb-item active">Durable Articles (Borrow)</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <input type="hidden" name="access_level" id="access_level" value="<?= $row["access_level"] ?>">
    <input type="hidden" name="agency_id" id="agency_id" value="<?= $row["agency_id"] ?>">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">ครุภัณฑ์ <span style="font-size: 10pt; color: red;">หมายเหตุ *ผู้ดูแลระบบ และเจ้าหน้าที่ไม่สามารถกดยืมได้โดยตรง ต้องเพิ่มข้อมูลเท่านั้น</span></h3>
                        </div>
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <table id="Da_ItemTable_Borrow" class="table table-bordered dataTable dtr-inline"
                                    aria-describedby="example1_info">
                                    <thead class="text-center">
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>รหัสครุภัณฑ์</th>
                                            <th>รายการครุภัณฑ์</th>
                                            <th>รูปครุภัณฑ์</th>
                                            <th>สภาพครุภัณฑ์</th>
                                            <th>หน่วยนับ</th>
                                            <th>มูลค่าครุภัณฑ์ (บาท)</th>
                                            <th>วันที่ได้มา</th>
                                            <th>แหล่งเงิน</th>
                                            <th>คุณสมบัติ (ยี่ห้อ/รุ่น)</th>
                                            <th>หมายเหตุ/เลขครุภัณฑ์เดิม</th>
                                            <th>สถานที่ตั้ง/จัดเก็บ</th>
                                            <th>สถานะครุภัณฑ์</th>
                                            <th>ประเภทครุภัณฑ์</th>
                                            <th>รหัสห้อง</th>
                                            <th>ประเภทห้อง</th>
                                            <th>สาขา</th>
                                            <th>คณะ</th>
                                            <th>ยืม</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">ยืม-คืนครุภัณฑ์</h3>
                        </div>
                        <div class="card-body">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <table id="Da_BorrowTable" class="table table-bordered dataTable dtr-inline"
                                    aria-describedby="example1_info">
                                    <thead class="text-center">
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อผู้ยืม</th>
                                            <th>รหัสครุภัณฑ์</th>
                                            <th>รายการครุภัณฑ์</th>
                                            <th>ยืมวันที่</th>
                                            <th>คืนวันที่</th>
                                            <th>สถานะการยืม</th>
                                            <th>แก้ไข</th>
                                            <th>ลบ</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">

                                    </tbody>
                                </table>
                            </div>
                            <!-- Button trigger modal -->
                            <button class="btn btn-success" type="button" data-toggle="modal"
                                data-target="#da_borrow_add" title="เพิ่มข้อมูล" onclick="da_borrow_add_data()">
                                <i class="fas fa-plus-square"></i> เพิ่มข้อมูล
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

<!-- Modal Add $Edit-->
<div class="modal fade" id="da_borrow_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                    <form method="post" id="insert_da_borrow_form">
                        <input type="hidden" name="dabr_id" id="dabr_id">
                        <div class="form-group">
                            <label for="exampleInputEmail1">ชื่อผู้ยืม</label>
                            <select class="form-control" name="account_id" id="account_id" required>
                                <?php
                                include_once("./src/connect.php");
                                $conn = connectDB();
                                if ($access_level == 0) {
                                    $sql = "SELECT * FROM accounts";
                                } else {
                                    $sql = "SELECT * FROM accounts WHERE access_level <> '0' AND agency_id ='$agency_id'";
                                }
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row["account_id"] . '">' . $row["fullname"] . '</option>';
                                    }
                                }
                                $conn->close();
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">รหัสครุภัณฑ์</label>
                            <input type="text" class="form-control" name="da_id" id="da_id" placeholder="รหัสครุภัณฑ์"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">สถานที่ตั้ง/จัดเก็บ</label>
                            <input type="text" class="form-control" name="da_location" id="da_location"
                                placeholder="สถานที่ตั้ง/จัดเก็บ" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">วันที่ยืม</label>
                            <input type="date" class="form-control" name="da_borrow" id="da_borrow" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">วันที่คืน</label>
                            <input type="date" class="form-control" name="da_return" id="da_return" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">สถานะการยืม</label>
                            <select class="form-control" name="allow_br" id="allow_br">
                                <option value="0">รอดำเนินการ</option>
                                <option value="1">ยืม</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="da_borrow_insert" class="btn btn-success">Submit</button>
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

<!-- Modal Borrow -->
<div class="modal fade" id="da_item_borrow" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">
                    เลือกระยะเวลาการยืม
                </h5>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">วันที่ยืม</label>
                        <input type="date" class="form-control" name="da_borrow" id="da_borrow" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">วันที่คืน</label>
                        <input type="date" class="form-control" name="da_return" id="da_return" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info da_item_confirm_borrow">ยืม</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="da_item_borrow_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">
                    ลบการยืม
                </h5>
            </div>
            <div class="modal-body">
                <span>ต้องการลบข้อมูลการยืมหรือไม่</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info agency_confirm_delete">ลบข้อมูล</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
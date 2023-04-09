<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Durable Articles</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                        <li class="breadcrumb-item active">Durable Articles</li>
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
                            <h3 class="card-title">ครุภัณฑ์</h3>
                        </div>
                        <form method="post" id="delete_da_item_form">
                            <div class="card-body">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <table id="Da_ItemTable" class="table table-bordered dataTable dtr-inline"
                                        aria-describedby="example1_info">
                                        <thead class="text-center">
                                            <tr>
                                                <th><input type="checkbox" name="checkbox_da_id[]" id="checkbox_da_id"
                                                        onclick="checkUncheck(this)"></th>
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
                                    data-target="#da_item_add" title="เพิ่มข้อมูล" onclick="da_item_add_data()">
                                    <i class="fas fa-plus-square"></i> เพิ่มข้อมูล
                                </button>
                                <button class="btn btn-danger delete_select" type="button" data-toggle="modal"
                                    data-target="#da_item_delete_select" title="Delete">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </div>

                            <!-- Modal Delete Select -->
                            <div class="modal fade" id="da_item_delete_select" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">
                                                ลบครุภัณฑ์
                                            </h5>
                                        </div>
                                        <div class="modal-body">
                                            <span>ต้องการลบครุภัณฑ์ที่เลือกหรือไม่</span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info" id="da_item_delete">ลบข้อมูล</button>
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">ยกเลิก</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Add $Edit-->
<div class="modal fade" id="da_item_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                <form method="post" id="insert_da_item_form">
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">รหัสครุภัณฑ์</label>
                                        <input type="text" class="form-control" name="da_id" id="da_id"
                                            placeholder="รหัสครุภัณฑ์" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">รายการครุภัณฑ์</label>
                                        <textarea class="form-control" name="da_lists" id="da_lists"
                                            required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">สภาพครุภัณฑ์</label>
                                        <select class="form-control" name="da_status_i" id="da_status_i" required>
                                            <option value="0" selected>ปกติ</option>
                                            <option value="1">ชำรุด</option>
                                            <option value="2">เสื่อมคุณถาพ</option>
                                            <option value="3">สูญหาย</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">หน่วยนับ</label>
                                        <input type="text" class="form-control" name="da_unit" id="da_unit"
                                            placeholder="หน่วยนับ" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">มูลค่าครุภัณฑ์ (บาท)</label>
                                        <input type="text" class="form-control" name="da_rates" id="da_rates"
                                            placeholder="มูลค่าครุภัณฑ์ (บาท)" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">วันที่ได้มา</label>
                                        <input type="date" class="form-control" name="da_date" id="da_date"
                                            placeholder="วันที่ได้มา" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">แหล่งเงิน</label>
                                        <input type="text" class="form-control" name="da_source" id="da_source"
                                            placeholder="แหล่งเงิน" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">คุณสมบัติ</label>
                                        <input type="text" class="form-control" name="da_feature" id="da_feature"
                                            placeholder="คุณสมบัติ (ยี่ห่อ/รุ่น)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">หมายเหตุ</label>
                                        <textarea class="form-control" name="da_annotation" id="da_annotation"
                                            placeholder="หมายเหตุ/เลขครุภัณฑ์เดิม"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">สถานที่ตั้ง</label>
                                        <input type="text" class="form-control" name="da_location" id="da_location"
                                            placeholder="สถานที่ตั้ง/จัดเก็บ" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="exampleInputEmail1">สถานะครุภัณฑ์</label>
                                    <select class="form-control" name="da_status_ii" id="da_status_ii">
                                        <option value="0">ปกติ</option>
                                        <option value="1">ยืม</option>
                                        <option value="2">แจ้งซ่อม</option>
                                        <option value="3" selected>ครุภัณฑ์ห้อง</option>
                                        <option value="4">การตัดจำหน่าย</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ประเภทครุภัณฑ์</label>
                                        <select class="form-control" name="da_type_id" id="da_type_id" required>
                                            <?php
                                            include_once("./src/connect.php");
                                            $conn = connectDB();
                                            $sql = "SELECT * FROM da_types";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option value="' . $row["da_type_id"] . '">' . $row["da_type_name"] . '</option>';
                                                }
                                            }
                                            $conn->close();
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">รหัสห้อง</label>
                                        <select class="form-control" name="room_id" id="room_id" required>
                                            <?php
                                            include_once("./src/connect.php");
                                            $conn = connectDB();
                                            $sql = "SELECT * FROM rooms";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option value="' . $row["room_id"] . '">' . $row["room_id"] . '</option>';
                                                }
                                            }
                                            $conn->close();
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="da_item_insert" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            onclick="clear_modal()">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="clear_modal()">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="da_item_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">
                    ลบครุภัณฑ์
                </h5>
            </div>
            <div class="modal-body">
                <span>ต้องการลบครุภัณฑ์หรือไม่</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info da_item_confirm_delete">ลบข้อมูล</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
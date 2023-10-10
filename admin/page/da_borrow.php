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

    <input type="hidden" name="access_level" id="access_level" value="<?= $row['access_level']?>">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">ครุภัณฑ์</h3>
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
                                    <tbody>
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
                                            <th>สถาพครุภัณฑ์ (ก่อนยืม)</th>
                                            <th>สถาพครุภัณฑ์ (หลังยืม)</th>
                                            <th>สถานที่</th>
                                            <th>ยืมวันที่</th>
                                            <th>คืนวันที่</th>
                                            <th>สถานะครุภัณฑ์</th>
                                            <th>สถานะการยืม</th>
                                            <?php
                                                if ($row['access_level'] == 0 || $row['access_level'] == 2)
                                                echo '<th>อนุมัติ</th>
                                                <th>ไม่อนุมัติ</th>
                                                <th>คืน</th>';
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Modal Borrow Add -->
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
                    <form method="post" id="da_borrow_form">
                        <div class="form-group">
                            <input type="hidden" name="account_id" id="account_id" value="<?= $row["account_id"] ?>">
                            <label for="exampleInputEmail1">วันที่ยืม</label>
                            <input type="date" class="form-control" name="da_borrow" id="da_borrow" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">วันที่คืน</label>
                            <input type="date" class="form-control" name="da_return" id="da_return" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">สถานที่</label>
                            <input type="text" class="form-control" name="da_br_location" id="da_br_location" placeholder="สถานที่" required>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info da_item_confirm_borrow">ยืม</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="clear_modal_borrow_date()">ยกเลิก</button>
                <button type="button" class="btn btn-primary" onclick="clear_modal_borrow_date()">Reset</button>
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
                    ลบสาขา
                </h5>
            </div>
            <div class="modal-body">
                <span>ต้องการลบข้อมูลสาขาหรือไม่</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info agency_confirm_delete">ลบข้อมูล</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
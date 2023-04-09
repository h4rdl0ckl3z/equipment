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
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Add $Edit-->
<div class="modal fade" id="section_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                    <form method="post" id="insert_section_form">
                        <input type="hidden" name="section_id" id="section_id">
                        <div class="form-group">
                            <label for="exampleInputEmail1">แผนก</label>
                            <input type="text" class="form-control" name="section_name" id="section_name"
                                placeholder="แผนก" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="section_insert" class="btn btn-success">Submit</button>
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

<!-- Modal Delete -->
<div class="modal fade" id="section_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">
                    ลบข้อมูลแผนก
                </h5>
            </div>
            <div class="modal-body">
                <span>ต้องการข้อมูลแผนกหรือไม่</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info section_confirm_delete">ลบข้อมูล</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
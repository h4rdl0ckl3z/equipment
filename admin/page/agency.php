<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Agency</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                        <li class="breadcrumb-item active">Agency</li>
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
                            <h3 class="card-title">สาขา</h3>
                        </div>
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <table id="AgencyTable" class="table table-bordered dataTable dtr-inline"
                                    aria-describedby="example1_info">
                                    <thead class="text-center">
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>รหัสคณะ/รหัสสาขา</th>
                                            <th>คณะ/สาขา</th>
                                            <th>แก้ไข</th>
                                            <th>ลบ</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- Button trigger modal -->
                            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#agency_add"
                                title="เพิ่มข้อมูล" onclick="agency_add_data()">
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

<!-- Modal Add $Edit-->
<div class="modal fade" id="agency_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                    <form method="post" id="insert_agency_form">
                        <div class="form-group">
                            <label for="exampleInputEmail1">รหัสคณะ/รหัสสาขา</label>
                            <input type="text" class="form-control" name="agency_id" id="agency_id"
                                placeholder="รหัสคณะ/รหัสสาขา" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">คณะ/สาขา</label>
                            <input type="text" class="form-control" name="agency_name" id="agency_name"
                                placeholder="คณะ/สาขา" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="agency_insert" class="btn btn-success">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="clear_modal()">Cancel</button>
                            <button type="button" class="btn btn-primary" onclick="clear_modal()">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="agency_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                <button type="submit" class="btn btn-info agency_confirm_delete">ลบข้อมูล</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Durable Articles (QRCode)</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                        <li class="breadcrumb-item active">Durable Articles (QRCode)</li>
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
                            <h3 class="card-title">ครุภัณฑ์ <span style="font-size: 10pt; color: red;">หมายเหตุ
                                    *ผู้ดูแลระบบ และเจ้าหน้าที่สามารถกดเพิ่มได้</span>
                            </h3>
                        </div>
                        <form method="post" id="qrcode_select_form">
                            <div class="card-body">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <table id="Da_ItemTable_QrCode" class="table table-bordered dataTable dtr-inline"
                                        aria-describedby="example1_info">
                                        <thead class="text-center">
                                            <tr>
                                                <th><input type="checkbox" name="checkbox_da_id[]" id="checkbox_da_id"
                                                        onclick="checkUncheck(this)"></th>
                                                <th>ลำดับ</th>
                                                <th>รหัสครุภัณฑ์</th>
                                                <th>ชื่อครุภัณฑ์</th>
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
                                                <th>เพิ่ม QrCode</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        </tbody>
                                    </table>
                                    <button class="btn btn-success qrcode_select2" type="button" data-toggle="modal"
                                        data-target="#da_item_qrcode_select" title="Qrcode">
                                        <i class="fas fa-qrcode"></i> เพิ่ม Qrcode
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- Modal Qrcode Select -->
                        <div class="modal fade" id="da_item_qrcode_select" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle02" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle02">
                                            เพิ่ม Qrcode ครุภัณฑ์
                                        </h5>
                                    </div>
                                    <div class="modal-body">
                                        <span>ต้องการเพิ่ม Qrcode ครุภัณฑ์ที่เลือกหรือไม่</span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info qrcode_confirm">เพิ่ม
                                            Qrcode</button>
                                        <button type="button" class="btn btn-danger"
                                            data-dismiss="modal">ยกเลิก</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">QrCode ครุภัณฑ์ <span style="font-size: 10pt; color: red;">หมายเหตุ *QrCode จะถูกลบก็ต่อเมื่อลบครุภัณฑ์</span>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <table id="Da_ItemQrCodeTable" class="table table-bordered dataTable dtr-inline"
                                    aria-describedby="example1_info" style="font-family: 'THSarabun';">
                                    <thead class="text-center">
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>รหัสครุภัณฑ์</th>
                                            <th>QRCode</th>
                                            <th>Link</th>
                                            <th>วันที่สร้าง</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-success" onclick="Convert_HTML_To_PDF()">ดาวน์โหลด</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Delete -->
<div class="modal fade" id="da_item_qrcode_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">
                    ลบ qrcode ครุภัณฑ์
                </h5>
            </div>
            <div class="modal-body">
                <span>ต้องการลบ qrcode ครุภัณฑ์หรือไม่</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info da_item_qrcode_confirm_delete">ลบข้อมูล</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Qrcode -->
<div class="modal fade" id="da_item_qrcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">
                    เพิ่ม qrcode
                </h5>
            </div>
            <div class="modal-body">
                <span>ต้องการเพิ่ม qrcode หรือไม่</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info da_item_confirm_qrcode">เพิ่ม</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
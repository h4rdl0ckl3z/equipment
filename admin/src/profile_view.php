<?php
session_start(); // เปิดใช้งาน session
if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
    header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
    exit;
}
include_once("./connect.php");
$conn = connectDB();
$account_id = $_POST["id"];
// echo $account_id;
$sql = "SELECT * FROM ((accounts INNER JOIN sections ON accounts.section_id = sections.section_id)
INNER JOIN agencys ON accounts.agency_id = agencys.agency_id) WHERE account_id=" . $account_id;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { ?>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">ชื่อ-สกุล</label>
                        <input type="text" class="form-control" name="fullname" id="fullname" placeholder="ชื่อ-สกุล" readonly
                            value="<?= $row["fullname"] ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">เบอร์โทร</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="เบอร์โทร" readonly
                            value="<?= $row["phone"] ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">ที่อยู่</label>
                <textarea class="form-control" name="address" id="address" placeholder="ที่อยู่"
                    readonly><?= $row["address"] ?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">ชื่อผู้ใช้งาน</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="ชื่อผู้ใช้งาน" readonly
                    value="<?= $row["username"] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputSection">แผนก</label>
                <input type="text" class="form-control" name="section" id="section" placeholder="แผนก" readonly
                    value="<?= $row["section_name"] ?>">
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputSection">สาขา</label>
                        <input type="text" class="form-control" name="agency_name" id="agency_name" placeholder="สาขา" readonly
                            value="<?= $row["agency_name"] ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputAccess">ระดับผู้ใช้งาน</label>
                        <input type="text" class="form-control" name="access_level" id="access_level"
                            placeholder="ระดับผู้ใช้งาน" readonly <?php if ($row["access_level"] == '0') {
                                echo "value='ผู้ดูแลระบบ'";
                            } elseif ($row["access_level"] == '1') {
                                echo "value='ผู้บริหาร'";
                            } elseif ($row["access_level"] == '2') {
                                echo "value='เจ้าหน้าที่'";
                            } else {
                                echo "value='ผู้ใช้งาน'";
                            }
                            ?>>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
        </div>
    <?php }
}
$conn->close();
?>
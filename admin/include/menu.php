<?php
if ($row["access_level"] == '0' or $row["access_level"] == '2') {
?>
<li class="nav-item" id="1">
    <a href="./index.php" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>
            หน้าหลัก
        </p>
    </a>
</li>
<li class="nav-header">จัดการทั่วไป</li>
<li class="nav-item">
    <a href="./personnel.php" class="nav-link">
        <i class="nav-icon fas fa-user-alt"></i>
        <p>
            ผู้ใช้งาน
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="./section.php" class="nav-link">
        <i class="nav-icon far fa-address-card"></i>
        <p>
            แผนก
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="./agency.php" class="nav-link">
        <i class="nav-icon fa fa-map-pin"></i>
        <p>
            สาขา
        </p>
    </a>
</li>
<li class="nav-header">จัดการห้อง</li>
<li class="nav-item">
    <a href="./room.php" class="nav-link">
        <i class="nav-icon far fa-building"></i>
        <p>
            ห้อง
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="./room_type.php" class="nav-link">
        <i class="nav-icon fas fa-door-closed"></i>
        <p>
            ประเภทห้อง
        </p>
    </a>
</li>
<li class="nav-header">จัดการครุภัณฑ์</li>
<li class="nav-item">
    <a href="./da_item.php" class="nav-link">
        <i class="nav-icon fas fa-box"></i>
        <p>
            ครุภัณฑ์
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="./da_type.php" class="nav-link">
        <i class="nav-icon fas fa-boxes"></i>
        <p>
            ประเภทครุภัณฑ์
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="./da_borrow.php" class="nav-link">
        <i class="nav-icon fas fa-exchange-alt"></i>
        <p>
            ยืม-คืนครุภัณฑ์
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="./da_sale.php" class="nav-link">
        <i class="nav-icon fas fa-store-slash"></i>
        <p>
            การจัดจำหน่าย
        </p>
    </a>
</li>
<li class="nav-header">จัดการแจ้งซ่อม</li>
<li class="nav-item">
    <a href="./da_da_repair.php" class="nav-link">
        <i class="nav-icon fas fa-tools"></i>
        <p>
            แจ้งซ่อม
        </p>
    </a>
</li>
<li class="nav-header">จัดการ QrCode</li>
<li class="nav-item">
    <a href="./da_qrcode.php" class="nav-link">
        <i class="nav-icon fas fa-qrcode"></i>
        <p>
            ครุภัณฑ์
        </p>
    </a>
</li>
<li class="nav-header">รายงาน</li>
<li class="nav-item">
    <a href="./doc_da.php" class="nav-link">
        <i class="nav-icon far fa-file-pdf"></i>
        <p>
            ครุภัณฑ์
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-file-pdf"></i>
        <p>
            การยืม-คืนครุภัณฑ์
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-file-pdf"></i>
        <p>
            การจัดจำหน่ายครุภัณฑ์
        </p>
    </a>
</li>
<?php
} elseif ($row["access_level"] == '1') {
?>
<li class="nav-item" id="1">
    <a href="./index.php" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>
            หน้าหลัก
        </p>
    </a>
</li>
<?php
} else {
?>
<li class="nav-item" id="1">
    <a href="./index.php" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>
            หน้าหลัก
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="./da_borrow.php" class="nav-link">
        <i class="nav-icon fas fa-exchange-alt"></i>
        <p>
            ยืม-คืนครุภัณฑ์
        </p>
    </a>
</li>
<?php
}
?>
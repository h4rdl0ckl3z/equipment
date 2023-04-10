<?php
    session_start(); // เปิดใช้งาน session
    if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
        header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
        exit;
    }
    include_once("./connect.php");
    $conn = connectDB();
    $da_id = $_POST["da_id"];
    $da_location = $_POST["da_location"];
    $allow_br = $_POST["allow_br"];
    if ($allow_br != '0') {
        $sql = "UPDATE da_items, da_brs SET da_items.da_status_ii = '1', da_items.da_location = '$da_location', da_brs.allow_br = '$allow_br' WHERE da_items.da_id = '$da_id' AND da_brs.da_id = '$da_id'";
    } else {
        $sql = "UPDATE da_items, da_brs SET da_items.da_status_ii = '0', da_items.da_location = '$da_location', da_brs.allow_br = '$allow_br' WHERE da_items.da_id = '$da_id' AND da_brs.da_id = '$da_id'";
    }
    $conn->query($sql);
    $conn->close();
?>
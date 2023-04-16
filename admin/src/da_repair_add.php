<?php
    session_start(); // เปิดใช้งาน session
    if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
        header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
        exit;
    }
    include_once("./connect.php");
    $conn = connectDB();
    $da_id = $_POST["da_id"];
    $da_r_id = $_POST["da_r_id"];
    $da_location = $_POST["da_location"];
    $da_repair = $_POST["da_repair"];
    $da_repair_status = $_POST["da_repair_status"];
    if ($da_repair_status != '0') {
        $sql = "UPDATE da_items, da_repairs SET da_items.da_status_ii = '2', da_items.da_location = '$da_location', da_repairs.da_repair='$da_repair', da_repairs.da_repair_status = '$da_repair_status' WHERE da_items.da_id = '$da_id' AND da_repairs.da_r_id = '$da_r_id'";
    } else {
        $sql = "UPDATE da_items, da_repairs SET da_items.da_status_ii = '0', da_items.da_location = '$da_location', da_repairs.da_repair='$da_repair', da_repairs.da_repair_status = '$da_repair_status' WHERE da_items.da_id = '$da_id' AND da_repairs.da_r_id = '$da_r_id'";
    }
    $conn->query($sql);
    $conn->close();
?>
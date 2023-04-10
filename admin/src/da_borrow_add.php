<?php
    session_start(); // เปิดใช้งาน session
    if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
        header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
        exit;
    }
    include_once("./connect.php");
    $conn = connectDB();
    $dabr_id = $_POST["dabr_id"];
    $account_id = $_POST["account_id"];
    $da_id = $_POST["da_id"];
    $da_location = $_POST["da_location"];
    $da_borrow = $_POST["da_borrow"];
    $da_return = $_POST["da_return"];
    $allow_br = $_POST["allow_br"];
    if ($dabr_id == '') {
        $sql = "INSERT INTO da_brs (account_id, da_id, da_borrow, da_return, allow_br) VALUES ('$account_id', '$da_id', '$da_borrow', '$da_return', '$allow_br')";
    }
    if ($allow_br != '0') {
        $sql = "UPDATE da_items, da_brs SET da_items.da_status_ii = '1', da_items.da_location = '$da_location', da_brs.da_borrow='$da_borrow', da_brs.da_return='$da_return', da_brs.allow_br = '$allow_br' WHERE da_items.da_id = '$da_id' AND da_brs.da_id = '$da_id'";
    } else {
        $sql = "UPDATE da_items, da_brs SET da_items.da_status_ii = '0', da_items.da_location = '$da_location', da_brs.da_borrow='$da_borrow', da_brs.da_return='$da_return', da_brs.allow_br = '$allow_br' WHERE da_items.da_id = '$da_id' AND da_brs.da_id = '$da_id'";
    }
    $conn->query($sql);
    $conn->close();
?>
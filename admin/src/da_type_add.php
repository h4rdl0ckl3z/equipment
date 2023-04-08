<?php
    session_start(); // เปิดใช้งาน session
    if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
        header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
        exit;
    }
    include_once("./connect.php");
    $conn = connectDB();
    $da_type_id = $_POST["da_type_id"];
    $da_type_name = $_POST["da_type_name"];
    $sql = "INSERT INTO da_types (da_type_id, da_type_name) VALUES ('$da_type_id', '$da_type_name') ON DUPLICATE KEY UPDATE da_type_id='$da_type_id', da_type_name='$da_type_name'";
    $conn->query($sql);
    $conn->close();
?>
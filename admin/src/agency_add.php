<?php
    session_start(); // เปิดใช้งาน session
    if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
        header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
        exit;
    }
    include_once("./connect.php");
    $conn = connectDB();
    $agency_id = $_POST["agency_id"];
    $agency_name = $_POST["agency_name"];
    $sql = "INSERT INTO agencys (agency_id, agency_name) VALUES ('$agency_id', '$agency_name') ON DUPLICATE KEY UPDATE agency_id='$agency_id', agency_name='$agency_name'";
    $conn->query($sql);
    $conn->close();
?>
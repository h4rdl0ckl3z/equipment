<?php
session_start(); // เปิดใช้งาน session
if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
    header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
    exit;
}
include_once("./connect.php");
$conn = connectDB();
$da_id = $_POST["id"];
$sql = "INSERT INTO qrcodes (da_id, qrcode_status) VALUES ('$da_id', '0')";
$conn->query($sql);
$conn->close();
?>
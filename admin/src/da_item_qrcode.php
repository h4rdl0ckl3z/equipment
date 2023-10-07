<?php
session_start(); // เปิดใช้งาน session
if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
    header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
    exit;
}
include_once("./connect.php");
include('../../phpqrcode/qrlib.php');
$conn = connectDB();
$conn2 = connectDB();
$da_id = $_POST["id"];
$hostname = $_SERVER['HTTP_HOST'];

if (filter_var($hostname, FILTER_VALIDATE_IP)) {
    $str = $hostname . "/equipment/da_item.html?da_id=" . $da_id;
} else {
    $str = $hostname . "/da_item.html?da_id=" . $da_id;
}

$file = date("Ymd") . "_" . uniqid();
QRcode::png($str, "../../upload/qrcode/" . $file . ".png");
$sql = "INSERT INTO qrcodes (da_id, qrcode_img, qrcode_date) VALUES ('$da_id', '$file.png', DATE(NOW()))";
$conn->query($sql);
$sql2 = "UPDATE da_items SET qrcode_status='1' WHERE da_id='$da_id'";
$conn->query($sql2);
$conn->close();
?>
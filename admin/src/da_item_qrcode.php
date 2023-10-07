<?php
session_start(); // เปิดใช้งาน session
if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
    header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
    exit;
}
include_once("./connect.php");
include('../../phpqrcode/qrlib.php');
$conn = connectDB();
$str = $_POST["id"];
$da_id = str_replace('-', '', $str);
$hostname = $_SERVER['HTTP_HOST'];

if (filter_var($hostname, FILTER_VALIDATE_IP)) {
    $url = $hostname . "/equipment/da_item.html?da_id=" . $str;
} else {
    $url = $hostname . "/da_item.html?da_id=" . $str;
}

$file = date("Ymd") . "_" . uniqid();
QRcode::png($url, "../../upload/qrcode/" . $file . ".png");
$sql = "INSERT INTO qrcodes (da_id, qrcode_img, qrcode_date) VALUES ('$da_id', '$file.png', DATE(NOW()))";
$conn->query($sql);
$sql2 = "UPDATE da_items SET qrcode_status='1' WHERE da_id='$da_id'";
$conn->query($sql2);
$conn->close();
?>
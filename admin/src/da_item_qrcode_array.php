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
$hostname = $_SERVER['HTTP_HOST'];
if (isset($_POST["checkbox_da_id"]) <> '') {
    $da_id = $_POST["checkbox_da_id"];
    if ($da_id <> '') {
        // print_r($da_id);
        for ($i=0; $i < count($da_id); $i++) { 
            if ($da_id[$i] <> 'on') {
                $str = $hostname . "/equipment/da_item.html?da_id=" . $da_id[$i];
                $file = date("Ymd") . "_" . uniqid();
                QRcode::png($str, "../../upload/qrcode/" . $file . ".png");
                $sql = "INSERT INTO qrcodes (da_id, qrcode_img, qrcode_date) VALUES ('$da_id[$i]', '$file.png', DATE(NOW()))";
                // echo $sql . "<br>";
                $conn->query($sql);
                $sql2 = "UPDATE da_items SET qrcode_status='1' WHERE da_id='$da_id[$i]'";
                $conn->query($sql2);
            }
        }
        $conn->close();
    }
}
?>
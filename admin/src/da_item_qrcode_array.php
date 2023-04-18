<?php
session_start(); // เปิดใช้งาน session
if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
    header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
    exit;
}
include_once("./connect.php");
$conn = connectDB();
if (isset($_POST["checkbox_da_id"]) <> '') {
    $da_id = $_POST["checkbox_da_id"];
    if ($da_id <> '') {
        // print_r($da_id);
        for ($i=0; $i < count($da_id); $i++) { 
            if ($da_id[$i] <> 'on') {
                $sql = "INSERT INTO qrcodes (da_id, qrcode_status) VALUES ($da_id[$i], '0')";
                // echo $sql . "<br>";
                $conn->query($sql);
            }
        }
        $conn->close();
    }
}
?>
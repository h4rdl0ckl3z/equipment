<?php
    session_start(); // เปิดใช้งาน session
    if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
        header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
        exit;
    }
    include_once("./connect.php");
    $conn = connectDB();
    $room_id = $_POST["room_id"];
    $room_type_id = $_POST["room_type_id"];
    $sql = "INSERT INTO rooms (room_id, room_type_id) VALUES ('$room_id', '$room_type_id') ON DUPLICATE KEY UPDATE room_id = '$room_id', room_type_id = '$room_type_id'";
    $conn->query($sql);
    $conn->close();
?>
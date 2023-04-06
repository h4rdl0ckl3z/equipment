<?php
    session_start(); // เปิดใช้งาน session
    if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
        header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
        exit;
    }
    include_once("./connect.php");
    $conn = connectDB();
    $section_id = $_POST["id"];
    $sql = "SELECT * FROM sections WHERE section_id=" . $section_id;
    $result = $conn -> query($sql);
    $row = $result -> fetch_array(MYSQLI_ASSOC);
    echo json_encode($row);
    $conn->close();
?>
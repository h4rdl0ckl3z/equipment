<?php
    session_start(); // เปิดใช้งาน session
    if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
        header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
        exit;
    }
    include_once("./connect.php");
    $conn = connectDB();
    $dabr_id = $_POST["id"];
    $sql = "SELECT * FROM ((da_brs INNER JOIN accounts ON da_brs.account_id = accounts.account_id)
    INNER JOIN da_items ON da_brs.da_id = da_items.da_id) WHERE dabr_id='" . $dabr_id . "'";
    $result = $conn -> query($sql);
    $row = $result -> fetch_array(MYSQLI_ASSOC);
    echo json_encode($row);
    $conn->close();
?>
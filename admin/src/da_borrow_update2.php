<?php
    session_start(); // เปิดใช้งาน session
    if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
        header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
        exit;
    }
    include_once("./connect.php");
    $conn = connectDB();
    $dabr_id = $_POST["id"];
    $sql = "SELECT dabr_id, da_id, allow_br, dabr_status FROM da_brs WHERE dabr_id='$dabr_id'";
    $result = $conn->query($sql);
    $row = $result -> fetch_array(MYSQLI_ASSOC);
    
    echo json_encode($row);

    if ($row['dabr_status'] == 1) {
        $sql2 = "UPDATE da_brs INNER JOIN da_items ON da_brs.da_id = da_items.da_id SET da_brs.allow_br = '0', da_brs.dabr_status = '2', da_items.da_status_ii = '0' WHERE da_brs.dabr_id = '$dabr_id' AND da_brs.da_id = '" . $row['da_id'] . "'";
    } else {
        $sql2 = "UPDATE da_brs INNER JOIN da_items ON da_brs.da_id = da_items.da_id SET da_brs.allow_br = '0', da_brs.dabr_status = '3', da_items.da_status_ii = '0' WHERE da_brs.dabr_id = '$dabr_id' AND da_brs.da_id = '" . $row['da_id'] . "'";
    }
    
    // echo $sql2;
    $conn->query($sql2);
    $conn->close();
?>
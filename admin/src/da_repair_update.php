<?php
    session_start(); // เปิดใช้งาน session
    if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
        header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
        exit;
    }
    include_once("./connect.php");
    $conn = connectDB();
    $da_r_id = $_POST["id"];
    $sql = "SELECT da_r_id, da_id, da_repair_status FROM da_repairs WHERE da_r_id='$da_r_id'";
    $result = $conn->query($sql);
    $row = $result -> fetch_array(MYSQLI_ASSOC);
    
    echo json_encode($row);

    if ($row['da_repair_status'] != '1') {
        $sql2 = "UPDATE da_repairs INNER JOIN da_items ON da_repairs.da_id = da_items.da_id SET da_repairs.da_repair_status = '1', da_items.da_status_ii = '5' WHERE da_repairs.da_r_id = '$da_r_id' AND da_repairs.da_id = '" . $row['da_id'] . "'";
        $conn->query($sql2);
    } else {
        $sql2 = "UPDATE da_repairs INNER JOIN da_items ON da_repairs.da_id = da_items.da_id SET da_repairs.da_repair_status = '0', da_items.da_status_ii = '0' WHERE da_repairs.da_r_id = '$da_r_id' AND da_repairs.da_id = '" . $row['da_id'] . "'";
        $conn->query($sql2);
    }
    $conn->close();
?>
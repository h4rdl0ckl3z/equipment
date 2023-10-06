<?php
    session_start(); // เปิดใช้งาน session
    if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
        header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
        exit;
    }
    include_once("./connect.php");
    $conn = connectDB();
    $da_type_id = $_POST["da_type_id"];
    $da_type_name = $_POST["da_type_name"];

    $sql1 = "SELECT da_type_id FROM da_types WHERE da_type_id='$da_type_id'";
    $result = $conn->query($sql1);
    $row = $result -> fetch_array(MYSQLI_ASSOC);
    
    echo json_encode($row);

    if ($row == null) {
        $sql = "INSERT INTO da_types (da_type_id, da_type_name) VALUES ('$da_type_id', '$da_type_name')";
        $conn->query($sql);
    } else {
        if ($da_type_id != '') {
            $sql = "UPDATE da_types SET da_type_id='$da_type_id', da_type_name='$da_type_name' WHERE da_type_id='$da_type_id'";
            $conn->query($sql);
        }
    }
    
    $conn->close();
?>
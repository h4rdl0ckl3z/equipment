<?php
    session_start(); // เปิดใช้งาน session
    if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
        header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
        exit;
    }
    include_once("./connect.php");
    $conn = connectDB();
    $da_id = $_POST["da_id"];
    $da_lists = $_POST["da_lists"];
    $da_status_i = $_POST["da_status_i"];
    $da_unit = $_POST["da_unit"];
    $da_rates = $_POST["da_rates"];
    $da_date = $_POST["da_date"];
    $da_source = $_POST["da_source"];
    $da_feature = $_POST["da_feature"];
    $da_annotation = $_POST["da_annotation"];
    $da_location = $_POST["da_location"];
    $da_status_ii = $_POST["da_status_ii"];
    $da_type_id = $_POST["da_type_id"];
    $room_id = $_POST["room_id"];

    $sql1 = "SELECT da_id FROM da_items WHERE da_id='$da_id'";
    $result = $conn->query($sql1);
    $row = $result -> fetch_array(MYSQLI_ASSOC);
    
    echo json_encode($row);

    if ($row == null) {
        $sql = "INSERT INTO da_items (da_id, da_lists, da_status_i, da_unit, da_rates, da_date,
        da_source, da_feature, da_annotation, da_location, da_status_ii, da_type_id, room_id) VALUES
        ('$da_id', '$da_lists', '$da_status_i', '$da_unit', '$da_rates', '$da_date', '$da_source', 
        '$da_feature', '$da_annotation', '$da_location', '$da_status_ii', '$da_type_id', '$room_id')";
        $conn->query($sql);
    } else {
        $sql = "UPDATE da_items SET da_id='$da_id', da_lists='$da_lists', da_status_i='$da_status_i', da_unit='$da_unit', 
        da_rates='$da_rates', da_date='$da_date', da_source='$da_source', da_feature='$da_feature', 
        da_annotation='$da_annotation', da_location='$da_location', da_status_ii='$da_status_ii', 
        da_type_id='$da_type_id', room_id='$room_id' WHERE da_id='$da_id'";
        $conn->query($sql);
    }
    $conn->close();
?>
<?php
    session_start(); // เปิดใช้งาน session
    if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
        header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
        exit;
    }
    include_once("./connect.php");
    $conn = connectDB();
    $agency_id = $_POST["agency_id"];
    $agency_name = $_POST["agency_name"];

    $sql1 = "SELECT agency_id FROM agencys WHERE agency_id=$agency_id";
    $result = $conn->query($sql1);
    $row = $result -> fetch_array(MYSQLI_ASSOC);
    
    echo json_encode($row);

    if ($row == null) {
        $sql = "INSERT INTO agencys (agency_id, agency_name) VALUES ('$agency_id', '$agency_name')";
        $conn->query($sql);
    } else {
        if ($agency_id != '') {
            $sql = "UPDATE agencys SET agency_id='$agency_id', agency_name='$agency_name' WHERE agency_id='$agency_id'";
            $conn->query($sql);
        }
    }
    $conn->close();
?>
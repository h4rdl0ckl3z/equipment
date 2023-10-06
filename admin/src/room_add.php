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
    $agency_id = $_POST["agency_id"];

    $sql1 = "SELECT room_id FROM rooms WHERE room_id='$room_id'";
    $result = $conn->query($sql1);
    $row = $result -> fetch_array(MYSQLI_ASSOC);
    
    echo json_encode($row);

    if ($row == null) {
        $sql = "INSERT INTO rooms (room_id, room_type_id, agency_id) VALUES ('$room_id', '$room_type_id', '$agency_id')";
        $conn->query($sql);
    } else {
        if ($room_id != '') {
            $sql = "UPDATE rooms SET room_id = '$room_id', room_type_id = '$room_type_id', agency_id = '$agency_id' WHERE room_id = '$room_id'";
            $conn->query($sql);
        }
    }
    
    $conn->close();
?>
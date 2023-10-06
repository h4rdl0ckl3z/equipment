<?php
    session_start(); // เปิดใช้งาน session
    if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
        header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
        exit;
    }
    include_once("./connect.php");
    $conn = connectDB();
    $section_id = $_POST["section_id"];
    $section_name = $_POST["section_name"];

    $sql1 = "SELECT section_id FROM sections WHERE section_id='$section_id'";
    $result = $conn->query($sql1);
    $row = $result -> fetch_array(MYSQLI_ASSOC);
    
    echo json_encode($row);

    if ($row == null) {
        $sql = "INSERT INTO sections (section_name) VALUES ('$section_name')";
        $conn->query($sql);
    } else {
        if ($section_id != '') {
            $sql = "UPDATE sections SET section_name='$section_name' WHERE section_id=" . $section_id;
            $conn->query($sql);
        }
    }
    $conn->close();
?>
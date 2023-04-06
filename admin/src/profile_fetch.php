<?php
    session_start(); // เปิดใช้งาน session
    if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
        header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
        exit;
    }
    include_once("./connect.php");
    $conn = connectDB();
    $account_id = $_POST["id"];
    // echo $account_id;
    $sql = "SELECT * FROM ((accounts INNER JOIN sections ON accounts.section_id = sections.section_id)
    INNER JOIN agencys ON accounts.agency_id = agencys.agency_id) WHERE account_id=" . $account_id;
    $result = $conn -> query($sql);
    $row = $result -> fetch_array(MYSQLI_ASSOC);
    echo json_encode($row);
    $conn->close();
?>
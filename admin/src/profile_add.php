<?php
    session_start(); // เปิดใช้งาน session
    if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
        header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
        exit;
    }
    include_once("./connect.php");
    $conn = connectDB();
    $account_id = $_POST["account_id"];
    // echo $account_id;
    $username = $_POST["username"];
    $password = $_POST["passwd"];
    $password2 = $_POST["passwd2"];
    $fullname = $_POST["fullname"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $access_level = $_POST["access_level"];
    $section_id = $_POST["section_id"];
    $agency_id = $_POST["agency_id"];

    $passwd = md5($password);

    if ($password == $password2) {
        if ($account_id != '') {
            $sql = "UPDATE accounts SET username='$username',passwd='$passwd', fullname='$fullname', address='$address', phone='$phone', access_level=$access_level, section_id=$section_id, agency_id=$agency_id WHERE account_id=" . $account_id;
        } else {
            $sql = "INSERT INTO accounts (username, passwd, fullname, address, phone, access_level, section_id, agency_id) VALUES ('$username', '$passwd', '$fullname', '$address', '$phone', $access_level, $section_id, '$agency_id')";
        }
        $conn->query($sql);
        $conn->close();    
    }
?>
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
    $name_title = $_POST["name_title"];
    $fullname = $_POST["fullname"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $access_level = $_POST["access_level"];
    $section_id = $_POST["section_id"];
    $agency_id = $_POST["agency_id"];

    $passwd = md5($password);


    $sql1 = "SELECT account_id FROM accounts WHERE username='$username'";
    $result = $conn->query($sql1);
    $row = $result -> fetch_array(MYSQLI_ASSOC);
    
    echo json_encode($row);

    if ($row == null) {
        if ($password == $password2) {
            $sql = "INSERT INTO accounts (username, passwd, name_title, fullname, address, phone, access_level, section_id, agency_id) VALUES ('$username', '$passwd', '$name_title', '$fullname', '$address', '$phone', $access_level, $section_id, '$agency_id')";
            $conn->query($sql);
        }
    } else {
        if ($password == $password2) {
            if ($account_id == '') {

            } else {
                $sql = "UPDATE accounts SET username='$username',passwd='$passwd', name_title='$name_title', fullname='$fullname', address='$address', phone='$phone', access_level=$access_level, section_id=$section_id, agency_id=$agency_id WHERE account_id=" . $account_id;
                $conn->query($sql);
            }
        }
    }
    $conn->close();
?>
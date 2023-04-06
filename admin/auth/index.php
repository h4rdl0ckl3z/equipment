<?php
    session_start(); // เปิดใช้งาน session
    if (isset($_SESSION['account'])) { // ถ้าเข้าระบบอยู่
        header("location: ../index.php");
        exit;
    }
?>
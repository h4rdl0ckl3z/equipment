<?php
session_start(); // เปิดใช้งาน session
if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
  header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
  exit;
}
include_once("./connect.php");
$conn = connectDB();
if (isset($_POST["checkbox_da_id"]) <> '') {
  $da_id = $_POST["checkbox_da_id"];
  if ($da_id <> '') {
    if ($da_id[0] == 'on') {
      unset($da_id[0]);
      $extract_id = implode(', ', $da_id);
      $sql = "DELETE FROM da_items WHERE da_id IN ($extract_id)";
    } else {
      $extract_id = implode(', ', $da_id);
      $sql = "DELETE FROM da_items WHERE da_id IN ($extract_id)";
    }
    $conn->query($sql);
    $conn->close();
  }
}
?>
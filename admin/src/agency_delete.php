<?php
  session_start(); // เปิดใช้งาน session
  if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
      header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
      exit;
  }
  include_once("./connect.php");
  $conn = connectDB();
  $da_location_id = $_POST["id"];
  // sql to delete a record
  $sql = "DELETE FROM da_locations WHERE da_location_id=" . $da_location_id;

  if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $conn->error;
  }

  $conn->close();
?>
<?php
  session_start(); // เปิดใช้งาน session
  if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
      header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
      exit;
  }
  include_once("./connect.php");
  $conn = connectDB();
  $account_id = $_POST["id"];
  // sql to delete a record
  $sql = "DELETE FROM accounts WHERE account_id=" . $account_id;
  $conn->query($sql);
  // if ($conn->query($sql) === TRUE) {
  //   echo "Record deleted successfully";
  // } else {
  //   echo "Error deleting record: " . $conn->error;
  // }

  $conn->close();
?>
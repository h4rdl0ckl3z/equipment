<?php
  session_start(); // เปิดใช้งาน session
  if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
      header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
      exit;
  }
  include_once("./connect.php");
  $conn = connectDB();
  $da_id = $_POST["id"];
  $account_id = $_POST["account_id"];
  $da_repair_location = $_POST["da_repair_location"];
  $da_repair = $_POST["da_repair"];

  $sql2 = "INSERT INTO da_repairs (account_id, da_id, da_repair_location, da_repair, da_repair_status) VALUES ('$account_id', '$da_id', '$da_repair_location', '$da_repair', '0')";
  $conn->query($sql2);
  // if ($conn->query($sql) === TRUE) {
  //   echo "Record deleted successfully";
  // } else {
  //   echo "Error deleting record: " . $conn->error;
  // }
  $conn->close();
?>
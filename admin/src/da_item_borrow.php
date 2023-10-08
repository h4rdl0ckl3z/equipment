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
  $da_br_location = $_POST["da_br_location"];

  $sql = "SELECT da_status_i FROM da_items WHERE da_id='$da_id'";
  $result = $conn->query($sql);
  $row = $result -> fetch_array(MYSQLI_ASSOC);
  $da_br_status = $row['da_status_i'];

  $da_borrow = $_POST["da_borrow"];
  $da_return = $_POST["da_return"];
  $sql2 = "INSERT INTO da_brs (account_id, da_id, da_br_location, da_br_status, da_borrow, da_return, allow_br) VALUES ('$account_id', '$da_id', '$da_br_location', '$da_br_status', '$da_borrow', '$da_return', '0')";
  $conn->query($sql2);
  // echo $sql;
  // if ($conn->query($sql) === TRUE) {
  //   echo "Record deleted successfully";
  // } else {
  //   echo "Error deleting record: " . $conn->error;
  // }
  $conn->close();
?>
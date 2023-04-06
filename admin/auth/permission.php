<!-- ckeck permission -->
<?php
  session_start(); // เปิดใช้งาน session
  if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
      header("location: ./auth/login.php"); // redirect ไปยังหน้า login.php
      exit;
  }
  $account = $_SESSION['account'];
  $account_id = $account["account_id"];
  include_once("./src/connect.php");
  $objCon = connectDB(); // เชื่อมต่อฐานข้อมูล
  $strSQL = "SELECT * FROM accounts WHERE account_id = $account_id";
  $result = $objCon->query($strSQL);
  $row = $result->fetch_assoc();
  $objCon->close();
?>
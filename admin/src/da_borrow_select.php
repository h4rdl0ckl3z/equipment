<?php
  session_start(); // เปิดใช้งาน session
  if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
      header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
      exit;
  }
  include_once("./connect.php");
  $conn = connectDB();
  $agency_id = $_POST["agency_id"];
  $access_level = $_POST["access_level"];
  if ($access_level == '0') {
    $sql = "SELECT * FROM ((da_brs INNER JOIN accounts ON da_brs.account_id = accounts.account_id)
    INNER JOIN da_items ON da_brs.da_id = da_items.da_id) WHERE da_status_ii='0' OR da_status_ii='1'";
  } else {
    $sql = "SELECT * FROM (((da_brs INNER JOIN accounts ON da_brs.account_id = accounts.account_id)
    INNER JOIN da_items ON da_brs.da_id = da_items.da_id)
    INNER JOIN agencys ON accounts.agency_id = agencys.agency_id) WHERE agencys.agency_id='$agency_id' AND da_status_ii='0'";
  }
  $result = $conn -> query($sql);
  $data = array("data"=>array());
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result -> fetch_array(MYSQLI_ASSOC)) {
          // echo json_encode($row);
          array_push($data["data"], $row);
      }
    } else {
      // echo "0 results";
    }
  $conn -> close();
  echo json_encode($data);
  
?>
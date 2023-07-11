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
  if ($access_level == 0) {
    $sql = "SELECT * FROM ((accounts INNER JOIN sections ON accounts.section_id = sections.section_id)
    INNER JOIN agencys ON accounts.agency_id = agencys.agency_id)";
  } else {
    $sql = "SELECT * FROM ((accounts INNER JOIN sections ON accounts.section_id = sections.section_id)
    INNER JOIN agencys ON accounts.agency_id = agencys.agency_id) WHERE accounts.agency_id = '$agency_id'";
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
<?php
  session_start(); // เปิดใช้งาน session
  if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
      header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
      exit;
  }
  include_once("./connect.php");
  $conn = connectDB();
  $sql = "SELECT * FROM (((((da_items INNER JOIN da_types ON da_items.da_type_id = da_types.da_type_id)
  INNER JOIN rooms ON da_items.room_id = rooms.room_id)
  INNER JOIN room_types ON rooms.room_type_id = room_types.room_type_id)
  INNER JOIN agencys ON agencys.agency_id = rooms.agency_id)
  INNER JOIN communitys ON communitys.community_id = agencys.community_id) WHERE da_items.da_status_ii != '4'";
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
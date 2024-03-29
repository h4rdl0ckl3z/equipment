<?php
session_start(); // เปิดใช้งาน session
if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
  header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
  exit;
}
include_once("./connect.php");
$conn = connectDB();

$account_id = $_POST['account_id'];
$access_level = $_POST['access_level'];

if ($access_level == 0 || $access_level == 2) {
  $sql = "SELECT * FROM ((da_repairs INNER JOIN accounts ON da_repairs.account_id = accounts.account_id)
    INNER JOIN da_items ON da_repairs.da_id = da_items.da_id)";
} else {
  $sql = "SELECT * FROM ((da_repairs INNER JOIN accounts ON da_repairs.account_id = accounts.account_id)
    INNER JOIN da_items ON da_repairs.da_id = da_items.da_id) WHERE da_repairs.account_id = $account_id";
}


$result = $conn->query($sql);
$data = array("data" => array());
if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    // echo json_encode($row);
    array_push($data["data"], $row);
  }
} else {
  // echo "0 results";
}
$conn->close();
echo json_encode($data);

?>
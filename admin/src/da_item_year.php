<?php
session_start(); // เปิดใช้งาน session
if (!isset($_SESSION['account'])) { // ถ้าไม่เข้าระบบอยู่
    header("location: ../auth/login.php"); // redirect ไปยังหน้า login.php
    exit;
}
include_once("./connect.php");
$conn = connectDB();
$sql = "SELECT da_id, da_status_ii, ADDDATE(da_date, INTERVAL 1 YEAR) AS Date_NEW FROM da_items";
$result = $conn->query($sql);
$data = array("data" => array());
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        array_push($data["data"], $row);
    }
} else {
    // echo "0 results";
}
//   echo json_encode($data);


date_default_timezone_set("Asia/Bangkok");
// echo date("Y-m-d");
// print_r($data["data"][0]["Date_NEW"] == date("Y-m-d"));
for ($i=0; $i < count($data["data"]); $i++) { 
    if ($data["data"][$i]["Date_NEW"] == date("Y-m-d") && $data["data"][$i]["da_status_ii"] != '5') {
        $sql = "UPDATE da_items SET da_status_ii = '5' WHERE da_id='" . $data["data"][$i]["da_id"] . "'";
        echo $sql;
        $conn->query($sql);
    }
}
$conn->close();
?>
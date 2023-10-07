<?php
  include_once("../admin/src/connect.php");
  $conn = connectDB();

  $str = $_POST["id"];
  $da_id = str_replace('-', '', $str);
  $sql = "SELECT * FROM ((da_brs INNER JOIN accounts ON da_brs.account_id = accounts.account_id)
  INNER JOIN da_items ON da_brs.da_id = da_items.da_id) WHERE da_brs.da_id ='$da_id'";

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
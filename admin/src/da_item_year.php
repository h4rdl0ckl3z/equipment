<?php
include_once("./connect.php");
$conn = connectDB();
$da_id = (isset($_POST["checkbox_da_id"]))?$_POST['checkbox_da_id']:NULL;
// print_r($da_id);
if ($da_id <> '') {
    if ($da_id[0] == 'on') {
      unset($da_id[0]);
      print_r($da_id);
      $sql = "";
    } else {

    }
    // $conn->query($sql);
    // $conn->close();
  }
?>
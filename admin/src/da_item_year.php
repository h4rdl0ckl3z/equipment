<?php
include_once("./connect.php");
$conn = connectDB();
$da_id = (isset($_POST["checkbox_da_id"]))?$_POST['checkbox_da_id']:NULL;
// print_r($da_id);
if ($da_id <> '') {
    if ($da_id[0] == 'on') {
      unset($da_id[0]);
      $extract_id = implode(', ', $da_id);
      $sql = "UPDATE da_items SET da_status_ii = '4' WHERE da_id IN ($extract_id)";
    } else {
      $extract_id = implode(', ', $da_id);
      // echo $extract_id;
      $sql = "UPDATE da_items SET da_status_ii = '4' WHERE da_id IN ($extract_id)";
    }
    $conn->query($sql);
    $conn->close();
  }
?>
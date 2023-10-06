<?php
  include_once("./connect.php");
  $conn = connectDB();
  $room_type_id = $_POST["id"];
  // sql to delete a record
  $sql = "DELETE FROM room_types WHERE room_type_id=" . $room_type_id;
  if ($conn->query($sql) === TRUE) {
    // echo "Record deleted successfully";
  } else {
    // echo "Error deleting record: " . $conn->error;
  }

  $conn->close();
?>
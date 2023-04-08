<?php
    $da_id = $_POST["checkbox_da_id"];
    if ($da_id <> '') {
        // print_r($da_id);
        $extract_id = implode(', ', $da_id);
        // echo $extract_id;
        include_once("./connect.php");
        $conn = connectDB();
        // sql to delete a record
        $sql = "DELETE FROM da_items WHERE da_id IN ($extract_id)";
      
        if ($conn->query($sql) === TRUE) {
          echo "Record deleted successfully";
        } else {
          echo "Error deleting record: " . $conn->error;
        }
      
        $conn->close();
        header("location: ../da_item.php");
    } else {
        header("location: ../da_item.php");
    }
?>
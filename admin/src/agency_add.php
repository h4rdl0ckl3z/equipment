<?php
    include_once("./connect.php");
    $conn = connectDB();
    $da_location_id = $_POST["da_location_id"];
    $da_location_name = $_POST["da_location_name"];
    if ($da_location_id != '') {
        $sql = "UPDATE da_locations SET da_location_id='$da_location_id',da_location_name='$da_location_name' WHERE da_location_id=" . $da_location_id;
    } else {
        $sql = "INSERT INTO da_locations (da_location_name) VALUES ('$da_location_name')";
    }
    $conn->query($sql);
    $conn->close();
?>
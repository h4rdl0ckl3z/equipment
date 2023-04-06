<?php
    include_once("./connect.php");
    $conn = connectDB();
    $room_type_id = $_POST["room_type_id"];
    $room_type_name = $_POST["room_type_name"];
    if ($room_type_id != '') {
        $sql = "UPDATE room_types SET room_type_name='$room_type_name' WHERE room_type_id=" . $room_type_id;
    } else {
        $sql = "INSERT INTO room_types (room_type_name) VALUES ('$room_type_name')";
    }
    $conn->query($sql);
    $conn->close();
?>
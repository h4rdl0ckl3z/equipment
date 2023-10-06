<?php
    include_once("./connect.php");
    $conn = connectDB();
    $room_type_id = $_POST["room_type_id"];
    $room_type_name = $_POST["room_type_name"];

    $sql1 = "SELECT room_type_id FROM room_types WHERE room_type_id='$room_type_id'";
    $result = $conn->query($sql1);
    $row = $result -> fetch_array(MYSQLI_ASSOC);
    
    echo json_encode($row);

    if ($row == null) {
        $sql = "INSERT INTO room_types (room_type_name) VALUES ('$room_type_name')";
        $conn->query($sql);
    } else {
        if ($room_type_id != '') {
            $sql = "UPDATE room_types SET room_type_name='$room_type_name' WHERE room_type_id='$room_type_id'";
            $conn->query($sql);
        } 
    }
    $conn->close();
?>
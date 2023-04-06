<?php
    include_once("./connect.php");
    $conn = connectDB();
    $room_type_id = $_POST["id"];
    $sql = "SELECT * FROM room_types WHERE room_type_id='" . $room_type_id . "'";
    $result = $conn -> query($sql);
    $row = $result -> fetch_array(MYSQLI_ASSOC);
    echo json_encode($row);
    $conn->close();
?>
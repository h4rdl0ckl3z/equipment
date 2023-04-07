// Room
$(document).ready(function () {
    // Add Room
    $('#insert_room_form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "./src/room_add.php",
            method: "post",
            data: $('#insert_room_form').serialize(),
            beforeSend: function () {
                $('#room_insert').val("กำลังบันทึก...");
            },
            success: function () {
                $('#insert_room_form')[0].reset();
                $('#room_add').modal('hide');
                $('#RoomTable').DataTable().ajax.reload();
            }
        })
    })
    // Edit(Update) Room
    $('#RoomTable').on('click', '.update', function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "./src/room_fetch.php",
            method: "post",
            data: { id: uid },
            dataType: "json",
            success: function (data) {
                $('#room_add').modal('show');
                $('#room_id').val(data.room_id);
                $('#room_type_id').val(data.room_type_id);
                $('#room_insert').val('อัพเดทข้อมูล');
            }
        })
    })
    // Delete Room
    $('#RoomTable').on('click', '.delete', function () {
        var uid = $(this).attr("id");
        $('#room_delete').modal('show');
        $('.room_confirm_delete').click(function () {
            $.ajax({
                url: "./src/room_delete.php",
                method: "post",
                data: { id: uid },
                success: function () {
                    $('#room_delete').modal('hide');
                    $('#RoomTable').DataTable().ajax.reload();
                }
            })
        })
    })
})

// Update Modal-Title

function room_add_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "เพิ่มห้อง";
    document.getElementById("room_id").readOnly = false;
}
function room_edit_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "แก้ไขห้อง";
    document.getElementById("room_id").readOnly = true;
}

// Clear Modal
function clear_modal() {
    var room_id = document.getElementById("room_id").readOnly;
    if (room_id == false) {
        $('#room_id').val('');
    }
}
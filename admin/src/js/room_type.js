// Room Type
$(document).ready(function () {
    // Add Room Type
    $('#insert_room_type_form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "./src/room_type_add.php",
            method: "post",
            data: $('#insert_room_type_form').serialize(),
            beforeSend: function () {
                $('#room_type_insert').val("กำลังบันทึก...");
            },
            success: function () {
                $('#insert_room_type_form')[0].reset();
                $('#room_type_add').modal('hide');
                $('#Room_TypeTable').DataTable().ajax.reload();
            }
        })
    })
    // Edit(Update) Room Type
    $('#Room_TypeTable').on('click', '.update', function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "./src/room_type_fetch.php",
            method: "post",
            data: { id: uid },
            dataType: "json",
            success: function (data) {
                $('#room_type_add').modal('show');
                $('#room_type_id').val(data.room_type_id);
                $('#room_type_name').val(data.room_type_name);
                $('#room_type_insert').val('อัพเดทข้อมูล');
            }
        })
    })
    // Delete Room Type
    $('#Room_TypeTable').on('click', '.delete', function () {
        var uid = $(this).attr("id");
        $('#room_type_delete').modal('show');
        $('.room_type_confirm_delete').click(function () {
            $.ajax({
                url: "./src/room_type_delete.php",
                method: "post",
                data: { id: uid },
                success: function () {
                    $('#room_type_delete').modal('hide');
                    $('#Room_TypeTable').DataTable().ajax.reload();
                }
            })
        })
    })
})

// Update Modal-Title

function room_type_add_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "เพิ่มประเภทห้อง";
}
function room_type_edit_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "แก้ไขประเภทห้อง";
}

// Clear Modal
function clear_modal() {
    $('#room_type_name').val('');
}
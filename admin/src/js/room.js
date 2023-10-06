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
            success: function (data) {
                $('#insert_room_form')[0].reset();
                $('#room_add').modal('hide');
                $('#RoomTable').DataTable().ajax.reload();
                let room = JSON.parse(data);
                let room_id = document.getElementById('room_id').value;
                if (room == null) {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'เพิ่มข้อมูลห้อง',
                            text: 'ระบบเพิ่มข้อมูลห้องสำเร็จ',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                } else if (room.room_id != room_id) {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'อัพเดทข้อมูลห้อง',
                            text: 'ระบบอัพเดทข้อมูลห้องสำเร็จ',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                } else {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'เพิ่มผู้ห้องไม่สำเร็จ',
                            text: 'มีชื่อห้องนี้มีอยู่ในระบบแล้ว',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                }
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
                $('#agency_id').val(data.agency_id);
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
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบข้อมูลห้อง',
                            text: 'ระบบลบข้อมูลห้องเรียบร้อย',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
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
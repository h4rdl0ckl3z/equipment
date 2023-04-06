$(document).ready(function () {
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
                location.reload();
            }
        })
    })
})
$(document).ready(function () {
    $('#insert_roomtype_form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "./src/roomtype_add.php",
            method: "post",
            data: $('#insert_roomtype_form').serialize(),
            beforeSend: function () {
                $('#roomtype_insert').val("กำลังบันทึก...");
            },
            success: function () {
                $('#insert_roomtype_form')[0].reset();
                $('#roomtype_add').modal('hide');
                location.reload();
            }
        })
    })
})
$(document).ready(function () {
    $('#insert_da_locat_form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "./src/locat_add.php",
            method: "post",
            data: $('#insert_da_locat_form').serialize(),
            beforeSend: function () {
                $('#da_locat_insert').val("กำลังบันทึก...");
            },
            success: function () {
                $('#insert_da_locat_form')[0].reset();
                $('#da_locat_add').modal('hide');
                location.reload();
            }
        })
    })
    $('.da_locat_edit_data').click(function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "./src/da_locat_fetch.php",
            method: "post",
            data: { id: uid },
            dataType: "json",
            success: function (data) {
                $('#da_location_id').val(data.da_location_id);
                $('#da_location_name').val(data.da_location_name);
                $('#da_locat_insert').val('อัพเดทข้อมูล');
                $('#da_locat_add').modal('show');
            }
        })
    })
    $(document).ready(function () {
        $('#insert_section_form').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: "./src/section_add.php",
                method: "post",
                data: $('#insert_section_form').serialize(),
                beforeSend: function () {
                    $('#section_insert').val("กำลังบันทึก...");
                },
                success: function () {
                    $('#insert_section_form')[0].reset();
                    $('#section_add').modal('hide');
                    location.reload();
                }
            })
        })
    })
    $('.section_edit_data').click(function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "./src/section_fetch.php",
            method: "post",
            data: { id: uid },
            dataType: "json",
            success: function (data) {
                $('#section_id').val(data.section_id);
                $('#section_name').val(data.section_name);
                $('#section_insert').val('อัพเดทข้อมูล');
                $('#section_add').modal('show');
            }
        })
    })
})

$('.room_edit_data').click(function () {
    var uid = $(this).attr("id");
    $.ajax({
        url: "./src/room_fetch.php",
        method: "post",
        data: { id: uid },
        dataType: "json",
        success: function (data) {
            $('#room_id').val(data.room_id);
            $('#room_type_id');
            $('#room_insert').val('อัพเดทข้อมูล');
            $('#room_add').modal('show');
        }
    })
})
$('.roomtype_edit_data').click(function () {
    var uid = $(this).attr("id");
    $.ajax({
        url: "./src/roomtype_fetch.php",
        method: "post",
        data: { id: uid },
        dataType: "json",
        success: function (data) {
            $('#room_type_id').val(data.room_type_id);
            $('#room_type_name').val(data.room_type_name);
            $('#roomtype_insert').val('อัพเดทข้อมูล');
            $('#roomtype_add').modal('show');
        }
    })
})

$(document).ready(function () {
    $('.da_locat_delete_data').click(function () {
        var uid = $(this).attr("id");
        $('.da_locat_confirm_delete').click(function () {
            $.ajax({
                url: "./src/da_locat_delete.php",
                method: "post",
                data: { id: uid },
                success: function (data) {
                    location.reload();
                }
            })
        })
    })
})
$(document).ready(function () {
    $('.section_delete_data').click(function () {
        var uid = $(this).attr("id");
        $('.section_confirm_delete').click(function () {
            $.ajax({
                url: "./src/section_delete.php",
                method: "post",
                data: { id: uid },
                success: function (data) {
                    location.reload();
                }
            })
        })
    })
})
$(document).ready(function () {
    $('.room_delete_data').click(function () {
        var uid = $(this).attr("id");
        $('.room_confirm_delete').click(function () {
            $.ajax({
                url: "./src/room_delete.php",
                method: "post",
                data: { id: uid },
                success: function (data) {
                    location.reload();
                }
            })
        })
    })
})
$(document).ready(function () {
    $('.roomtype_delete_data').click(function () {
        var uid = $(this).attr("id");
        $('.roomtype_confirm_delete').click(function () {
            $.ajax({
                url: "./src/roomtype_delete.php",
                method: "post",
                data: { id: uid },
                success: function (data) {
                    location.reload();
                }
            })
        })
    })
})

function da_locat_add_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "เพิ่มสถานที่";
}
function da_loca_edit_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "แก้ไขสถานที่";
}
function room_edit_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "แก้ไขห้อง";
    document.getElementById("room_id").readOnly = true;
}
function room_add_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "เพิ่มห้อง";
}
function roomtype_add_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "เพิ่มประเภทห้อง";
}
function roomtype_edit_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "แก้ไขประเภทห้อง";
}

function cancel() {
    location.reload();
}
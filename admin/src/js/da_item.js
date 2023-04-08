// Da_Item
$(document).ready(function () {
    // Add Da_Item
    $('#insert_person_form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "./src/profile_add.php",
            method: "post",
            data: $('#insert_person_form').serialize(),
            beforeSend: function () {
                $('#person_insert').val("กำลังบันทึก...");
            },
            success: function () {
                $('#insert_person_form')[0].reset();
                $('#person_add').modal('hide');
                $('#PersonTable').DataTable().ajax.reload();
            }
        })
    })
    // Edit(Update) Da_Item
    $('#PersonTable').on('click', '.update', function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "./src/profile_fetch.php",
            method: "post",
            data: { id: uid },
            dataType: "json",
            success: function (data) {
                $('#person_add').modal('show');
                $('#account_id').val(data.account_id);
                $('#username').val(data.username);
                $('#fullname').val(data.fullname);
                $('#address').val(data.address);
                $('#phone').val(data.phone);
                $('#access_level');
                $('#section_id');
                $('#person_insert').val('อัพเดทข้อมูล');
            }
        })
    })
    // Delete Da_Item
    $('#PersonTable').on('click', '.delete', function () {
        var uid = $(this).attr("id");
        $('#person_delete').modal('show');
        $('.person_confirm_delete').click(function () {
            $.ajax({
                url: "./src/profile_delete.php",
                method: "post",
                data: { id: uid },
                success: function () {
                    $('#person_delete').modal('hide');
                    $('#PersonTable').DataTable().ajax.reload();
                }
            })
        })
    })
})

// Update Modal-Title
function person_edit_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "แก้ไขผู้ใช้งาน";
}
function da_item_add_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "เพิ่มครุภัณฑ์";
}

// Clear Modal
function clear_modal() {
    $('#account_id').val('');
    $('#username').val('');
    $('#fullname').val('');
    $('#address').val('');
    $('#phone').val('');
    $('#passwd').val('');
    $('#passwd2').val('');
}

// Checkbox All
function checkUncheck(checkBox) {
    get = document.getElementsByName('checkbox_da_id');
    for (var i = 0; i < get.length; i++) {
        get[i].checked = checkBox.checked;
    }
}

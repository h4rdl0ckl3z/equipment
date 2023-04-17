// Da_Item
$(document).ready(function () {
    // Add Da_Item
    $('#insert_da_item_form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "./src/da_item_add.php",
            method: "post",
            data: $('#insert_da_item_form').serialize(),
            beforeSend: function () {
                $('#da_item_insert').val("กำลังบันทึก...");
            },
            success: function () {
                $('#insert_da_item_form')[0].reset();
                $('#da_item_add').modal('hide');
                $('#Da_ItemTable').DataTable().ajax.reload();
            }
        })
    })
    // Edit(Update) Da_Item
    $('#Da_ItemTable').on('click', '.update', function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "./src/da_item_fetch.php",
            method: "post",
            data: { id: uid },
            dataType: "json",
            success: function (data) {
                $('#da_item_add').modal('show');
                $('#da_id').val(data.da_id);
                $('#da_lists').val(data.da_lists);
                $('#da_status_i').val(data.da_status_i);
                $('#da_unit').val(data.da_unit);
                $('#da_rates').val(data.da_rates);
                $('#da_date').val(data.da_date);
                $('#da_source').val(data.da_source);
                $('#da_feature').val(data.da_feature);
                $('#da_annotation').val(data.da_annotation);
                $('#da_location').val(data.da_location);
                $('#da_status_ii').val(data.da_status_ii);
                $('#da_type_id').val(data.da_type_id);
                $('#room_id').val(data.room_id);
                $('#da_item_insert').val('อัพเดทข้อมูล');
            }
        })
    })
    // Delete Da_Item
    $('#Da_ItemTable').on('click', '.delete', function () {
        var uid = $(this).attr("id");
        $('#da_item_delete').modal('show');
        $('.da_item_confirm_delete').click(function () {
            $.ajax({
                url: "./src/da_item_delete.php",
                method: "post",
                data: { id: uid },
                success: function () {
                    $('#da_item_delete').modal('hide');
                    $('#Da_ItemTable').DataTable().ajax.reload();
                }
            })
        })
    })
    // DeleteSelect Da_Item
    $('#da_item_form').on('click', '.delete_all', function (e) {
        e.preventDefault();
        $.ajax({
            url: "./src/da_item_delete_select.php",
            method: "post",
            data: $('#da_item_form').serialize(),
            beforeSend: function () {
                $('#da_item_delete').val("กำลังลบ...");
            },
            success: function () {
                $('#da_item_delete_select').modal('hide');
                $('#Da_ItemTable').DataTable().ajax.reload();
            }
        })
    })
})

// Update Modal-Title
function da_item_add_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "เพิ่มครุภัณฑ์";
    document.getElementById("da_id").readOnly = false;
}
function da_item_edit_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "แก้ไขครุภัณฑ์";
    document.getElementById("da_id").readOnly = true;
}

// Clear Modal
function clear_modal() {
    var da_id = document.getElementById("da_id").readOnly;
    if (da_id == true) {
        $('#da_lists').val('');
        $('#da_unit').val('');
        $('#da_rates').val('');
        $('#da_date').val('');
        $('#da_source').val('');
        $('#da_feature').val('');
        $('#da_annotation').val('');
        $('#da_location').val('');
    } else {
        $('#da_id').val('');
        $('#da_lists').val('');
        $('#da_unit').val('');
        $('#da_rates').val('');
        $('#da_date').val('');
        $('#da_source').val('');
        $('#da_feature').val('');
        $('#da_annotation').val('');
        $('#da_location').val('');
    }
}

// Checkbox All
function checkUncheck(checkBox) {
    get = document.getElementsByName('checkbox_da_id[]');
    for (var i = 0; i < get.length; i++) {
        get[i].checked = checkBox.checked;
    }
}
function checkUncheck2(checkBox) {
    get = document.getElementsByName('checkbox_da_id2[]');
    for (var i = 0; i < get.length; i++) {
        get[i].checked = checkBox.checked;
    }
}
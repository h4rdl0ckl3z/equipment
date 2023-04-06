// Location
$(document).ready(function () {
    // Add Location
    $('#insert_da_locat_form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "./src/locat_add.php",
            method: "post",
            data: $('#insert_da_locat_form').serialize(),
            beforeSend: function () {
                $('#section_insert').val("กำลังบันทึก...");
            },
            success: function () {
                $('#insert_da_locat_form')[0].reset();
                $('#locat_add').modal('hide');
                $('#LocatTable').DataTable().ajax.reload();
            }
        })
    })
    // Edit(Update) Location
    $('#LocatTable').on('click', '.update', function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "./src/locat_fetch.php",
            method: "post",
            data: { id: uid },
            dataType: "json",
            success: function (data) {
                $('#locat_add').modal('show');
                $('#da_location_id').val(data.da_location_id);
                $('#da_location_name').val(data.da_location_name);
                $('#locat_insert').val('อัพเดทข้อมูล');
            }
        })
    })
    // Delete Location
    $('#LocatTable').on('click', '.delete', function () {
        var uid = $(this).attr("id");
        $('#locat_delete').modal('show');
        $('.locat_confirm_delete').click(function () {
            $.ajax({
                url: "./src/locat_delete.php",
                method: "post",
                data: { id: uid },
                success: function () {
                    $('#locat_delete').modal('hide');
                    $('#LocatTable').DataTable().ajax.reload();
                }
            })
        })
    })
})

// Update Modal-Title

function locat_add_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "เพิ่มสถานที่";
}
function locat_edit_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "แก้ไขสถานที่";
}


// Clear Modal
function clear_modal() {
    $('#da_location_name').val('');
}
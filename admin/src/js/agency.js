// Agency
$(document).ready(function () {
    // Add Agency
    $('#insert_agency_form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "./src/agency_add.php",
            method: "post",
            data: $('#insert_agency_form').serialize(),
            beforeSend: function () {
                $('#agency_insert').val("กำลังบันทึก...");
            },
            success: function () {
                $('#insert_agency_form')[0].reset();
                $('#agency_add').modal('hide');
                $('#AgencyTable').DataTable().ajax.reload();
            }
        })
    })
    // Edit(Update) Agency
    $('#AgencyTable').on('click', '.update', function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "./src/agency_fetch.php",
            method: "post",
            data: { id: uid },
            dataType: "json",
            success: function (data) {
                $('#agency_add').modal('show');
                $('#agency_id').val(data.agency_id);
                $('#agency_name').val(data.agency_name);
                $('#agency_insert').val('อัพเดทข้อมูล');
            }
        })
    })
    // Delete Agency
    $('#AgencyTable').on('click', '.delete', function () {
        var uid = $(this).attr("id");
        $('#agency_delete').modal('show');
        $('.agency_confirm_delete').click(function () {
            $.ajax({
                url: "./src/agency_delete.php",
                method: "post",
                data: { id: uid },
                success: function () {
                    $('#agency_delete').modal('hide');
                    $('#AgencyTable').DataTable().ajax.reload();
                }
            })
        })
    })
})

// Update Modal-Title

function agency_add_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "เพิ่มสาขา";
    document.getElementById("agency_id").readOnly = false;
}
function agency_edit_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "แก้ไขสาขา";
    document.getElementById("agency_id").readOnly = true;
}


// Clear Modal
function clear_modal() {
    // $('#agency_id').val('');
    $('#agency_name').val('');
}


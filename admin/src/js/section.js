// Section
$(document).ready(function () {
    // Add Section
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
                $('#SectionTable').DataTable().ajax.reload();
            }
        })
    })
    // Edit(Update) Section
    $('#SectionTable').on('click', '.update', function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "./src/section_fetch.php",
            method: "post",
            data: { id: uid },
            dataType: "json",
            success: function (data) {
                $('#section_add').modal('show');
                $('#section_name').val(data.section_name);
                $('#section_insert').val('อัพเดทข้อมูล');
            }
        })
    })
    // Delete Section
    $('#SectionTable').on('click', '.delete', function () {
        var uid = $(this).attr("id");
        $('#section_delete').modal('show');
        $('.section_confirm_delete').click(function () {
            $.ajax({
                url: "./src/section_delete.php",
                method: "post",
                data: { id: uid },
                success: function () {
                    $('#section_delete').modal('hide');
                    $('#SectionTable').DataTable().ajax.reload();
                }
            })
        })
    })
})

// Update Modal-Title

function section_add_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "เพิ่มแผนก";
}
function section_edit_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "แก้ไขแผนก";
}


// Clear Modal
function clear_modal() {
    $('#section_name').val('');
}
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
            success: function (data) {
                $('#insert_section_form')[0].reset();
                $('#section_add').modal('hide');
                $('#SectionTable').DataTable().ajax.reload();
                let section = JSON.parse(data);
                let section_id = document.getElementById('section_id').value;
                console.log(section);
                if (section == null) {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'เพิ่มข้อมูลแผนก',
                            text: 'ระบบเพิ่มข้อมูลแผนกสำเร็จ',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                } else if (section.section_id == section_id) {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'อัพเดทข้อมูลแผนก',
                            text: 'ระบบอัพเดทข้อมูลแผนกสำเร็จ',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                } else {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'เพิ่มผู้แผนกไม่สำเร็จ',
                            text: 'มีชื่อแผนกนี้มีอยู่ในระบบแล้ว',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                }
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
                $('#section_id').val(data.section_id);
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
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบข้อมูลแผนก',
                            text: 'ระบบลบข้อมูลแผนกเรียบร้อย',
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
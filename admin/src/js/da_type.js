// Da_Type
$(document).ready(function () {
    // Add Da_Type
    $('#insert_da_type_form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "./src/da_type_add.php",
            method: "post",
            data: $('#insert_da_type_form').serialize(),
            beforeSend: function () {
                $('#da_type_insert').val("กำลังบันทึก...");
            },
            success: function (data) {
                $('#insert_da_type_form')[0].reset();
                $('#da_type_add').modal('hide');
                $('#Da_TypeTable').DataTable().ajax.reload();
                let da_type = JSON.parse(data);
                let da_type_id = document.getElementById('da_type_id').value;
                if (da_type == null) {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'เพิ่มข้อมูลประเภทครุภัณฑ์',
                            text: 'ระบบเพิ่มข้อมูลประเภทครุภัณฑ์สำเร็จ',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                } else if (da_type.da_type_id != da_type_id) {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'อัพเดทข้อมูลประเภทครุภัณฑ์',
                            text: 'ระบบอัพเดทข้อมูลประเภทครุภัณฑ์สำเร็จ',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                } else {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'เพิ่มผู้ประเภทครุภัณฑ์ไม่สำเร็จ',
                            text: 'มีชื่อประเภทครุภัณฑ์นี้มีอยู่ในระบบแล้ว',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                }
            }
        })
    })
    // Edit(Update) Da_Type
    $('#Da_TypeTable').on('click', '.update', function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "./src/da_type_fetch.php",
            method: "post",
            data: { id: uid },
            dataType: "json",
            success: function (data) {
                $('#da_type_add').modal('show');
                $('#da_type_id').val(data.da_type_id);
                $('#da_type_name').val(data.da_type_name);
                $('#da_type_insert').val('อัพเดทข้อมูล');
            }
        })
    })
    // Delete Da_Type
    $('#Da_TypeTable').on('click', '.delete', function () {
        var uid = $(this).attr("id");
        $('#da_type_delete').modal('show');
        $('.da_type_confirm_delete').click(function () {
            $.ajax({
                url: "./src/da_type_delete.php",
                method: "post",
                data: { id: uid },
                success: function () {
                    $('#da_type_delete').modal('hide');
                    $('#Da_TypeTable').DataTable().ajax.reload();
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบข้อมูลประเภทครุภัณฑ์',
                            text: 'ระบบลบข้อมูลประเภทครุภัณฑ์เรียบร้อย',
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

function da_type_add_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "เพิ่มประเภทครุภัณฑ์";
    document.getElementById("da_type_id").readOnly = false;
}
function da_type_edit_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "แก้ไขประเภทครุภัณฑ์";
    document.getElementById("da_type_id").readOnly = true;
}


// Clear Modal
function clear_modal() {
    var da_type_id = document.getElementById("da_type_id").readOnly;
    if (da_type_id == true) {
        $('#da_type_name').val('');
    } else {
        $('#da_type_id').val('');
        $('#da_type_name').val('');
    }
}


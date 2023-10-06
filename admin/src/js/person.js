// Person
$(document).ready(function () {
    // Add Person
    $('#insert_person_form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "./src/profile_add.php",
            method: "post",
            data: $('#insert_person_form').serialize(),
            beforeSend: function () {
                $('#person_insert').val("กำลังบันทึก...");
            },
            success: function (data) {
                $('#insert_person_form')[0].reset();
                $('#person_add').modal('hide');
                $('#PersonTable').DataTable().ajax.reload();
                let account = JSON.parse(data);
                let account_id = document.getElementById('account_id').value;
                if (account == null) {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'เพิ่มข้อมูลผู้ใช้งาน',
                            text: 'ระบบเพิ่มข้อมูลผู้ใช้งานสำเร็จ',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                } else if (account.account_id == account_id) {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'อัพเดทข้อมูลผู้ใช้งาน',
                            text: 'ระบบอัพเดทข้อมูลผู้ใช้งานสำเร็จ',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                } else {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'เพิ่มผู้ใช้งานไม่สำเร็จ',
                            text: 'มีชื่อผู้ใช้งานนี้มีอยู่ในระบบแล้ว',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                }
            }
        })       
    })
    // Person View
    $('#PersonTable').on('click', '.view', function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "./src/profile_view.php",
            method: "post",
            data: { id: uid },
            success: function (data) {
                $('#detail').html(data);
                $('#person_view').modal('show');
            }
        })
    })
    // Edit(Update) Person
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
                $('#name_title').val(data.name_title);
                $('#fullname').val(data.fullname);
                $('#address').val(data.address);
                $('#phone').val(data.phone);
                $('#access_level').val(data.access_level);
                $('#section_id').val(data.section_id);
                $('#agency_id').val(data.agency_id);
                $('#person_insert').val('อัพเดทข้อมูล');
            }
        })
    })
    // Delete Person
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
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบข้อมูลผู้ใช้งาน',
                            text: 'ระบบลบข้อมูลผู้ใช้งานเรียบร้อย',
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
function person_edit_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "แก้ไขผู้ใช้งาน";
}
function person_add_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "เพิ่มผู้ใช้งาน";
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

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
            success: function (data) {
                $('#insert_agency_form')[0].reset();
                $('#agency_add').modal('hide');
                $('#AgencyTable').DataTable().ajax.reload();
                let agency = JSON.parse(data);
                let agency_id = document.getElementById('agency_id').value;
                console.log(typeof(agency_id));
                if (agency == null) {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'เพิ่มข้อมูลสาขา',
                            text: 'ระบบเพิ่มข้อมูลสาขาสำเร็จ',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                } else if (agency.agency_id == agency_id) {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'อัพเดทข้อมูลสาขา',
                            text: 'ระบบอัพเดทข้อมูลสาขาสำเร็จ',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                } else {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'เพิ่มผู้สาขาไม่สำเร็จ',
                            text: 'มีชื่อสาขานี้มีอยู่ในระบบแล้ว',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                }
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
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบข้อมูลสาขา',
                            text: 'ระบบลบข้อมูลสาขาเรียบร้อย',
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
    var agency_id = document.getElementById("agency_id").readOnly;
    if (agency_id == true) {
        $('#agency_name').val('');
    } else {
        $('#agency_id').val('');
        $('#agency_name').val('');
    }
}


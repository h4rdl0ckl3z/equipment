// Da_Item Repair
$(document).ready(function () {
    //Add Da_Item Repair
    $('#Da_ItemTable_Repair').on('click', '.repair', function () {
        var uid = $(this).attr("id");
        $('#da_item_repair').modal({
            backdrop: false
        });
        $('#insert_da_repair_form').on('submit', function () {
            $.ajax({
                url: "./src/da_item_repair.php",
                method: "post",
                data: $('#insert_da_repair_form').serialize() + '&id=' + uid,
                success: function () {
                    $('#insert_da_repair_form')[0].reset();
                    $('#da_item_repair').modal('hide');
                    $('#Da_ItemTable_Repair').DataTable().ajax.reload();
                    $('#Da_RepairTable').DataTable().ajax.reload();
                }
            })
            setTimeout(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'เพิ่มข้อมูลแจ้งซ่อม',
                    text: 'ระบบเพิ่มข้อมูลแจ้งซ่อมสำเร็จ',
                    timer: 1200,
                    showConfirmButton: false
                })
            })
        })
    })
    // Edit(Update) Da_Item Repair
    $('#Da_RepairTable').on('click', '.update', function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "./src/da_repair_update.php",
            method: "post",
            data: { id: uid },
            dataType: "json",
            success: function (data) {
                $('#Da_ItemTable_Repair').DataTable().ajax.reload();
                $('#Da_RepairTable').DataTable().ajax.reload();
                if (data.da_repair_status != 0) {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'แจ้งซ่อม',
                            text: 'ระบบแจ้งซ่อมสำเร็จ',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                } else {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'ดำเนินการซ่อม',
                            text: 'ระบบดำเนินการซ่อมสำเร็จ',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                }
            }
        })
    })

    // Edit(Update) Da_Item Repair(Success)
    $('#Da_RepairTable').on('click', '.success', function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "./src/da_repair_success.php",
            method: "post",
            data: { id: uid },
            dataType: "json",
            success: function (data) {
                $('#Da_ItemTable_Repair').DataTable().ajax.reload();
                $('#Da_RepairTable').DataTable().ajax.reload();
                if (data.da_repair_status == 1) {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: 'ระบบดำเนินการซ่อมสำเร็จ',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                }
            }
        })
    })
})


// Clear Modal
function clear_modal() {
    $('#da_repair_location').val('');
}

// Date Repair
function dr() {
    document.getElementById('da_repair').valueAsDate = new Date();
}

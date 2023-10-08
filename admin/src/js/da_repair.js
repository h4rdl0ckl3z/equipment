// Da_Item Repair
$(document).ready(function () {
    //Add Da_Item Repair
    $('#Da_ItemTable_Repair').on('click', '.repair', function () {
        var uid = $(this).attr("id");
        var account_id = document.getElementById('account_id');
        var da_repair_btn = document.getElementById('da_repair_btn');
        $('#da_item_repair').modal('show');
        $('.da_item_confirm_repair').click(function () {
            $.ajax({
                url: "./src/da_item_repair.php",
                method: "post",
                data: {
                    id: uid,
                    account_id: account_id.value,
                    da_repair: da_repair_btn.value
                },
                success: function () {
                    $('#da_item_repair').modal('hide');
                    $('#Da_ItemTable_Repair').DataTable().ajax.reload();
                    $('#Da_RepairTable').DataTable().ajax.reload();
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'เพิ่มข้อมูลแจ้งซ่อม',
                            text: 'ระบบเพิ่มข้อมูลแจ้งซ่อมสำเร็จ',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                }
            })
        })
    })
})


// Clear Modal
function clear_modal() {
    $('#da_repair').val('');
    $('#da_repair_location').val('');
}


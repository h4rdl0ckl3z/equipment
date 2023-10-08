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
                }
            })
        })
    })
})

// Update Modal-Title
function da_repair_add_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "เพิ่มการแจ้งซ่อม";
    document.getElementById("da_id").readOnly = false;
    document.getElementById("fullname").readOnly = false;
    document.getElementById("da_location").readOnly = false;
}
function da_repair_edit_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "แก้ไขการแจ้งซ่อม";
    document.getElementById("da_id").readOnly = true;
    document.getElementById("fullname").readOnly = true;
    document.getElementById("da_location").readOnly = true;
}

// Clear Modal
function clear_modal() {
    $('#da_repair').val('');
}


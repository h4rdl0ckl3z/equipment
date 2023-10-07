// Da_Item Repair
$(document).ready(function () {
    // Add Repair
    $('#insert_da_repair_form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "./src/da_repair_add.php",
            method: "post",
            data: $('#insert_da_repair_form').serialize(),
            beforeSend: function () {
                $('#da_repair_insert').val("กำลังบันทึก...");
            },
            success: function () {
                $('#insert_da_repair_form')[0].reset();
                $('#da_repair_add').modal('hide');
                $('#Da_RepairTable').DataTable().ajax.reload();
                $('#Da_ItemTable_Repair').DataTable().ajax.reload();
            }
        })
    })
    // Edit(Update) Da_Item Repair
    $('#Da_RepairTable').on('click', '.update', function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "./src/da_repair_fetch.php",
            method: "post",
            data: { id: uid },
            dataType: "json",
            success: function (data) {
                $('#da_repair_add').modal('show');
                $('#fullname').val(data.fullname);
                $('#da_r_id').val(data.da_r_id);
                $('#da_id').val(data.da_id);
                $('#da_location').val(data.da_location);
                $('#da_repair').val(data.da_repair);
                $('#da_repair_status').val(data.da_repair_status);
                $('#da_repair_insert').val('อัพเดทข้อมูล');
            }
        })
    })
    // Delete Da_Item Repair
    $('#Da_RepairTable').on('click', '.delete', function () {
        var uid = $(this).attr("id");
        $('#da_item_repair_delete').modal('show');
        $('.da_repair_confirm_delete').click(function () {
            $.ajax({
                url: "./src/da_repair_delete.php",
                method: "post",
                data: { id: uid },
                success: function () {
                    $('#da_item_repair_delete').modal('hide');
                    $('#Da_RepairTable').DataTable().ajax.reload();
                    $('#Da_ItemTable_Repair').DataTable().ajax.reload();
                }
            })
        })
    })
    // Da_Item Repair
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


// Da_Item Borrow
$(document).ready(function () {
    // Add Agency
    $('#insert_da_borrow_form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "./src/da_borrow_add.php",
            method: "post",
            data: $('#insert_da_borrow_form').serialize(),
            beforeSend: function () {
                $('#da_borrow_insert').val("กำลังบันทึก...");
            },
            success: function () {
                $('#insert_da_borrow_form')[0].reset();
                $('#da_borrow_add').modal('hide');
                $('#Da_BorrowTable').DataTable().ajax.reload();
                $('#Da_ItemTable_Borrow').DataTable().ajax.reload();
            }
        })
    })
    // Edit(Update) Da_Item Borrow
    $('#Da_BorrowTable').on('click', '.update', function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "./src/da_borrow_fetch.php",
            method: "post",
            data: { id: uid },
            dataType: "json",
            success: function (data) {
                $('#da_borrow_add').modal('show');
                $('#account_id').val(data.account_id);
                $('#dabr_id').val(data.dabr_id);
                $('#da_id').val(data.da_id);
                $('#da_location').val(data.da_location);
                $('#da_borrow').val(data.da_borrow);
                $('#da_return').val(data.da_return);
                $('#allow_br').val(data.allow_br);
                $('#da_borrow_insert').val('อัพเดทข้อมูล');
            }
        })
    })
    // Delete Da_Item Borrow
    $('#Da_BorrowTable').on('click', '.delete', function () {
        var uid = $(this).attr("id");
        $('#da_item_borrow_delete').modal('show');
        $('.agency_confirm_delete').click(function () {
            $.ajax({
                url: "./src/da_borrow_delete.php",
                method: "post",
                data: { id: uid },
                success: function () {
                    $('#da_item_borrow_delete').modal('hide');
                    $('#Da_BorrowTable').DataTable().ajax.reload();
                    $('#Da_ItemTable_Borrow').DataTable().ajax.reload();
                }
            })
        })
    })
    // Da_Item Borrow
    $('#Da_ItemTable_Borrow').on('click', '.borrow', function () {
        var uid = $(this).attr("id");
        var account_id = document.getElementById('account_id');
        var da_borrow = document.getElementById('da_borrow');
        var da_return = document.getElementById('da_return');
        $('#da_item_borrow').modal('show');
        $('.da_item_confirm_borrow').click(function () {
            $.ajax({
                url: "./src/da_item_borrow.php",
                method: "post",
                data: {
                    id: uid,
                    account_id: account_id.value,
                    da_borrow: da_borrow.value,
                    da_return: da_return.value
                },
                success: function () {
                    $('#da_item_borrow').modal('hide');
                    $('#Da_ItemTable_Borrow').DataTable().ajax.reload();
                    $('#Da_BorrowTable').DataTable().ajax.reload();
                }
            })
        })
    })
})

// Update Modal-Title
function da_borrow_add_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "เพิ่มการยืม";
    document.getElementById("account_id").readOnly = false;
    document.getElementById("da_id").readOnly = false;
}
function da_borrow_edit_data() {
    document.getElementById("exampleModalCenterTitle").innerHTML = "แก้ไขการยืม";
    document.getElementById("account_id").readOnly = true;
    document.getElementById("da_id").readOnly = true;
}

// Clear Modal
function clear_modal() {
    var da_id = document.getElementById("da_id").readOnly;
    if (da_id == true) {
        $('#da_location').val('');
    } else {
        $('#da_id').val('');
        $('#da_location').val('');
    }
}

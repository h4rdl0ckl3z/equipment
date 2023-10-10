// Da_Item Borrow
$(document).ready(function () {
    // Edit(Update) Da_Item Borrow
    $('#Da_BorrowTable').on('click', '.update', function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "./src/da_borrow_update.php",
            method: "post",
            data: { id: uid },
            dataType: "json",
            success: function (data) {
                $('#Da_ItemTable_Borrow').DataTable().ajax.reload();
                $('#Da_BorrowTable').DataTable().ajax.reload();
                if (data.allow_br == 0) {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'อนุมัติการยืม',
                            text: 'ระบบอนุมัติการยืมสำเร็จ',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                } else {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'ไม่อนุมัติการยืม',
                            text: 'ระบบไม่อนุมัติการยืมสำเร็จ',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                }
            }
        })
    })

    // Edit(Update) Da_Item Borrow Status
    $('#Da_BorrowTable').on('click', '.update_status', function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "./src/da_borrow_update2.php",
            method: "post",
            data: { id: uid },
            dataType: "json",
            success: function (data) {
                $('#Da_ItemTable_Borrow').DataTable().ajax.reload();
                $('#Da_BorrowTable').DataTable().ajax.reload();
                if (data.dabr_status == 1) {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'เรียกคืน',
                            text: 'ระบบเรียกคืนสำเร็จ',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                } else {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'ไม่อนุมัติการยืม',
                            text: 'ระบบไม่อนุมัติการยืมสำเร็จ',
                            timer: 1200,
                            showConfirmButton: false
                        })
                    })
                }
            }
        })
    })

    //Add Da_Item Borrow
    $('#Da_ItemTable_Borrow').on('click', '.borrow', function () {
        var uid = $(this).attr("id");
        $('#da_item_borrow').modal('show');
        $('.da_item_confirm_borrow').click(function () {
            $.ajax({
                url: "./src/da_item_borrow.php",
                method: "post",
                data: $('#da_borrow_form').serialize() + '&id=' + uid,
                success: function () {
                    $('#da_borrow_form')[0].reset();
                    $('#da_item_borrow').modal('hide');
                    $('#Da_ItemTable_Borrow').DataTable().ajax.reload();
                    $('#Da_BorrowTable').DataTable().ajax.reload();
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'เพิ่มข้อมูลการยืม',
                            text: 'ระบบเพิ่มข้อมูลการยืมสำเร็จ',
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

function clear_modal_borrow_date() {
    $('#da_br_location').val('');
    $('#da_borrow').val('');
    $('#da_return').val('');
}

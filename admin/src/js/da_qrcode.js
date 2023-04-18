// Da_Item
$(document).ready(function () {
    // Qrcode Da_Item
    $('#Da_ItemTable_QrCode').on('click', '.qrcode', function () {
        var uid = $(this).attr("id");
        $('#da_item_qrcode').modal('show');
        $('.da_item_confirm_qrcode').click(function () {
            $.ajax({
                url: "./src/da_item_qrcode.php",
                method: "post",
                data: { id: uid },
                success: function () {
                    $('#da_item_qrcode').modal('hide');
                    $('#Da_ItemTable_QrCode').DataTable().ajax.reload();
                    $('#Da_ItemQrCodeTable').DataTable().ajax.reload();
                }
            })
        })
    })
    // QrCodeSelect Da_Item
    $('#qrcode_select_form').on('click', '.qrcode_select2', function (e) {
        e.preventDefault();
        $('.qrcode_confirm').click(function () {
            $.ajax({
                url: "./src/da_item_qrcode_array.php",
                method: "post",
                data: $('#qrcode_select_form').serialize(),
                success: function () {
                    $('#da_item_qrcode_select').modal('hide');
                    $('#Da_ItemTable_QrCode').DataTable().ajax.reload();
                    $('#Da_ItemQrCodeTable').DataTable().ajax.reload();
                }
            })
        })
    })
})


// Checkbox All
function checkUncheck(checkBox) {
    get = document.getElementsByName('checkbox_da_id[]');
    for (var i = 0; i < get.length; i++) {
        get[i].checked = checkBox.checked;
    }
}

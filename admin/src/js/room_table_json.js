$(document).ready(function () {
    var table = $('#RoomTable').DataTable({
        ajax: {
            url: './src/room_select.php',
            method: 'post',
        },
        columns: [
            {
                data: '',
                defaultContent: ''
            },
            {data: 'room_id'},
            {data: 'room_type_name'},
            {data: 'agency_name'},
            {data: 'room_id', render: function(room_id) {
                return '<button type="button" name="update" id="' + room_id + '"class="btn btn-warning update" title="แก้ไข" onclick="room_edit_data()"><i class="fas fa-pencil-alt"></i></button>';
            }},
            {data: 'room_id', render: function(room_id) {
                return '<button type="button" name="delete" id="' + room_id + '"class="btn btn-danger delete" title="ลบ"><i class="fas fa-trash-alt"></i></button>';   
            }}
        ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
    $('#RoomTable tbody tr').each(function (idx) {
        $(this).children("td:eq(0)").html(idx + 1);
    });
    table.on('order.dt search.dt', function () {
        let i = 1;
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
});

$(document).ready(function () {
    var table = $('#LocatTable').DataTable({
        ajax: {
            url: './src/agency_select.php',
            method: 'post'
        },
        columns: [
            {
                data: '',
                defaultContent: ''
            },
            {data: 'agency_id'},
            {data: 'agency_name'},
            {data: 'agency_id', render: function(agency_id) {
                return '<button type="button" name="update" id="' + agency_id + '"class="btn btn-warning update" title="แก้ไข" onclick="locat_edit_data()"><i class="fas fa-pencil-alt"></i></button>';
            }},
            {data: 'agency_id', render: function(agency_id) {
                return '<button type="button" name="delete" id="' + agency_id + '"class="btn btn-danger delete" title="ลบ"><i class="fas fa-trash-alt"></i></button>';   
            }}
        ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
    $('#LocatTable tbody tr').each(function (idx) {
        $(this).children("td:eq(0)").html(idx + 1);
    });
    table.on('order.dt search.dt', function () {
        let i = 1;
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
});

$(document).ready(function () {
    var table = $('#Da_TypeTable').DataTable({
        ajax: {
            url: './src/da_type_select.php',
            method: 'post'
        },
        columns: [
            {
                data: '',
                defaultContent: ''
            },
            {data: 'da_type_id'},
            {data: 'da_type_name'},
            {data: 'da_type_id', render: function(da_type_id) {
                return '<button type="button" name="update" id="' + da_type_id + '"class="btn btn-warning update" title="แก้ไข" onclick="da_type_edit_data()"><i class="fas fa-pencil-alt"></i></button>';
            }},
            {data: 'da_type_id', render: function(da_type_id) {
                return '<button type="button" name="delete" id="' + da_type_id + '"class="btn btn-danger delete" title="ลบ"><i class="fas fa-trash-alt"></i></button>';   
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
    $('#Da_TypeTable tbody tr').each(function (idx) {
        $(this).children("td:eq(0)").html(idx + 1);
    });
    table.on('order.dt search.dt', function () {
        let i = 1;
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
});

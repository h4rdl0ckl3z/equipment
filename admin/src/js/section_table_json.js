$(document).ready(function () {
    var table = $('#SectionTable').DataTable({
        ajax: {
            url: './src/section_select.php',
            method: 'post'
        },
        columns: [
            {
                data: '',
                defaultContent: ''
            },
            {data: 'section_name'},
            {data: 'section_id', render: function(section_id) {
                return '<button type="button" name="update" id="' + section_id + '"class="btn btn-warning update" title="แก้ไข" onclick="section_edit_data()"><i class="fas fa-pencil-alt"></i></button>';
            }},
            {data: 'section_id', render: function(section_id) {
                return '<button type="button" name="delete" id="' + section_id + '"class="btn btn-danger delete" title="ลบ"><i class="fas fa-trash-alt"></i></button>';   
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
    $('#SectionTable tbody tr').each(function (idx) {
        $(this).children("td:eq(0)").html(idx + 1);
    });
    table.on('order.dt search.dt', function () {
        let i = 1;
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
});

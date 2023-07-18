$(document).ready(function () {
    var check_access_level = '';
    var agency_id = document.getElementById('agency_id');
    var access_level = document.getElementById('access_level');
    var account_id_2 = document.getElementById('account_id');
    var table = $('#PersonTable').DataTable({
        ajax: {
            url: './src/profile_select.php',
            method: 'post',
            data: {
                agency_id: agency_id.value,
                access_level: access_level.value
            }
        },
        columns: [
            {
                data: '',
                defaultContent: ''
            },
            {data: 'fullname'},
            {data: 'address'},
            {data: 'phone'},
            {data: 'section_name'},
            {data: 'agency_name'},
            {data: 'access_level', render: function(access_level) {
                if (access_level == '0') {
                    check_access_level = access_level;
                    return 'ผู้ดูแลระบบ';
                } else if (access_level == '1') {
                    check_access_level = access_level;
                    return 'ผู้บริหาร';
                } else if (access_level == '2') {
                    check_access_level = access_level;
                    return 'เจ้าหน้าที่';
                } else {
                    check_access_level = access_level;
                    return 'ผู้ใช้งาน';
                }
            }},
            {data: 'account_id', render: function(account_id) {
                if (check_access_level == '0') {
                    return '<button class="btn btn-secondary"><i class="fas fa-eye-slash"></i></button>';
                } else {
                    if (account_id == account_id_2.value) {
                        return '<button type="button" name="update" id="' + account_id + '"class="btn btn-warning update" title="แก้ไข" onclick="person_edit_data()"><i class="fas fa-pencil-alt"></i></button>';
                    } else {
                        return '<button class="btn btn-secondary"><i class="fas fa-eye-slash"></i></button>';
                    }
                }
            }},
            {data: 'account_id', render: function(account_id) {
                if (access_level.value != '0') {
                    if (check_access_level != '3') {
                        return '<button class="btn btn-secondary"><i class="fas fa-eye-slash"></i></button>';
                    } else {
                        return '<button type="button" name="delete" id="' + account_id + '"class="btn btn-danger delete" title="ลบ"><i class="fas fa-user-minus"></i></button>';
                    }
                } else {
                    if (check_access_level != '0') {
                        return '<button type="button" name="delete" id="' + account_id + '"class="btn btn-danger delete" title="ลบ"><i class="fas fa-user-minus"></i></button>';
                    } else {
                        return '<button class="btn btn-secondary"><i class="fas fa-eye-slash"></i></button>';
                    }
                }
            }},
            {data: 'account_id', render: function(account_id) {
                if (check_access_level == '0') {
                    return '<button class="btn btn-secondary"><i class="fas fa-eye-slash"></i></button>';
                } else {
                    return '<button type="button" name="view" id="' + account_id + '"class="btn btn-info view" title="เพิ่มเติม"><i class="far fa-id-card"></i></button>';
                }
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
    $('#PersonTable tbody tr').each(function (idx) {
        $(this).children("td:eq(0)").html(idx + 1);
    });
    table.on('order.dt search.dt', function () {
        let i = 1;
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
});

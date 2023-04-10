$(document).ready(function () {
    var agency_id = document.getElementById('agency_id');
    var access_level = document.getElementById('access_level');
    // console.log(access_level.value);
    var check_da_status_ii = '';
    var table = $('#Da_ItemTable_Borrow').DataTable({
        ajax: {
            url: './src/da_item_borrow_select.php',
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
            {data: 'da_id'},
            {data: 'da_lists'},
            {data: 'da_img', visible: false, render: function (da_img) {
                if (da_img != null) {
                    return '<img src="../upload/da/' + da_img + '" class="img-fluid" alt="da_img" width="80" height="80">';
                } else {
                    return '';
                }
            }},
            {data: 'da_status_i', render: function (da_status_i) {
                if (da_status_i == '0') {
                    return 'ปกติ';
                } else if (da_status_i == '1') {
                    return 'ชำรุด';
                } else if (da_status_i == '2') {
                    return 'เสื่อมคุณถาพ';
                } else {
                    return 'สูญหาย';
                }
            }},
            {data: 'da_unit', visible: false},
            {data: 'da_rates', visible: false, render: function (da_rates) {
                let thai = new Intl.NumberFormat('th-TH', { style: 'currency', currency: 'THB' }).format(da_rates);
                return thai;
            }},
            {data: 'da_date', visible: false, render: function (da_date) {
                function toThaiDateString(date) {
                    let monthNames = [
                        "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน",
                        "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม",
                        "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
                    ];
                    let monthNames_Short = [
                        "ม.ค.", "ก.พ.", "มี.ค.", "มี.ค.",
                        "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.",
                        "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."
                    ];

                    let year = date.getFullYear() + 543;
                    let month = monthNames_Short[date.getMonth()];
                    let numOfDay = date.getDate();
                
                    return `${numOfDay} ${month} ${year}`;
                }
                let date = new Date(da_date);
                return toThaiDateString(date);
            }},
            {data: 'da_source', visible: false},
            {data: 'da_feature'},
            {data: 'da_annotation'},
            {data: 'da_location'},
            {data: 'da_status_ii', render: function (da_status_ii) {
                if (da_status_ii == '0') {
                    check_da_status_ii = da_status_ii;
                    return 'ปกติ';
                } else if (da_status_ii == '1') {
                    check_da_status_ii = da_status_ii;
                    return 'ยืม';
                } else if (da_status_ii == '2') {
                    return 'แจ้งซ่อม';
                } else {
                    return 'ครุภัณฑ์ห้อง';
                }
            }},
            {data: 'da_type_name', visible: false},
            {data: 'room_id', visible: false},
            {data: 'room_type_name', visible: false},
            {data: 'agency_name', visible: false},
            {data: 'community_name', visible: false},
            {data: 'da_id', render: function (da_id) {
                if (access_level.value == '0' || access_level.value == '2') {
                    return '<button class="btn btn-secondary"><i class="fas fa-eye-slash"></i></button>';
                } else {
                    if (check_da_status_ii == '0') {
                        return '<button type="button" name="borrow" id="' + da_id + '"class="btn btn-success borrow" title="ยืม"><i class="fas fa-archive"></i></button>';
                    } else {
                        return '<button class="btn btn-secondary"><i class="fas fa-eye-slash"></i></button>';
                    }
                }
            }}
        ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true
    });
    $('#Da_ItemTable_Borrow tbody tr').each(function (idx) {
        $(this).children("td:eq(0)").html(idx + 1);
    });
    table.on('order.dt search.dt', function () {
        let i = 1;
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
    new $.fn.dataTable.Buttons( table, {
        "buttons": ["colvis"]
    } );
    table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)', table.table().container());
});


$(document).ready(function () {
    var agency_id = document.getElementById('agency_id');
    var access_level = document.getElementById('access_level');
    var check_allow_br = '';
    // console.log(access_level.value);
    var table2 = $('#Da_BorrowTable').DataTable({
        ajax: {
            url: './src/da_borrow_select.php',
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
            {data: 'da_id'},
            {data: 'da_lists'},
            {data: 'da_borrow', render: function (da_borrow) {
                function toThaiDateString(date) {
                    let monthNames = [
                        "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน",
                        "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม",
                        "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
                    ];
                    let monthNames_Short = [
                        "ม.ค.", "ก.พ.", "มี.ค.", "มี.ค.",
                        "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.",
                        "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."
                    ];

                    let year = date.getFullYear() + 543;
                    let month = monthNames_Short[date.getMonth()];
                    let numOfDay = date.getDate();
                
                    return `${numOfDay} ${month} ${year}`;
                }
                let date = new Date(da_borrow);
                return toThaiDateString(date);
            }},
            {data: 'da_return', render: function (da_return) {
                function toThaiDateString(date) {
                    let monthNames = [
                        "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน",
                        "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม",
                        "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
                    ];
                    let monthNames_Short = [
                        "ม.ค.", "ก.พ.", "มี.ค.", "มี.ค.",
                        "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.",
                        "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."
                    ];

                    let year = date.getFullYear() + 543;
                    let month = monthNames_Short[date.getMonth()];
                    let numOfDay = date.getDate();
                
                    return `${numOfDay} ${month} ${year}`;
                }
                let date = new Date(da_return);
                return toThaiDateString(date);
            }},
            {data: 'allow_br', render: function (allow_br) {
                check_allow_br = allow_br
                if (allow_br == '0') {
                    return 'รอดำเนินการ';
                } else {
                    return 'ยืม';
                }
            }},
            {data: 'dabr_id', render: function (dabr_id) {
                if (access_level.value == '0' || access_level.value == '2') {
                    return '<button type="button" name="update" id="' + dabr_id + '"class="btn btn-warning update" title="แก้ไข" onclick="da_borrow_edit_data()"><i class="fas fa-pencil-alt"></i></button>';
                } else {
                    return '<button class="btn btn-secondary"><i class="fas fa-eye-slash"></i></button>';
                }
            }},
            {data: 'dabr_id', render: function (dabr_id) {
                if (check_allow_br == '0') {
                    return '<button type="button" name="delete" id="' + dabr_id + '"class="btn btn-danger delete" title="ลบ"><i class="fas fa-trash-alt"></i></button>';
                } else {
                    return '<button class="btn btn-secondary"><i class="fas fa-eye-slash"></i></button>';
                }
            }}
        ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true
    });
    $('#Da_BorrowTable tbody tr').each(function (idx) {
        $(this).children("td:eq(0)").html(idx + 1);
    });
    table2.on('order.dt search.dt', function () {
        let i = 1;
        table2.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
    new $.fn.dataTable.Buttons( table2, {
        "buttons": ["colvis"]
    } );
    table2.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)', table2.table().container());
});

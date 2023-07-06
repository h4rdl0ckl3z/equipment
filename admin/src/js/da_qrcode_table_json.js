$(document).ready(function () {
    var check_da_status_ii = '';
    var agency_id = document.getElementById('agency_id');
    var access_level = document.getElementById('access_level');
    var table = $('#Da_ItemTable_QrCode').DataTable({
        ajax: {
            url: './src/da_item_qrcode_select.php',
            method: 'post',
            data: {
                agency_id: agency_id.value,
                access_level: access_level.value
            }
        },
        columns: [
            {data: 'da_id', render: function (da_id) {
                return '<input type="checkbox" name="checkbox_da_id[]" id="checkbox_da_id" value="' + da_id + '">';
            }},
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
            {data: 'da_status_ii', visible: false, render: function (da_status_ii) {
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
                return '<button type="button" name="qrcode" id="' + da_id + '"class="btn btn-success qrcode" title="QrCode"><i class="fas fa-qrcode"></i></button>';
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
    $('#Da_ItemTable_QrCode tbody tr').each(function (idx) {
        $(this).children("td:eq(0)").html(idx + 1);
    });
    table.on('order.dt search.dt', function () {
        let i = 1;
        table.cells(null, 1, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
    new $.fn.dataTable.Buttons( table, {
        "buttons": ["colvis"]
    } );
    table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)', table.table().container());
});



$(document).ready(function () {
    var check_qrcode_status = '';
    var table2 = $('#Da_ItemQrCodeTable').DataTable({
        ajax: {
            url: './src/da_qrcode_select.php',
            method: 'post',
        },
        columns: [
            {
                data: '',
                defaultContent: ''
            },
            {data: 'da_id', render: function (da_id) {
                link_da_id = da_id;
                return da_id;
            }},
            {data: 'qrcode_img', render: function (qrcode_img) {
                if (qrcode_img != null) {
                    return '<img src="../upload/qrcode/' + qrcode_img + '" class="img-fluid" alt="da_qrcode" width="80" height="80">';
                } else {
                    return '';
                }
            }},
            {data: 'da_id', visible: false, render: function (da_id) {
                return '<a href="../da_item.html?da_id=' + da_id + '"class="btn btn-info" target="_blank">link</a>';
            }},
            {data: 'qrcode_date', render: function (qrcode_date) {
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
                let date = new Date(qrcode_date);
                return toThaiDateString(date);
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
    $('#Da_ItemQrCodeTable tbody tr').each(function (idx) {
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

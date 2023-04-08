$(document).ready(function () {
    var table = $('#Da_ItemTable').DataTable({
        ajax: {
            url: './src/da_item_select.php',
            method: 'post'
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
            {data: 'da_img', visible: false},
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
            {data: 'da_unit'},
            {data: 'da_rates', render: function (da_rates) {
                let thai = new Intl.NumberFormat('th-TH', { style: 'currency', currency: 'THB' }).format(da_rates);
                return thai;
            }},
            {data: 'da_date', render: function (da_date) {
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
            {data: 'da_source'},
            {data: 'da_feature'},
            {data: 'da_annotation'},
            {data: 'da_location'},
            {data: 'da_status_ii', visible: false, render: function (da_status_ii) {
                if (da_status_ii == '0') {
                    return 'ปกติ';
                } else if (da_status_ii == '1') {
                    return 'ยืม';
                } else if (da_status_ii == '2') {
                    return 'แจ้งซ่อม';
                } else {
                    return 'ครุภัณฑ์ห้อง';
                }
            }},
            {data: 'da_type_name', visible: false},
            {data: 'room_id', visible: false},
            {data: 'agency_name', visible: false},
            {data: 'community_name', visible: false},
            {data: 'da_id', render: function (da_id) {
                return '<button type="button" name="update" id="' + da_id + '"class="btn btn-warning update" title="แก้ไข" onclick="da_item_edit_data()"><i class="fas fa-pencil-alt"></i></button>';
            }},
            {data: 'da_id', render: function (da_id) {
                return '<button type="button" name="delete" id="' + da_id + '"class="btn btn-danger delete" title="ลบ"><i class="fas fa-trash-alt"></i></button>';
            }},
            {data: 'da_id', visible: false, render: function (da_id) {
                return '<button type="button" name="gen_qrcode" id="' + da_id + '"class="btn btn-info gen_qrcode" title="QrCode"><i class="fas fa-qrcode"></i></button>';
            }}
        ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true
    });
    $('#Da_ItemTable tbody tr').each(function (idx) {
        $(this).children("td:eq(0)").html(idx + 1);
    });
    table.on('order.dt search.dt', function () {
        let i = 1;
        table.cells(null, 1, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
    new $.fn.dataTable.Buttons( table, {
        "buttons": ["excel", "print", "colvis"]
    } );
    table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)', table.table().container());
});

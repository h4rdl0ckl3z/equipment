$(document).ready(function () {
    var table2 = $('#Da_BorrowTable').DataTable({
        ajax: {
            url: './src/doc_da_borrow_select.php',
            method: 'post',
        },
        columns: [
            {
                data: '',
                defaultContent: ''
            },
            {data: 'fullname'},
            {data: 'da_id', render: function (da_id) {
                if(typeof(da_id) !== 'string') da_id = da_id.toString()
                if(da_id.length === 22){
                  pat_daid = da_id.replace(/(\d{2})(\d{2})(\d{6})(\d{3})(\d{5})(\d{4})/, "$1-$2-$3-$4-$5-$6");
                  return pat_daid;
                } else if(da_id.length < 22) {
                  return ''
                } else if(da_id.length > 22) {
                  return ''
                } else {
                  return ''
                }
            }},
            {data: 'da_lists'},
            {data: 'da_br_status', render: function (da_status_i) {
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
            {data: 'da_status_i', render: function (da_status_i) {
                check_da_status_i = da_status_i
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
            {data: 'da_br_location'},
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
            {data: 'da_status_ii', visible: false, render: function (da_status_ii) {
                check_da_status_ii = da_status_ii
                if (da_status_ii == '0') {
                    return 'ปกติ';
                } else if (da_status_ii == '1') {
                    return 'ยืม';
                } else if (da_status_ii == '2') {
                    return 'แจ้งซ่อม';
                } else if (da_status_ii == '3') {
                    return 'การตัดจำหน่าย';
                } else {
                    return 'ตรวจสอบสภาพ';
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
        "buttons": ["excel", "print", "colvis"]
    } );
    table2.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)', table2.table().container());
});

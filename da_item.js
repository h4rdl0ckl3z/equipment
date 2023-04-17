$(document).ready(function () {
    // given url string
    let url_str = window.location.href;

    let url = new URL(url_str);
    let search_params = url.searchParams;

    // get value of "id" parameter
    // "100"
    // console.log(search_params.get('da_id'));
    var da_id = search_params.get('da_id');
    var table = $('#Da_ItemTable').DataTable({
        ajax: {
            url: './api/da_item.php',
            method: 'post',
            data: { id: da_id }
        },
        columns: [
            {data: 'da_id'},
            {data: 'da_lists'},
            {data: 'da_img', visible: false, render: function (da_img) {
                if (da_img != null) {
                    return '<img src="./upload/da/' + da_img + '" class="img-fluid" alt="da_img" width="80" height="80">';
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
                    return 'ปกติ';
                } else if (da_status_ii == '1') {
                    return 'ยืม';
                } else if (da_status_ii == '2') {
                    return 'แจ้งซ่อม';
                } else if (da_status_ii == '3') {
                    return 'ครุภัณฑ์ห้อง';
                } else if (da_status_ii == '4') {
                    return 'การตัดจำหน่าย';
                } else {
                    return 'ตรวจสอบสภาพ';
                }
            }},
            {data: 'da_type_name', visible: false},
            {data: 'room_id', visible: false},
            {data: 'room_type_name', visible: false},
            {data: 'agency_name', visible: false},
            {data: 'community_name', visible: false}
        ],
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "responsive": true
    });
    new $.fn.dataTable.Buttons( table, {
        "buttons": ["colvis"]
    } );
    table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)', table.table().container());
});

var access_level = document.getElementById('access_level').value;
var account_id = document.getElementById('account_id').value;
if (access_level == 0 || access_level == 2) {
    $(document).ready(function () {
        var table = $('#Da_ItemTable_Borrow').DataTable({
            ajax: {
                url: './src/da_item_borrow_select.php',
                method: 'post',
            },
            columns: [
                {
                    data: '',
                    defaultContent: ''
                },
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
                }},
                {data: 'da_type_name', visible: false},
                {data: 'room_id', visible: false},
                {data: 'room_type_name', visible: false},
                {data: 'agency_name', visible: false},
                {data: 'community_name', visible: false},
                {data: 'da_id', render: function (da_id) {
                    return '<button type="button" name="borrow" id="' + da_id + '"class="btn btn-success borrow" title="ยืม" onclick="br()"><i class="fas fa-archive"></i></button>';
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
        var table2 = $('#Da_BorrowTable').DataTable({
            ajax: {
                url: './src/da_borrow_select.php',
                method: 'post',
                data: {
                    access_level: access_level,
                    account_id: account_id
                }
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
                {data: 'da_br_status', render: function (da_br_status) {
                    if (da_br_status == '0') {
                        return 'ปกติ';
                    } else if (da_br_status == '1') {
                        return 'ชำรุด';
                    } else if (da_br_status == '2') {
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
                }},
                {data: 'dabr_status', render: function (dabr_status) {
                    check_dabr_status = dabr_status
                    if (dabr_status == '0') {
                        return 'รอดำเนินการ';
                    } else if (dabr_status == '1') {
                        return 'ยืม';
                    } else if (dabr_status == '2') {
                        return 'คืน';
                    } else {    // 3
                        return 'ไม่อนุมัติ';
                    }
                }},
                {data: 'dabr_id', render: function (dabr_id) {
                    if (check_dabr_status == 0) {
                        if (check_da_status_ii == 0) {
                            return '<button type="button" name="update" id="' + dabr_id + '"class="btn btn-success update" title="อนุมัติ"><i class="fa fa-check"></i></button>';
                        } else {
                            return '<button type="button" class="btn btn-secondary" title="อนุมัติ"><i class="fa fa-check"></i></button>';
                        }
                    } else {
                        return '<button type="button" class="btn btn-secondary" title="อนุมัติ"><i class="fa fa-check"></i></button>';
                    }
                }},
                {data: 'dabr_id', render: function (dabr_id) {
                    if (check_dabr_status == 0) {
                        return '<button type="button" name="update_status" id="' + dabr_id + '"class="btn btn-danger update_status" title="ไม่อนุมัติ"><i class="fa fa-window-close"></i></button>';
                    } else {
                        return '<button type="button" class="btn btn-secondary" title="ไม่อนุมัติ"><i class="fa fa-window-close"></i></button>';
                    }
                }},
                {data: 'dabr_id', render: function (dabr_id) {
                    if (check_dabr_status == 1) {
                        return '<button type="button" name="update_status" id="' + dabr_id + '"class="btn btn-success update_status" title="คืน"><i class="fas fa-undo"></i></button>';
                    } else {
                        return '<button type="button" class="btn btn-secondary" title="คืน"><i class="fas fa-undo"></i></button>';
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
} else {
    $(document).ready(function () {
        var table = $('#Da_ItemTable_Borrow').DataTable({
            ajax: {
                url: './src/da_item_borrow_select.php',
                method: 'post',
            },
            columns: [
                {
                    data: '',
                    defaultContent: ''
                },
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
                }},
                {data: 'da_type_name', visible: false},
                {data: 'room_id', visible: false},
                {data: 'room_type_name', visible: false},
                {data: 'agency_name', visible: false},
                {data: 'community_name', visible: false},
                {data: 'da_id', render: function (da_id) {
                    return '<button type="button" name="borrow" id="' + da_id + '"class="btn btn-success borrow" title="ยืม" onclick="br()"><i class="fas fa-archive"></i></button>';
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
        var table2 = $('#Da_BorrowTable').DataTable({
            ajax: {
                url: './src/da_borrow_select.php',
                method: 'post',
                data: {
                    access_level: access_level,
                    account_id: account_id
                }
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
                }},
                {data: 'dabr_status', render: function (dabr_status) {
                    check_dabr_status = dabr_status
                    if (dabr_status == '0') {
                        return 'รอดำเนินการ';
                    } else if (dabr_status == '1') {
                        return 'ยืม';
                    } else {    // 2
                        return 'คืน';
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
}
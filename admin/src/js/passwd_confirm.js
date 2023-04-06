function confirm_passwd() {
    var passwd = document.getElementById('passwd').value;
    var passwd2 = document.getElementById('passwd2').value;
    if (passwd != passwd2) {
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'Password ไม่ถูกต้อง!',
            timer: 1200,
            showConfirmButton: false
        })
    }
}
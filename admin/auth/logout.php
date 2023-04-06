<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth.logout</title>
    <link rel="stylesheet" href="../dist/css/sweetalert2.min.css">
</head>
<body>
    <!-- SweetAlert2 -->
    <script src="../dist/js/sweetalert2.all.min.js"></script>    
    <?php
        session_start();
        session_destroy(); // ลบ session ทั้งหมด
        // header("location: login.php"); // redirect ไปยังหน้า login.php
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'ออกจากระบบสำเร็จ',
                text: '',
                timer: 1200,
                showConfirmButton: false
            }).then((result) => {
                window.location = 'login.php'
            })
        </script>";
    ?>    
</body>
</html>

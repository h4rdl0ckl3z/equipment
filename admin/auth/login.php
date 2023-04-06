<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบบริหารครุภัณฑ์</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="signin.css">
    <link rel="shortcut icon" href="../../logo/SciTech-G.png" type="image/x-icon">
    <link rel="stylesheet" href="../dist/css/sweetalert2.min.css">
</head>
<body class="text-center">
    <form class="form-signin" method="post" action="">
        <img class="mb-4 img-fluid" src="../../logo/SciTech-G.png" alt="" width="auto" height="auto">
        <h1 class="h3 mb-3 font-weight-normal">กรุณาเข้าสู่ระบบ</h1>
        <label for="inputUser" class="sr-only">Username</label>
        <input type="user" id="username" name="username" class="form-control" placeholder="Username" required autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="passwd" name="passwd" class="form-control" placeholder="Password" required>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">เข้าสู่ระบบ</button>
        <p class="mt-5 mb-3 text-muted">Copyright &copy; 2022 วิทยาการคอมพิวเตอร์ คณะวิทยาศาสตร์และเทคโนโลยี มหาวิทยาลัยราชภัฏสุราษฎร์ธานี</p>
    </form>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <?php
        session_start();
        include_once("../src/connect.php");
        $objCon = connectDB();
        if (isset($_SESSION['username'])) { // ถ้าเข้าระบบอยู่
            header("location: index.php"); // redirect ไปยังหน้า index.php
            exit;
        }
        if (isset($_POST['username']) && isset($_POST['passwd'])) {
            $username = $_POST['username'];
            $password = md5($_POST['passwd']);
            $strSQL = "SELECT * FROM accounts WHERE username = '$username' AND passwd = '$password'";
            $objQuery = mysqli_query($objCon, $strSQL);
            $row = mysqli_num_rows($objQuery);
            if ($row) {
                $res = mysqli_fetch_assoc($objQuery);
                $_SESSION['account'] = array(
                    'account_id' => $res['account_id']
                );
                echo "
                <script src='../dist/js/sweetalert2.all.min.js'></script>
                <script>
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'เข้าสู่ระบบสำเร็จ',
                            text: 'ยินดีต้อนรับคุณ " . $res['fullname'] . "',
                            timer: 1200,
                            showConfirmButton: false
                        }).then((result) => {
                            window.location = 'index.php'
                        })                
                    })
                </script>";
                exit();
            } else {
                echo "
                <script src='../dist/js/sweetalert2.all.min.js'></script>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: 'Username หรือ Password ไม่ถูกต้อง!',
                        timer: 1200,
                        showConfirmButton: false
                    }).then((result) => {
                        window.location = 'login.php'
                    })
                </script>";
            }            
        }
    ?>
</body>
</html>
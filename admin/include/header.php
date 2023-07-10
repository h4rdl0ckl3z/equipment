<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?php
      if ($row['access_level'] == 0)
      echo 'ผู้ดูแลระบบ';
      if ($row['access_level'] == 1)
      echo 'ผู้บริหาร';
      if ($row['access_level'] == 2)
      echo 'เจ้าหน้าที่';
      if ($row['access_level'] == 3)
      echo 'ผู้ใช้งาน';
    ?>
  </title>

  <!-- icon tab -->
  <link rel="shortcut icon" href="../logo/SciTech-G.png" type="image/x-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="dist/css/sweetalert2.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="dist/css/style.css">

  <!-- DataTables Adminlte 3 -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../logo/SciTech-G.png" alt="sci logo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="javascript:void(0);" class="nav-link">ระบบบริหารครุภัณฑ์ คณะวิทยาศาสตร์และเทคโนโลยี
            มหาวิทยาลัยราชภัฏสุราษฎร์ธานี</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="javascript:void(0);" class="brand-link">
        <img src="../logo/SciTech-G.png" alt="SCI Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">
          <?php
            if ($row['access_level'] == 0)
            echo 'ผู้ดูแลระบบ';
            if ($row['access_level'] == 1)
            echo 'ผู้บริหาร';
            if ($row['access_level'] == 2)
            echo 'เจ้าหน้าที่';
            if ($row['access_level'] == 3)
            echo 'ผู้ใช้งาน';
          ?>
        </span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Profile Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link user-panel mt-3 pb-3 mb-3 d-flex" data-toggle="dropdown" href="#" aria-expanded="false">
            <div class="image">
              <img src="../upload/profile/<?= $row['profile_img']; ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <?= $row['fullname']; ?>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right bg-dark" style="left: inherit; right: 0px;">
            <div class="dropdown-divider"></div>
            <a href="./profile.php?account_id=<?= $row['account_id']; ?>" class="dropdown-item bg-dark">
              <i class="fas fa-edit mr-2"></i> แก้ไขผู้ใช้งาน
            </a>
            <div class="dropdown-divider"></div>
            <a href="./auth/logout.php" class="dropdown-item bg-dark">
              <i class="fas fa-sign-out-alt mr-2"></i> ออกจากระบบ
            </a>
          </div>
        </li>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <?php
            include("menu.php");
            ?>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
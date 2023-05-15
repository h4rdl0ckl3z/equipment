  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <!-- <h3>150</h3> -->
                <?php
                    include_once("./src/connect.php");
                    $conn = connectDB();
                    $sql = "SELECT COUNT(da_id) AS count_da_id FROM da_items";
                    $objQuery = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($objQuery);
                    if($row) {
                        $res = mysqli_fetch_assoc($objQuery);
                    }
                    echo '<h3>' . $res["count_da_id"] . '</h3>';
                ?>
                <p>ครุภัณฑ์</p>
              </div>
              <div class="icon">
                <i class="ion ion-cube"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <!-- <h3>53<sup style="font-size: 20px">%</sup></h3> -->
                <?php
                    include_once("./src/connect.php");
                    $conn = connectDB();
                    $sql = "SELECT COUNT(dabr_id) AS count_dabr_id FROM da_brs";
                    $objQuery = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($objQuery);
                    if($row) {
                        $res = mysqli_fetch_assoc($objQuery);
                    }
                    echo '<h3>' . $res["count_dabr_id"] . '</h3>';
                ?>
                <p>ยืม-คืนครุภัณฑ์</p>
              </div>
              <div class="icon">
                <i class="ion ion-arrow-swap"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <!-- <h3>65</h3> -->
                <?php
                    include_once("./src/connect.php");
                    $conn = connectDB();
                    $sql = "SELECT COUNT(da_r_id) AS count_da_r_id FROM da_repairs";
                    $objQuery = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($objQuery);
                    if($row) {
                        $res = mysqli_fetch_assoc($objQuery);
                    }
                    echo '<h3>' . $res["count_da_r_id"] . '</h3>';
                ?>
                <p>แจ้งซ่อม</p>
              </div>
              <div class="icon">
                <i class="ion ion-settings"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <!-- <h3>44</h3> -->
                <?php
                    include_once("./src/connect.php");
                    $conn = connectDB();
                    $sql = "SELECT COUNT(account_id) AS count_account FROM accounts";
                    $objQuery = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($objQuery);
                    if($row) {
                        $res = mysqli_fetch_assoc($objQuery);
                    }
                    echo '<h3>' . $res["count_account"] . '</h3>';
                ?>

                <p>ผู้ใช้งาน</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
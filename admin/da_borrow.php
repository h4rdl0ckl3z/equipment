<!-- check login -->
<?php
  include("./auth/permission.php");
?>

<!-- header -->
<?php 
  include("./include/header.php");
?>

<!-- da borrow -->
<?php 
  if ($row["access_level"] == '0' || $row["access_level"] == '2') {
    include("./page/da_borrow.php");
  } else {
    include("./page/da_borrow_al.php");
  }
?>

<!-- footer -->
<?php
  include("./include/footer.php");
?>

<script src="./src/js/da_borrow_table_json.js"></script>
<script src="./src/js/da_borrow.js"></script>

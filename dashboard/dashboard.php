<?php
include "includes/header.php";
require_once("../db.php");
include "function.php";
$select = q("SELECT * FROM `users` WHERE `status`=1");
$assoc = mysqli_fetch_assoc($select);

?>
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="dashboard.php">Dashboard</a>
        <span class="breadcrumb-item active">Users</span>
      </nav>

      <div class="sl-pagebody">
        <div class="sl-page-title">
         <h1>Welcome to Dashboard <span class="text-danger"><?php echo $assoc['name'];?></span></h1>
        </div>
      </div>
    </div>
    <!-- ########## END: MAIN PANEL ########## -->
<?php
include "includes/footer.php";
?>
<?php 
	ob_start();
	include "includes/header.php";
	require_once("../db.php");
	include "function.php";
    $select = q("SELECT * FROM `fiverr` WHERE `status`=1");
    $assoc = f($select);
?>

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="#">Fiverr</a>
        <span class="breadcrumb-item active">Update Fiverr Link</span>
      </nav>
        <div class="service_form p-5">
            <?php
                include "alert.php";
            ?>
            <form action="fiverr-update.php" method="POST">
                    <div class="card pd-2 pd-sm-40 form-layout form-layout-4">
                        <input type="hidden" name="fiverr_id" value="<?php echo $assoc['fiverr_id'];?>">
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Fiverr Link: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control" name="fiverrlink" value="<?php echo $assoc['fiverrlink'];?>">
                            </div>
                        </div>

                        <div class="form-layout-footer mg-t-30 text-center">
                            <button style="cursor:pointer" class="btn btn-info mg-r-5 rounded">Update Fiverr Link</button>
                        </div>
                    </div>
            </form>
                <!-- form-layout-footer -->
        </div>

</div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
<?php include 'includes/footer.php' ?>
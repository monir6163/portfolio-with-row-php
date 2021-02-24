<?php 
	ob_start();
	include "includes/header.php";
	require_once("../db.php");
	include "function.php";
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $fiverrlink = $_POST['fiverrlink'];
    if (empty($fiverrlink)) {
    	warning("Please Input All Filed");
    	redirect("");
    }else{
    	$insert = q("INSERT INTO `fiverr`(`fiverrlink`) VALUES ('$fiverrlink')");
    	success("Fiverr Link Add Successfully");
    	redirect("");
    }
  }
?>

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="#">Fiverr</a>
        <span class="breadcrumb-item active">Add Fiverr Link</span>
      </nav>
        <div class="service_form p-5">
            <?php
                include "alert.php";
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="card pd-2 pd-sm-40 form-layout form-layout-4">
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Fiverr Link: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control" name="fiverrlink" placeholder="ex:https://www.fiverr.com/monirweb">
                            </div>
                        </div>

                        <div class="form-layout-footer mg-t-30 text-center">
                            <button style="cursor:pointer" class="btn btn-info mg-r-5 rounded">Save Fiverr Link</button>
                        </div>
                    </div>
            </form>
                <!-- form-layout-footer -->
        </div>

</div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
<?php include 'includes/footer.php' ?>
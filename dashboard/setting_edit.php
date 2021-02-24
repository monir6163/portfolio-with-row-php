<?php 
	ob_start();
	include "includes/header.php";
	require_once("../db.php");
	include "function.php";
  $selectSetting = "SELECT * FROM setting";
  $settingQuery = mysqli_query($conn, $selectSetting);
  $assoc = mysqli_fetch_assoc($settingQuery);
?>
	<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="setting.php">setting</a>
        <span class="breadcrumb-item active">add setting</span>
      </nav>
        <div class="service_form p-5">
           <?php
                include "alert.php";
            ?>
            <form action="update-setting.php" method="POST" enctype="multipart/form-data">
              <div class="card pd-2 pd-sm-40 form-layout form-layout-4">
              <!-- ##### Section Title ######  -->
                <h6 class="card-body-title text-center">Add Setting Content</h6>
                <!-- Website title  -->
                  <div class="row mg-t-20">
                      <label class="col-sm-4 form-control-label">Website Title: <span class="tx-danger">*</span></label>
                      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input type="text" class="form-control" name="websiteTitle" value="<?php echo $assoc['websiteTitle'];?>">
                      </div>
                  </div>
                  <!-- Footer copyright text  -->
                  <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Copyright Text: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" name="footerText" value="<?php echo $assoc['footerText'];?>">
                    </div>
                  </div>
                  <!-- Website Fav Icon -->
                  <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Fav Icon: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                      <input type="file" onchange="document.getElementById('bah').src = window.URL.createObjectURL(this.files[0])" class="form-control" name="favIcon">
                    </div>
                  </div>
                  <div class="row mg-t-20">
	                <label class="col-sm-4 form-control-label">Preview Fav Icon: <span class="tx-danger">*</span></label>
	                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
	                  <img id="bah" class="mt-2" src="../assets/images/logo/<?php echo $assoc['favIcon'] ?>" alt="">
	                </div>
	              </div>
                  <!-- Website Head Logo  -->
                  <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Header Logo: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
	                  <input type="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" name="headerLogo" class="form-control">
	                </div>
                  </div>
            	 <div class="row mg-t-20">
	                <label class="col-sm-4 form-control-label">Preview Header Logo: <span class="tx-danger">*</span></label>
	                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
	                  <img id="blah" class="mt-2" src="../assets/images/logo/<?php echo $assoc['headerLogo'] ?>" alt="">
	                </div>
	              </div>
                  <!-- add button -->
                  <div class="form-layout-footer mg-t-30 text-center">
                    <button style="cursor:pointer" class="btn btn-info mg-r-5 rounded">Update Setting</button>
                  </div>
              </div>
            </form>
                <!-- form-layout-footer -->
        </div>

</div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->


<?php include 'includes/footer.php' ?>
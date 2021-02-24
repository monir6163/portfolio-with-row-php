<?php 
ob_start();
include "includes/header.php";
require_once("../db.php");
require "function.php";
$contact_id = get('edit_id');
$select = q("SELECT * FROM `contact` WHERE `contact_id`='$contact_id'");
$assoc = mysqli_fetch_assoc($select);
?>

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="contactinfo.php">Contact Info</a>
        <span class="breadcrumb-item active">Update Contact Info</span>
      </nav>
        <div class="service_form p-5">
         <?php include "alert.php"?>
            <form action="update-contactinfo.php" method="POST">
            <input type="hidden" name="contact_id" value="<?php echo $assoc['contact_id'];?>">
                    <div class="card pd-2 pd-sm-40 form-layout form-layout-4">
                    <h6 class="card-body-title text-center">Update Contact Info</h6>
                        <div class="row">
                            <label class="col-sm-4 form-control-label">Contact Summery: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" name="summery" class="form-control" value="<?php echo $assoc['summery'];?>">
                            </div>
                        </div>
                        <!-- row -->
                        <div class="row">
                            <label class="col-sm-4 form-control-label">Office Name: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" name="off_name" class="form-control" value="<?php echo $assoc['off_title'];?>">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 form-control-label">Contact Address: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" name="address" class="form-control" value="<?php echo $assoc['address'];?>">
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 form-control-label">Phone Number: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" name="phone" class="form-control" value="<?php echo $assoc['phone'];?>">
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 form-control-label">Email Address: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" name="email" class="form-control" value="<?php echo $assoc['email'];?>">
                            </div>
                        </div>

                        <div class="form-layout-footer mg-t-30 text-center">
                            <button style="cursor:pointer" class="btn btn-info mg-r-5 rounded">Update Contact</button>
                        </div>
                    </div>
            </form>
                <!-- form-layout-footer -->
        </div>

</div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

<?php include 'includes/footer.php' ?>
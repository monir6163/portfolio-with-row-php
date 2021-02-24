<?php 
ob_start();
include "includes/header.php";
require_once("../db.php");
require "function.php";
if ($_SERVER['REQUEST_METHOD']== "POST") {
$summery = $_POST['summery'];
$off_name = $_POST['off_name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
if(empty($summery) || empty($off_name) || empty($address) || empty($phone) || empty($email)){
warning("Please Input Your Full Data Filed");
redirect("");
}else{
    $insert = q("INSERT INTO `contact`(`summery`, `off_title`, `address`, `phone`, `email`) VALUES ('$summery','$off_name','$address','$phone','$email')");
    success("Contact Info Add Successfuly");
    redirect("");
}
}
?>

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="contactinfo.php">Contact Info</a>
        <span class="breadcrumb-item active">Add Contact Info</span>
      </nav>
        <div class="service_form p-5">
         <?php include "alert.php"?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <div class="card pd-2 pd-sm-40 form-layout form-layout-4">
                        <h6 class="card-body-title text-center">Add New Contact Info</h6>

                        <div class="row">
                            <label class="col-sm-4 form-control-label">Contact Summery: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" name="summery" class="form-control" placeholder="Ex: Lorem ipsum dolar amet aset..">
                            </div>
                        </div>
                        <!-- row -->
                        <div class="row">
                            <label class="col-sm-4 form-control-label">Office Name: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" name="off_name" class="form-control" placeholder="Ex: New York..">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 form-control-label">Contact Address: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" name="address" class="form-control" placeholder="Ex: Lorem ipsum dolar amet aset..">
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 form-control-label">Phone Number: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" name="phone" class="form-control" placeholder="Ex: +966579220920">
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 form-control-label">Email Address: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" name="email" class="form-control" placeholder="Ex: demo.info@domain.com">
                            </div>
                        </div>

                        <div class="form-layout-footer mg-t-30 text-center">
                            <button style="cursor:pointer" class="btn btn-info mg-r-5 rounded">Save Contact</button>
                        </div>
                    </div>
            </form>
                <!-- form-layout-footer -->
        </div>

</div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

<?php include 'includes/footer.php' ?>
<?php
ob_start();
include "includes/header.php";
require_once("../db.php");
require "function.php";
if ($_SERVER['REQUEST_METHOD']== "POST") {
  $uploaded_img = $_FILES['brand_img'];
  $img_explode = explode(".", $uploaded_img['name']);
  $ext = end($img_explode);
  $allow_file = array('jpg','png','JPG','JPEG','webp','PNG');
  if (in_array($ext, $allow_file)) {
    if ($uploaded_img['size'] <= 100000) {
    $insert = "INSERT INTO `brand`(`brand_img`) VALUES ('$uploaded_img')";
    $run = mysqli_query($conn,$insert);
    $last_id = mysqli_insert_id($conn);
    $new_file_name = $last_id.'.'.$ext;
    $new_location = '../assets/images/brand/'.$new_file_name;
    move_uploaded_file($uploaded_img['tmp_name'], $new_location);
    $image_updated = q("UPDATE `brand` SET `brand_img`= '$new_file_name' WHERE `brand_id`='$last_id'");
    success("Brand Add successfully");
  }else{
    warning("Not Allow Try Again");
    }
  }else{
    if (empty($title) || empty($category) || empty($summery) || empty($uploaded_img)){
    warning("Please All InputForm Your Data.");
 }else{
    warning("Not Allow this type of Files");
 }
  }
}
?>
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="dashboard.php">Dashboard</a>
        <span class="breadcrumb-item active">Add New Counter</span>
      </nav>
      <div class="sl-pagebody">
        <div class="row row-sm mg-t-20">
          <div class="col-xl-12">
            <?php include "alert.php"?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
              <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Brand Logo: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="file" name="brand_img" class="form-control">
                </div>
              </div><!-- row -->
              <div class="form-layout-footer mg-t-30 text-center">
                <button type="submit" class="btn btn-info mg-r-5" style="cursor: pointer;">Add Brand</button>
              </div><!-- form-layout-footer -->
            </div><!-- card -->
            </form>
          </div><!-- col-6 -->
        </div><!-- row -->
      </div><!-- sl-pagebody -->
      <footer class="sl-footer">
        <div class="footer-left">
          <div class="mg-b-2">Copyright © 2017. Starlight. All Rights Reserved.</div>
          <div>Made by ThemePixels.</div>
        </div>
        <div class="footer-right d-flex align-items-center">
          <span class="tx-uppercase mg-r-10">Share:</span>
          <a target="_blank" class="pd-x-5" href="https://www.facebook.com/sharer/sharer.php?u=http%3A//themepixels.me/starlight"><i class="fa fa-facebook tx-20"></i></a>
          <a target="_blank" class="pd-x-5" href="https://twitter.com/home?status=Starlight,%20your%20best%20choice%20for%20premium%20quality%20admin%20template%20from%20Bootstrap.%20Get%20it%20now%20at%20http%3A//themepixels.me/starlight"><i class="fa fa-twitter tx-20"></i></a>
        </div>
      </footer>
</div>
<?php include "includes/footer.php";?>
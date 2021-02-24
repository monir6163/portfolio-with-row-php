<?php
ob_start();
include "includes/header.php";
require_once("../db.php");
require "function.php";
if ($_SERVER['REQUEST_METHOD']== "POST") {
  $summery = $_POST['summery'];
  $title = $_POST['title'];
  $sub_title = $_POST['sub_title'];
  // $lower = strtolower($title);
  // $slug = str_replace(' ', '-', $lower);
  $uploaded_img = $_FILES['img'];
  $img_explode = explode(".", $uploaded_img['name']);
  $ext = end($img_explode);
  $allow_file = array('jpg','png','JPG','JPEG','webp','PNG');
  if (in_array($ext, $allow_file)) {
    if ($uploaded_img['size'] <= 300000) {
    // $insert = "INSERT INTO `portfolios`(`title`, `category`, `summery`) VALUES ('$title','$category','$summery')";
    // $run = mysqli_query($conn,$insert);
    // $last_id = mysqli_insert_id($conn);
    $new_file_name = rand().".".$ext;
    // $new_file_name = $slug.'-'.$last_id.'.'.$ext;
    $new_location = '../assets/images/testimonial/'.$new_file_name;
    move_uploaded_file($uploaded_img['tmp_name'], $new_location);
    $insert = q("INSERT INTO `testimonials`(`img`, `summery`, `title`, `sub_title`) VALUES ('$new_file_name','$summery','$title','$sub_title')");
    success("Testimonial Add successfully!");
  }else{
    warning("Not Allow Try Again");
    }
  }else{
    if (empty($uploaded_img) || empty($summery) || empty($title) || empty($sub_title)){
    warning("Please All InputForm Your Data.");
 }else{
    warning("Not Allow this type of Files");
    ob_end_flush();
 }
  }
}
?>
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="dashboard.php">Dashboard</a>
        <span class="breadcrumb-item active">Add New Portfolio</span>
      </nav>
      <div class="sl-pagebody">
        <div class="row row-sm mg-t-20">
          <div class="col-xl-12">
            <?php include "alert.php"?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
              <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Testimonial Image<span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" name="img" class="form-control">
                </div>
              </div><!-- row -->
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Testimonial Preview Image<span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <img id="blah" width= 50px src="" alt="">
                </div>
              </div><!-- row -->
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Testimonial summery: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <textarea name="summery" id="" cols="30" rows="10" class="form-control" placeholder="Enter Summery"></textarea>
                </div>
              </div>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Testimonial Title: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="text" class="form-control" name="title" placeholder="Enter Title">
                </div>
              </div>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Testimonial Sub Title: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="text" class="form-control" name="sub_title" placeholder="Enter Sub Title">
                </div>
              </div>
              <div class="form-layout-footer mg-t-30 text-center">
                <button type="submit" class="btn btn-info mg-r-5" style="cursor: pointer;">Add Testimonial</button>
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
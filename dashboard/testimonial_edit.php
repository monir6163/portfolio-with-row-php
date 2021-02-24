<?php
include "includes/header.php";
require_once("../db.php");
require "function.php";
$edit_id = get('edit_id');
$select = q("SELECT * FROM `testimonials` WHERE `testimonial_id`='$edit_id'");
$assoc = mysqli_fetch_assoc($select);
?>
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="dashboard.php">Dashboard</a>
        <span class="breadcrumb-item active">Edit Testimonial</span>
      </nav>
      <div class="sl-pagebody">
        <div class="row row-sm mg-t-20">
          <div class="col-xl-12">
            <?php include "alert.php"?>
            <form action="testimonial_update.php" method="POST" enctype="multipart/form-data">
              <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
              <input type="hidden" name="testimonial_id" value="<?php echo $assoc['testimonial_id'];?>">
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Testimonial Image<span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" name="img" class="form-control">
                </div>
              </div><!-- row -->
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Testimonial Preview Image<span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <img id="blah" width= 50px src="../assets/images/testimonial/<?php echo $assoc['img'];?>" alt="">
                </div>
              </div><!-- row -->
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Testimonial summery: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  
                  <input type="text" class="form-control" name="summery" value="<?php echo $assoc['summery'];?>">
                </div>
              </div>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Testimonial Title: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="text" class="form-control" name="title" value="<?php echo $assoc['title'];?>">
                </div>
              </div>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Testimonial Sub Title: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="text" class="form-control" name="sub_title" value="<?php echo $assoc['sub_title'];?>">
                </div>
              </div>
              <div class="form-layout-footer mg-t-30 text-center">
                <button type="submit" class="btn btn-info mg-r-5" style="cursor: pointer;">Update Testimonial</button>
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
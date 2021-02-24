<?php
include "includes/header.php";
require_once("../db.php");
require "function.php";
$edit_id = get('edit_id');
$select = q("SELECT * FROM `portfolios` WHERE `portfolio_id`='$edit_id'");
$assoc = mysqli_fetch_assoc($select);
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
            <form action="portfolio_update.php" method="POST" enctype="multipart/form-data">
              <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
              <div class="row mg-t-20">
              	<input type="hidden" name="portfolio_id" value="<?php echo $assoc['portfolio_id'];?>">
                <label class="col-sm-4 form-control-label">Portfolio Title: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="text" name="title" value="<?php echo $assoc['title'];?>" class="form-control" placeholder="Enter Portfolio Title">
                </div>
              </div><!-- row -->
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Protfolio Category: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="text" name="category" value="<?php echo $assoc['category'];?>" class="form-control" placeholder="Enter Category Name">
                </div>
              </div>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Portfolio Summery: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="text" class="form-control" name="summery" value="<?php echo $assoc['summery']?>" placeholder="Enter Portfolio Summery"/>
                </div>
              </div>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Portfolio Thumbnail: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" class="form-control" name="thumbnail">
                </div>
              </div>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Preview Thumbnail: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <img id="blah" width= 50px src="../assets/images/portfolios/<?php echo $assoc['thumbnail'];?>" alt="">
                </div>
              </div>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Portfolio Feature Image: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="file" class="form-control" onchange="document.getElementById('f_blah').src = window.URL.createObjectURL(this.files[0])" class="form-control" name="feature_img">
                </div>
              </div>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Preview Feature Image: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <img id="f_blah" width= 50px src="../assets/images/featured-image/<?php echo $assoc['featured_image'];?>" alt="">
                </div>
              </div>
              <div class="form-layout-footer mg-t-30 text-center">
                <button type="submit" class="btn btn-info mg-r-5" style="cursor: pointer;">Update Portfolio</button>
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
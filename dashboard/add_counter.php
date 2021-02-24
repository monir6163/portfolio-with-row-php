<?php
ob_start();
include "includes/header.php";
require_once("../db.php");
require "function.php";
if ($_SERVER['REQUEST_METHOD']== "POST") {
  $title = $_POST['title'];
  $number = $_POST['number'];
  $icon = $_POST['icon'];
  if (empty($title) || empty($number) || empty($icon)) {
  	warning("Please Input All Filed");
  	redirect("");
  }else{
  	$insert = q("INSERT INTO `counter`(`title`, `number`, `icon`) VALUES ('$title','$number','$icon')");
  	success("Counter Add Successfully");
  	redirect("counter.php");
  	ob_end_flush();
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
                <label class="col-sm-4 form-control-label">Counter Title: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="text" name="title" class="form-control" placeholder="Enter Counter Title">
                </div>
              </div><!-- row -->
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Counter Number: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="text" name="number" class="form-control" placeholder="Enter Counter Number">
                </div>
              </div>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Counter Icon: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <select name="icon" class="form-control">
                    <option value="" disabled selected >Select Counter Icon</option>
                    <option value="flaticon-award">Award</option>
                    <option value="flaticon-like">Like</option>
                    <option value="flaticon-event">Event</option>
                    <option value="flaticon-woman">Woman</option>
                  </select>
                </div>
              </div>
              <div class="form-layout-footer mg-t-30 text-center">
                <button type="submit" class="btn btn-info mg-r-5" style="cursor: pointer;">Add Counter</button>
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
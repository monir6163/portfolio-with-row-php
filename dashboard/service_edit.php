<?php 
include "includes/header.php";
require_once("../db.php");
require "function.php";
$edit_id = get('edit_id');
$select = q("SELECT * FROM `services` WHERE `services_id`='$edit_id'");
$assoc = mysqli_fetch_assoc($select);
$selectedIcon = $assoc['services_icon'];
?>
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="dashboard.php">Dashboard</a>
        <span class="breadcrumb-item active">Add New Service</span>
      </nav>

      <div class="sl-pagebody">
        <div class="row row-sm mg-t-20">
          <div class="col-xl-12">
            <?php include "alert.php"?>
            <form action="service_update.php" method="POST">
              <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                <input type="hidden" name="service_id" value="<?php echo $assoc['services_id'];?>">
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Service Title: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="text" name="title" value="<?php echo $assoc['services_title'];?>" class="form-control" placeholder="Enter Service Title">
                </div>
              </div><!-- row -->
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Service Summery: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="text" class="form-control" name="summery" value="<?php echo $assoc['services_summery'];?>" placeholder="Enter Service Summery"/>
                </div>
              </div>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Service Icon: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <!-- <input type="text" name="icon" class="form-control" placeholder="Ex: fab fa-facebook"> -->
                  <select name="icon" class="form-control">
                    <option value="" disabled >Service Icon</option>
                                <option value="fas fa-pen-nib"
                                <?php
                                    if($selectedIcon == 'fas fa-pen-nib'){
                                        echo "selected";
                                    }
                                ?>
                                >Graphic</option>
                                <option value="fas fa-magic"
                                <?php
                                    if($selectedIcon == 'fas fa-magic'){
                                        echo "selected";
                                    }
                                ?>
                                >Magic Icon</option>
                                <option value="fas fa-desktop"
                                <?php
                                    if($selectedIcon == 'fas fa-desktop'){
                                        echo "selected";
                                    }
                                ?>
                                >Desktop Icon</option>
                                <option value="fas fa-sitemap"
                                <?php
                                    if($selectedIcon == 'fas fa-sitemap'){
                                        echo "selected";
                                    }
                                ?>
                                >Network Icon</option>
                                <option value="fas fa-bullseye"
                                <?php
                                    if($selectedIcon == 'fas fa-bullseye'){
                                        echo "selected";
                                    }
                                ?>
                                >Focus Icon</option>
                                <option value="fas fa-lightbulb"
                                <?php
                                    if($selectedIcon == 'fas fa-lightbulb'){
                                        echo "selected";
                                    }
                                ?>
                                > Light Icon</option>
                  </select>
                </div>
              </div>
              <div class="form-layout-footer mg-t-30 text-center">
                <button type="submit" class="btn btn-info mg-r-5" style="cursor: pointer;">Update Service</button>
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
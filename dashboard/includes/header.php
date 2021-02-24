<?php
require "session.php";
ob_start();
require_once("../db.php");
$select = "SELECT COUNT(*) as total_message FROM message WHERE read_status = 1";
$run_select = mysqli_query($conn,$select);
$message_assoc = mysqli_fetch_assoc($run_select);

$setting = "SELECT * FROM `setting` WHERE `status`= 1";
$settings = mysqli_query($conn,$setting);
$assoc = mysqli_fetch_assoc($settings);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $assoc['websiteTitle'];?></title>

    <!-- vendor css -->
    <link href="assets/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="assets/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="assets/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">


    <!-- Starlight CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/starlight.css">
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <div class="sl-logo"><a href="dashboard.php"><i class="icon ion-android-star-outline"></i>Home</a></div>
    <div class="sl-sideleft">
      <div class="input-group input-group-search">
        <input type="search" name="search" class="form-control" placeholder="Search">
        <span class="input-group-btn">
          <button class="btn"><i class="fa fa-search"></i></button>
        </span><!-- input-group-btn -->
      </div><!-- input-group -->
      <label class="sidebar-label">Navigation</label>
      <div class="sl-sideleft-menu">
        <a href="dashboard.php" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Dashboard</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="all_users.php" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-person-stalker tx-20"></i>
            <span class="menu-item-label">Users</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="banner.php" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-desktop tx-20"></i>
            <span class="menu-item-label">Banner</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="about_me.php" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-person tx-20"></i>
            <span class="menu-item-label">About Me</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="education.php" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-book tx-20"></i>
            <span class="menu-item-label">Education</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="services.php" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-handshake-o tx-20"></i>
            <span class="menu-item-label">Services</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="portfolios.php" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-camera tx-20"></i>
            <span class="menu-item-label">Portfolios</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="counter.php" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-star tx-20"></i>
            <span class="menu-item-label">Counter</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="brand.php" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-heart tx-20"></i>
            <span class="menu-item-label">Brand</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="testimonial.php" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-aperture tx-20"></i>
            <span class="menu-item-label">Testimonial</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="message.php" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-envelope tx-20"></i>
            <span class="menu-item-label">Messages (<span class="text-danger"><?php echo $message_assoc['total_message'];?></span>)</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="contact-info.php" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-phone tx-20"></i>
            <span class="menu-item-label">Contact-Info</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="social.php" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-share-square-o tx-20"></i>
            <span class="menu-item-label">Social Icon</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="fiverr.php" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-telegram tx-20"></i>
            <span class="menu-item-label">Fiverr Link</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="setting.php" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-cog tx-20"></i>
            <span class="menu-item-label">Setting</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
      </div><!-- sl-sideleft-menu -->

      <br>
    </div><!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="sl-header">
      <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
      </div><!-- sl-header-left -->
      <div class="sl-header-right">
        <nav class="nav">
          <div class="dropdown">
            <a href="http://localhost/wdl/portfolio/" target="_blank" class="nav-link nav-link-profile">
              <span class="logged-name">Web<span class="hidden-md-down"> Site</span></span>
            </a>
        </nav>
      </div><!-- sl-header-right -->
    </div><!-- sl-header -->
    <!-- ########## END: HEAD PANEL ########## -->
    <!-- ########## END: RIGHT PANEL ########## --->
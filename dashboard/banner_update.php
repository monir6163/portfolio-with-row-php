<?php
ob_start();
include "includes/header.php";
require_once("../db.php");
require "function.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $banner_id = $_POST['banner_id'];
  $summery = mysqli_real_escape_string($conn, $_POST['summery']);
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $sub_title = mysqli_real_escape_string($conn, $_POST['sub_title']);
  //Service Title Validation.
  if(empty($title)){
    $_SESSION['portfolioTitle_error'] = "Write your Portfolio title properly.";
    header('location: testimonial-edit.php?banner_id='.$banner_id);
  }else{
    $validTitle= $title;
  }
  //Portfolio Category Validation.
  if(empty($sub_title)){
    $_SESSION['portfolioCategory_error'] = "Write your Portfolio Category properly.";
    header('location:testimonial-edit.php?banner_id='.$banner_id);
  }else{
      $validCategory= $sub_title;
  }
  //Portfolio Summary Validation.
  if(empty($summery)){
    $_SESSION['portfolioSummary_error'] = "Write your Portfolio Summary properly.";
    header('location:testimonial-edit.php?banner_id='.$banner_id);
  }else{
    $validSummary = $summery;
  }

  $updateData = " UPDATE banner SET summery= '$validSummary', sub_title= '$validCategory', title= '$validTitle' WHERE banner_id = $banner_id";
  if (mysqli_query($conn, $updateData)) {
    $_SESSION['message'] = " Update Successfully.";
    header('location: banner.php');
  }else{
    $_SESSION['message'] = " Something Wrong.".mysqli_error($conn);
    header('location: banner.php');
  }
  $uploaded_img = $_FILES['img'];
  $img_explode = explode(".", $uploaded_img['name']);
  $ext = end($img_explode);
  $allow_file = array('jpg','png','JPG','JPEG','webp','PNG');
  if (in_array($ext, $allow_file)) {
    if ($uploaded_img['size'] <= 900000) {
      $dataSelect = " SELECT * FROM banner WHERE banner_id = $banner_id ";
      $dataQuery = mysqli_query($conn, $dataSelect);
      $dataAssoc = mysqli_fetch_assoc($dataQuery);
      $imgSourse1 = "../assets/images/banner/".$dataAssoc['img'];
      if(file_exists($imgSourse1)){
        unlink($imgSourse1);
      }
      $newFileName = rand().".".$ext;
      $newlocation = "../assets/images/banner/".$newFileName;
      move_uploaded_file($uploaded_img['tmp_name'], $newlocation );
      $updateThumbnail = q("UPDATE banner SET img = '$newFileName' WHERE banner_id = $banner_id");
    success("Testimonial Update successfully");
    header("Location:banner.php");
  }else{
    warning("Not Allow Try Again");
    header("Location:testimonial_edit.php");
    }
  }else{
    if (empty($uploaded_img)){
    warning("Please All InputForm Your Data.");
    header("Location:testimonial_update.php");
 }else{
    warning("Not Allow this type of Files");
    header("Location:testimonial_update.php");
    ob_end_flush();
 }
  }
}
?>
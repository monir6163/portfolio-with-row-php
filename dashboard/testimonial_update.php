<?php
ob_start();
include "includes/header.php";
require_once("../db.php");
require "function.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $testimonial_id = $_POST['testimonial_id'];
  $summery = mysqli_real_escape_string($conn, $_POST['summery']);
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $sub_title = mysqli_real_escape_string($conn, $_POST['sub_title']);
  //Service Title Validation.
  if(empty($title)){
    $_SESSION['portfolioTitle_error'] = "Write your Portfolio title properly.";
    header('location: testimonial-edit.php?testimonial_id='.$testimonial_id);
  }else{
    $titleLen = strlen($title);
      if($titleLen > 100){
        $_SESSION['portfolioTitle_error'] = "Portfolio title is to long.";
        header('location:testimonial-edit.php?testimonial_id='.$testimonial_id);
      }else{
        $validTitle= $title;
      } 
  }
  //Portfolio Category Validation.
  if(empty($sub_title)){
    $_SESSION['portfolioCategory_error'] = "Write your Portfolio Category properly.";
    header('location:testimonial-edit.php?testimonial_id='.$testimonial_id);
  }else{
    $categoryLen = strlen($sub_title);
    if($categoryLen > 100){
      $_SESSION['portfolioCategory_error'] = "Portfolio Category is to long.";
      header('location:testimonial-edit.php?testimonial_id='.$testimonial_id);
      }else{
        $validCategory= $sub_title;
      } 
  }
  //Portfolio Summary Validation.
  if(empty($summery)){
    $_SESSION['portfolioSummary_error'] = "Write your Portfolio Summary properly.";
    header('location:testimonial-edit.php?testimonial_id='.$testimonial_id);
  }else{
    $validSummary = $summery;
  }

  $updateData = " UPDATE testimonials SET summery= '$validSummary', sub_title= '$validCategory', title= '$validTitle' WHERE testimonial_id = $testimonial_id";
  if (mysqli_query($conn, $updateData)) {
    $_SESSION['message'] = " Update Successfully.";
    header('location: testimonial.php');
  }else{
    $_SESSION['message'] = " Something Wrong.".mysqli_error($conn);
    header('location: testimonial.php');
  }
  $uploaded_img = $_FILES['img'];
  $img_explode = explode(".", $uploaded_img['name']);
  $ext = end($img_explode);
  $allow_file = array('jpg','png','JPG','JPEG','webp','PNG');
  if (in_array($ext, $allow_file)) {
    if ($uploaded_img['size'] <= 300000) {
      $dataSelect = " SELECT * FROM testimonials WHERE testimonial_id = $testimonial_id ";
      $dataQuery = mysqli_query($conn, $dataSelect);
      $dataAssoc = mysqli_fetch_assoc($dataQuery);
      $imgSourse1 = "../assets/images/testimonial/".$dataAssoc['img'];
      if(file_exists($imgSourse1)){
        unlink($imgSourse1);
      }
      $newFileName = rand().".".$ext;
      $newlocation = "../assets/images/testimonial/".$newFileName;
      move_uploaded_file($uploaded_img['tmp_name'], $newlocation );
      $updateThumbnail = q("UPDATE testimonials SET img = '$newFileName' WHERE testimonial_id = $testimonial_id");
    success("Testimonial Update successfully");
    header("Location:testimonial.php");
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
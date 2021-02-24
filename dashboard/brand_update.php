<?php
ob_start();
include "includes/header.php";
require_once("../db.php");
require "function.php";
if ($_SERVER['REQUEST_METHOD']== "POST") {
  $uploaded_img = $_FILES['brand'];
  $brand_id = $_POST['brand_id'];
  $img_explode = explode(".", $uploaded_img['name']);
  $ext = end($img_explode);
  $allow_file = array('jpg','png','JPG','JPEG','webp','PNG');
  if (in_array($ext, $allow_file)) {
    if ($uploaded_img['size'] <= 100000) {
      $dataSelect = " SELECT * FROM brand WHERE brand_id = $brand_id ";
      $dataQuery = mysqli_query($conn, $dataSelect);
      $dataAssoc = mysqli_fetch_assoc($dataQuery);
      $imgSourse1 = "../assets/images/brand/".$dataAssoc['brand_img'];
      if(file_exists($imgSourse1)){
        unlink($imgSourse1);
      }
      $newFileName = rand().".".$ext;
      $newlocation = "../assets/images/brand/".$newFileName;
      move_uploaded_file($uploaded_img['tmp_name'], $newlocation );

      $updateThumbnail = q("UPDATE brand SET brand_img = '$newFileName' WHERE brand_id = $brand_id");
    success("Brand Add successfully");
    header("Location:brand.php");
  }else{
    warning("Not Allow Try Again");
    header("Location:brand_update.php");
    }
  }else{
    if (empty($uploaded_img)){
    warning("Please All InputForm Your Data.");
    header("Location:brand_update.php");
 }else{
    warning("Not Allow this type of Files");
    header("Location:brand_update.php");
 }
  }
}
?>
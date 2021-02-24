<?php
ob_start();
include "includes/header.php";
require_once("../db.php");
require "function.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $category = mysqli_real_escape_string($conn, $_POST['category']);
  $summary = mysqli_real_escape_string($conn, $_POST['summary']);
  $portfolio_id = $_POST['portfolio_id'];
  //Service Title Validation.
  if(empty($title)){
    $_SESSION['portfolioTitle_error'] = "Write your Portfolio title properly.";
    header('location: portfolio-edit.php?portfolio_id='.$portfolio_id);
  }else{
    $titleLen = strlen($title);
      if($titleLen > 100){
        $_SESSION['portfolioTitle_error'] = "Portfolio title is to long.";
        header('location:portfolio-edit.php?portfolio_id='.$portfolio_id);
      }else{
        $validTitle= $title;
      } 
  }
  //Portfolio Category Validation.
  if(empty($category)){
    $_SESSION['portfolioCategory_error'] = "Write your Portfolio Category properly.";
    header('location:portfolio-edit.php?portfolio_id='.$portfolio_id);
  }else{
    $categoryLen = strlen($category);
    if($categoryLen > 100){
      $_SESSION['portfolioCategory_error'] = "Portfolio Category is to long.";
      header('location:portfolio-edit.php?portfolio_id='.$portfolio_id);
      }else{
        $validCategory= $category;
      } 
  }
  //Portfolio Summary Validation.
  if(empty($summary)){
    $_SESSION['portfolioSummary_error'] = "Write your Portfolio Summary properly.";
    header('location:portfolio-edit.php?portfolio_id='.$portfolio_id);
  }else{
    $validSummary = $summary;
  }

  $updateData = " UPDATE portfolios SET summary= '$validSummary', category= '$validCategory', title= '$validTitle' WHERE portfolio_id = $portfolio_id";
  if (mysqli_query($conn, $updateData)) {
    $_SESSION['message'] = " Update Successfully.";
    header('location: portfolios.php');
    die();
  }else{
    $_SESSION['message'] = " Something Wrong.".mysqli_error($conn);
    header('location: portfolios.php');
  }

  $thumbnail = $_FILES['thumbnail'];
  $extention= end(explode('.', $thumbnail['name']));
  $allowType = array( 'jpeg', 'jpg', 'png', 'webp', 'JPEG', 'JPG', 'PNG');

  if(in_array($extention, $allowType)){
    if($thumbnail['size'] < 2000000 ){
      $dataSelect = " SELECT * FROM portfolios WHERE portfolio_id = $portfolio_id ";
      $dataQuery = mysqli_query($conn, $dataSelect);
      $dataAssoc = mysqli_fetch_assoc($dataQuery);
      $imgSourse1 = "../assets/images/portfolios/".$dataAssoc['thumbnail'];
      if(file_exists($imgSourse1)){
        unlink($imgSourse1);
      }
      $newFileName = rand().".".$extention;
      $newlocation = "../assets/images/portfolios/".$newFileName;
      move_uploaded_file($thumbnail['tmp_name'], $newlocation );

      $updateThumbnail = " UPDATE portfolios SET thumbnail = '$newFileName' WHERE portfolio_id = $portfolio_id";
      if(mysqli_query($conn, $updateThumbnail)){
        success("Portfolios Update successfully");
        header('location: portfolios.php');
      }else{
        echo "Something Error ".mysqli_error($conn);
      }

    }else{
      echo "File is to big.";
    }
  }else{
    $_SESSION['message'] = "This type of Thumbnail images file not allow.";
    header('location: portfolios.php');
  }

  $feature_img = $_FILES['feature_img'];
  $extention2= end(explode('.', $feature_img['name']));
  $allowType2 = array( 'jpeg', 'jpg', 'png', 'webp', 'JPEG', 'JPG', 'PNG');

  if(in_array($extention2, $allowType2)){
    if($feature_img['size'] < 2000000 ){
      $dataSelect2 = " SELECT * FROM portfolios WHERE portfolio_id = $portfolio_id ";
      $dataQuery2 = mysqli_query($conn, $dataSelect2);
      $dataAssoc2 = mysqli_fetch_assoc($dataQuery2);

      $imgSourse2 = "../assets/images/featured-image/".$dataAssoc2['featured_image'];
      if(file_exists($imgSourse2)){
        unlink($imgSourse2);
      }
      $newFileName2 = rand().".".$extention2;
      $newlocation2 = "../assets/images/featured-image/".$newFileName2;
      move_uploaded_file($feature_img['tmp_name'], $newlocation2 );

      $updatefeature_img = " UPDATE portfolios SET featured_image = '$newFileName2' WHERE portfolio_id = $portfolio_id";
      if(mysqli_query($conn, $updatefeature_img)){
        success("Portfolios Update successfully");
        header('location: portfolios.php');
      }else{
        $_SESSION['message'] = "Something Error ".mysqli_error($conn);
        header('location: portfolios.php');
      }

    }else{
      $_SESSION['message'] =  "File is to big.";
      header('location: portfolios.php');
    }
  }else{
    $_SESSION['message'] = "This type of Feature images file not allow.";
    header('location: portfolios.php');
  }

}

?>
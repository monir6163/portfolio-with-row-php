<?php
// ob_start();
// include "includes/header.php";
// require_once("../db.php");
// require "function.php";
// if($_SERVER['REQUEST_METHOD'] == 'POST'){
//   $about = mysqli_real_escape_string($conn, $_POST['about']);
//   $about_id = $_POST['about_id'];
//   //Portfolio Summary Validation.
//   if(empty($about)){
//     warning("Please All InputForm Your Data.");
//     header("Location:about_update.php");
//   }else{
//     $validSummary = $about;
//   }
//   $updateData = q("UPDATE about SET about = '$validSummary' WHERE about_id = $about_id");
//   success("About Update successfully");
//   header("Location:about_me.php");
//   $thumbnail = $_FILES['thumbnail'];
//   $extention= end(explode('.', $thumbnail['name']));
//   $allowType = array( 'jpeg', 'jpg', 'png', 'webp', 'JPEG', 'JPG', 'PNG');

//   if(in_array($extention, $allowType)){
//     if($thumbnail['size'] < 2000000 ){
//       $dataSelect = " SELECT * FROM about WHERE about_id = $about_id ";
//       $dataQuery = mysqli_query($conn, $dataSelect);
//       $dataAssoc = mysqli_fetch_assoc($dataQuery);
//       $imgSourse1 = "../assets/images/about/".$dataAssoc['about_img'];
//       if(file_exists($imgSourse1)){
//         unlink($imgSourse1);
//       }
//       $newFileName = rand().".".$extention;
//       $newlocation = "../assets/images/about/".$newFileName;
//       move_uploaded_file($thumbnail['tmp_name'], $newlocation );
//       $updateThumbnail = q("UPDATE about SET about_img = '$newFileName' WHERE about_id = $about_id");
//         success("About Update successfully");
//         header('location: about_me.php');
//     }else{
//       warning("File Size is Big");
//       header("Location:about_update.php");
//     }
//   }else{
//     warning("Not Allow this type of Files");
//     header("Location:about_update.php");
//     ob_end_flush();
//   }

// }

  ob_start();
  include "includes/header.php";
  require_once("../db.php");
  require "function.php";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $summary = mysqli_real_escape_string($conn, $_POST['about']);

    // About Summary Validation Here..
    if(empty($summary)){
      $_SESSION['aboutSummary_error'] = "About summary Must be Filed with Test.";
      header('location: about_edit.php');
    }else{
      $update = " UPDATE about SET about = '$summary' ";
      if(mysqli_query($conn, $update)){
        $_SESSION['message'] = "About Update Successfully.";
        header('location: about_me.php');
      }     
    }

    // About Photo Validation.. 
    $aboutPhoto = $_FILES['thumbnail'];
    $extention= end(explode('.', $aboutPhoto['name']));
    $allowType = array( 'jpeg', 'jpg', 'png', 'webp', 'JPEG', 'JPG', 'PNG');
    if (in_array($extention, $allowType)) {
      if($aboutPhoto['size'] < 2000000) {
        $dataSelect = " SELECT * FROM about ";
        $dataQuery = mysqli_query($conn, $dataSelect);
        $dataAssoc = mysqli_fetch_assoc($dataQuery);

        $imgSourse1 = "../assets/images/about/".$dataAssoc['about_img'];
        if(file_exists($imgSourse1)){
          unlink($imgSourse1);
        }

        $newFileName = rand().'.'.$extention;
        $newlocation = "../assets/images/about/".$newFileName;
        move_uploaded_file($aboutPhoto['tmp_name'], $newlocation );

        $updatePhoto = " UPDATE about SET about_img = '$newFileName' ";
        if(mysqli_query($conn, $updatePhoto)){
          $_SESSION['message']= "About Content Updated Successfully";
          header('location: about_me.php');
        }else{
          echo "Something Error ".mysqli_error($conn);
        }


      }else{
        $_SESSION['bannerPhoto_error'] = "Your File Size too big";
        header('location: about-edit.php');
      }
    }

  }

?>
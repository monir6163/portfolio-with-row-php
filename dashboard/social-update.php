 <?php 
  ob_start();
  include "includes/header.php";
  require_once("../db.php");
  include "function.php";
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $social_id = $_POST['social_id'];
    $socailIcon = $_POST['socailIcon'];
    $sociallink = $_POST['link'];
    if (empty($socailIcon) || empty($sociallink)) {
    	warning("Please Input All Filed");
    	redirect("");
    }else{
    	$update = q("UPDATE `social` SET `icon`='$socailIcon',`link`='$sociallink' WHERE `social_id`='$social_id'");
    	success("Social Update Successfully");
    	redirect("social.php");
    }
  }
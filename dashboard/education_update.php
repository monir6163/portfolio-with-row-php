<?php
ob_start();
include "includes/header.php";
require_once("../db.php");
require "function.php";
if ($_SERVER['REQUEST_METHOD']== "POST") {
  $education_id = $_POST['education_id'];
  $year = $_POST['year'];
  $number = $_POST['number'];
  $title = $_POST['title'];
  if (empty($year) || empty($number) || empty($title)) {
  	warning("Please Input All Filed");
  	redirect("");
  }else{
  	$update_education = " UPDATE `education` SET `year` = '$year', `number` = '$number', `title` = '$title' WHERE `education_id` = $education_id";
    $run = mysqli_query($conn,$update_education);
    if ($run) {
      success("Education Update Successfully");
      header("Location:education.php");
    }else{
      warning("Education Update Error.");
      header("Location:education_update.php");
      ob_end_flush();
    }
  }
  
}
?>
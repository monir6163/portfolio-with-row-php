<?php
ob_start();
include "includes/header.php";
require_once("../db.php");
require "function.php";
if ($_SERVER['REQUEST_METHOD']== "POST") {
  $counter_id = $_POST['counter_id'];
  $title = $_POST['title'];
  $number = $_POST['number'];
  $icon = $_POST['icon'];
  if (empty($title) || empty($number) || empty($icon)) {
  	warning("Please Input All Filed");
  	redirect("");
  }else{
  	$updatecounter = " UPDATE `counter` SET `title` = '$title', `number` = '$number', `icon` = '$icon' WHERE `counter_id` = $counter_id";
    $run = mysqli_query($conn,$updatecounter);
    if ($run) {
      success("counter Service Successfully");
      header("Location:counter.php");
    }else{
      warning("counter Service Add Error.");
      header("Location:counter_update.php");
      ob_end_flush();
    }
  }
  
}
?>
<?php 
ob_start();
include "includes/header.php";
require_once("../db.php");
require "function.php";
if ($_SERVER['REQUEST_METHOD']== "POST") {
  $service_id = $_POST['service_id'];
  $title = $_POST['title'];
  $summery = $_POST['summery'];
  $icon = $_POST['icon'];
  if (empty($title) || empty($summery) || empty($icon)) {
    warning("Please All InputForm Your Data.");
  }else{
    $updateService = " UPDATE `services` SET `services_title` = '$title', `services_summery` = '$summery', `services_icon` = '$icon' WHERE `services_id` = $service_id";
    $run = mysqli_query($conn,$updateService);
    if ($run) {
      success("Update Service Successfully");
      header("Location:services.php");
    }else{
      warning("Update Service Add Error.");
      header("Location:service_update.php");
      ob_end_flush();
    }
  }
}
?>
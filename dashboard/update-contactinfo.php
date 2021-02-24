<?php 
ob_start();
include "includes/header.php";
require_once("../db.php");
require "function.php";
if ($_SERVER['REQUEST_METHOD']== "POST") {
$contact_id = $_POST['contact_id'];
$summery = $_POST['summery'];
$off_name = $_POST['off_name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
if(empty($summery) || empty($off_name) || empty($address) || empty($phone) || empty($email)){
warning("Please Input Your Full Data Filed");
redirect("");
}else{
    $update_insert = q("UPDATE `contact` SET `summery`='$summery',`off_title`='$off_name',`address`='$address',`phone`='$phone',`email`='$email' WHERE `contact_id`='$contact_id'");
    success("Contact Info Update Successfuly");
    redirect("contact-info.php");
}
}
?>
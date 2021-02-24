<?php
session_start();
ob_start();
require_once("../db.php");
require "function.php";
    $setting_id = $_GET['statusid'];
    $setting_status = "SELECT * FROM setting WHERE setting_id  = $setting_id  ";
    $setting_query = mysqli_query($conn, $setting_status);
    $setting_assoc = mysqli_fetch_assoc($setting_query);

    if($setting_assoc['status'] == 1){
        $setting_update = "UPDATE setting SET status = 2 WHERE setting_id  = $setting_id ";
        if(mysqli_query($conn, $setting_update)){
        	warning("Setting Deactive Successfully");
            // $_SESSION['message'] = "counter Deactive Successfully";
            header('location:setting.php');
        }
    }else{
        $setting_update = "UPDATE setting SET status = 1 WHERE setting_id  = $setting_id ";
        if(mysqli_query($conn, $setting_update)){
        	success("Setting Active Successfully");
            // $_SESSION['message'] = "counter Active Successfully";
            header('location:setting.php');
        }
    }
?>
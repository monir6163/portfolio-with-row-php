<?php
session_start();
ob_start();
require_once("../db.php");
require "function.php";
    $banner_id = $_GET['statusid'];
    $banner_status = "SELECT * FROM banner WHERE banner_id  = $banner_id  ";
    $banner_query = mysqli_query($conn, $banner_status);
    $banner_assoc = mysqli_fetch_assoc($banner_query);

    if($banner_assoc['status'] == 1){
        $banner_update = "UPDATE banner SET status = 2 WHERE banner_id  = $banner_id ";
        if(mysqli_query($conn, $banner_update)){
            warning("banner Deactive Successfully");
            header('location:banner.php');
        }
    }else{
        $banner_update = "UPDATE banner SET status = 1 WHERE banner_id  = $banner_id ";
        if(mysqli_query($conn, $banner_update)){
            success("banner Active Successfully");
            header('location:banner.php');
        }
    }
?>
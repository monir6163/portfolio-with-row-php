<?php
session_start();
ob_start();
require_once("../db.php");
require "function.php";
    $social_id = $_GET['statusid'];
    $social_status = "SELECT * FROM social WHERE social_id  = $social_id  ";
    $social_query = mysqli_query($conn, $social_status);
    $social_assoc = mysqli_fetch_assoc($social_query);

    if($social_assoc['status'] == 1){
        $social_update = "UPDATE social SET status = 2 WHERE social_id  = $social_id ";
        if(mysqli_query($conn, $social_update)){
            // $_SESSION['message'] = "social Deactive Successfully";
            warning("Social Deactive Successfully");
            header('location:social.php');
        }
    }else{
        $social_update = "UPDATE social SET status = 1 WHERE social_id  = $social_id ";
        if(mysqli_query($conn, $social_update)){
            // $_SESSION['message'] = "social Active Successfully";
            success("Social Active Successfully");
            header('location:social.php');
        }
    }
?>
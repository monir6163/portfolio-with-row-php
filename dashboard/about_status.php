<?php
session_start();
ob_start();
require_once("../db.php");
require "function.php";
    $about_id = $_GET['statusid'];
    $about_status = "SELECT * FROM about WHERE about_id  = $about_id  ";
    $about_query = mysqli_query($conn, $about_status);
    $about_assoc = mysqli_fetch_assoc($about_query);

    if($about_assoc['status'] == 1){
        $about_update = "UPDATE about SET status = 2 WHERE about_id  = $about_id ";
        if(mysqli_query($conn, $about_update)){
            $_SESSION['message'] = "About Deactive Successfully";
            header('location:about_me.php');
        }
    }else{
        $about_update = "UPDATE about SET status = 1 WHERE about_id  = $about_id ";
        if(mysqli_query($conn, $about_update)){
            $_SESSION['message'] = "About Active Successfully";
            header('location:about_me.php');
        }
    }
?>
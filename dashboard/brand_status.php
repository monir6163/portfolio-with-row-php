<?php
session_start();
ob_start();
require_once("../db.php");
require "function.php";
    $brand_id = $_GET['statusid'];
    $brand_status = "SELECT * FROM brand WHERE brand_id  = $brand_id  ";
    $brand_query = mysqli_query($conn, $brand_status);
    $brand_assoc = mysqli_fetch_assoc($brand_query);

    if($brand_assoc['status'] == 1){
        $brand_update = "UPDATE brand SET status = 2 WHERE brand_id  = $brand_id ";
        if(mysqli_query($conn, $brand_update)){
            $_SESSION['message'] = "brand Deactive Successfully";
            header('location:brand.php');
        }
    }else{
        $brand_update = "UPDATE brand SET status = 1 WHERE brand_id  = $brand_id ";
        if(mysqli_query($conn, $brand_update)){
            $_SESSION['message'] = "brand Active Successfully";
            header('location:brand.php');
        }
    }
?>
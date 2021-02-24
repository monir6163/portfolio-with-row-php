<?php
session_start();
ob_start();
require_once("../db.php");
require "function.php";
    $services_id = $_GET['statusid'];
    $portfolio_status = "SELECT * FROM services WHERE services_id  = $services_id  ";
    $portfolio_query = mysqli_query($conn, $portfolio_status);
    $portfolio_assoc = mysqli_fetch_assoc($portfolio_query);

    if($portfolio_assoc['services_status'] == 1){
        $portfolio_update = "UPDATE services SET services_status = 2 WHERE services_id  = $services_id ";
        if(mysqli_query($conn, $portfolio_update)){
            $_SESSION['message'] = "Portfolio Deactive Successfully";
            header('location:services.php');
        }
    }else{
        $portfolio_update = "UPDATE services SET services_status = 1 WHERE services_id  = $services_id ";
        if(mysqli_query($conn, $portfolio_update)){
            $_SESSION['message'] = "Portfolio Active Successfully";
            header('location:services.php');
        }
    }
?>
<?php
session_start();
ob_start();
require_once("../db.php");
require "function.php";
	$portfolio_id = $_GET['statusid'];
	echo $portfolio_id;
    $portfolio_status = "SELECT * FROM portfolios WHERE portfolio_id = $portfolio_id ";
    $portfolio_query = mysqli_query($conn, $portfolio_status);
    $portfolio_assoc = mysqli_fetch_assoc($portfolio_query);

    if($portfolio_assoc['status'] == 1){
        $portfolio_update = "UPDATE portfolios SET status = 2 WHERE portfolio_id = $portfolio_id";
        if(mysqli_query($conn, $portfolio_update)){
            $_SESSION['message'] = "Portfolio Deactive Successfully";
            header('location:portfolios.php');
        }
    }else{
        $portfolio_update = "UPDATE portfolios SET status = 1 WHERE portfolio_id = $portfolio_id";
        if(mysqli_query($conn, $portfolio_update)){
            $_SESSION['message'] = "Portfolio Active Successfully";
            header('location:portfolios.php');
        }
    }
?>
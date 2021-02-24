<?php
session_start();
ob_start();
require_once("../db.php");
require "function.php";
    $fiverr_id = $_GET['statusid'];
    $fiverr_status = "SELECT * FROM fiverr WHERE fiverr_id  = $fiverr_id  ";
    $fiverr_query = mysqli_query($conn, $fiverr_status);
    $fiverr_assoc = mysqli_fetch_assoc($fiverr_query);

    if($fiverr_assoc['status'] == 1){
        $fiverr_update = "UPDATE fiverr SET status = 2 WHERE fiverr_id  = $fiverr_id ";
        if(mysqli_query($conn, $fiverr_update)){
            warning("Fiverr Link Deactive Successfully");
            // $_SESSION['message'] = "brand Deactive Successfully";
            header('location:fiverr.php');
        }
    }else{
        $fiverr_update = "UPDATE fiverr SET status = 1 WHERE fiverr_id  = $fiverr_id ";
        if(mysqli_query($conn, $fiverr_update)){
        	success("Fiverr Link Active Successfully");
            // $_SESSION['message'] = "brand Active Successfully";
            header('location:fiverr.php');
        }
    }
?>
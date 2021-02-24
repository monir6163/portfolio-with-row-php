<?php
session_start();
ob_start();
require_once("../db.php");
require "function.php";
    $counter_id = $_GET['statusid'];
    $counter_status = "SELECT * FROM counter WHERE counter_id  = $counter_id  ";
    $counter_query = mysqli_query($conn, $counter_status);
    $counter_assoc = mysqli_fetch_assoc($counter_query);

    if($counter_assoc['status'] == 1){
        $counter_update = "UPDATE counter SET status = 2 WHERE counter_id  = $counter_id ";
        if(mysqli_query($conn, $counter_update)){
            $_SESSION['message'] = "counter Deactive Successfully";
            header('location:counter.php');
        }
    }else{
        $counter_update = "UPDATE counter SET status = 1 WHERE counter_id  = $counter_id ";
        if(mysqli_query($conn, $counter_update)){
            $_SESSION['message'] = "counter Active Successfully";
            header('location:counter.php');
        }
    }
?>
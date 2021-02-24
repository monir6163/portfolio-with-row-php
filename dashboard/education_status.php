<?php
session_start();
ob_start();
require_once("../db.php");
require "function.php";
    $education_id = $_GET['statusid'];
    $education_status = "SELECT * FROM education WHERE education_id  = $education_id  ";
    $education_query = mysqli_query($conn, $education_status);
    $education_assoc = mysqli_fetch_assoc($education_query);

    if($education_assoc['status'] == 1){
        $education_update = "UPDATE education SET status = 2 WHERE education_id  = $education_id ";
        if(mysqli_query($conn, $education_update)){
            warning("Education Deactive Successfully");
            // $_SESSION['message'] = "Education Deactive Successfully";
            header('Location:education.php');
        }
    }else{
        $education_update = "UPDATE education SET status = 1 WHERE education_id  = $education_id ";
        if(mysqli_query($conn, $education_update)){
            success("Education Active Successfully");
            // $_SESSION['message'] = "Education Active Successfully";
            header('Location:education.php');
        }
    }
?>
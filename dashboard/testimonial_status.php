<?php
session_start();
ob_start();
require_once("../db.php");
require "function.php";
    $testimonial_id = $_GET['statusid'];
    $testimonial_status = "SELECT * FROM testimonials WHERE testimonial_id  = $testimonial_id  ";
    $testimonial_query = mysqli_query($conn, $testimonial_status);
    $testimonial_assoc = mysqli_fetch_assoc($testimonial_query);

    if($testimonial_assoc['status'] == 1){
        $testimonial_update = "UPDATE testimonials SET status = 2 WHERE testimonial_id  = $testimonial_id ";
        if(mysqli_query($conn, $testimonial_update)){
            warning("Testimonial Deactive Successfully");
            // $_SESSION['message'] = "Education Deactive Successfully";
            header('Location:testimonial.php');
        }
    }else{
        $testimonial_update = "UPDATE testimonials SET status = 1 WHERE testimonial_id  = $testimonial_id ";
        if(mysqli_query($conn, $testimonial_update)){
            success("Testimonial Active Successfully");
            // $_SESSION['message'] = "Education Active Successfully";
            header('Location:testimonial.php');
        }
    }
?>
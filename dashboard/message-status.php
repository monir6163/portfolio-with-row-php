<?php
session_start();
ob_start();
require_once("../db.php");
require "function.php";
    $message_id = $_GET['statusid'];
    $testimonial_status = "SELECT * FROM message WHERE message_id  = $message_id  ";
    $testimonial_query = mysqli_query($conn, $testimonial_status);
    $testimonial_assoc = mysqli_fetch_assoc($testimonial_query);

    if($testimonial_assoc['read_status'] == 1){
        $testimonial_update = "UPDATE message SET read_status = 2 WHERE message_id  = $message_id ";
        if(mysqli_query($conn, $testimonial_update)){
            warning("Massage Read Successfully");
            // $_SESSION['message'] = "Education Deactive Successfully";
            header('Location:message.php');
        }
    }else{
        $testimonial_update = "UPDATE message SET read_status = 1 WHERE message_id  = $message_id ";
        if(mysqli_query($conn, $testimonial_update)){
            success("Massage Unread Successfully");
            // $_SESSION['message'] = "Education Active Successfully";
            header('Location:message.php');
        }
    }
?>
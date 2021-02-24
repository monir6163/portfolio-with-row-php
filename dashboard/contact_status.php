<?php
session_start();
ob_start();
require_once("../db.php");
require "function.php";
    $contact_id = $_GET['statusid'];
    $contact_status = "SELECT * FROM contact WHERE contact_id  = $contact_id  ";
    $contact_query = mysqli_query($conn, $contact_status);
    $contact_assoc = mysqli_fetch_assoc($contact_query);

    if($contact_assoc['status'] == 1){
        $contact_update = "UPDATE contact SET status = 2 WHERE contact_id  = $contact_id ";
        if(mysqli_query($conn, $contact_update)){
        	warning("Contact Deactive Successfully");
            // $_SESSION['message'] = "contact Deactive Successfully";
            header('location:contact.php');
        }
    }else{
        $contact_update = "UPDATE contact SET status = 1 WHERE contact_id  = $contact_id ";
        if(mysqli_query($conn, $contact_update)){
        	success("Contact Active Successfully");
            // $_SESSION['message'] = "contact Active Successfully";
            header('location:contact.php');
        }
    }
?>
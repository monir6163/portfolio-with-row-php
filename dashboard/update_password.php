<?php
session_start();
require_once("db.php");
if (isset($_POST['btn'])) {
	$pass_id = $_POST['pass_id'];
	$old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $select = "SELECT * FROM `users` WHERE `user_id`='$pass_id'";
    $run = mysqli_query($conn,$select);
    $show = mysqli_fetch_assoc($run);
    if (password_verify($old_password, $show['password'])) {
    	if ($new_password == $confirm_password) {
    		$new_hash = password_hash($new_password, PASSWORD_DEFAULT);
    		$pass_update = "UPDATE `users` SET `password`='$new_hash' WHERE `user_id`='$pass_id'";
    		$run_pass = mysqli_query($conn,$pass_update);
    		if ($run_pass) {
    			echo "Password Update Successfully!";
    		}else{
    			echo "Password Update Failed!";
    		}
    	}else{
    		echo "New & Confirm Password Not Matched!";
    	}
    }else{
    	echo "Enter Your Correct Old Password!";
    }
}
?>
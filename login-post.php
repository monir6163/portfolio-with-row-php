<?php
session_start();
require_once("db.php");
if(isset($_POST['btn'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $select = "SELECT COUNT(*) as total,name,email,password FROM `users` WHERE `email`='$email'";
    $run_query = mysqli_query($conn,$select);
    $show = mysqli_fetch_assoc($run_query);
    if ($show['total'] > 0) {
    	$user_pass = $show['password'];
	    if (password_verify($password, $user_pass)) {
            $_SESSION['email'] = $show['email'];
            $_SESSION['name'] = $show['name'];
            $_SESSION['not_email'] = 'Email not matched';
            header("Location:dashboard/dashboard.php");
	    }else{
	    	$_SESSION['not_pass'] = 'password not matched';
            header("Location:login.php");
	    }
    }else{
        header("Location:login.php");
    }
}
?>
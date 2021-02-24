<?php
session_start();
require_once("../db.php");
if(isset($_POST['btn'])){
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    // if(empty($name)){
    //     $_SESSION['username']='Enter Your Name';
    //     header("Location:index.php");
    // }else{
    //     $number    = preg_match('@[0-9]@', $name);
    //     $specialChars = preg_match('@[^\w]@', $name);
    //     if($number || $specialChars) {
    //         $valid_name = $name;
    //         $_SESSION['username']='Please Enter Your name not number & specialChars';
    //         header("Location:index.php");
    //     } 
    // }
    if (!empty($name)) {
        $namelen = strlen($name);
        if ($namelen > 2 && $namelen < 40) {
            $valid_name = $name;
        }else{
            $_SESSION['username'] = "Your Name Is Short";
            header("Location:user-edit.php");
        }
    }else{
        $_SESSION['username'] = "Enter Your Name";
            header("Location:user-edit.php");
    }
    if(!empty($email)){
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$/'; 
        if(preg_match($regex, $email)){
            $valid_email = $email;
        }else{
            $_SESSION['email_valid']='Please enter your Valid Email';
        }
    }else{
        $_SESSION['email_valid']='Enter Your Email Address';
        header("Location:user-edit.php");
    }
if($valid_name && $valid_email){
    $update_query = "UPDATE `users` SET `name`='$valid_name',`email`='$valid_email' WHERE `user_id`='$user_id'";
    $run_query = mysqli_query($conn,$update_query);
    header("Location:all_users.php");
}else{
    $_SESSION['invaildquery'] = "Something Wrong!";
    header("Location:user-edit.php");
}
}else{
    echo 'Data Not Found!!!';
}
?>
<?php
session_start();
require_once("db.php");
if(isset($_POST['btn'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!empty($name)) {
        $namelen = strlen($name);
        if ($namelen > 2 && $namelen < 20) {
            $valid_name = $name;
        }else{
            $_SESSION['username'] = "Your Name Is Short";
            header("Location:registation.php");
        }
    }else{
        $_SESSION['username'] = "Enter Your Name";
            header("Location:registation.php");
    }
    if(!empty($email)){
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$/'; 
        if(preg_match($regex, $email)){
            $select = "SELECT COUNT(*) as total FROM `users` WHERE `email`='$email'";
            $run_query = mysqli_query($conn,$select);
            $show = mysqli_fetch_assoc($run_query);
            if ($show['total'] > 0) {
                $_SESSION['email_valid']='Your Email Already Exists!';
                header("Location:registation.php");
            }else{
               $valid_email = $email;
            }
        }else{
            $_SESSION['email_valid']='Please enter your Valid Email';
        }
    }else{
        $_SESSION['email_valid']='Enter Your Email Address';
        header("Location:registation.php");
    }
if(!empty($password)){
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
    $_SESSION['pass_emp']='Please Enter Your Password Minimum 8 characters, at least one uppercase letter, one lowercase letter, one number and one special character:';
    header("Location:registation.php");
}else{
    $valid_password = password_hash("$password", PASSWORD_BCRYPT);
    }
}else{
    $_SESSION['pass_emp']='Enter your Password';
    header("Location:registation.php");
}
if($valid_name && $valid_email && $valid_password){
    $insert_query = "INSERT INTO `users`(`name`, `email`, `password`) VALUES ('$valid_name','$valid_email','$valid_password')";
    $run_query = mysqli_query($conn,$insert_query);
    header("Location:login.php");
}else{
    $_SESSION['invaildquery'] = "Something Wrong!";
    header("Location:registation.php");
}
}else{
    echo 'Data Not Found!!!';
}
?>
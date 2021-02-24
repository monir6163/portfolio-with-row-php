<?php 
session_start();
require_once ('db.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    // Name Validation 
    if(empty($name)){
      $_SESSION['nameError'] = "Please Write your Name.";
      header('location:index.php#contact');
    }else{
      $validName= $name;
    }
    //Email Validation
    if(empty($email)){
      $_SESSION['emailError'] = "Please Write your Email.";
      header('location:index.php#contact');
    }else{
      $regex = '/^[_A-za-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,6})$/';
      $emailRegex = preg_match($regex,$email);
      if($emailRegex){
        $validEmail = $email;
      }else{
        $_SESSION['emailError'] = "Your email is not correct.";
        header('location:index.php#contact');
      }
    }
    //Message Validation.
    if(empty($message)){
      $_SESSION['messageError'] = "Please Write your message.";
      header('location:index.php#contact');
    }else{
      $len = strlen($message);
      if($len < 255){
        $validMessage = $message;
      }else{
        $_SESSION['messageError'] = "Please Write message shortyly.";
        header('location:index.php#contact');
      }
    }

    if($validName && $validEmail && $validMessage){
      $insertData = "INSERT INTO message ( name, email, message ) VALUES ( '$validName', '$validEmail' , '$validMessage' )";
      if(mysqli_query($conn, $insertData)){
        $_SESSION['message'] = "Message Sent Successfully.";
        header('location:index.php#contact');
      }else{
        $_SESSION['message'] = "Message Sent Successfully.".mysqli_error($conn);
        header('location:location:index.php#contact');
      }
    }
}
?>
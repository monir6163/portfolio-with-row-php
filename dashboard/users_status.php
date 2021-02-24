<?php
// status update
  session_start();
  require_once("../db.php");
  $statusid = $_GET['statusid'];
  $select = "SELECT * FROM `users` WHERE user_id='$statusid'";
  $run_select = mysqli_query($conn,$select);
  $assoc = mysqli_fetch_assoc($run_select);
  if ($assoc['status']==1) {
      $status_query = "UPDATE `users` SET `status`= 2 WHERE user_id='$statusid'";
      if (mysqli_query($conn,$status_query)) {
      $_SESSION['statusmsg'] = $assoc['name'].' !Deactivated Successfully!';
      header("Location:all_users.php");
      }
      
  }else{
      $status_query = "UPDATE `users` SET `status`= 1 WHERE user_id='$statusid'";
      if (mysqli_query($conn,$status_query)) {
      $_SESSION['statusmsg'] = $assoc['name'].' !Activated Successfully!';  
      header("Location:all_users.php");
      }
      
  }
?>
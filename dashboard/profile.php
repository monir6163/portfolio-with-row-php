<?php
session_start();
require_once("../db.php");
$pro_id = $_GET['pro_id'];
$pro_data = "SELECT * FROM `users` WHERE user_id='$pro_id'";
$run_data = mysqli_query($conn,$pro_data);
$pro_datacount = mysqli_fetch_assoc($run_data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
<div class="container mt-5">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-3">
      <div class="card" style="width:100%">
        <div class="card-body">
          <img class="card-img-top" src="https://www.w3schools.com/bootstrap4/img_avatar3.png" alt="Card image" style="width:100%;">
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="card" style="width:100%">
        <div class="card-body">
          <h2 class="card-title"><i class="fa fa-user"></i> <?php echo $pro_datacount['name'];?></h2>
          <h4 class="card-title"><i class="fa fa-envelope"></i> <?php echo $pro_datacount['email'];?></h4>
          <h4 class="card-title"><i class="fa fa-lock"></i> ******</h4>
          <a href="change_password.php?pass_id=<?php echo $pro_datacount['user_id'];?>" class="btn btn-primary">Change Password</a>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>

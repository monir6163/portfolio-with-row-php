<?php
session_start();
require_once("../db.php");
$edit_id = $_GET['edit_id'];
$select = "SELECT * FROM `users` WHERE `user_id`='$edit_id'";
$query_run = mysqli_query($conn,$select);
$show = mysqli_fetch_assoc($query_run);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Information Update From</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <div class="row mt-5">
      <div class="col-8 offset-2">
        <div class="card">
            <div class="card-header text-center bg-info text-white">Update <b class="text-danger"><?php echo $show['name'];?>'s</b> information
             <a class="btn btn-primary" href="all_users.php">All Users</a>
            </div>
            <span class="text-color">
                      <?php
                      if(isset($_SESSION['invaildquery'])){
                          ?>
                          <style type="text/css">
                            .text-color{
                                color: red;
                                text-align: center;
                            }
                          </style>
                          <?php
                        echo $_SESSION['invaildquery'];
                        unset($_SESSION['invaildquery']);
                      }
                      ?>
                    </span>
            <div class="card-body">
                <form action="user-update.php" method="POST">
                	<input type="hidden" name="user_id" value="<?php echo $show['user_id'];?>">
                    <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control border_red" id="name" placeholder="Enter Name" name="name" value="<?php echo $show['name'];?>">
                    <p>
                    <span class="text-color">
                      <?php
                      if(isset($_SESSION['username'])){
                          ?>
                          <style type="text/css">
                            .border_red{
                                border: 1px solid red;
                            }
                            .text-color{
                                color: red;
                            }
                          </style>
                          <?php
                        echo $_SESSION['username'];
                        unset($_SESSION['username']);
                      }
                      ?>
                    </span>
                    </p>
                    </div>
                    <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control border_red" id="email" placeholder="Enter email" name="email" value="<?php echo $show['email'];?>">
                    <p>
                    <span class="text-color">
                      <?php
                      if(isset($_SESSION['email_valid'])){
                          ?>
                          <style type="text/css">
                            .border_red{
                                border: 1px solid red;
                            }
                            .text-color{
                                color: red;
                            }
                          </style>
                          <?php
                        echo $_SESSION['email_valid'];
                        unset($_SESSION['email_valid']);
                      }
                      ?>
                    </span>
                    </p>
                    </div>
                    <div class="text-center">
                      <button type="submit" name="btn" class="btn btn-primary">Update Now</button>
                    </div>
                </form>
                </div> 
            </div>
      </div>
  </div>
</div>

<!-- <?php
$r = 1;
$arr = array("Volvo", "BMW", "Toyota", "Nissan", "Audi");
foreach($arr as $value){
    if($value=="Toyota"){
        echo "Toyota Is Present";
    }else{
        $r++;
    }
}
echo "<br>";
if(array_search("Toyota",$arr)){
    echo "Toyota Is Present";
}
echo "<br>";
echo "<br>";
for($i = 1; $i <= 8; $i++){
    for($m = 1; $m <= $i; $m++){
        echo "*";
    }
    echo "<br>";
}
?> -->
</body>
</html>
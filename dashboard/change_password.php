<?php
session_start();
$pass_id = $_GET['pass_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Password Change From</title>
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
        <div class="login text-center mb-5">
          <a href="index.php" class="btn btn-primary">Register</a>
        </div>
        <div class="card">
            <div class="card-header text-center bg-info text-white">Change Password
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
                <form action="update_password.php" method="POST">
                  <input type="hidden" name="pass_id" value="<?php echo $pass_id;?>">
                    <div class="form-group">
                    <label for="pwd">Old Password:</label>
                    <input type="password" class="form-control border_red" id="pwd" placeholder="Enter Old Password" name="old_password">
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
                    <div class="form-group">
                    <label for="newpwd">New Password:</label>
                    <input type="password" class="form-control border_red" id="newpwd" placeholder="Enter New password" name="new_password">
                    <p>
                    <span class="text-color">
                      <?php
                      if(isset($_SESSION['pass_emp'])){
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
                        echo $_SESSION['pass_emp'];
                        unset($_SESSION['pass_emp']);
                      }
                      ?>
                    </span>
                    </p>
                    </div>
                    <div class="form-group">
                    <label for="cpwd">Confirm New Password:</label>
                    <input type="password" class="form-control border_red" id="cpwd" placeholder="Enter Confirm password" name="confirm_password">
                    <p>
                    <span class="text-color">
                      <?php
                      if(isset($_SESSION['pass_emp'])){
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
                        echo $_SESSION['pass_emp'];
                        unset($_SESSION['pass_emp']);
                      }
                      ?>
                    </span>
                    </p>
                    </div>
                    <div class="text-center">
                      <button type="submit" name="btn" class="btn btn-primary">Update Password</button>
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
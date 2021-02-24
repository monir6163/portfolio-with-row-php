<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register From</title>
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
          <a href="login.php" class="btn btn-primary">Login</a>
        </div>
        <div class="card">
            <div class="card-header text-center bg-info text-white">Register
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
                <form action="rg.php" method="POST">
                    <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control border_red" id="name" placeholder="Enter Name" name="name">
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
                    <input type="email" class="form-control border_red" id="email" placeholder="Enter email" name="email">
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
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control border_red" id="pwd" placeholder="Enter password" name="password">
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
                      <button type="submit" name="btn" class="btn btn-primary">Register</button>
                    </div>
                </form>
                </div> 
            </div>
      </div>
  </div>
</div>
</body>
</html>
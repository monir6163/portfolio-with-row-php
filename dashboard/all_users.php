<?php
include "includes/header.php";
require_once("../db.php");
$data = "SELECT * FROM `users` WHERE `status`= 1 ORDER BY user_id DESC";
$run_data = mysqli_query($conn,$data);
$deactivate_data = "SELECT * FROM `users` WHERE `status`= 2 ORDER BY user_id DESC";
$d_data = mysqli_query($conn,$deactivate_data);
$datacount = "SELECT COUNT(*) as total FROM users WHERE `status`= 1";
$rundatacount = mysqli_query($conn,$datacount);
$datacount2 = "SELECT COUNT(*) as total FROM users WHERE `status`= 2";
$d_datacount = mysqli_query($conn,$datacount2);
$de_datacount = mysqli_fetch_assoc($d_datacount);
$all_datacount = mysqli_fetch_assoc($rundatacount);
//user delete
if (isset($_GET['del'])) {
  $del = $_GET['del'];
  $del_query = "DELETE FROM `users` WHERE `user_id`= '$del'";
  mysqli_query($conn,$del_query);
  header("Location: all_users.php");
}

?>
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="dashboard.php">Dashboard</a>
        <span class="breadcrumb-item active">Users</span>
      </nav>

      <div class="sl-pagebody">
        <div class="sl-page-title">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header text-center bg-info text-white">All Active Users ( <span style = "color: red; font-size: 18px; font-weight: 900"><?php echo $all_datacount['total'];?></span> ) 
            </div>
              <div class="card-body">
                <span class="text-color">
                      <?php
                      if(isset($_SESSION['statusmsg'])){
                          ?>
                          <div class="alert alert-danger" role="alert">
                              <strong><?php echo $_SESSION['statusmsg'];?></strong>
                          </div>
                          <?php
                        unset($_SESSION['statusmsg']);
                      }
                      ?>
                    </span>
                <table id="table_id" class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">Name</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                      foreach ($run_data as $key => $value) {
                      ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $value['name'];?></td>
                      <td><?php echo $value['email'];?></td>
                      <td>
                        <?php
                          if ($value['status']==1) {
                            ?>
                            <a class="btn btn-success" href="users_status.php?statusid=<?php echo $value['user_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="users_status.php?statusid=<?php echo $value['user_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($value['status']==1) {?>
                           <a href="user-edit.php?edit_id=<?php echo $value['user_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $value['user_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
                           <a href="profile.php?pro_id=<?php echo $value['user_id'];?>" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                         <?php }
                         else{
                          echo '<button type="button" class="btn btn-outline-danger">Not Allow</button>';
                         }
                        ?>
                      </td>
                    </tr>
                    <?php }
                    ?>
                  </tbody>
                </table>
              </div> 
        </div>
      </div>
  </div>
  <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header text-center bg-info text-white">All Deactivate Users ( <span style = "color: red; font-size: 18px; font-weight: 900"><?php echo $de_datacount['total'];?></span>)
            </div>
              <div class="card-body">
                <span class="text-color">
                      <?php
                      if(isset($_SESSION['statusmsg'])){
                          ?>
                          <div class="alert alert-danger" role="alert">
                              <strong><?php echo $_SESSION['statusmsg'];?></strong>
                          </div>
                          <?php
                        unset($_SESSION['statusmsg']);
                      }
                      ?>
                    </span>
                <table id="table_id" class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">Name</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                      foreach ($d_data as $key => $value) {
                      ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $value['name'];?></td>
                      <td><?php echo $value['email'];?></td>
                      <td>
                        <?php
                          if ($value['status']==1) {
                            ?>
                            <a class="btn btn-success" href="users_status.php?statusid=<?php echo $value['user_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="users_status.php?statusid=<?php echo $value['user_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($value['status']==1) {?>
                           <a href="user-edit.php?edit_id=<?php echo $value['user_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $value['user_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
                           <a href="profile.php?pro_id=<?php echo $value['user_id'];?>" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                         <?php }
                         else{
                          echo '<button type="button" class="btn btn-outline-danger">Not Allow</button>';
                         }
                        ?>
                      </td>
                    </tr>
                    <?php }
                    ?>
                  </tbody>
                </table>
              </div> 
        </div>
      </div>
  </div>
        </div><!-- sl-page-title -->

      </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
<?php
include "includes/footer.php";
?>
<script>
      function deleteUserdata(userId){
        if (confirm('Are you want to sure delete your data')) {
          location.replace('all_users.php?del='+userId);
        }
      }
</script>
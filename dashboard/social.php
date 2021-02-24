<?php
ob_start();
include "includes/header.php";
require_once("../db.php");
include "function.php";
$select_social = "SELECT * FROM social WHERE status = 1 ";
$social_query = mysqli_query($conn, $select_social );

$deactive_social = "SELECT * FROM social WHERE status = 2";
$deactive_socials_query = mysqli_query($conn, $deactive_social);

$deactive_social2= "SELECT COUNT(*) status FROM social WHERE status = 2";
$deactive_social_query2 = mysqli_query($conn, $deactive_social2);
$deactive_assoc = mysqli_fetch_assoc($deactive_social_query2);
if (gisset('del')) {
  $del = get('del');
  $q_del = q("DELETE FROM `social` WHERE `social_id`='$del'");
  success("Social Delete successfully");
  redirect("");
  ob_end_flush();
  }
?>
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="dashboard.php">Dashboard</a>
        <span class="breadcrumb-item active">Social</span>
      </nav>
      <div class="sl-pagebody">
        <div class="sl-page-title">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header text-center bg-info text-white">All Active Social</div>
            	<a class="text-right pr-5 pt-3" href="add_social.php"><i class="fa fa-plus"></i> Add New Social Icon</a>
              <div class="card-body">
                <?php
                include "alert.php";
                ?>
                <table id="myTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">Icon</th>
                      <th class="text-center">Icon Link</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                    $select = "SELECT * FROM `social` WHERE `status`= 1";
                    $socials = mysqli_query($conn,$select);
                      foreach ($socials as $key => $social) {
                      ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $social['icon'];?></td>
                      <td><?php echo $social['link'];?></td>
                      <td>
                        <?php
                          if ($social['status']==1) {
                            ?>
                            <a class="btn btn-success" href="social_status.php?statusid=<?php echo $social['social_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="social_status.php?statusid=<?php echo $social['social_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($social['status']==1) {?>
                           <a href="social_edit.php?edit_id=<?php echo $social['social_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $social['social_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
            <div class="card-header text-center bg-info text-white">All Deactive Social</div>
              <div class="card-body">
                <table class="table table-bordered" id="myTable">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">Icon</th>
                      <th class="text-center">Icon Link</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                      foreach ($deactive_socials_query as $key => $social) {
                      ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $social['icon'];?></td>
                      <td><?php echo $social['link'];?></td>
                      <td>
                        <?php
                          if ($social['status']==1) {
                            ?>
                            <a class="btn btn-success" href="social_status.php?statusid=<?php echo $social['social_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="social_status.php?statusid=<?php echo $social['social_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($social['status']==1) {?>
                           <a href="social_edit.php?edit_id=<?php echo $social['social_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $social['social_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
</div>

      </div>
    </div>
    <!-- ########## END: MAIN PANEL ########## -->
<?php
include "includes/footer.php";
?>
<script>
      function deleteUserdata(userId){
        if (confirm('Are you want to sure delete your data')) {
          location.replace('counter.php?del='+userId);
        }
      }
</script>
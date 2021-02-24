<?php
ob_start();
include "includes/header.php";
require_once("../db.php");
include "function.php";
$select_counter = "SELECT * FROM counter WHERE status = 1 ";
$counter_query = mysqli_query($conn, $select_counter );

$deactive_counter = "SELECT * FROM counter WHERE status = 2";
$deactive_counters_query = mysqli_query($conn, $deactive_counter);

$deactive_counter2= "SELECT COUNT(*) status FROM counter WHERE status = 2";
$deactive_counter_query2 = mysqli_query($conn, $deactive_counter2);
$deactive_assoc = mysqli_fetch_assoc($deactive_counter_query2);
if (gisset('del')) {
  $del = get('del');
  $q_del = q("DELETE FROM `counter` WHERE `counter_id`='$del'");
  success("Counter Delete successfully");
  redirect("");
  ob_end_flush();
  }
?>
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="dashboard.php">Dashboard</a>
        <span class="breadcrumb-item active">Counter</span>
      </nav>
      <div class="sl-pagebody">
        <div class="sl-page-title">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header text-center bg-info text-white">All Active Counter</div>
            	<a class="text-right pr-5 pt-3" href="add_counter.php"><i class="fa fa-plus"></i> Add New Counter</a>
              <div class="card-body">
                <div class="message">
                    <?php if (isset($_SESSION['message'])):?>
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <button class="close" data-dismiss="alert">&times;</button>
                                <strong><?= $_SESSION['message']; ?></strong>
                            </div>
                        <?php 
                            unset($_SESSION['message']); 
                        endif;?>
                </div>
                <?php
                include "alert.php";
                ?>
                <table id="myTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">Title</th>
                      <th class="text-center">Number</th>
                      <th class="text-center">Icon</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                    $select = "SELECT * FROM `counter` WHERE `status`= 1";
                    $counters = mysqli_query($conn,$select);
                      foreach ($counters as $key => $counter) {
                      ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $counter['title'];?></td>
                      <td><?php echo $counter['number'];?></td>
                      <td><?php echo $counter['icon'];?></td>
                      <td>
                        <?php
                          if ($counter['status']==1) {
                            ?>
                            <a class="btn btn-success" href="counter_status.php?statusid=<?php echo $counter['counter_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="counter_status.php?statusid=<?php echo $counter['counter_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($counter['status']==1) {?>
                           <a href="counter_edit.php?edit_id=<?php echo $counter['counter_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $counter['counter_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
            <div class="card-header text-center bg-info text-white">All Deactive Counter</div>
              <div class="card-body">
                <table class="table table-bordered" id="myTable">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">Title</th>
                      <th class="text-center">Number</th>
                      <th class="text-center">Icon</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                      foreach ($deactive_counters_query as $key => $value) {
                      ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $value['title'];?></td>
                      <td><?php echo $value['number'];?></td>
                      <td><?php echo $value['icon'];?></td>
                      <td>
                        <?php
                          if ($value['status'] == 1) {
                            ?>
                            <a class="btn btn-success" href="counter_status.php?statusid=<?php echo $value['counter_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="counter_status.php?statusid=<?php echo $value['counter_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($value['status'] == 1) {?>
                           <a href="counter_edit.php.php?edit_id=<?php echo $value['counter_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $value['counter_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
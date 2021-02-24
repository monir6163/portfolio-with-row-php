<?php
ob_start();
include "includes/header.php";
require_once("../db.php");
include "function.php";
$select_fiverr = "SELECT * FROM fiverr WHERE status = 1 ";
$fiverr_query = mysqli_query($conn, $select_fiverr );

$deactive_fiverr = "SELECT * FROM fiverr WHERE status = 2";
$deactive_fiverr_query = mysqli_query($conn, $deactive_fiverr);

$deactive_fiverr2= "SELECT COUNT(*) status FROM fiverr WHERE status = 2";
$deactive_fiverr_query2 = mysqli_query($conn, $deactive_fiverr2);
$deactive_assoc = mysqli_fetch_assoc($deactive_fiverr_query2);
if (gisset('del')) {
  $del = get('del');
  $q_del = q("DELETE FROM `fiverr` WHERE `fiverr_id`='$del'");
  success("Fiverr Link Delete successfully");
  redirect("");
  ob_end_flush();
  }
?>
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="dashboard.php">Dashboard</a>
        <span class="breadcrumb-item active">Fiverr</span>
      </nav>
      <div class="sl-pagebody">
        <div class="sl-page-title">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header text-center bg-info text-white">All Active Fiverr Link</div>
            	<a class="text-right pr-5 pt-3" href="add_fiverr.php"><i class="fa fa-plus"></i> Add New Fiverr Link</a>
              <div class="card-body">
                <?php
                include "alert.php";
                ?>
                <table id="myTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">Fiverr Link</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                    $select = "SELECT * FROM `fiverr` WHERE `status`= 1";
                    $fiverrs = mysqli_query($conn,$select);
                      foreach ($fiverrs as $key => $fiverr) {
                      ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $fiverr['fiverrlink'];?></td>
                      <td>
                        <?php
                          if ($fiverr['status']==1) {
                            ?>
                            <a class="btn btn-success" href="fiverr_status.php?statusid=<?php echo $fiverr['fiverr_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="fiverr_status.php?statusid=<?php echo $fiverr['fiverr_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($fiverr['status']==1) {?>
                           <a href="fiverr_edit.php?edit_id=<?php echo $fiverr['fiverr_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $fiverr['fiverr_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
            <div class="card-header text-center bg-info text-white">All Deactive Fiverr Link</div>
              <div class="card-body">
                <table class="table table-bordered" id="myTable">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">Fiverr Link</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                      foreach ($deactive_fiverr_query as $key => $fiverr) {
                      ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $fiverr['fiverrlink'];?></td>
                      <td>
                        <?php
                          if ($fiverr['status']==1) {
                            ?>
                            <a class="btn btn-success" href="fiverr_status.php?statusid=<?php echo $fiverr['fiverr_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="fiverr_status.php?statusid=<?php echo $fiverr['fiverr_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($fiverr['status']==1) {?>
                           <a href="fiverr_edit.php?edit_id=<?php echo $fiverr['fiverr_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $fiverr['fiverr_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
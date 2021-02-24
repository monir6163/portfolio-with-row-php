<?php
ob_start();
include "includes/header.php";
require_once("../db.php");
require "function.php";
$select_services = "SELECT * FROM services WHERE services_status = 1 ";
$services_query = mysqli_query($conn, $select_services );

$deactive_services = "SELECT * FROM services WHERE services_status = 2";
$deactive_services_querry = mysqli_query($conn, $deactive_services);

$deactive_services2= "SELECT COUNT(*) services_status FROM services WHERE services_status = 2";
$deactive_services_querry2 = mysqli_query($conn, $deactive_services2);
$deactive_assoc = mysqli_fetch_assoc($deactive_services_querry2);
//user delete
if (isset($_GET['del'])) {
  $del = $_GET['del'];
  $del_query = "DELETE FROM `services` WHERE `services_id`= '$del'";
  mysqli_query($conn,$del_query);
  success("Service Delete successfully");
  ob_end_flush();
}

?>
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="dashboard.php">Dashboard</a>
        <span class="breadcrumb-item active">Services</span>
      </nav>

      <div class="sl-pagebody">
        <div class="sl-page-title">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header text-center bg-info text-white">All Active Services</div>
            	<a class="text-right pr-5 pt-3" href="add_service.php"><i class="fa fa-plus"></i> Add New Service</a>
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
                <table class="table table-bordered" id="myTable">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">Title</th>
                      <th class="text-center">Summery</th>
                      <th class="text-center">Icon</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                    $service = "SELECT * FROM `services` WHERE `services_status`= 1";
                    $services = mysqli_query($conn,$service);
                      foreach ($services as $key => $service) {
                      ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $service['services_title'];?></td>
                      <td><?php echo $service['services_summery'];?></td>
                      <td><?php echo $service['services_icon'];?></td>
                      <td>
                        <?php
                          if ($service['services_status'] == 1) {
                            ?>
                            <a class="btn btn-success" href="services_status.php?statusid=<?php echo $service['services_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="services_status.php?statusid=<?php echo $service['services_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($service['services_status'] == 1) {?>
                           <a href="service_edit.php?edit_id=<?php echo $service['services_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $service['services_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
            <div class="card-header text-center bg-info text-white">All Deactive Services</div>
              <div class="card-body">
                <table class="table table-bordered" id="myTable">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">Title</th>
                      <th class="text-center">Summery</th>
                      <th class="text-center">Icon</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                      foreach ($deactive_services_querry as $key => $value) {
                      ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $value['services_title'];?></td>
                      <td><?php echo $value['services_summery'];?></td>
                      <td><?php echo $value['services_icon'];?></td>
                      <td>
                        <?php
                          if ($value['services_status'] == 1) {
                            ?>
                            <a class="btn btn-success" href="services_status.php?statusid=<?php echo $value['services_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="services_status.php?statusid=<?php echo $value['services_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($value['services_status'] == 1) {?>
                           <a href="service_edit.php?edit_id=<?php echo $value['services_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $value['services_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
          location.replace('services.php?del='+userId);
        }
      }
</script>
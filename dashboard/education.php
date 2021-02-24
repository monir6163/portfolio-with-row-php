<?php
ob_start();
include "includes/header.php";
require_once("../db.php");
include "function.php";
$select_education = "SELECT * FROM education WHERE status = 1 ";
$education_query = mysqli_query($conn, $select_education );

$deactive_education = "SELECT * FROM education WHERE status = 2";
$deactive_education_query = mysqli_query($conn, $deactive_education);

$deactive_education2= "SELECT COUNT(*) status FROM education WHERE status = 2";
$deactive_education_query2 = mysqli_query($conn, $deactive_education2);
$deactive_assoc = mysqli_fetch_assoc($deactive_education_query2);
if (gisset('del')) {
  $del = get('del');
  $q_del = q("DELETE FROM `education` WHERE `education_id`='$del'");
  success("Education Delete successfully");
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
            <div class="card-header text-center bg-info text-white">All Active Education</div>
              <a class="text-right pr-5 pt-3" href="add_education.php"><i class="fa fa-plus"></i> Add New Education</a>
              <div class="card-body">
                
                <?php
                include "alert.php";
                ?>
                <table id="myTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">Year</th>
                      <th class="text-center">Number</th>
                      <th class="text-center">Title</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                    $select = "SELECT * FROM `education` WHERE `status`= 1";
                    $educations = mysqli_query($conn,$select);
                      foreach ($educations as $key => $education) {
                      ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $education['year'];?></td>
                      <td><?php echo $education['number'];?></td>
                      <td><?php echo $education['title'];?></td>
                      <td>
                        <?php
                          if ($education['status']==1) {
                            ?>
                            <a class="btn btn-success" href="education_status.php?statusid=<?php echo $education['education_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="education_status.php?statusid=<?php echo $education['education_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($education['status']==1) {?>
                           <a href="education_edit.php?edit_id=<?php echo $education['education_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $education['education_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
            <div class="card-header text-center bg-info text-white">All Deactive Education</div>
              <div class="card-body">
                <table class="table table-bordered" id="myTable">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">Year</th>
                      <th class="text-center">Number</th>
                      <th class="text-center">Title</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                      foreach ($deactive_education_query as $key => $value) {
                      ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $value['year'];?></td>
                      <td><?php echo $value['number'];?></td>
                      <td><?php echo $value['title'];?></td>
                      <td>
                        <?php
                          if ($value['status'] == 1) {
                            ?>
                            <a class="btn btn-success" href="education_status.php?statusid=<?php echo $value['education_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="education_status.php?statusid=<?php echo $value['education_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($value['status'] == 1) {?>
                           <a href="education_edit.php.php?edit_id=<?php echo $value['education_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $value['education_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
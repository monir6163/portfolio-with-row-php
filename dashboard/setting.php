<?php
ob_start();
include "includes/header.php";
require_once("../db.php");
include "function.php";
$setting_social = "SELECT * FROM setting WHERE status = 1 ";
$setting_query = mysqli_query($conn, $setting_social );

$deactive_setting = "SELECT * FROM setting WHERE status = 2";
$deactive_setting_query = mysqli_query($conn, $deactive_setting);

$deactive_setting2= "SELECT COUNT(*) status FROM setting WHERE status = 2";
$deactive_setting_query2 = mysqli_query($conn, $deactive_setting2);
$deactive_assoc = mysqli_fetch_assoc($deactive_setting_query2);
if (gisset('del')) {
  $del = get('del');
  $select = q("SELECT * FROM `setting` WHERE `setting_id`='$del'");
  $assoc = mysqli_fetch_assoc($select);
  $logoSource = "../assets/images/logo/". $assoc['headerLogo'];
  $favIcon = "../assets/images/logo/". $assoc['favIcon'];
  if(file_exists($logoSource)){
    unlink($logoSource);
    unlink($favIcon);
  $q_del = q("DELETE FROM `setting` WHERE `setting_id`='$del'");
  success("Setting Delete successfully");
  }
}
?>
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="dashboard.php">Dashboard</a>
        <span class="breadcrumb-item active">Setting</span>
      </nav>
      <div class="sl-pagebody">
        <div class="sl-page-title">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header text-center bg-info text-white">All Active Setting</div>
            	<a class="text-right pr-5 pt-3" href="add-setting.php"><i class="fa fa-plus"></i> Add New Setting Content</a>
              <div class="card-body">
                <?php
                include "alert.php";
                ?>
                <table id="myTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">WebTitle</th>
                      <th class="text-center">FooterText</th>
                      <th class="text-center">FavIcon</th>
                      <th class="text-center">Logo</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                    $select = "SELECT * FROM `setting` WHERE `status`= 1";
                    $settings = mysqli_query($conn,$select);
                      foreach ($settings as $key => $setting) {
                      ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $setting['websiteTitle'];?></td>
                      <td><?php echo $setting['footerText'];?></td>
                      <td>
                        <img width="50px" height="50px" src="../assets/images/logo/<?php echo $setting['favIcon'];?>" alt="img">
                      </td>
                      <td>
                        <img width="50px" height="50px" src="../assets/images/logo/<?php echo $setting['headerLogo'];?>" alt="img">
                      </td>
                      <td>
                        <?php
                          if ($setting['status']==1) {
                            ?>
                            <a class="btn btn-success" href="setting_status.php?statusid=<?php echo $setting['setting_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="setting_status.php?statusid=<?php echo $setting['setting_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($setting['status']==1) {?>
                           <a href="setting_edit.php?edit_id=<?php echo $setting['setting_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $setting['setting_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
            <div class="card-header text-center bg-info text-white">All Deactive Setting</div>
              <div class="card-body">
                <table id="myTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">WebTitle</th>
                      <th class="text-center">FooterText</th>
                      <th class="text-center">FavIcon</th>
                      <th class="text-center">Logo</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                      foreach ($deactive_setting_query as $key => $setting) {
                      ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $setting['websiteTitle'];?></td>
                      <td><?php echo $setting['footerText'];?></td>
                      <td>
                        <img width="50px" height="50px" src="../assets/images/logo/<?php echo $setting['favIcon'];?>" alt="img">
                      </td>
                      <td>
                        <img width="50px" height="50px" src="../assets/images/logo/<?php echo $setting['headerLogo'];?>" alt="img">
                      </td>
                      <td>
                        <?php
                          if ($setting['status']==1) {
                            ?>
                            <a class="btn btn-success" href="setting_status.php?statusid=<?php echo $setting['setting_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="setting_status.php?statusid=<?php echo $setting['setting_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($setting['status']==1) {?>
                           <a href="setting_edit.php?edit_id=<?php echo $setting['setting_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $setting['setting_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
          location.replace('setting.php?del='+userId);
        }
      }
</script>
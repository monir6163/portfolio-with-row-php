<?php
include "includes/header.php";
require_once("../db.php");
include "function.php";
$selectbanner = " SELECT * FROM banner WHERE status = 1 ";
$bannerQuery = mysqli_query($conn, $selectbanner);

$deactivebanner = "SELECT * FROM banner WHERE status = 2";
$deactivebannerQuerry = mysqli_query($conn, $deactivebanner);
$deactiveAssoc = mysqli_fetch_assoc($deactivebannerQuerry);
if (gisset('del')) {
  $del = get('del');
  $select = q("SELECT * FROM `banner` WHERE `banner_id`='$del'");
  $assoc = mysqli_fetch_assoc($select);
  $img_location = "../assets/images/banner/". $assoc['img'];
  if (file_exists($img_location)) {
    unlink($img_location);
  $q_del = q("DELETE FROM `banner` WHERE `banner_id`='$del'");
  success("Banner Delete successfully");
  header("Location:banner.php");
  }
}
?>
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="dashboard.php">Dashboard</a>
        <span class="breadcrumb-item active">Banner</span>
      </nav>
      <div class="sl-pagebody">
        <div class="sl-page-title">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header text-center bg-info text-white">All Active Banner</div>
            	<a class="text-right pr-5 pt-3" href="add_banner.php"><i class="fa fa-plus"></i> Add New Banner</a>
              <div class="card-body">
                <?php
                include "alert.php";
                ?>
                <table id="myTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">Sub Title</th>
                      <th class="text-center">Title</th>
                      <th class="text-center">Summery</th>
                      <th class="text-center">Image</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                    $select = "SELECT * FROM `banner` WHERE `status`= 1 ORDER BY banner_id DESC";
                    $banners = mysqli_query($conn,$select);
                      foreach ($banners as $key => $banner) {
                      ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $banner['sub_title'];?></td>
                      <td><?php echo $banner['title'];?></td>
                      <td><?php echo $banner['summery'];?></td>
                      <td>
                        <img width="50px" height="50px" src="../assets/images/banner/<?php echo $banner['img'];?>" alt="img">
                      </td>
                      <td>
                        <?php
                          if ($banner['status']==1) {
                            ?>
                            <a class="btn btn-success" href="banner_status.php?statusid=<?php echo $banner['banner_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="banner_status.php?statusid=<?php echo $banner['banner_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($banner['status']==1) {?>
                           <a href="banner_edit.php?edit_id=<?php echo $banner['banner_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $banner['banner_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
            <div class="card-header text-center bg-info text-white">All Deactive Banner</div>
              <div class="card-body">
                <table id="myTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">Sub Title</th>
                      <th class="text-center">Title</th>
                      <th class="text-center">Summery</th>
                      <th class="text-center">Image</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php foreach ($deactivebannerQuerry as $key => $banner) { ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $banner['sub_title'];?></td>
                      <td><?php echo $banner['title'];?></td>
                      <td><?php echo $banner['summery'];?></td>
                      <td>
                        <img width="50px" height="50px" src="../assets/images/banner/<?php echo $banner['img'];?>" alt="img">
                      </td>
                      <td>
                        <?php
                          if ($banner['status']==1) {
                            ?>
                            <a class="btn btn-success" href="banner_status.php?statusid=<?php echo $banner['banner_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="banner_status.php?statusid=<?php echo $banner['banner_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($banner['status']==1) {?>
                           <a href="banner_edit.php?edit_id=<?php echo $banner['banner_idbanner_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $banner['banner_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
          location.replace('banner.php?del='+userId);
        }
      }
</script>
<?php
include "includes/header.php";
require_once("../db.php");
include "function.php";
$selectbrand = " SELECT * FROM brand WHERE status = 1 ";
$brandQuery = mysqli_query($conn, $selectbrand);

$deactivebrand = "SELECT * FROM brand WHERE status = 2";
$deactivebrandQuerry = mysqli_query($conn, $deactivebrand);
$deactiveAssoc = mysqli_fetch_assoc($deactivebrandQuerry);
if (gisset('del')) {
  $del = get('del');
  $select = q("SELECT * FROM `brand` WHERE `brand_id`='$del'");
  $assoc = mysqli_fetch_assoc($select);
  $img_location = "../assets/images/brand/". $assoc['brand_img'];
  if (file_exists($img_location)) {
    unlink($img_location);
  $q_del = q("DELETE FROM `brand` WHERE `brand_id`='$del'");
  success("Portfolios Delete successfully");
  }
}
?>
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="dashboard.php">Dashboard</a>
        <span class="breadcrumb-item active">Brand</span>
      </nav>
      <div class="sl-pagebody">
        <div class="sl-page-title">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header text-center bg-info text-white">All Active Brand</div>
              <a class="text-right pr-5 pt-3" href="add_brand.php"><i class="fa fa-plus"></i> Add New Brand</a>
              <div class="card-body">
                <?php
                include "alert.php";
                ?>
                <div class="message">
                            <?php if (isset($_SESSION['message'])) : ?>
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button class="close" data-dismiss="alert">&times;</button>
                                    <strong><?= $_SESSION['message']; ?></strong>
                                </div>
                            <?php
                                unset($_SESSION['message']);
                            endif; ?>
                </div>
                <table id="myTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">Brand Image</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                    $select = "SELECT * FROM `brand` WHERE `status`= 1";
                    $Brands = mysqli_query($conn,$select);
                      foreach ($Brands as $key => $brand) {
                      ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td>
                        <img width="50px" height="50px" src="../assets/images/brand/<?php echo $brand['brand_img'];?>" alt="img">
                      </td>
                      <td>
                        <?php
                          if ($brand['status']==1) {
                            ?>
                            <a class="btn btn-success" href="brand_status.php?statusid=<?php echo $brand['brand_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="brand_status.php?statusid=<?php echo $brand['brand_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($brand['status']==1) {?>
                           <a href="brand_edit.php?edit_id=<?php echo $brand['brand_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $brand['brand_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
            <div class="card-header text-center bg-info text-white">All Deactive Brand</div>
              <div class="card-body">
                <table id="myTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">Brand Image</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php foreach ($deactivebrandQuerry as $key => $brand) { ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td>
                        <img width="50px" height="50px" src="../assets/images/brand/<?php echo $brand['brand_img'];?>" alt="img">
                      </td>
                      <td>
                        <?php
                          if ($brand['status']==1) {
                            ?>
                            <a class="btn btn-success" href="brand_status.php?statusid=<?php echo $brand['brand_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="brand_status.php?statusid=<?php echo $brand['brand_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($brand['status']==1) {?>
                           <a href="brand_edit.php?edit_id=<?php echo $brand['brand_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $brand['brand_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
          location.replace('brand.php?del='+userId);
        }
      }
</script>
<?php
include "includes/header.php";
require_once("../db.php");
include "function.php";
$selectabout = " SELECT * FROM about WHERE status = 1 ";
$aboutQuery = mysqli_query($conn, $selectabout);

$deactiveabout = "SELECT * FROM about WHERE status = 2";
$deactiveaboutQuerry = mysqli_query($conn, $deactiveabout);
$deactiveAssoc = mysqli_fetch_assoc($deactiveaboutQuerry);
if (gisset('del')) {
  $del = get('del');
  $select = q("SELECT * FROM `about` WHERE `about_id`='$del'");
  $assoc = mysqli_fetch_assoc($select);
  $img_location = "../assets/images/about/". $assoc['about_img'];
  if (file_exists($img_location)) {
    unlink($img_location);
  $q_del = q("DELETE FROM `about` WHERE `about_id`='$del'");
  success("About Delete successfully");
  }
}
?>
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="dashboard.php">Dashboard</a>
        <span class="breadcrumb-item active">About</span>
      </nav>
      <div class="sl-pagebody">
        <div class="sl-page-title">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header text-center bg-info text-white">All Active About</div>
            	<a class="text-right pr-5 pt-3" href="add_about.php"><i class="fa fa-plus"></i> Add New About</a>
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
                      <th class="text-center">Summery</th>
                      <th class="text-center">Thumbnail</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                    $select = "SELECT * FROM `about` WHERE `status`= 1 ORDER BY about_id DESC";
                    $abouts = mysqli_query($conn,$select);
                      foreach ($abouts as $key => $about) {
                      ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $about['about'];?></td>
                      <td>
                        <img width="50px" height="50px" src="../assets/images/about/<?php echo $about['about_img'];?>" alt="img">
                      </td>
                      <td>
                        <?php
                          if ($about['status']==1) {
                            ?>
                            <a class="btn btn-success" href="about_status.php?statusid=<?php echo $about['about_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="about_status.php?statusid=<?php echo $about['about_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($about['status']==1) {?>
                           <a href="about_edit.php?edit_id=<?php echo $about['about_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $about['about_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
            <div class="card-header text-center bg-info text-white">All Deactive About</div>
              <div class="card-body">
                <table id="myTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">Summery</th>
                      <th class="text-center">Thumbnail</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php foreach ($deactiveaboutQuerry as $key => $about) { ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $about['about'];?></td>
                      <td>
                        <img width="50px" height="50px" src="../assets/images/about/<?php echo $about['about_img'];?>" alt="img">
                      </td>
                      <td>
                        <?php
                          if ($about['status']==1) {
                            ?>
                            <a class="btn btn-success" href="about_status.php?statusid=<?php echo $about['about_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="about_status.php?statusid=<?php echo $about['about_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($about['status']==1) {?>
                           <a href="about_edit.php?edit_id=<?php echo $about['about_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $about['about_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
          location.replace('about_me.php?del='+userId);
        }
      }
</script>
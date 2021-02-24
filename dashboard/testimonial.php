<?php
include "includes/header.php";
require_once("../db.php");
include "function.php";
$selecttestimonial = " SELECT * FROM testimonials WHERE status = 1 ";
$testimonialQuery = mysqli_query($conn, $selecttestimonial);

$deactivetestimonial = "SELECT * FROM testimonials WHERE status = 2";
$deactivetestimonialQuerry = mysqli_query($conn, $deactivetestimonial);
$deactiveAssoc = mysqli_fetch_assoc($deactivetestimonialQuerry);
if (gisset('del')) {
  $del = get('del');
  $select = q("SELECT * FROM `testimonials` WHERE `testimonial_id`='$del'");
  $assoc = mysqli_fetch_assoc($select);
  $img_location = "../assets/images/testimonial/". $assoc['img'];
  if (file_exists($img_location)) {
    unlink($img_location);
  $q_del = q("DELETE FROM `testimonials` WHERE `testimonial_id`='$del'");
  success("Testimonial Delete successfully");
  header("Location:testimonial.php");
  }
}
?>
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="dashboard.php">Dashboard</a>
        <span class="breadcrumb-item active">Testimonial</span>
      </nav>
      <div class="sl-pagebody">
        <div class="sl-page-title">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header text-center bg-info text-white">All Active Testimonial</div>
            	<a class="text-right pr-5 pt-3" href="add_testimonial.php"><i class="fa fa-plus"></i> Add New Testimonial</a>
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
                      <th class="text-center">Title</th>
                      <th class="text-center">Sub Title</th>
                      <th class="text-center">Image</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                    $select = "SELECT * FROM `testimonials` WHERE `status`= 1 ORDER BY testimonial_id DESC";
                    $testimonials = mysqli_query($conn,$select);
                      foreach ($testimonials as $key => $testimonial) {
                      ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $testimonial['summery'];?></td>
                      <td><?php echo $testimonial['title'];?></td>
                      <td><?php echo $testimonial['sub_title'];?></td>
                      <td>
                        <img width="50px" height="50px" src="../assets/images/testimonial/<?php echo $testimonial['img'];?>" alt="img">
                      </td>
                      <td>
                        <?php
                          if ($testimonial['status']==1) {
                            ?>
                            <a class="btn btn-success" href="testimonial_status.php?statusid=<?php echo $testimonial['testimonial_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="testimonial_status.php?statusid=<?php echo $testimonial['testimonial_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($testimonial['status']==1) {?>
                           <a href="testimonial_edit.php?edit_id=<?php echo $testimonial['testimonial_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $testimonial['testimonial_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
            <div class="card-header text-center bg-info text-white">All Deactive Testimonial</div>
              <div class="card-body">
                <table id="myTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">Summery</th>
                      <th class="text-center">Title</th>
                      <th class="text-center">Sub Title</th>
                      <th class="text-center">Image</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php foreach ($deactivetestimonialQuerry as $key => $testimonial) { ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $testimonial['summery'];?></td>
                      <td><?php echo $testimonial['title'];?></td>
                      <td><?php echo $testimonial['sub_title'];?></td>
                      <td>
                        <img width="50px" height="50px" src="../assets/images/testimonial/<?php echo $testimonial['img'];?>" alt="img">
                      </td>
                      <td>
                        <?php
                          if ($testimonial['status']==1) {
                            ?>
                            <a class="btn btn-success" href="testimonial_status.php?statusid=<?php echo $testimonial['testimonial_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="testimonial_status.php?statusid=<?php echo $testimonial['testimonial_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($testimonial['status']==1) {?>
                           <a href="testimonial_edit.php?edit_id=<?php echo $testimonial['testimonial_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $testimonial['testimonial_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
          location.replace('testimonial.php?del='+userId);
        }
      }
</script>
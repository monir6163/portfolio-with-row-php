<?php
include "includes/header.php";
require_once("../db.php");
include "function.php";
$selectPortfolios = " SELECT * FROM portfolios WHERE status = 1 ";
$portfoliosQuery = mysqli_query($conn, $selectPortfolios);

$deactivePortfolios = "SELECT * FROM portfolios WHERE status = 2";
$deactivePortfoliosQuerry = mysqli_query($conn, $deactivePortfolios);
$deactiveAssoc = mysqli_fetch_assoc($deactivePortfoliosQuerry);
if (gisset('del')) {
  $del = get('del');
  $select = q("SELECT * FROM `portfolios` WHERE `portfolio_id`='$del'");
  $assoc = mysqli_fetch_assoc($select);
  $img_location = "../assets/images/portfolios/". $assoc['thumbnail'];
  $featured_image = "../assets/images/portfolios/". $assoc['featured_image'];
  if(file_exists($img_location)){
    unlink($img_location);
    unlink($featured_image);
  $q_del = q("DELETE FROM `portfolios` WHERE `portfolio_id`='$del'");
  success("Portfolios Delete successfully");
  }
}
?>
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="dashboard.php">Dashboard</a>
        <span class="breadcrumb-item active">Portfolios</span>
      </nav>
      <div class="sl-pagebody">
        <div class="sl-page-title">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header text-center bg-info text-white">All Active Portfolios</div>
            	<a class="text-right pr-5 pt-3" href="add_porfolio.php"><i class="fa fa-plus"></i> Add New Portfolios</a>
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
                      <th class="text-center">Title</th>
                      <th class="text-center">Category</th>
                      <th class="text-center">Summery</th>
                      <th class="text-center">Thumbnail</th>
                      <th class="text-center">Featured Image</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                    $select = "SELECT * FROM `portfolios` WHERE `status`= 1 ORDER BY portfolio_id DESC";
                    $portfolios = mysqli_query($conn,$select);
                      foreach ($portfolios as $key => $portfolio) {
                      ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $portfolio['title'];?></td>
                      <td><?php echo $portfolio['category'];?></td>
                      <td><?php echo $portfolio['summery'];?></td>
                      <td>
                        <img width="50px" height="50px" src="../assets/images/portfolios/<?php echo $portfolio['thumbnail'];?>" alt="img">
                      </td>
                      <td>
                        <?php
                        if ($portfolio['featured_image'] == NULL) {
                          echo '<span class = "red">N/A</span>';
                        }else{
                          ?>
                          <img width="50px" height="50px" src="../assets/images/featured-image/<?php echo $portfolio['featured_image'];?>" alt="img">
                          <?php
                        }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($portfolio['status']==1) {
                            ?>
                            <a class="btn btn-success" href="portfolio_status.php?statusid=<?php echo $portfolio['portfolio_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="portfolio_status.php?statusid=<?php echo $portfolio['portfolio_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($portfolio['status']==1) {?>
                           <a href="portfolio_edit.php?edit_id=<?php echo $portfolio['portfolio_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $portfolio['portfolio_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
            <div class="card-header text-center bg-info text-white">All Deactive Portfolios</div>
              <div class="card-body">
                <table id="myTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">Title</th>
                      <th class="text-center">Category</th>
                      <th class="text-center">Summery</th>
                      <th class="text-center">Thumbnail</th>
                      <th class="text-center">Featured Image</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php foreach ($deactivePortfoliosQuerry as $key => $portfolio) { ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $portfolio['title'];?></td>
                      <td><?php echo $portfolio['category'];?></td>
                      <td><?php echo $portfolio['summery'];?></td>
                      <td>
                        <img width="50px" height="50px" src="../assets/images/portfolios/<?php echo $portfolio['thumbnail'];?>" alt="img">
                      </td>
                      <td>
                        <?php
                        if ($portfolio['featured_image'] == NULL) {
                          echo '<span class = "red">N/A</span>';
                        }else{
                          ?>
                          <img width="50px" height="50px" src="../assets/images/featured-image/<?php echo $portfolio['featured_image'];?>" alt="img">
                          <?php
                        }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($portfolio['status']==1) {
                            ?>
                            <a class="btn btn-success" href="portfolio_status.php?statusid=<?php echo $portfolio['portfolio_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="portfolio_status.php?statusid=<?php echo $portfolio['portfolio_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($portfolio['status']==1) {?>
                           <a href="portfolio_edit.php?edit_id=<?php echo $portfolio['portfolio_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $portfolio['portfolio_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
          location.replace('portfolios.php?del='+userId);
        }
      }
</script>
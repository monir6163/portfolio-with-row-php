<?php
ob_start();
include "includes/header.php";
require_once("../db.php");
require "function.php";
//user delete
if (isset($_GET['del'])) {
  $del = $_GET['del'];
  $del_query = "DELETE FROM `contact` WHERE `contact_id`= '$del'";
  mysqli_query($conn,$del_query);
  success("Contact-Info Delete successfully");
  redirect("contact-info.php");
  ob_end_flush();
}

?>
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="dashboard.php">Dashboard</a>
        <span class="breadcrumb-item active">Contact</span>
      </nav>

      <div class="sl-pagebody">
        <div class="sl-page-title">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header text-center bg-info text-white">All Active Contact</div>
            	<a class="text-right pr-5 pt-3" href="add_contact.php"><i class="fa fa-plus"></i> Add New Contact</a>
              <div class="card-body">
                <?php
                include "alert.php";
                ?>
                <table class="table table-bordered" id="myTable">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">Summery</th>
                      <th class="text-center">Office Name</th>
                      <th class="text-center">Address</th>
                      <th class="text-center">Phone</th>
                      <th class="text-center">E-mail</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                    $contact = "SELECT * FROM `contact` WHERE `status`= 1";
                    $contacts = mysqli_query($conn,$contact);
                      foreach ($contacts as $key => $contact) {
                      ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $contact['summery'];?></td>
                      <td><?php echo $contact['off_title'];?></td>
                      <td><?php echo $contact['address'];?></td>
                      <td><?php echo $contact['phone'];?></td>
                      <td><?php echo $contact['email'];?></td>
                      <td>
                        <?php
                          if ($contact['status'] == 1) {
                            ?>
                            <a class="btn btn-success" href="contact_status.php?statusid=<?php echo $contact['contact_id'];?>">Activated</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="contact_status.php?statusid=<?php echo $contact['contact_id'];?>">Deactivated</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          if ($contact['status'] == 1) {?>
                           <a href="contact_edit.php?edit_id=<?php echo $contact['contact_id'];?>" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                           <a onclick="deleteUserdata(<?php echo $contact['contact_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
          location.replace('contact-info.php?del='+userId);
        }
      }
</script>
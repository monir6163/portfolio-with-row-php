<?php
ob_start();
include "includes/header.php";
require_once("../db.php");
require "function.php";
if (gisset('del')) {
  $del = get('del');
  $q_del = q("DELETE FROM `message` WHERE `message_id`='$del'");
  success("Message Delete successfully");
  redirect("");
  ob_end_flush();
  }
?>
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="dashboard.php">Dashboard</a>
        <span class="breadcrumb-item active">Message</span>
      </nav>

      <div class="sl-pagebody">
        <div class="sl-page-title">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header text-center bg-info text-white">All Message</div>
              <div class="card-body">
                <?php
                include "alert.php";
                ?>
                <table class="table table-bordered" id="myTable">
                  <thead>
                    <tr>
                      <th class="text-center">Sr.No</th>
                      <th class="text-center">Name</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Message</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                    $select_message = "SELECT * FROM message ORDER BY message_id DESC";
                    $message_query = mysqli_query($conn, $select_message );
                      foreach ($message_query as $key => $message) {
                      ?>
                    <tr>
                      <td><?php echo ++$key;?></td>
                      <td><?php echo $message['name'];?></td>
                      <td><?php echo $message['email'];?></td>
                      <td><?php echo $message['message'];?></td>
                      <td>
                        <?php
                          if ($message['read_status'] == 1) {
                            ?>
                            <a class="btn btn-outline-success" href="message-status.php?statusid=<?php echo $message['message_id'];?>">Unread</a>
                          <?php
                          }else{
                            ?>
                            <a class="btn btn-danger" href="message-status.php?statusid=<?php echo $message['message_id'];?>">Read</a>
                          <?php
                          }
                        ?>
                      </td>
                      <td>
                           <a onclick="deleteUserdata(<?php echo $message['message_id'];?>)" class= "btn btn-danger"><i class='fa fa-trash-o'></i></a>
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
          location.replace('message.php?del='+userId);
        }
      }
</script>
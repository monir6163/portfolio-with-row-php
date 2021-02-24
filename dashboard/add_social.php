<?php 
  //ob_start();
	ob_start();
	include "includes/header.php";
	require_once("../db.php");
	include "function.php";

  function socailIcon($options){
    foreach($options as $key => $option){
      printf("<option value='%s'>%s</option>", $option, $key);
    }
  }

  $icon = [
    'Facebook' => 'fab fa-facebook-f',
    'Twitter' => 'fab fa-twitter',
    'Instagram' => 'fab fa-instagram',
    'Pinterest' => 'fab fa-pinterest',
    'Linkedin' => 'fab fa-linkedin-in',
    'Youtube' => 'fab fa-youtube'
  ];

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $socialIcon = $_POST['socialIcon'];
    $sociallink = $_POST['sociallink'];
    if (empty($socialIcon) || empty($sociallink)) {
    	warning("Please Input All Filed");
    	redirect("");
    }else{
    	$insert = q("INSERT INTO `social`(`icon`, `link`) VALUES ('$socialIcon','$sociallink')");
    	success("Social Add Successfully");
    	redirect("");
    }
  }
?>

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="socialmedia.php">Social Media</a>
        <span class="breadcrumb-item active">Add Social Icon</span>
      </nav>
        <div class="service_form p-5">
            <?php
                include "alert.php";
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="card pd-2 pd-sm-40 form-layout form-layout-4">
                        <h6 class="card-body-title text-center">Add New Social Icon</h6>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Social Media Icon: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <select class="form-control" name="socialIcon">
                                <option value=""disabled selected>Service Icon</option>
                                <?php socailIcon($icon); ?>
                            </select>
                            </div>
                        </div>

                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Social Media Link: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control" name="sociallink" placeholder="ex:https://www.facebook.com/monir.wdd">
                            </div>
                        </div>

                        <div class="form-layout-footer mg-t-30 text-center">
                            <button style="cursor:pointer" class="btn btn-info mg-r-5 rounded">Save Social Icon</button>
                        </div>
                    </div>
            </form>
                <!-- form-layout-footer -->
        </div>

</div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->


<?php include 'includes/footer.php' ?>
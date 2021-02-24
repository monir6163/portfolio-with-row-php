<?php 
	ob_start();
	include "includes/header.php";
	require_once("../db.php");
	include "function.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $websiteTitle = mysqli_real_escape_string($conn, $_POST['websiteTitle']);
  $footerText = mysqli_real_escape_string($conn, $_POST['footerText']);
  // Website Title Validation.
  if(empty($websiteTitle)){
    $_SESSION['websiteTitle_error'] = "Please Write your Website title.";
    header('location: setting-add.php');
  }else{
    $validTitle = $websiteTitle;
  }
  // Website Title Validation.
  if(empty($footerText)){
    $_SESSION['footerText_error'] = "Please Write your Website title.";
    header('location: setting-add.php');
  }else{
    $validText = $footerText;
  }

  // Media File Validation Start Here.
  $favIcon = $_FILES['favIcon'];
  $extention= end(explode('.', $favIcon['name']));
  $allowType = array( 'jpeg', 'jpg', 'png', 'webp', 'JPEG', 'JPG', 'PNG');

  if(in_array($extention, $allowType)){

    if($favIcon['size'] <= 200000 ){
      $newFileName = rand().".".$extention;
      $newLocation = "../assets/images/logo/".$newFileName;
      move_uploaded_file($favIcon['tmp_name'], $newLocation);

      $headerLogo = $_FILES['headerLogo'];
      $logoExten = end(explode('.',$headerLogo['name']));
      $allowType = array( 'jpeg', 'jpg', 'png', 'webp', 'JPEG', 'JPG', 'PNG');
      if(in_array($logoExten, $allowType)){
        if($headerLogo['size'] < 2000000){
          $newfileName2 = rand().'.'.$logoExten;
          $newLocation2 = "../assets/images/logo/".$newfileName2;
          move_uploaded_file($headerLogo['tmp_name'], $newLocation2);

          $insertFavicon = " INSERT INTO setting ( websiteTitle, footerText, favIcon,headerLogo) VALUES ( '$validTitle', '$validText', '$newFileName','$newfileName2') ";
          if(mysqli_query($conn, $insertFavicon)){
          	success("Setting Content Add Successfully");
            // $_SESSION['message']= "Setting Content Add Successfully";
            redirect("");
          }else{
            echo "Something Error ".mysqli_error($conn);
          }

        }else{
          echo "Data inser hoitechy na.".mysqli_error($conn);
        }
      }else{
        $_SESSION['portfolioFeature_error']= 'This type of file not allow.';
        // header('location:setting-add.php'.mysqli_error($conn));
      }

    }else{
      $_SESSION['portfolioThumbnail_error']= 'Image size maximum 2MB allow.';
      header('location:setting-add.php'.mysqli_error($conn));
    }
  }else{
    $_SESSION['portfolioThumbnail_error']= 'This type of file not allow.';
    header('location:setting-add.php'.mysqli_error($conn));
  }
}



?>
	<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="setting.php">setting</a>
        <span class="breadcrumb-item active">add setting</span>
      </nav>
        <div class="service_form p-5">
           <?php
                include "alert.php";
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
              <div class="card pd-2 pd-sm-40 form-layout form-layout-4">
              <!-- ##### Section Title ######  -->
                <h6 class="card-body-title text-center">Add Setting Content</h6>
                <!-- Website title  -->
                  <div class="row mg-t-20">
                      <label class="col-sm-4 form-control-label">Website Title: <span class="tx-danger">*</span></label>
                      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input type="text" class="form-control" name="websiteTitle">
                      </div>
                  </div>
                  <!-- Footer copyright text  -->
                  <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Copyright Text: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" name="footerText">
                    </div>
                  </div>
                  <!-- Website Fav Icon -->
                  <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Fav Icon: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                      <input type="file" onchange="document.getElementById('bah').src = window.URL.createObjectURL(this.files[0])" class="form-control" name="favIcon">
                    </div>
                  </div>
                  <div class="row mg-t-20">
	                <label class="col-sm-4 form-control-label">Preview Fav Icon: <span class="tx-danger">*</span></label>
	                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
	                  <img id="bah" width= 50px alt="">
	                </div>
	              </div>
                  <!-- Website Head Logo  -->
                  <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Header Logo: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
	                  <input type="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" name="headerLogo" class="form-control">
	                </div>
                  </div>
            	 <div class="row mg-t-20">
	                <label class="col-sm-4 form-control-label">Preview Header Logo: <span class="tx-danger">*</span></label>
	                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
	                  <img id="blah" width= 50px alt="">
	                </div>
	              </div>
                  <!-- add button -->
                  <div class="form-layout-footer mg-t-30 text-center">
                    <button style="cursor:pointer" class="btn btn-info mg-r-5 rounded">Save Setting</button>
                  </div>
              </div>
            </form>
                <!-- form-layout-footer -->
        </div>

</div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->


<?php include 'includes/footer.php' ?>
 <?php 
  ob_start();
  include "includes/header.php";
  require_once("../db.php");
  include "function.php";
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $fiverr_id = $_POST['fiverr_id'];
    $fiverrlink = $_POST['fiverrlink'];
    if (empty($fiverrlink)) {
    	warning("Please Input All Filed");
    	redirect("");
    }else{
    	$update = q("UPDATE `fiverr` SET `fiverrlink`='$fiverrlink' WHERE `fiverr_id`='$fiverr_id'");
    	success("Fiverr Link Update Successfully");
    	redirect("fiverr.php");
    }
  }
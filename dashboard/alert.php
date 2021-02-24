<?php
	if(isset($_SESSION['success']))
	{
?>


<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong><?php echo $_SESSION['message']; ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php unset($_SESSION['success']); unset($_SESSION['message']); }?>
<?php
	if(isset($_SESSION['warning']))
	{
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong><?php echo $_SESSION['message']; ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php unset($_SESSION['warning']); unset($_SESSION['message']);  } ?>

<!-- invoke alert and reinitialize alert status -->
<?php if (isset($_SESSION['alert_status']) and $_SESSION['alert_status']==1) { ?>
  <div class="alert alert-<?=$_SESSION['alert_type']?> alert-dismissible fade show my-0 fw800 d-print-none " role="alert">
    <p class="h6 light mb-0 text-center">
      <?=strtoupper($_SESSION['alert_strong'])?> &nbsp; <?=$_SESSION['alert_text']?>
    </p>
  </div>
<?php }
	$_SESSION['alert_status']=0;
	$_SESSION['alert_type']="";
	$_SESSION['alert_strong']="";
	$_SESSION['alert_text']="";
?>

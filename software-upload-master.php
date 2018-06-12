<?php
include_once "classes/db2.class.php";
include_once "classes/paginator.class.php";
include_once 'functions.php';

// Static variable values set
if (isset($_GET['clear'])) {
    if (strtolower($_GET['clear']) == 'search') {
        unset($_SESSION['search_term']);
    }
}
user_session_check();
$page_title = 'OneEMS';

// page logging
$usertype = (isset($_SESSION['userlevel']) == 1 ) ? "Cell sitetechnician" : "";
  $username = $_SESSION['username'];
  $mesg = " User name: $username User type : $usertype Page:  Software Master page Description: Cell Site Tech has navigated to the Software Upload Master page.";
  write_log($mesg);
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once("includes.php");?>
<script src="resources/js/os_repository.js?t=<?php echo date('his'); ?>"></script>

<!-- datepicker styling -->
<link rel="stylesheet" href="resources/css/jquery-ui.css" class="ref">
<!-- datepicker styling -->

</head>
<body>

<script>
  $(function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      showAnim: "drop"
    });
  });
</script>

<div class="container-fluid sw-delivery-devices" id="sw-delivery-devices-master">
  <?php include_once ('menu.php'); ?>
  <?php
    $values = array('Software Master' => '#');
    echo generate_site_breadcrumb($values);
  ?>

<!-- Content Wrapper. Contains page content -->
    <div class="content">
<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
					<div id="status" style="display: none;" class="alert errmsg"></div>
<!-- backup management content row -->
            <form data-licenseKey="" name="wizard-75a3c2" id="wizard-75a3c2" action="#" method='POST'>

              <div class="row">

<!-- left side -->
<!-- router selection content row -->
                <div class="col-sm-12 col-md-6" id="lsform">
                  <div class="jf-form">

                    <div class="alert alert-secondary">
                      <b>Device Series</b>
                    </div>

<!-- select OS Version options -->
                  <?php $swrepo_get_osversion = swrepo_get_osversion(); ?>
                    <div class="form-group f1 required" data-fid="f1">
                      <label class="control-label" for="f1">Select OS Version</label>
                        <select id="dsosversion" name ="dsosversion" class="form-control custom-select" data-rule-required="true">
                          <option value="">- SELECT OS Version -</option>
                          <?php foreach ($swrepo_get_osversion as $key => $val){ ?>
                          <option value="<?php echo $val['osid'];?>"><?php echo $val['osversion'];?></option>
                          <?php }; ?>
                        </select>
                    </div>
<!-- select OS Version options -->

<!-- select device series options -->
                  
                    <div class="form-group f2 required" data-fid="f2">
                      <label class="control-label" for="f2">Device Series</label>
                      <input class="form-control inline" id="dsdeviceseries" type="deviceSeries" value="" placeholder="Enter Device Series">
                    </div>
<!-- /select device series options -->

                    <input name="deviceSeries" id="deviceseriessubmit" class="btn config-submit" value="add" type="submit">

<!-- /select OS version options -->
                    <div class="clearfix"></div>
                    <p>&nbsp;</p>
<!-- /router scripting selection form div -->

                  </div>
                </div>
<!-- /router selection content row -->
<!-- left side -->

<!-- right side -->
<!-- script output -->
      <div class="col-sm-12 col-md-6" id="rsform" style="display:none;">
                  <div class="jf-form">

                    <div class="alert alert-secondary">
                      <b>OS Version</b>
                    </div>

<!-- select OS Version options -->
                    <div class="form-group f3 required" data-fid="f3">
                      <label class="control-label" for="f3">OS Version</label>
                      <input class="form-control inline" id="osversion" name="osversion" type="" placeholder="Enter OS Version">
                    </div>
<!-- select OS Version options -->

<!-- select RAN Vendor options -->
                    <div class="form-group f4 required" data-fid="f4">
                      <label class="control-label" for="f4">Vendor Name</label>
                      <input class="form-control inline" id="vendorname" name="vendorname" type="" placeholder="Enter Vendor Name">
                    </div>
<!-- /select RAN Vendor options -->

<!-- select OS Patch options -->
                      <div class="form-group f5 required" data-fid="f5">
                        <label class="control-label" for="f5">Select Patch</label>
                          <select class="form-control custom-select" id="ospatch" name="ospatch" data-rule-required="true">
                            <option value="">- SELECT Patch -</option>
                            <option value="y">Yes</option>
                            <option value="n">No</option>
                          </select>
                      </div>
<!-- select OS Patch options -->

<!-- select Minimum OS Version options -->
                      <div class="form-group f7 required" data-fid="f7">
                        <label class="control-label" for="f6">Minimum OS Version</label>
                        <input class="form-control inline" id="minverreq" type="" placeholder="Enter Minimum OS Version">
                      </div>
<!-- select Minimum OS Version options -->

<!-- activate by date -->
                      <div class="form-group f8 required">
                        <p><b>Activate By Date: <input type="text" id="datepicker" placeholder="Apply date" class="form-control applydate"></b></p>
                      </div>
<!-- activate by date -->

<!-- retired? -->
                      <div class="form-check form-check-inline">
                        <label class="control-label" for="f9">Retire this OS?</label>
                        <br>
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" checked="checked" id="inlineRadio1" value="y">
                        <label class="form-check-label" for="inlineRadio1">Yes</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="n">
                        <label class="form-check-label" for="inlineRadio2">No</label>
                      </div>
<!-- retired? -->

                      <br>

                      <input name="OSVersion" class="btn configsubmit" id="osversubmit" value="add" type="submit">

<!-- /select OS version options -->
                      <div class="clearfix"></div>
                      <p>&nbsp;</p>
<!-- /router scripting selection form div -->

                  </div>
                </div>

<!-- /backup management content row -->
				</div>
				</form>
			</section>
			<!-- /.content -->
		</div>


</div>
<!-- container-fluid -->
<?php include_once ('footer.php'); ?>
</body>
</html>

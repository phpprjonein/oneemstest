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
<script src="resources/js/swd_batch_page.js?t=<?php echo date('his'); ?>"></script>

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

<div class="container-fluid sw-delivery-devices" id="sw-delivery-devices">
  <?php include_once ('menu.php'); ?>
  <?php
    $values = array('Software Master' => '#');
    echo generate_site_breadcrumb($values);
  ?>

<!-- Content Wrapper. Contains page content -->
    <div class="content">
      <div class="modal fade" id="batchModal">
		    <div class="modal-dialog" >

<!-- Modal content -->
          <div class="modal-content" id="batchModalContent">

<!-- Modal Header -->
        		<div class="modal-header" id ="backupmodalhdr">
              <h5 class="modal-title">Batch Success</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
<!-- /Modal Header -->

<!-- Modal body -->
    			  <div class="modal-body">
      			  Please do keep track of the status on the Batch Page
      			  <?php if(isset($_SESSION['batch_vars']['batchid'])):?>
      			  <br>
              Batch ID : <?php echo $_SESSION['batch_vars']['batchid']; ?></b>
      			  <?php endif;?>
    			  </div>
<!-- /Modal body -->

<!-- Modal footer -->
    			  <div class="modal-footer">
    				  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    			  </div>
<!-- /Modal footer -->

          </div>
<!-- /Modal content -->

        </div>
		  </div>

<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
					<div id="status" style="display: none;" class="alert"></div>
<!-- backup management content row -->
            <form data-licenseKey="" name="wizard-75a3c2" id="wizard-75a3c2" action='generate_script2.php' method='POST' enctype='multipart/form-data' novalidate autocomplete="on">

              <div class="row">

<!-- left side -->
<!-- router selection content row -->
                <div class="col-sm-12 col-md-6">
                  <div class="jf-form">

                    <div class="alert alert-secondary">
                      <b>Device Series</b>
                    </div>

<!-- select OS Version options -->
                  <?php $swrepolist = swrepo_get_deviceseries(); ?>
                    <div class="form-group f1 required" data-fid="f1">
                      <label class="control-label" for="f1">Select OS Version</label>
                        <select id="device_series" name ="device_series" class="form-control custom-select" data-rule-required="true">
                          <option value="">- SELECT OS Version -</option>
                          <?php foreach ($swrepolist as $key => $val){ ?>
                          <option value="<?php echo $val['deviceseries'];?>"><?php echo $val['deviceseries'];?></option>
                          <?php }; ?>
                        </select>
                    </div>
<!-- select OS Version options -->

<!-- select device series options -->
                  <?php $swreponodeversions = swrepo_get_nodeversions();?>
                    <div class="form-group f2 required" data-fid="f2">
                      <label class="control-label" for="f2">Device Series</label>
                      <input class="form-control inline" id="deviceSeries" type="deviceSeries" placeholder="Enter Device Series">
                    </div>
<!-- /select device series options -->

                    <input name="deviceSeries" class="btn config-submit" value="add" type="submit">

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
      <div class="col-sm-12 col-md-6">
                  <div class="jf-form">

                    <div class="alert alert-secondary">
                      <b>OS Version</b>
                    </div>

<!-- select OS Version options -->
                  <?php $swrepolist = swrepo_get_deviceseries(); ?>
                    <div class="form-group f3 required" data-fid="f3">
                      <label class="control-label" for="f3">OS Version</label>
                      <input class="form-control inline" id="" type="" placeholder="Enter OS Version">
                    </div>
<!-- select OS Version options -->

<!-- select RAN Vendor options -->
                  <?php $swreponodeversions = swrepo_get_nodeversions();?>
                    <div class="form-group f4 required" data-fid="f4">
                      <label class="control-label" for="f4">RAN Vendor</label>
                      <input class="form-control inline" id="" type="" placeholder="Enter RAN Vendor">
                    </div>
<!-- /select RAN Vendor options -->

<!-- select OS Patch options -->
                    <?php $swrepogetfilenames = swrepo_get_filenames(); ?>
                      <div class="form-group f5 required" data-fid="f5">
                        <label class="control-label" for="f5">Select Patch / OS Version</label>
                          <select class="form-control custom-select" id ="swrp_filename" name ="swrp_filename" data-rule-required="true">
                            <option value="">- SELECT Patch / OS Version -</option>
                          </select>
                      </div>
<!-- select OS Patch options -->

<!-- select Minimum OS Version options -->
                      <div class="form-group f7 required" data-fid="f7">
                        <label class="control-label" for="f6">Minimum OS Version</label>
                        <input class="form-control inline" id="" type="" placeholder="Enter Minimum OS Version">
                      </div>
<!-- select Minimum OS Version options -->

<!-- activate by date -->
                      <div class="form-group f8 required">
                        <p><b>Activate By Date: <input type="text" id="datepicker" class="form-control"></b></p>
                      </div>
<!-- activate by date -->

<!-- retired? -->
                      <div class="form-check form-check-inline">
                        <label class="control-label" for="f9">Retire this OS?</label>
                        <br>
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                        <label class="form-check-label" for="inlineRadio1">Yes</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                        <label class="form-check-label" for="inlineRadio2">No</label>
                      </div>
<!-- retired? -->

                      <br>

                      <input name="OSVersion" class="btn configsubmit" value="add" type="submit">

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

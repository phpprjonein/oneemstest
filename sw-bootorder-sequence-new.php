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
  $mesg = " User name: $username User type : $usertype Page:  Change-bootorder-sequence Settings Description: Cell Site Tech has navigated to the OS Repository Software Upload page.";
  write_log($mesg); 
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once("includes.php");  ?>
<script src="resources/js/swd_bootorder_batch_page.js?t=<?php echo date('his'); ?>"></script>
</head>
<body>
<script>
    $(function() {
        $(".chosen-select").chosen({
          disable_search_threshold: 10,
          inherit_select_classes: true,
          no_results_text: "No results found! Please try searching again...",
          width: "100%"
        });
    });
</script>
<div class="container-fluid sw-delivery-devices" id="sw-delivery-devices">
    <?php include_once ('menu.php'); ?>
      <?php
        $values = array('Software Delivery' => '#');
        echo generate_site_breadcrumb($values);
      ?>

<!-- Content Wrapper. Contains page content -->
      <div class="content">


        <div class="modal fade" id="batchModal">
		      <div class="modal-dialog" >
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
        			  Please do keep track the status on Batch Page
                     <?php $batchid = time(); ?>
                     <br>Batch ID : <?php echo $batchid; ?></b>
                     <input type="hidden" value="<?php echo $batchid; ?>" id="batchid"/>
      			  </div>
<!-- /Modal body -->

<!-- Modal footer -->
      			  <div class="modal-footer">
      				  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      			  </div>
<!-- /Modal footer -->

            </div>
		      </div>
		    </div>

<!-- Main content -->
        <section class="content">
				  <div class="col-md-12">
            <div id="status" style="display: none;" class="alert"></div>

<!-- backup management content row -->
            <form data-licenseKey="" name="wizard-75a3c2" id="wizard-75a3c2" action='generate_script2.php' method='POST' enctype='multipart/form-data' novalidate autocomplete="on">

              <div class="row">

<!-- router selection content row -->
                <div class="col-sm-12 col-md-4">
                  <div class="jf-form">

<!-- select purpose options -->
                  <?php $swrepolist = swrepo_get_deviceseries(); ?>
                    <div class="form-group f4 required" data-fid="f4">
                      <label class="control-label" for="f4">Select Device Series</label>
                      <select id="device_series" name ="device_series" class="form-control custom-select" data-rule-required="true">
                        <option value="">- SELECT Device Series -</option>
                        <?php foreach ($swrepolist as $key => $val){ ?>
        				        <option value="<?php echo $val['deviceseries'];?>"><?php echo $val['deviceseries'];?></option>
        				        <?php }; ?>
                      </select>
                    </div>
<!-- /select purpose options -->

<!-- select OS version options -->
                  <div class="form-group f8 required" data-fid="f8">
                    <label class="control-label" for="f8">Select File Name</label>
                    <select class="form-control custom-select chosen-select" multiple id ="swrp_filename" name ="swrp_filename" data-rule-required="true">
                    	<option value=""> SELECT Filename -</option>
                    </select>
                  </div>
<!-- /select OS version options -->

<!-- select RAN vendor options -->
                  <?php  $configtmpddwndata =getconfigtempldpdwntbl('configscriptranvendor'); ?>
                  <div class="form-group f9 required" data-fid="f9">
                    <label class="control-label" for="f9">Priority</label>
                    <select class="form-control custom-select" id="sw_selpriority" name="sw_selpriority">
                		<option>1</option>
                    	<option>2</option>
                    	<option>3</option>
                    	<option>4</option>
                        <option>5</option>
                    	<option>6</option>
                    	<option>7</option>
                    	<option>8</option>
                    	<option>9</option>
                    	<option>10</option>
                    </select>
                  </div>
<!-- /select RAN vendor options -->

<!-- /select OS version options -->
                  <div class="clearfix"></div>
                  <p>&nbsp;</p>

<!-- /router scripting selection form div -->
                </div>
              </div>
<!-- /router selection content row -->


<!-- right side -->
<!-- script output -->
              <div class="col-sm-12 col-md-8" id="listname-dd">

<!-- template output content -->
          		<div class="form-group col-md-8">
                <div class="btn-group" id="backup-restore-list-dt-filter">
  						    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My routers</button>
    						  <div class="dropdown-menu">
      						  <?php
      						  $celltuser_list = get_celltechusers_list($_SESSION['userid']);
      						  foreach ($celltuser_list as $key => $value):
      							if(isset($value['listname'])):
      						  ?>
      						  <a class="dropdown-item" href="#"><?php echo ($value['listname'] == "0") ? 'My routers' : $value['listname'] ; ?></a>
      						  <?php
      						  endif;
      						  endforeach;
                                  ?>
    						  </div>
  						  </div>
              </div>
              <div class="row">
                <div class="col">
                  <input type="hidden" value="" name="cbvals" id="cbvals"/>
                  <table id="swdelvrybatchpro" class="display" style="width:100%">
                    <thead>
                      <tr>
                      	<th></th>
                        <th>Id</th>
                        <th>IP Address</th>
                        <th>Device Name</th>
                        <th>Device Series</th>
                        <th>Market</th>
                        <th>Current Version</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
<!-- /template name content -->

              <div class="row">
                <div class="col">
                  <button type="button" value="SUBMIT" class="btn btn-default text-center"  id="batch-submit" name="batch-submit">SUBMIT</button>
                </div>
              </div>
<!-- /right side -->

            </div>
<!-- /script output -->

<!-- /backup management content row -->
          </div>
				</form>
			</section>
		</div>
<!-- /.content -->

  </div>
<!-- container-fluid -->

<?php include_once ('footer.php'); ?>
</body>
</html>
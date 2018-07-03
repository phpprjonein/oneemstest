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
  $mesg = " User name: $username User type : $usertype Page:  Schedule-backup Settings Description: Cell Site Tech has navigated to the OS Repository Software Upload page.";
  write_log($mesg);
$market_list = get_market_list_backup();
?>
<!DOCTYPE html>
<html>
<head>
  <title>One Ems</title>
  <meta charset="utf-8">
<?php include_once("includes.php");  ?>
<script src="resources/js/config-template-uservar.js"> </script>
</head>
<body>
<div class="container-fluid" id="config-template-uservar">
  <?php include_once ('menu.php'); ?>
  <?php
    $values = array(
      ' User Variables' => '#'
    );
    echo generate_site_breadcrumb($values);
  ?> 
  
  <form action="#" method="POST">
  <div class="content">

<!-- Modal -->
    <div class="modal fade" id="configtemplusrvalModal">
      <div class="modal-dialog">
          <div class="modal-content" id="configtemplusrvalModalContent">

    <!-- Modal Header -->
              <div class="modal-header" id="configtemplusrvalModalhdr">
                  <h5 class="modal-title">Message</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
    <!-- Modal Header -->

    <!-- Modal body -->
              <div class="modal-body"> Configuration user variables saved successfully.</div>
    <!-- Modal body -->

    <!-- Modal footer -->
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
    </div>
<!-- Modal -->


    <section class="content">

      <div class="col-md-12">
        <div id="status" style="display: none;" class="alert"></div>
 
          <div class="row">
            <div class="col-sm-12 col-md-4">
              <div class="jf-form">
            	<?php $username = $_SESSION['username'];?>
              <!--<form action="software/html/tags/html_form_tag_action.cfm">-->
              <input type="hidden" id='username' value="<?php echo $username; ?>" name="username">

<div class="form-group">
<label for="usrvarname">Variable name</label>
<input type="text" class="form-control" id="usrvarname" placeholder="Enter Variable name">
</div>
<div class="form-group">
<label for="usrvarval">Variable value </label>
<input type="text" class="form-control" id="usrvarval" placeholder="Variable value">
</div>

<div class="form-group">
<label for="deviceseries">Device Series </label>
<input type="text" class="form-control" id="deviceseries" placeholder="Device Series">
</div>

<div class="form-group">
<label for="templname">Template Name </label>
<input type="text" class="form-control" id="templname" placeholder="Template Name">
</div>
 <button type="button" value="SUBMIT" class="btn text-center"  id="configtemplusrvar_submit" name="configtemplusrvar_submit">Submit</button>
</form>
</div>
<?php //include_once ('footer.php'); ?>
</body>
</html>
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
include_once ('config/session_check_cellsite_tech.php');

$page_title = 'OneEMS';

?>
<!DOCTYPE html>
<html>
<head>
   <?php include_once("includes.php");  ?>
   <script src="resources/js/cellsitetech_config.js?t=<?php echo date('his'); ?>"></script>
</head>
<body>
	<div class="container-fluid" id="cellsitech-config">
	<?php include_once ('menu.php'); ?> 
        <!-- Content Wrapper. Contains page content -->
		<div class="content">
			<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
				<!-- backup management content row -->



  <div class="row">
    <div class="col-5">TEMPLATE NAME: <b>Golden_ASR920_15.6_ALL_standalone_GreatLakes_AKRON_opw_021418</b></div>
    <div class="form-group">

      <div class="col">
        <input type="text" class="form-control" id="inputAlias" placeholder="Alias">
      </div>
    </div>
    <div class="form-group">

      <div class="col">
        <input type="text" class="form-control" id="inputREFMop" placeholder="REFMop">
      </div>
    </div>
  </div>

      <div class="row">
<!-- router selection content row -->
      <div class="col-4">
        <div class="jf-form">

<!-- router scripting selection form div -->
          <form data-licenseKey="" name="wizard-75a3c2" id="wizard-75a3c2" action='admin.php' method='post' enctype='multipart/form-data' novalidate autocomplete="on">
            <input type="hidden" name="method" value="validateForm">
            <input type="hidden" id="serverValidationFields" name="serverValidationFields" value="">

<!-- select purpose options -->
            <div class="form-group f4 required" data-fid="f4">
              <label class="control-label" for="f4">Select Purpose</label>
              <select class="form-control custom-select" id="f4" name="f4" data-rule-required="true" disabled>
                <option value="<?php echo $_GET['f4'];?>"><?php echo $_GET['f4']; ?></option> 
                <!-- <option value="asr920">XXXX</option> -->
              </select>
            </div>
<!-- /select purpose options -->

<!-- select device series options -->
            <div class="form-group f7 required" data-fid="f7">
              <label class="control-label" for="f7">Select Device Series</label>
              <select class="form-control custom-select" id="f7" name="f7" data-rule-required="true" disabled>
                <!-- <option value="">ASR9210</option>  -->
               <option value="<?php echo $_GET['f7'];?>"><?php echo $_GET['f7'];?></option> 
              </select>
            </div>
<!-- /select device series options -->

<!-- select OS version options -->
            <div class="form-group f8 required" data-fid="f8">
              <label class="control-label" for="f8">Select OS Version</label>
              <select class="form-control custom-select" id="f8" name="f8" data-rule-required="true" disabled>
                <option value="<?php echo $_GET['f8'];?>"><?php echo $_GET['f8'];?></option> 
                <option></option>
              </select>
            </div>
<!-- /select OS version options -->

<!-- select RAN vendor options -->
            <div class="form-group f9 required" data-fid="f9">
              <label class="control-label" for="f9">Select RAN vendor</label>
              <select class="form-control custom-select" id="f9" name="f9" data-rule-required="true" disabled>
                <!-- <option value="">ALL</option> -->
                <option value="<?php echo $_GET['f9'];?>"><?php echo $_GET['f9'];?></option> 
              </select>
            </div>
<!-- /select RAN vendor options -->

<!-- select RAN vendor options -->
            <div class="form-group f10 required" data-fid="f10">
              <label class="control-label" for="f10">Select Script Type</label>
              <select class="form-control custom-select" id="f10" name="f10" data-rule-required="true" disabled>
                <option value="<?php echo $_GET['f10'];?>"><?php echo $_GET['f10'];?></option> 
                <option></option>
              </select>
            </div>
<!-- /select RAN vendor options -->

<!-- select region options -->
            <div class="form-group f11 required" data-fid="f11">
              <label class="control-label" for="f11">Select Region</label>
              <select class="form-control custom-select" id="f11" name="f11" data-rule-required="true" disabled>
                <option value="">Great Lakes</option>
                <option value="<?php echo $_GET['f11'];?>"><?php echo $_GET['f11'];?></option> 
              </select>
            </div>
<!-- /select region options -->

<!-- select switch type options -->
            <div class="form-group f12 required" data-fid="f12">
              <label class="control-label" for="f12">Select Switch Type</label>
              <select class="form-control custom-select" id="f12" name="f12" data-rule-required="true" disabled>
                <option value="<?php echo $_GET['f12'];?>"><?php echo $_GET['f12'];?></option> 
                <option></option>
              </select>
            </div>
<!-- /select switch type options -->

<!-- select market options -->
            <div class="form-group f13 required" data-fid="f13">
              <label class="control-label" for="f13">Select Market</label>
              <select class="form-control custom-select" id="f13" name="f13" data-rule-required="true" disabled>
                <option value="<?php echo $_GET['f13'];?>"><?php echo $_GET['f13'];?></option> 
                <option></option>
              </select>
            </div>
<!-- /select market options -->

            <div class="clearfix"></div>
          </form>
<!-- /router scripting selection form div -->

        </div>
      </div>
<!-- /router selection content row -->


<!-- right side -->
<!-- script output -->
      <div class="col">

<!-- template output content -->
        <div class="row">
          <div class="col">

            <div class="modal-body scroller tags p-b-2">
                                    <div id="file_process">
              <form name="file_process" action="cellsite-config-process.php" method="post" class="border"><div class="form-group cb-control"><label>Hide Readonly Fields&nbsp;</label><input value="1" id="show_hide_readonly" type="checkbox"></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">testcase nagle
</label><input style="display:none !important;" size="16" name="loop[looper_1][]" value="testcase nagle
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_1][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#detailsModal">add details</button></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">no service pad
</label><input style="display:none !important;" size="16" name="loop[looper_2][]" value="no service pad
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_2][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#detailsModal">add details</button></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">service tcp-keepalives-in
</label><input style="display:none !important;" size="27" name="loop[looper_3][]" value="service tcp-keepalives-in
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_3][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#detailsModal">add details</button></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">service tcp-keepalives-out
</label><input style="display:none !important;" size="28" name="loop[looper_4][]" value="service tcp-keepalives-out
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_4][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#detailsModal">add details</button></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">service timestamps debug datetime msec localtime show-timezone
</label><input style="display:none !important;" size="64" name="loop[looper_5][]" value="service timestamps debug datetime msec localtime show-timezone
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_5][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#detailsModal">add details</button></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">service timestamps log datetime msec localtime show-timezone
</label><input style="display:none !important;" size="62" name="loop[looper_6][]" value="service timestamps log datetime msec localtime show-timezone
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_6][]" value="0" type="hidden"><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#detailsModal">add details</button></span></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">service password-encryption
</label><input style="display:none !important;" size="29" name="loop[looper_7][]" value="service password-encryption
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_7][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#detailsModal">add details</button></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">no platform punt-keepalive disable-kernel-core
</label><input style="display:none !important;" size="48" name="loop[looper_8][]" value="no platform punt-keepalive disable-kernel-core
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_8][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#detailsModal">add details</button></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_9][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_9][]" value="0" type="hidden"></span></div>

<div class="form-group"><span class="form-editable-fields"><label class="readonly">hostname </label><input style="display:none !important;" size="9" name="loop[looper_10][]" value="hostname " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_10][]" value="0" type="hidden"><input size="18" name="loop[looper_10][]" value="XXXXXXXXXXXXXXXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_10][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_10][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_10][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#validationModal">validate</button></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_11][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_11][]" value="0" type="hidden"></span></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">boot-start-marker
</label><input style="display:none !important;" size="19" name="loop[looper_12][]" value="boot-start-marker
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_12][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#detailsModal">add details</button></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">boot system bootflash:asr920-universalk9_npe.03.17.01.S.156-1.S1-std.bin
</label><input style="display:none !important;" size="74" name="loop[looper_13][]" value="boot system bootflash:asr920-universalk9_npe.03.17.01.S.156-1.S1-std.bin
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_13][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#detailsModal">add details</button></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">boot-end-marker
</label><input style="display:none !important;" size="17" name="loop[looper_14][]" value="boot-end-marker
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_14][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#detailsModal">add details</button></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_15][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_15][]" value="0" type="hidden"></span></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_16][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_16][]" value="0" type="hidden"></span></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">vrf definition CELL_MGMT
</label><input style="display:none !important;" size="26" name="loop[looper_17][]" value="vrf definition CELL_MGMT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_17][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#detailsModal">add details</button></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> description CELL_MGMT VRF
</label><input style="display:none !important;" size="28" name="loop[looper_18][]" value=" description CELL_MGMT VRF
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_18][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#detailsModal">add details</button></div>

<div class="form-group"><span class="form-editable-fields"><label class="readonly"> rd </label><input style="display:none !important;" size="4" name="loop[looper_19][]" value=" rd " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_19][]" value="0" type="hidden"><input size="5" name="loop[looper_19][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_19][]" value="1" type="hidden"><label class="readonly">:3000
</label><input style="display:none !important;" size="7" name="loop[looper_19][]" value=":3000
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_19][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#validationModal">validate</button></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> !
</label><input style="display:none !important;" size="4" name="loop[looper_20][]" value=" !
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_20][]" value="0" type="hidden"></span></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> address-family ipv4
</label><input style="display:none !important;" size="22" name="loop[looper_21][]" value=" address-family ipv4
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_21][]" value="0" type="hidden"></span></div>

<div class="form-group"><span class="form-editable-fields"><label class="readonly">  route-target export </label><input style="display:none !important;" size="22" name="loop[looper_22][]" value="  route-target export " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_22][]" value="0" type="hidden"><input size="5" name="loop[looper_22][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_22][]" value="1" type="hidden"><label class="readonly">:3000
</label><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#validationModal">validate</button><input style="display:none !important;" size="7" name="loop[looper_22][]" value=":3000
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_22][]" value="0" type="hidden"></span></div>

<div class="form-group"><span class="form-editable-fields"><label class="readonly">  route-target import </label><input style="display:none !important;" size="22" name="loop[looper_23][]" value="  route-target import " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_23][]" value="0" type="hidden"><input size="5" name="loop[looper_23][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_23][]" value="1" type="hidden"><label class="readonly">:3000
<button type="button" class="btn btn-sm" data-toggle="modal" data-target="#validateModal">validate</button></label><input style="display:none !important;" size="7" name="loop[looper_23][]" value=":3000
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_23][]" value="0" type="hidden"></span></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">no logging monitor
</label><input style="display:none !important;" size="20" name="loop[looper_51][]" value="no logging monitor
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_51][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#detailsModal">add details</button></div>

<div class="form-group"><span class="form-editable-fields"><label class="readonly">enable secret </label><input style="display:none !important;" size="14" name="loop[looper_52][]" value="enable secret " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_52][]" value="0" type="hidden"><input size="10" name="loop[looper_52][]" value="XXXXXXXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_52][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_52][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_52][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#validateModal">validate</button></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_53][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_53][]" value="0" type="hidden"></span></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">aaa new-model
</label><input style="display:none !important;" size="15" name="loop[looper_54][]" value="aaa new-model
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_54][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#detailsModal">add details</button></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">aaa session-id common
</label><input style="display:none !important;" size="23" name="loop[looper_59][]" value="aaa session-id common
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_59][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#detailsModal">add details</button></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_60][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_60][]" value="0" type="hidden"></span></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ethernet cfm ieee
</label><input style="display:none !important;" size="19" name="loop[looper_61][]" value="ethernet cfm ieee
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_61][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#detailsModal">add details</button></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ethernet cfm global
</label><input style="display:none !important;" size="21" name="loop[looper_62][]" value="ethernet cfm global
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_62][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#detailsModal">add details</button></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ethernet cfm traceroute cache
</label><input style="display:none !important;" size="31" name="loop[looper_63][]" value="ethernet cfm traceroute cache
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_63][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#detailsModal">add details</button></div>

<div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ethernet cfm domain Y.1731 level 1
</label><input style="display:none !important;" size="36" name="loop[looper_64][]" value="ethernet cfm domain Y.1731 level 1
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_64][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#detailsModal">add details</button></div>

<div class="form-group"><span class="form-editable-fields"><label class="readonly"> service </label><input style="display:none !important;" size="9" name="loop[looper_65][]" value=" service " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_65][]" value="0" type="hidden"><input size="5" name="loop[looper_65][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#detailsModal">validate</button><input name="hidden[looper_65][]" value="1" type="hidden"><label class="readonly">-1 evc EVC</label>

  <input style="display:none !important;" size="10" name="loop[looper_65][]" value="-1 evc EVC" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_65][]" value="0" type="hidden"><input size="4" name="loop[looper_65][]" value="YYYY" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_65][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_65][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_65][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#validateModal">validate</button></div>

<div class="form-group"><span class="form-editable-fields"><label class="readonly"> service </label><input style="display:none !important;" size="9" name="loop[looper_66][]" value=" service " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_66][]" value="0" type="hidden"><input size="5" name="loop[looper_66][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#validateModal">validate</button>

  <input name="hidden[looper_66][]" value="1" type="hidden"><label class="readonly">-2 evc EVC</label><input style="display:none !important;" size="10" name="loop[looper_66][]" value="-2 evc EVC" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_66][]" value="0" type="hidden"><input size="4" name="loop[looper_66][]" value="YYYY" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_66][]" value="1" type="hidden"><label class="readonly">
</label><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#validateModal">validate</button>

<input style="display:none !important;" size="21" name="loop[looper_88][]" value="no ip domain lookup
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_88][]" value="0" type="hidden"></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#validateModal">validate</button></div>

<div class="form-group">
  <span class="form-non-editable-fields">
    <label class="readonly">ip domain name ncmwireless.com</label>
    <input style="display:none !important;" size="36" name="loop[looper_89][]" value="ip domain name ncmwireless.com" class="form-control cellsitech-configtxtdisp" type="text">
    <input name="hidden[looper_89][]" value="0" type="hidden">
  </span>
</div>

<div class="form-group">
  <span class="form-non-editable-fields">
    <label class="readonly">!</label>
    <input style="display:none !important;" size="3" name="loop[looper_90][]" value="!" class="form-control cellsitech-configtxtdisp" type="text">
    <input name="hidden[looper_90][]" value="0" type="hidden">
  </span>
</div>

<div class="form-group">
  <span class="form-non-editable-fields">
    <label class="readonly">ip multicast-routing distributed</label>
    <input style="display:none !important;" size="34" name="loop[looper_91][]" value="ip multicast-routing distributed" class="form-control cellsitech-configtxtdisp" type="text">
    <input name="hidden[looper_91][]" value="0" type="hidden">
  </span>
</div>

<div class="form-group">
  <span class="form-editable-fields">
    <label class="readonly">ip dhcp excluded-address </label>
    <input style="display:none !important;" size="25" name="loop[looper_92][]" value="ip dhcp excluded-address " class="form-control cellsitech-configtxtdisp" type="text">
    <input name="hidden[looper_92][]" value="0" type="hidden">
    <input size="7" name="loop[looper_92][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text">
    <input name="hidden[looper_92][]" value="1" type="hidden">
    <label class="readonly">&nbsp;</label>
    <input style="display:none !important;" size="1" name="loop[looper_92][]" value=" " class="form-control cellsitech-configtxtdisp" type="text">
    <input name="hidden[looper_92][]" value="0" type="hidden"><label class="readonly"> Y.Y.Y.Y</label><input style="display:none !important;" size="8" name="loop[looper_92][]" value=" Y.Y.Y.Y" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_92][]" value="0" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_92][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_92][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ip dhcp excluded-address </label><input style="display:none !important;" size="25" name="loop[looper_93][]" value="ip dhcp excluded-address " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_93][]" value="0" type="hidden"><input size="7" name="loop[looper_93][]" value="Z.Z.Z.Z" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_93][]" value="1" type="hidden"><label class="readonly">&nbsp;</label><input style="display:none !important;" size="1" name="loop[looper_93][]" value=" " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_93][]" value="0" type="hidden"><input size="7" name="loop[looper_93][]" value="A.A.A.A" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_93][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_93][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_93][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ip dhcp excluded-address </label><input style="display:none !important;" size="25" name="loop[looper_94][]" value="ip dhcp excluded-address " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_94][]" value="0" type="hidden"><input size="7" name="loop[looper_94][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_94][]" value="1" type="hidden"><label class="readonly">&nbsp;</label><input style="display:none !important;" size="1" name="loop[looper_94][]" value=" " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_94][]" value="0" type="hidden"><input size="7" name="loop[looper_94][]" value="Y.Y.Y.Y" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_94][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_94][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_94][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ip dhcp excluded-address </label><input style="display:none !important;" size="25" name="loop[looper_95][]" value="ip dhcp excluded-address " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_95][]" value="0" type="hidden"><input size="7" name="loop[looper_95][]" value="Z.Z.Z.Z" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_95][]" value="1" type="hidden"><label class="readonly">  </label><input style="display:none !important;" size="2" name="loop[looper_95][]" value="  " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_95][]" value="0" type="hidden"><input size="7" name="loop[looper_95][]" value="A.A.A.A" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_95][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_95][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_95][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_96][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_96][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ip dhcp pool BTS</label><input style="display:none !important;" size="16" name="loop[looper_97][]" value="ip dhcp pool BTS" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_97][]" value="0" type="hidden"><input size="6" name="loop[looper_97][]" value="XXXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_97][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_97][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_97][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> network </label><input style="display:none !important;" size="9" name="loop[looper_98][]" value=" network " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_98][]" value="0" type="hidden"><input size="7" name="loop[looper_98][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_98][]" value="1" type="hidden"><label class="readonly"> 255.255.255.240
</label><input style="display:none !important;" size="18" name="loop[looper_98][]" value=" 255.255.255.240
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_98][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> bootfile /screl/active/boot/bts-471.boot
</label><input style="display:none !important;" size="43" name="loop[looper_99][]" value=" bootfile /screl/active/boot/bts-471.boot
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_99][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> next-server </label><input style="display:none !important;" size="13" name="loop[looper_100][]" value=" next-server " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_100][]" value="0" type="hidden"><input size="7" name="loop[looper_100][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_100][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_100][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_100][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> dns-server </label><input style="display:none !important;" size="12" name="loop[looper_101][]" value=" dns-server " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_101][]" value="0" type="hidden"><input size="7" name="loop[looper_101][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_101][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="3" name="loop[looper_101][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_101][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> option 26 hex 05dc
</label><input style="display:none !important;" size="21" name="loop[looper_102][]" value=" option 26 hex 05dc
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_102][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> option 43 ascii "10.188.130.136;10.188.130.143;10.188.0.1;scadmneft;motoneft;255.255.255.248"
</label><input style="display:none !important;" size="96" name="loop[looper_103][]" value=" option 43 ascii &quot;10.188.130.136;10.188.130.143;10.188.0.1;scadmneft;motoneft;255.255.255.248&quot;
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_103][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> default-router </label><input style="display:none !important;" size="16" name="loop[looper_104][]" value=" default-router " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_104][]" value="0" type="hidden"><input size="7" name="loop[looper_104][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_104][]" value="1" type="hidden"><label class="readonly">
</label></span><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#validateModal">validate</button>

</div>
                </form></div>
                <br>
                <div class="form-group"> <input class="btn" name="action" value="Download Script" type="submit"></div>

                </div>

          </div>
        </div>
<!-- /template name content -->
<p></p>
<div class="row">
  <div class="col">
    <button type="submit" class="btn btn-primary btn-lg">OK</button>
  </div>
</div>
<!-- /right side -->
<!-- /script output -->

    </div>
<!-- /backup management content row -->

  </div>
<!-- /container div -->


<!-- details modal -->
  <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModal" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

<!-- details modal header -->
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ADD DETAILS</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
<!-- /details modal header -->

<!-- details modal body -->
        <div class="modal-body">

<!-- category button row -->
          <div class="form-row">
            <div class="btn-group">
              <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              category
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Category 1</a>
                <a class="dropdown-item" href="#">Category 2</a>
                <a class="dropdown-item" href="#">Category 3</a>
              </div>
            </div>
          </div>
<!-- /category button row -->

          <p></p>

<!-- auditable boolean check row -->
          <div class="form-row">
            <div class="form-group">
              <label>Auditable</label>
              <input value="1" id="" type="checkbox">
            </div>
          </div>
<!-- /auditable boolean check row -->

          <p></p>

<!-- add comment row -->
          <div class="form-row">
            <div class="form-group">
              <label>Comment</label>
              <input type="text" class="form-control" id="" placeholder="ADD COMMENT" value="ADD COMMENT" required>
            </div>
          </div>
<!-- /add comment row -->

          <p></p>
          <button class="btn" type="submit">Submit</button>
        </div>
<!-- /details modal body -->

      </div>
    </div>
  </div>
<!-- /details modal -->



<!-- validation modal -->
  <div class="modal fade" id="validationModal" tabindex="-1" role="dialog" aria-labelledby="validationModal" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

<!-- validation modal header -->
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">VALIDATE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
<!-- /validation modal header -->

<!-- validation modal body -->
        <div class="modal-body">

<!-- add value row -->
          <div class="form-row">
            <div class="btn-group">
              <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              add value
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">value 1</a>
                <a class="dropdown-item" href="#">value 2</a>
                <a class="dropdown-item" href="#">value 3</a>
              </div>
            </div>
          </div>
<!-- /add value row -->

<!-- ascii row -->
          <div class="form-row">
            <div class="form-group">
              <label>All ASCII</label>
              <input value="1" id="" type="checkbox">
            </div>
          </div>
<!-- /ascii row -->


<!-- validate IPv4 row -->
          <div class="form-row">
            <div class="form-group">
              <label>Validate IPv4</label>
              <input value="1" id="" type="checkbox">
            </div>
          </div>
<!-- /validate IPv4 row -->

<!-- validate IPv6 row -->
          <div class="form-row">
            <div class="form-group">
              <label>Validate IPv4</label>
              <input value="1" id="" type="checkbox">
            </div>
          </div>
<!-- /validate IPv4 row -->

          <p></p>
          <button class="btn" type="submit">validate</button>
        </div>
<!-- /validation modal body -->

      </div>
    </div>
  </div>
<!-- /validation modal -->
				</div>
			</section>
			<!-- /.content -->
		</div>
	</div>
	<!-- container-fluid -->

        <?php include_once ('footer.php'); ?> 
    </body>
	
	<!-- JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS. Must load stack in this order for this page; popovers will not work otherwise -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

<!-- form wizard scripting -->
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script src="js/vendor.js" ></script>
<script src="js/form-wizard.js?ver=v2.1.0&id=wizard-75a3c2"></script>
<script type="text/javascript">
// dropdown fields values
;
(function() {
    var dataSource= {
        "f7": {
            "dependOn":"f4", "remote":null, "options":[ {
                "label": "- SELECT MODEL TYPE -", "value": "#novalue", "checked": false
            }
            , {
                "4": null, "label": "#depend", "value": "asr920", "checked": null, "image": null
            }
            , {
                "4": null, "label": "- Select Option -", "value": "#empty", "checked": null, "image": null
            }
            , {
                "4": null, "label": "15.6(1)S1", "value": "15.6(1)S1", "checked": null, "image": null
            }
            , {
                "4": null, "label": "15.5(3)S1a", "value": "15.5(3)S1a", "checked": null, "image": null
            }
            ]
        }
        , "f8": {
            "dependOn":"f7", "remote":null, "options":[ {
                "label": "- Select OS Version -", "value": "#novalue", "checked": false
            }
            , {
                "label": "#depend", "value": "15.6(1)S1", "checked": null
            }
            , {
                "label": "- Select Option -", "value": "#empty", "checked": null
            }
            , {
                "label": "Golden", "value": "gold15.6(1)S1V1C1", "checked": null
            }
            , {
                "label": "#depend", "value": "15.5(3)S1a", "checked": null
            }
            , {
                "label": "- Select Option -", "value": "#empty", "checked": null
            }
            , {
                "label": "Golden", "value": "gold15.5(3)S1aV1C1", "checked": null
            }
            ]
        }
        , "f9": {
            "dependOn":"f8", "remote":null, "options":[ {
                "label": "- Select Region -", "value": "#novalue", "checked": false
            }
            , {
                "label": "#depend", "value": "gold15.6(1)S1V1C1", "checked": null
            }
            , {
                "label": "- Select Option -", "value": "#empty", "checked": null
            }
            , {
                "label": "South", "value": "southGold15.6(1)S1V1C1", "checked": null
            }
            , {
                "label": "South East", "value": "southEastGold15.6(1)S1V1C1", "checked": null
            }
            , {
                "label": "South Central", "value": "southCentralGold15.6(1)S1V1C1", "checked": null
            }
            , {
                "label": "Great Lakes", "value": "greatLakesGold15.6(1)S1V1C1", "checked": null
            }
            , {
                "label": "Midwest", "value": "midWestGold15.6(1)S1V1C1", "checked": null
            }
            , {
                "label": "North Central", "value": "northCentralsGold15.6(1)S1V1C1", "checked": null
            }
            , {
                "label": "North Central / South Central", "value": "northsouthCentralGold15.6(1)S1V1C1", "checked": null
            }
            , {
                "label": "#depend", "value": "gold15.6(1)S1V2C1", "checked": null
            }
            , {
                "label": "- Select Option -", "value": "#empty", "checked": null
            }
            , {
                "label": "South", "value": "southGold15.6(1)S1V2C1", "checked": null
            }
            , {
                "label": "South East", "value": "southEastGold15.6(1)S1V2C1", "checked": null
            }
            , {
                "label": "South Central", "value": "southCentralGold15.6(1)S1V2C1", "checked": null
            }
            , {
                "label": "Great Lakes", "value": "greatLakesGold15.6(1)S1V2C1", "checked": null
            }
            , {
                "label": "Midwest", "value": "midWestGold15.6(1)S1V2C1", "checked": null
            }
            , {
                "label": "North Central", "value": "northCentralsGold15.6(1)S1V2C1", "checked": null
            }
            , {
                "label": "North Central / South Central", "value": "northsouthCentralGold15.6(1)S1V2C1", "checked": null
            }
            , {
                "label": "#depend", "value": "gold15.5(3)S1aV1C1", "checked": null
            }
            , {
                "label": "- Select Option -", "value": "#empty", "checked": null
            }
            , {
                "label": "South", "value": "southGoldGold15.5(3)S1aV1C1", "checked": null
            }
            , {
                "label": "South East", "value": "southEastGold15.5(3)S1aV1C1", "checked": null
            }
            , {
                "label": "South Central", "value": "southCentralGold15.5(3)S1aV1C1", "checked": null
            }
            , {
                "label": "Great Lakes", "value": "greatLakesGold15.5(3)S1aV1C1", "checked": null
            }
            , {
                "label": "Midwest", "value": "midWestGold15.5(3)S1aV1C1", "checked": null
            }
            , {
                "label": "North Central", "value": "northCentralsGold15.5(3)S1aV1C1", "checked": null
            }
            , {
                "label": "North Central / South Central", "value": "northsouthCentralGold15.5(3)S1aV1C1", "checked": null
            }
            , {
                "label": "#depend", "value": "gold15.5(3)S1aV2C1", "checked": null
            }
            , {
                "label": "- Select 15.5(3)S1a V2 C1 Region -", "value": "#empty", "checked": null
            }
            , {
                "label": "South", "value": "southGoldGold15.5(3)S1aV2C1", "checked": null
            }
            , {
                "label": "South East", "value": "southEastGold15.5(3)S1aV2C1", "checked": null
            }
            , {
                "label": "South Central", "value": "southCentralGold15.5(3)S1aV2C1", "checked": null
            }
            , {
                "label": "Great Lakes", "value": "greatLakesGold15.5(3)S1aV2C1", "checked": null
            }
            , {
                "label": "Midwest", "value": "midWestGold15.5(3)S1aV2C1", "checked": null
            }
            , {
                "label": "North Central", "value": "northCentralsGold15.5(3)S1aV2C1", "checked": null
            }
            , {
                "label": "North Central / South Central", "value": "northsouthCentralGold15.5(3)S1aV2C1", "checked": null
            }
            ]
        }
        , "f10": {
            "dependOn":"f9", "remote":null, "options":[ {
                "label": "- Select RAM -", "value": "#novalue", "checked": false
            }
            , {
                "label": "#depend", "checked": false, "value": "southGold15.6(1)S1V1C1"
            }
            , {
                "label": "- Select Option -", "checked": false, "value": "#empty"
            }
            , {
                "label": "Motorola", "value": "asr920GPV1C1Moto", "checked": null
            }
            , {
                "label": "Nokia", "value": "asr920GPV1C1Nokia", "checked": null
            }
            ]
          }
          , "f11": {
            "dependOn":"f10", "remote":null, "options":[ {
                "label": "- Select Service -", "value": "#novalue", "checked": false
            }
            , {
                "label": "#depend", "checked": false, "value": "asr920GPV1C1Moto"
            }
            , {
                "label": "- Select Option -", "checked": false, "value": "#empty"
            }
            , {
                "label": "LTE", "value": "asr920MotoLTE", "checked": null
            }
            , {
                "label": "No LTE", "value": "asr920NoLTE", "checked": null
            }
            ]
          }
          , "f12": {
            "dependOn":"f11", "remote":null, "options":[ {
                "label": "- Select Site Type -", "value": "#novalue", "checked": false
            }
            , {
                "label": "#depend", "checked": false, "value": "asr920MotoLTE"
            }
            , {
                "label": "- Select Option -", "checked": false, "value": "#empty"
            }
            , {
                "label": "Standalone", "value": "siteStandalone", "checked": null
            }
            ]
          }
    }
    ;
    $(document).trigger( 'dependent:setup', dataSource);
}

)();
</script>

<script type="text/javascript">

  // start form wizard initialization
  // --------------------------------
  JF.init('#wizard-75a3c2');

  // watch form element change event to run form wizard's formlogic
  // ---------------------------------------------------------------
  var logics = [
    {
        "disabled": false,
        "action": "disable",
        "selector": "f7",
        "match": "any",
        "rules": [
            {
                "disabled": false,
                "selector": "f4",
                "condition": "contains",
                "value": "#novalue"
            }
        ]
    }
];
  $('input,input:radio,select').change(function(){
    $.formlogic( {logics: logics} );
  });
</script>
</html>

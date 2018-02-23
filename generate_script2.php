<?php
include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';

// Static variable values set
if (isset($_GET['clear'])) {
    if (strtolower($_GET['clear']) == 'search') {
        unset($_SESSION['search_term']);
    }
}

user_session_check();
check_user_authentication('1'); // cellsite tech type user

$page_title = 'OneEMS';
?>
<!DOCTYPE html>
<html>
<head>
   <?php include("includes.php");  ?>
   <script src="resources/js/cellsitetech_config.js?t=<?php echo date('his'); ?>"></script>
</head>
<body>
	<div class="container-fluid" id="cellsitech-config">
	<?php include ('menu.php'); ?> 
        <!-- Content Wrapper. Contains page content -->
		<div class="content">
			<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
<!-- backup management content row -->
    <div class="row">

<!-- router selection content row -->
      <div class="col-4">
        <div class="jf-form">

<!-- router scripting selection form div -->
          <form data-licenseKey="" name="wizard-75a3c2" id="wizard-75a3c2" action='admin.php' method='post' enctype='multipart/form-data' novalidate autocomplete="on">
            <small><b>Purpose_DeviceSeries_OS-Ver_RAN-Vendor_ScriptType_MopRef_Region_Switch_Market_DateTime</b></small>
            <hr>
            <input type="hidden" name="method" value="validateForm">
            <input type="hidden" id="serverValidationFields" name="serverValidationFields" value="">

<!-- select router model options -->
            <div class="form-group f4 required" data-fid="f4">
              <label class="control-label" for="f4">Select Device Model</label>
              <select class="form-control custom-select" id="f4" name="f4" data-rule-required="true" disabled>
                <option value="<?php echo $_GET['f4'];?>"><?php echo $_GET['f4'];?></option>
              </select>
            </div>
<!-- /select router model options -->

<!-- select router model options -->
            <div class="form-group f7 required" data-fid="f7">
              <label class="control-label" for="f7">Select OS</label>
              <select class="form-control custom-select" id="f7" name="f7" data-rule-required="true" disabled>
                <option value="<?php echo $_GET['f7'];?>"><?php echo $_GET['f7'];?></option>
              </select>
            </div>
<!-- /select router model options -->

<!-- select template options -->
            <div class="form-group f8 required" data-fid="f8">
              <!-- <label class="control-label" for="f8">Select OS Configuration</label> -->
              <label class="control-label" for="f8">Select Template Type</label>
              <select class="form-control custom-select" id="f8" name="f8" data-rule-required="true" disabled>
                <option value="<?php echo $_GET['f8'];?>"><?php echo $_GET['f8'];?></option>
              </select>
            </div>
<!-- /select template options -->

<!-- select region options -->
            <div class="form-group f9 required" data-fid="f9">
              <label class="control-label" for="f9">Select Region</label>
              <select class="form-control custom-select" id="f9" name="f9" data-rule-required="true" disabled>
                <option value="<?php echo $_GET['f9'];?>"><?php echo $_GET['f9'];?></option>
              </select>
            </div>
<!-- /select region options -->

<!-- select RAN vendor options -->
            <div class="form-group f10 required" data-fid="f10">
              <label class="control-label" for="f10">Select RAN Vendor</label>
              <select class="form-control custom-select" id="f10" name="f10" data-rule-required="true" disabled>
                <option value="<?php echo $_GET['f10'];?>"><?php echo $_GET['f10'];?></option>
              </select>
            </div>
<!-- /select RAN vendor options -->

<!-- select service options -->
            <div class="form-group f11 required" data-fid="f11">
              <label class="control-label" for="f11">Select Service</label>
              <select class="form-control custom-select" id="f11" name="f11" data-rule-required="true" disabled>
                <option value="<?php echo $_GET['f11'];?>"><?php echo $_GET['f11'];?></option>
              </select>
            </div>
<!-- /select service options -->

<!-- select site type options -->
            <div class="form-group f12 required" data-fid="f12">
              <label class="control-label" for="f12">Select Site Type</label>
              <select class="form-control custom-select" id="f12" name="f12" data-rule-required="true" disabled>
                <option value="<?php echo $_GET['f12'];?>"><?php echo $_GET['f12'];?></option>
              </select>
            </div>
<!-- /select site type options -->

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
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_1][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">no service pad
</label><input style="display:none !important;" size="16" name="loop[looper_2][]" value="no service pad
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_2][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">service tcp-keepalives-in
</label><input style="display:none !important;" size="27" name="loop[looper_3][]" value="service tcp-keepalives-in
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_3][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">service tcp-keepalives-out
</label><input style="display:none !important;" size="28" name="loop[looper_4][]" value="service tcp-keepalives-out
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_4][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">service timestamps debug datetime msec localtime show-timezone
</label><input style="display:none !important;" size="64" name="loop[looper_5][]" value="service timestamps debug datetime msec localtime show-timezone
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_5][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">service timestamps log datetime msec localtime show-timezone
</label><input style="display:none !important;" size="62" name="loop[looper_6][]" value="service timestamps log datetime msec localtime show-timezone
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_6][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">service password-encryption
</label><input style="display:none !important;" size="29" name="loop[looper_7][]" value="service password-encryption
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_7][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">no platform punt-keepalive disable-kernel-core
</label><input style="display:none !important;" size="48" name="loop[looper_8][]" value="no platform punt-keepalive disable-kernel-core
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_8][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_9][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_9][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">hostname </label><input style="display:none !important;" size="9" name="loop[looper_10][]" value="hostname " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_10][]" value="0" type="hidden"><input size="18" name="loop[looper_10][]" value="XXXXXXXXXXXXXXXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_10][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_10][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_10][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_11][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_11][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">boot-start-marker
</label><input style="display:none !important;" size="19" name="loop[looper_12][]" value="boot-start-marker
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_12][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">boot system bootflash:asr920-universalk9_npe.03.17.01.S.156-1.S1-std.bin
</label><input style="display:none !important;" size="74" name="loop[looper_13][]" value="boot system bootflash:asr920-universalk9_npe.03.17.01.S.156-1.S1-std.bin
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_13][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">boot-end-marker
</label><input style="display:none !important;" size="17" name="loop[looper_14][]" value="boot-end-marker
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_14][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_15][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_15][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_16][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_16][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">vrf definition CELL_MGMT
</label><input style="display:none !important;" size="26" name="loop[looper_17][]" value="vrf definition CELL_MGMT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_17][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> description CELL_MGMT VRF
</label><input style="display:none !important;" size="28" name="loop[looper_18][]" value=" description CELL_MGMT VRF
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_18][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> rd </label><input style="display:none !important;" size="4" name="loop[looper_19][]" value=" rd " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_19][]" value="0" type="hidden"><input size="5" name="loop[looper_19][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_19][]" value="1" type="hidden"><label class="readonly">:3000
</label><input style="display:none !important;" size="7" name="loop[looper_19][]" value=":3000
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_19][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> !
</label><input style="display:none !important;" size="4" name="loop[looper_20][]" value=" !
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_20][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> address-family ipv4
</label><input style="display:none !important;" size="22" name="loop[looper_21][]" value=" address-family ipv4
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_21][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  route-target export </label><input style="display:none !important;" size="22" name="loop[looper_22][]" value="  route-target export " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_22][]" value="0" type="hidden"><input size="5" name="loop[looper_22][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_22][]" value="1" type="hidden"><label class="readonly">:3000
</label><input style="display:none !important;" size="7" name="loop[looper_22][]" value=":3000
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_22][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  route-target import </label><input style="display:none !important;" size="22" name="loop[looper_23][]" value="  route-target import " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_23][]" value="0" type="hidden"><input size="5" name="loop[looper_23][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_23][]" value="1" type="hidden"><label class="readonly">:3000
</label><input style="display:none !important;" size="7" name="loop[looper_23][]" value=":3000
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_23][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> exit-address-family
</label><input style="display:none !important;" size="22" name="loop[looper_24][]" value=" exit-address-family
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_24][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> !
</label><input style="display:none !important;" size="4" name="loop[looper_25][]" value=" !
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_25][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> address-family ipv6
</label><input style="display:none !important;" size="22" name="loop[looper_26][]" value=" address-family ipv6
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_26][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  route-target export </label><input style="display:none !important;" size="22" name="loop[looper_27][]" value="  route-target export " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_27][]" value="0" type="hidden"><input size="5" name="loop[looper_27][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_27][]" value="1" type="hidden"><label class="readonly">:3001
</label><input style="display:none !important;" size="7" name="loop[looper_27][]" value=":3001
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_27][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  route-target import </label><input style="display:none !important;" size="22" name="loop[looper_28][]" value="  route-target import " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_28][]" value="0" type="hidden"><input size="5" name="loop[looper_28][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_28][]" value="1" type="hidden"><label class="readonly">:3001
</label><input style="display:none !important;" size="7" name="loop[looper_28][]" value=":3001
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_28][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> exit-address-family
</label><input style="display:none !important;" size="22" name="loop[looper_29][]" value=" exit-address-family
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_29][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_30][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_30][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">vrf definition LTE
</label><input style="display:none !important;" size="20" name="loop[looper_31][]" value="vrf definition LTE
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_31][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> description LTE VRF
</label><input style="display:none !important;" size="22" name="loop[looper_32][]" value=" description LTE VRF
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_32][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> rd </label><input style="display:none !important;" size="4" name="loop[looper_33][]" value=" rd " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_33][]" value="0" type="hidden"><input size="5" name="loop[looper_33][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_33][]" value="1" type="hidden"><label class="readonly">:4000
</label><input style="display:none !important;" size="7" name="loop[looper_33][]" value=":4000
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_33][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> !
</label><input style="display:none !important;" size="4" name="loop[looper_34][]" value=" !
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_34][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> address-family ipv6
</label><input style="display:none !important;" size="22" name="loop[looper_35][]" value=" address-family ipv6
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_35][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  route-target export </label><input style="display:none !important;" size="22" name="loop[looper_36][]" value="  route-target export " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_36][]" value="0" type="hidden"><input size="5" name="loop[looper_36][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_36][]" value="1" type="hidden"><label class="readonly">:4001
</label><input style="display:none !important;" size="7" name="loop[looper_36][]" value=":4001
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_36][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  route-target import </label><input style="display:none !important;" size="22" name="loop[looper_37][]" value="  route-target import " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_37][]" value="0" type="hidden"><input size="5" name="loop[looper_37][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_37][]" value="1" type="hidden"><label class="readonly">:4001
</label><input style="display:none !important;" size="7" name="loop[looper_37][]" value=":4001
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_37][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> exit-address-family
</label><input style="display:none !important;" size="22" name="loop[looper_38][]" value=" exit-address-family
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_38][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_39][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_39][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">vrf definition Mgmt-intf
</label><input style="display:none !important;" size="26" name="loop[looper_40][]" value="vrf definition Mgmt-intf
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_40][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> !
</label><input style="display:none !important;" size="4" name="loop[looper_41][]" value=" !
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_41][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> address-family ipv4
</label><input style="display:none !important;" size="22" name="loop[looper_42][]" value=" address-family ipv4
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_42][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> exit-address-family
</label><input style="display:none !important;" size="22" name="loop[looper_43][]" value=" exit-address-family
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_43][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> !
</label><input style="display:none !important;" size="4" name="loop[looper_44][]" value=" !
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_44][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> address-family ipv6
</label><input style="display:none !important;" size="22" name="loop[looper_45][]" value=" address-family ipv6
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_45][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> exit-address-family
</label><input style="display:none !important;" size="22" name="loop[looper_46][]" value=" exit-address-family
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_46][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_47][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_47][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">logging buffered 2000000
</label><input style="display:none !important;" size="26" name="loop[looper_48][]" value="logging buffered 2000000
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_48][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">logging rate-limit console all 15 except critical
</label><input style="display:none !important;" size="51" name="loop[looper_49][]" value="logging rate-limit console all 15 except critical
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_49][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">no logging console
</label><input style="display:none !important;" size="20" name="loop[looper_50][]" value="no logging console
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_50][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">no logging monitor
</label><input style="display:none !important;" size="20" name="loop[looper_51][]" value="no logging monitor
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_51][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">enable secret </label><input style="display:none !important;" size="14" name="loop[looper_52][]" value="enable secret " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_52][]" value="0" type="hidden"><input size="10" name="loop[looper_52][]" value="XXXXXXXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_52][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_52][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_52][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_53][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_53][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">aaa new-model
</label><input style="display:none !important;" size="15" name="loop[looper_54][]" value="aaa new-model
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_54][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">aaa authentication login default local-case
</label><input style="display:none !important;" size="45" name="loop[looper_55][]" value="aaa authentication login default local-case
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_55][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">aaa authorization config-commands
</label><input style="display:none !important;" size="35" name="loop[looper_56][]" value="aaa authorization config-commands
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_56][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">aaa authorization exec default local if-authenticated
</label><input style="display:none !important;" size="55" name="loop[looper_57][]" value="aaa authorization exec default local if-authenticated
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_57][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">aaa authorization commands 15 default if-authenticated
</label><input style="display:none !important;" size="56" name="loop[looper_58][]" value="aaa authorization commands 15 default if-authenticated
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_58][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">aaa session-id common
</label><input style="display:none !important;" size="23" name="loop[looper_59][]" value="aaa session-id common
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_59][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_60][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_60][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ethernet cfm ieee
</label><input style="display:none !important;" size="19" name="loop[looper_61][]" value="ethernet cfm ieee
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_61][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ethernet cfm global
</label><input style="display:none !important;" size="21" name="loop[looper_62][]" value="ethernet cfm global
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_62][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ethernet cfm traceroute cache
</label><input style="display:none !important;" size="31" name="loop[looper_63][]" value="ethernet cfm traceroute cache
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_63][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ethernet cfm domain Y.1731 level 1
</label><input style="display:none !important;" size="36" name="loop[looper_64][]" value="ethernet cfm domain Y.1731 level 1
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_64][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> service </label><input style="display:none !important;" size="9" name="loop[looper_65][]" value=" service " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_65][]" value="0" type="hidden"><input size="5" name="loop[looper_65][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_65][]" value="1" type="hidden"><label class="readonly">-1 evc EVC</label><input style="display:none !important;" size="10" name="loop[looper_65][]" value="-1 evc EVC" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_65][]" value="0" type="hidden"><input size="4" name="loop[looper_65][]" value="YYYY" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_65][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_65][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_65][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> service </label><input style="display:none !important;" size="9" name="loop[looper_66][]" value=" service " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_66][]" value="0" type="hidden"><input size="5" name="loop[looper_66][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_66][]" value="1" type="hidden"><label class="readonly">-2 evc EVC</label><input style="display:none !important;" size="10" name="loop[looper_66][]" value="-2 evc EVC" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_66][]" value="0" type="hidden"><input size="4" name="loop[looper_66][]" value="YYYY" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_66][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_66][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_66][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_67][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_67][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ethernet evc EVC</label><input style="display:none !important;" size="16" name="loop[looper_68][]" value="ethernet evc EVC" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_68][]" value="0" type="hidden"><input size="4" name="loop[looper_68][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_68][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_68][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_68][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_69][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_69][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ethernet evc EVC</label><input style="display:none !important;" size="16" name="loop[looper_70][]" value="ethernet evc EVC" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_70][]" value="0" type="hidden"><input size="4" name="loop[looper_70][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_70][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_70][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_70][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_71][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_71][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">clock timezone EST -5 0
</label><input style="display:none !important;" size="25" name="loop[looper_72][]" value="clock timezone EST -5 0
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_72][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">clock summer-time EST recurring
</label><input style="display:none !important;" size="33" name="loop[looper_73][]" value="clock summer-time EST recurring
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_73][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">no ip source-route
</label><input style="display:none !important;" size="20" name="loop[looper_74][]" value="no ip source-route
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_74][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_75][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_75][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ip vrf 1XRTT
</label><input style="display:none !important;" size="14" name="loop[looper_76][]" value="ip vrf 1XRTT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_76][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> description 1XRTT VRF
</label><input style="display:none !important;" size="24" name="loop[looper_77][]" value=" description 1XRTT VRF
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_77][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> rd </label><input style="display:none !important;" size="4" name="loop[looper_78][]" value=" rd " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_78][]" value="0" type="hidden"><input size="5" name="loop[looper_78][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_78][]" value="1" type="hidden"><label class="readonly">:2000
</label><input style="display:none !important;" size="7" name="loop[looper_78][]" value=":2000
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_78][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> route-target export </label><input style="display:none !important;" size="21" name="loop[looper_79][]" value=" route-target export " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_79][]" value="0" type="hidden"><input size="5" name="loop[looper_79][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_79][]" value="1" type="hidden"><label class="readonly">:2000
</label><input style="display:none !important;" size="7" name="loop[looper_79][]" value=":2000
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_79][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> route-target import </label><input style="display:none !important;" size="21" name="loop[looper_80][]" value=" route-target import " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_80][]" value="0" type="hidden"><input size="5" name="loop[looper_80][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_80][]" value="1" type="hidden"><label class="readonly">:2000
</label><input style="display:none !important;" size="7" name="loop[looper_80][]" value=":2000
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_80][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_81][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_81][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ip vrf RAN
</label><input style="display:none !important;" size="12" name="loop[looper_82][]" value="ip vrf RAN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_82][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> description EVDO VRF
</label><input style="display:none !important;" size="23" name="loop[looper_83][]" value=" description EVDO VRF
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_83][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> rd </label><input style="display:none !important;" size="4" name="loop[looper_84][]" value=" rd " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_84][]" value="0" type="hidden"><input size="5" name="loop[looper_84][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_84][]" value="1" type="hidden"><label class="readonly">:1000
</label><input style="display:none !important;" size="7" name="loop[looper_84][]" value=":1000
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_84][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> route-target export </label><input style="display:none !important;" size="21" name="loop[looper_85][]" value=" route-target export " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_85][]" value="0" type="hidden"><input size="5" name="loop[looper_85][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_85][]" value="1" type="hidden"><label class="readonly">:1000
</label><input style="display:none !important;" size="7" name="loop[looper_85][]" value=":1000
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_85][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> route-target import </label><input style="display:none !important;" size="21" name="loop[looper_86][]" value=" route-target import " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_86][]" value="0" type="hidden"><input size="5" name="loop[looper_86][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_86][]" value="1" type="hidden"><label class="readonly">:1000
</label><input style="display:none !important;" size="7" name="loop[looper_86][]" value=":1000
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_86][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_87][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_87][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">no ip domain lookup
</label><input style="display:none !important;" size="21" name="loop[looper_88][]" value="no ip domain lookup
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_88][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ip domain name verizonwireless.com
</label><input style="display:none !important;" size="36" name="loop[looper_89][]" value="ip domain name verizonwireless.com
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_89][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_90][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_90][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ip multicast-routing distributed
</label><input style="display:none !important;" size="34" name="loop[looper_91][]" value="ip multicast-routing distributed
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_91][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ip dhcp excluded-address </label><input style="display:none !important;" size="25" name="loop[looper_92][]" value="ip dhcp excluded-address " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_92][]" value="0" type="hidden"><input size="7" name="loop[looper_92][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_92][]" value="1" type="hidden"><label class="readonly">&nbsp;</label><input style="display:none !important;" size="1" name="loop[looper_92][]" value=" " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_92][]" value="0" type="hidden"><label class="readonly"> Y.Y.Y.Y</label><input style="display:none !important;" size="8" name="loop[looper_92][]" value=" Y.Y.Y.Y" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_92][]" value="0" type="hidden"><label class="readonly">
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
</label><input style="display:none !important;" size="2" name="loop[looper_104][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_104][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> lease 0 1
</label><input style="display:none !important;" size="12" name="loop[looper_105][]" value=" lease 0 1
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_105][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ip dhcp pool BTS</label><input style="display:none !important;" size="16" name="loop[looper_106][]" value="ip dhcp pool BTS" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_106][]" value="0" type="hidden"><input size="6" name="loop[looper_106][]" value="XXXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_106][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_106][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_106][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> network </label><input style="display:none !important;" size="9" name="loop[looper_107][]" value=" network " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_107][]" value="0" type="hidden"><input size="7" name="loop[looper_107][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_107][]" value="1" type="hidden"><label class="readonly"> 255.255.255.240
</label><input style="display:none !important;" size="18" name="loop[looper_107][]" value=" 255.255.255.240
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_107][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> bootfile /screl/active/boot/bts-471.boot
</label><input style="display:none !important;" size="43" name="loop[looper_108][]" value=" bootfile /screl/active/boot/bts-471.boot
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_108][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> next-server </label><input style="display:none !important;" size="13" name="loop[looper_109][]" value=" next-server " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_109][]" value="0" type="hidden"><input size="7" name="loop[looper_109][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_109][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_109][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_109][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> dns-server </label><input style="display:none !important;" size="12" name="loop[looper_110][]" value=" dns-server " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_110][]" value="0" type="hidden"><input size="7" name="loop[looper_110][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_110][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="3" name="loop[looper_110][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_110][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> option 26 hex 05dc
</label><input style="display:none !important;" size="21" name="loop[looper_111][]" value=" option 26 hex 05dc
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_111][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> option 43 ascii "10.188.130.136;10.188.130.143;10.188.0.1;scadmneft;motoneft;255.255.255.248"
</label><input style="display:none !important;" size="96" name="loop[looper_112][]" value=" option 43 ascii &quot;10.188.130.136;10.188.130.143;10.188.0.1;scadmneft;motoneft;255.255.255.248&quot;
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_112][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> default-router </label><input style="display:none !important;" size="16" name="loop[looper_113][]" value=" default-router " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_113][]" value="0" type="hidden"><input size="7" name="loop[looper_113][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_113][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_113][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_113][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> lease 0 1
</label><input style="display:none !important;" size="12" name="loop[looper_114][]" value=" lease 0 1
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_114][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_115][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_115][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ipv6 unicast-routing
</label><input style="display:none !important;" size="22" name="loop[looper_116][]" value="ipv6 unicast-routing
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_116][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ipv6 multicast-routing
</label><input style="display:none !important;" size="24" name="loop[looper_117][]" value="ipv6 multicast-routing
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_117][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ipv6 multicast-routing vrf LTE
</label><input style="display:none !important;" size="32" name="loop[looper_118][]" value="ipv6 multicast-routing vrf LTE
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_118][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ipv6 multicast vrf LTE mpls source Loopback400
</label><input style="display:none !important;" size="48" name="loop[looper_119][]" value="ipv6 multicast vrf LTE mpls source Loopback400
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_119][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ipv6 multicast vrf LTE mpls mldp
</label><input style="display:none !important;" size="34" name="loop[looper_120][]" value="ipv6 multicast vrf LTE mpls mldp
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_120][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_121][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_121][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">mpls label protocol ldp
</label><input style="display:none !important;" size="25" name="loop[looper_122][]" value="mpls label protocol ldp
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_122][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">mpls ldp graceful-restart
</label><input style="display:none !important;" size="27" name="loop[looper_123][]" value="mpls ldp graceful-restart
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_123][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">mpls ldp tcp pak-priority
</label><input style="display:none !important;" size="27" name="loop[looper_124][]" value="mpls ldp tcp pak-priority
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_124][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">no mpls ldp advertise-labels
</label><input style="display:none !important;" size="30" name="loop[looper_125][]" value="no mpls ldp advertise-labels
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_125][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">mpls ldp advertise-labels for LOOPBACKS
</label><input style="display:none !important;" size="41" name="loop[looper_126][]" value="mpls ldp advertise-labels for LOOPBACKS
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_126][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">mpls mldp logging notifications
</label><input style="display:none !important;" size="33" name="loop[looper_127][]" value="mpls mldp logging notifications
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_127][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_128][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_128][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_129][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_129][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">archive
</label><input style="display:none !important;" size="9" name="loop[looper_130][]" value="archive
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_130][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> log config
</label><input style="display:none !important;" size="13" name="loop[looper_131][]" value=" log config
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_131][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  logging enable
</label><input style="display:none !important;" size="18" name="loop[looper_132][]" value="  logging enable
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_132][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  logging size 1000
</label><input style="display:none !important;" size="21" name="loop[looper_133][]" value="  logging size 1000
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_133][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  hidekeys
</label><input style="display:none !important;" size="12" name="loop[looper_134][]" value="  hidekeys
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_134][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> path bootflash:ARCHIVE/
</label><input style="display:none !important;" size="26" name="loop[looper_135][]" value=" path bootflash:ARCHIVE/
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_135][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_136][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_136][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">username PAMadmin privilege 15 secret N3Wbui!d
</label><input style="display:none !important;" size="48" name="loop[looper_137][]" value="username PAMadmin privilege 15 secret N3Wbui!d
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_137][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">username PAMadmingrp privilege 15 secret N3Wbui!d
</label><input style="display:none !important;" size="51" name="loop[looper_138][]" value="username PAMadmingrp privilege 15 secret N3Wbui!d
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_138][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">username PAMronlygrp privilege 7 secret N3Wbui!d
</label><input style="display:none !important;" size="50" name="loop[looper_139][]" value="username PAMronlygrp privilege 7 secret N3Wbui!d
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_139][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">username solkcpnebh privilege 15 secret 5 $1$MDA5$NY0xW7ae8RRmY57JjhqGL1
</label><input style="display:none !important;" size="74" name="loop[looper_140][]" value="username solkcpnebh privilege 15 secret 5 $1$MDA5$NY0xW7ae8RRmY57JjhqGL1
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_140][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">username njbbcpnebh privilege 15 secret 5 $1$YEL0$V8AvjQSmtM3WxxRUfeC/p0
</label><input style="display:none !important;" size="74" name="loop[looper_141][]" value="username njbbcpnebh privilege 15 secret 5 $1$YEL0$V8AvjQSmtM3WxxRUfeC/p0
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_141][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">username sev1snmpuser password CwvjqqTT5tQj
</label><input style="display:none !important;" size="45" name="loop[looper_142][]" value="username sev1snmpuser password CwvjqqTT5tQj
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_142][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">username </label><input style="display:none !important;" size="9" name="loop[looper_143][]" value="username " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_143][]" value="0" type="hidden"><input size="7" name="loop[looper_143][]" value="XXXXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_143][]" value="1" type="hidden"><label class="readonly"> privilege 15 secret </label><input style="display:none !important;" size="21" name="loop[looper_143][]" value=" privilege 15 secret " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_143][]" value="0" type="hidden"><input size="10" name="loop[looper_143][]" value="XXXXXXXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_143][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_143][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_143][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_144][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_144][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ip pim rp-address </label><input style="display:none !important;" size="18" name="loop[looper_145][]" value="ip pim rp-address " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_145][]" value="0" type="hidden"><input size="7" name="loop[looper_145][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_145][]" value="1" type="hidden"><label class="readonly"> MCAST_GRP_AN</label><input style="display:none !important;" size="13" name="loop[looper_145][]" value=" MCAST_GRP_AN" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_145][]" value="0" type="hidden"><input size="4" name="loop[looper_145][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_145][]" value="1" type="hidden"><label class="readonly"> override
</label><input style="display:none !important;" size="11" name="loop[looper_145][]" value=" override
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_145][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ip pim register-source Loopback0
</label><input style="display:none !important;" size="34" name="loop[looper_146][]" value="ip pim register-source Loopback0
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_146][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_147][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_147][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">class-map match-any CTRL-IN
</label><input style="display:none !important;" size="29" name="loop[looper_148][]" value="class-map match-any CTRL-IN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_148][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> match mpls experimental topmost 6  7
</label><input style="display:none !important;" size="39" name="loop[looper_149][]" value=" match mpls experimental topmost 6  7
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_149][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> match dscp cs6  cs7
</label><input style="display:none !important;" size="22" name="loop[looper_150][]" value=" match dscp cs6  cs7
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_150][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> match precedence 6  7
</label><input style="display:none !important;" size="24" name="loop[looper_151][]" value=" match precedence 6  7
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_151][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">class-map match-any BEARER-IN
</label><input style="display:none !important;" size="31" name="loop[looper_152][]" value="class-map match-any BEARER-IN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_152][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> match dscp cs5  ef
</label><input style="display:none !important;" size="21" name="loop[looper_153][]" value=" match dscp cs5  ef
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_153][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> match precedence 5
</label><input style="display:none !important;" size="21" name="loop[looper_154][]" value=" match precedence 5
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_154][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> match mpls experimental topmost 5
</label><input style="display:none !important;" size="36" name="loop[looper_155][]" value=" match mpls experimental topmost 5
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_155][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">class-map match-any VIDEO-OUT
</label><input style="display:none !important;" size="31" name="loop[looper_156][]" value="class-map match-any VIDEO-OUT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_156][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> match qos-group 3
</label><input style="display:none !important;" size="20" name="loop[looper_157][]" value=" match qos-group 3
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_157][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">class-map match-any PRIORITY-IN
</label><input style="display:none !important;" size="33" name="loop[looper_158][]" value="class-map match-any PRIORITY-IN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_158][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> match mpls experimental topmost 2
</label><input style="display:none !important;" size="36" name="loop[looper_159][]" value=" match mpls experimental topmost 2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_159][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> match dscp cs2
</label><input style="display:none !important;" size="17" name="loop[looper_160][]" value=" match dscp cs2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_160][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> match precedence 2
</label><input style="display:none !important;" size="21" name="loop[looper_161][]" value=" match precedence 2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_161][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">class-map match-any SIG-OUT
</label><input style="display:none !important;" size="29" name="loop[looper_162][]" value="class-map match-any SIG-OUT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_162][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> match qos-group 4
</label><input style="display:none !important;" size="20" name="loop[looper_163][]" value=" match qos-group 4
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_163][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">class-map match-any BEARER-OUT
</label><input style="display:none !important;" size="32" name="loop[looper_164][]" value="class-map match-any BEARER-OUT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_164][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> match qos-group 5
</label><input style="display:none !important;" size="20" name="loop[looper_165][]" value=" match qos-group 5
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_165][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">class-map match-any CTRL-OUT
</label><input style="display:none !important;" size="30" name="loop[looper_166][]" value="class-map match-any CTRL-OUT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_166][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> match qos-group 6
</label><input style="display:none !important;" size="20" name="loop[looper_167][]" value=" match qos-group 6
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_167][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">class-map match-any PRIORITY-OUT
</label><input style="display:none !important;" size="34" name="loop[looper_168][]" value="class-map match-any PRIORITY-OUT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_168][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> match qos-group 2
</label><input style="display:none !important;" size="20" name="loop[looper_169][]" value=" match qos-group 2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_169][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">class-map match-any SIG-IN
</label><input style="display:none !important;" size="28" name="loop[looper_170][]" value="class-map match-any SIG-IN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_170][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> match mpls experimental topmost 4
</label><input style="display:none !important;" size="36" name="loop[looper_171][]" value=" match mpls experimental topmost 4
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_171][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> match dscp af12  af13  cs4
</label><input style="display:none !important;" size="29" name="loop[looper_172][]" value=" match dscp af12  af13  cs4
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_172][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> match precedence 4
</label><input style="display:none !important;" size="21" name="loop[looper_173][]" value=" match precedence 4
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_173][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">class-map match-any VIDEO-IN
</label><input style="display:none !important;" size="30" name="loop[looper_174][]" value="class-map match-any VIDEO-IN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_174][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> match mpls experimental topmost 3
</label><input style="display:none !important;" size="36" name="loop[looper_175][]" value=" match mpls experimental topmost 3
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_175][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> match dscp cs3
</label><input style="display:none !important;" size="17" name="loop[looper_176][]" value=" match dscp cs3
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_176][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> match precedence 3
</label><input style="display:none !important;" size="22" name="loop[looper_177][]" value=" match precedence 3
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_177][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_178][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_178][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">policy-map METER-IN
</label><input style="display:none !important;" size="21" name="loop[looper_179][]" value="policy-map METER-IN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_179][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> class CTRL-IN
</label><input style="display:none !important;" size="16" name="loop[looper_180][]" value=" class CTRL-IN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_180][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  set qos-group 6
</label><input style="display:none !important;" size="19" name="loop[looper_181][]" value="  set qos-group 6
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_181][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> class BEARER-IN
</label><input style="display:none !important;" size="18" name="loop[looper_182][]" value=" class BEARER-IN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_182][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  set qos-group 5
</label><input style="display:none !important;" size="19" name="loop[looper_183][]" value="  set qos-group 5
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_183][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> class PRIORITY-IN
</label><input style="display:none !important;" size="20" name="loop[looper_184][]" value=" class PRIORITY-IN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_184][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  set qos-group 2
</label><input style="display:none !important;" size="19" name="loop[looper_185][]" value="  set qos-group 2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_185][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> class SIG-IN
</label><input style="display:none !important;" size="15" name="loop[looper_186][]" value=" class SIG-IN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_186][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  set qos-group 4
</label><input style="display:none !important;" size="19" name="loop[looper_187][]" value="  set qos-group 4
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_187][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> class VIDEO-IN
</label><input style="display:none !important;" size="17" name="loop[looper_188][]" value=" class VIDEO-IN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_188][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  set qos-group 3
</label><input style="display:none !important;" size="19" name="loop[looper_189][]" value="  set qos-group 3
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_189][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> class class-default
</label><input style="display:none !important;" size="22" name="loop[looper_190][]" value=" class class-default
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_190][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  set qos-group 0
</label><input style="display:none !important;" size="19" name="loop[looper_191][]" value="  set qos-group 0
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_191][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">policy-map SHAPE-OUT
</label><input style="display:none !important;" size="22" name="loop[looper_192][]" value="policy-map SHAPE-OUT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_192][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">class BEARER-OUT
</label><input style="display:none !important;" size="18" name="loop[looper_193][]" value="class BEARER-OUT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_193][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  police cir percent 80
</label><input style="display:none !important;" size="25" name="loop[looper_194][]" value="  police cir percent 80
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_194][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  priority level 2
</label><input style="display:none !important;" size="20" name="loop[looper_195][]" value="  priority level 2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_195][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  set cos 5
</label><input style="display:none !important;" size="13" name="loop[looper_196][]" value="  set cos 5
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_196][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> class CTRL-OUT
</label><input style="display:none !important;" size="17" name="loop[looper_197][]" value=" class CTRL-OUT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_197][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  set cos 7
</label><input style="display:none !important;" size="13" name="loop[looper_198][]" value="  set cos 7
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_198][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  police cir percent 2
</label><input style="display:none !important;" size="24" name="loop[looper_199][]" value="  police cir percent 2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_199][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  priority level 1
</label><input style="display:none !important;" size="20" name="loop[looper_200][]" value="  priority level 1
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_200][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> class SIG-OUT
</label><input style="display:none !important;" size="16" name="loop[looper_201][]" value=" class SIG-OUT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_201][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  bandwidth remaining percent 47
</label><input style="display:none !important;" size="34" name="loop[looper_202][]" value="  bandwidth remaining percent 47
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_202][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  set cos 4
</label><input style="display:none !important;" size="13" name="loop[looper_203][]" value="  set cos 4
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_203][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> class VIDEO-OUT
</label><input style="display:none !important;" size="18" name="loop[looper_204][]" value=" class VIDEO-OUT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_204][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  bandwidth remaining percent 25
</label><input style="display:none !important;" size="34" name="loop[looper_205][]" value="  bandwidth remaining percent 25
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_205][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  set cos 3
</label><input style="display:none !important;" size="13" name="loop[looper_206][]" value="  set cos 3
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_206][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> class PRIORITY-OUT
</label><input style="display:none !important;" size="21" name="loop[looper_207][]" value=" class PRIORITY-OUT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_207][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  bandwidth remaining percent 15
</label><input style="display:none !important;" size="34" name="loop[looper_208][]" value="  bandwidth remaining percent 15
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_208][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  set cos 2
</label><input style="display:none !important;" size="13" name="loop[looper_209][]" value="  set cos 2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_209][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> class class-default
</label><input style="display:none !important;" size="22" name="loop[looper_210][]" value=" class class-default
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_210][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  bandwidth remaining percent 13
</label><input style="display:none !important;" size="34" name="loop[looper_211][]" value="  bandwidth remaining percent 13
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_211][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  set cos 0
</label><input style="display:none !important;" size="13" name="loop[looper_212][]" value="  set cos 0
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_212][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  queue-limit 450000 bytes
</label><input style="display:none !important;" size="28" name="loop[looper_213][]" value="  queue-limit 450000 bytes
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_213][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">policy-map </label><input style="display:none !important;" size="11" name="loop[looper_214][]" value="policy-map " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_214][]" value="0" type="hidden"><input size="3" name="loop[looper_214][]" value="XXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_214][]" value="1" type="hidden"><label class="readonly">MB-4</label><input style="display:none !important;" size="4" name="loop[looper_214][]" value="MB-4" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_214][]" value="0" type="hidden"><input size="1" name="loop[looper_214][]" value="Y" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_214][]" value="1" type="hidden"><label class="readonly">MB
</label><input style="display:none !important;" size="4" name="loop[looper_214][]" value="MB
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_214][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> class class-default
</label><input style="display:none !important;" size="22" name="loop[looper_215][]" value=" class class-default
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_215][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  shape average </label><input style="display:none !important;" size="16" name="loop[looper_216][]" value="  shape average " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_216][]" value="0" type="hidden"><input size="9" name="loop[looper_216][]" value="XXXXXXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_216][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_216][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_216][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">   service-policy SHAPE-OUT
</label><input style="display:none !important;" size="29" name="loop[looper_217][]" value="   service-policy SHAPE-OUT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_217][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">policy-map METER-OUT
</label><input style="display:none !important;" size="22" name="loop[looper_218][]" value="policy-map METER-OUT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_218][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> class CTRL-OUT
</label><input style="display:none !important;" size="17" name="loop[looper_219][]" value=" class CTRL-OUT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_219][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> class BEARER-OUT
</label><input style="display:none !important;" size="19" name="loop[looper_220][]" value=" class BEARER-OUT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_220][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> class PRIORITY-OUT
</label><input style="display:none !important;" size="21" name="loop[looper_221][]" value=" class PRIORITY-OUT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_221][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> class SIG-OUT
</label><input style="display:none !important;" size="16" name="loop[looper_222][]" value=" class SIG-OUT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_222][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> class VIDEO-OUT
</label><input style="display:none !important;" size="18" name="loop[looper_223][]" value=" class VIDEO-OUT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_223][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> class class-default
</label><input style="display:none !important;" size="22" name="loop[looper_224][]" value=" class class-default
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_224][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_225][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_225][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">interface Loopback0
</label><input style="display:none !important;" size="21" name="loop[looper_226][]" value="interface Loopback0
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_226][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> description Global Loopback
</label><input style="display:none !important;" size="30" name="loop[looper_227][]" value=" description Global Loopback
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_227][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> ip address </label><input style="display:none !important;" size="12" name="loop[looper_228][]" value=" ip address " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_228][]" value="0" type="hidden"><input size="7" name="loop[looper_228][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_228][]" value="1" type="hidden"><label class="readonly"> 255.255.255.255
</label><input style="display:none !important;" size="18" name="loop[looper_228][]" value=" 255.255.255.255
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_228][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ip pim sparse-mode
</label><input style="display:none !important;" size="21" name="loop[looper_229][]" value=" ip pim sparse-mode
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_229][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_230][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_230][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">interface Loopback300
</label><input style="display:none !important;" size="23" name="loop[looper_231][]" value="interface Loopback300
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_231][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> description CELL_MGMT VRF Loopback
</label><input style="display:none !important;" size="37" name="loop[looper_232][]" value=" description CELL_MGMT VRF Loopback
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_232][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> vrf forwarding CELL_MGMT
</label><input style="display:none !important;" size="27" name="loop[looper_233][]" value=" vrf forwarding CELL_MGMT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_233][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> ip address </label><input style="display:none !important;" size="12" name="loop[looper_234][]" value=" ip address " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_234][]" value="0" type="hidden"><input size="7" name="loop[looper_234][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_234][]" value="1" type="hidden"><label class="readonly"> 255.255.255.255
</label><input style="display:none !important;" size="18" name="loop[looper_234][]" value=" 255.255.255.255
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_234][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> ipv6 address </label><input style="display:none !important;" size="14" name="loop[looper_235][]" value=" ipv6 address " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_235][]" value="0" type="hidden"><input size="15" name="loop[looper_235][]" value="X:X:X:X:X:X:X:X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_235][]" value="1" type="hidden"><label class="readonly">/128
</label><input style="display:none !important;" size="6" name="loop[looper_235][]" value="/128
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_235][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ipv6 traffic-filter Drop_ANI_IPv6 in
</label><input style="display:none !important;" size="39" name="loop[looper_236][]" value=" ipv6 traffic-filter Drop_ANI_IPv6 in
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_236][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_237][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_237][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">interface Loopback400
</label><input style="display:none !important;" size="23" name="loop[looper_238][]" value="interface Loopback400
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_238][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> description LTE VRF Loopback
</label><input style="display:none !important;" size="31" name="loop[looper_239][]" value=" description LTE VRF Loopback
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_239][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> vrf forwarding LTE
</label><input style="display:none !important;" size="21" name="loop[looper_240][]" value=" vrf forwarding LTE
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_240][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> no ip address
</label><input style="display:none !important;" size="16" name="loop[looper_241][]" value=" no ip address
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_241][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> ipv6 address </label><input style="display:none !important;" size="14" name="loop[looper_242][]" value=" ipv6 address " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_242][]" value="0" type="hidden"><input size="15" name="loop[looper_242][]" value="X:X:X:X:X:X:X:X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_242][]" value="1" type="hidden"><label class="readonly">/128
</label><input style="display:none !important;" size="6" name="loop[looper_242][]" value="/128
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_242][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ipv6 traffic-filter Drop_ANI_IPv6 in
</label><input style="display:none !important;" size="39" name="loop[looper_243][]" value=" ipv6 traffic-filter Drop_ANI_IPv6 in
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_243][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_244][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_244][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">interface range GigabitEthernet 0/0/0-23
</label><input style="display:none !important;" size="42" name="loop[looper_245][]" value="interface range GigabitEthernet 0/0/0-23
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_245][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">service-policy input METER-IN
</label><input style="display:none !important;" size="31" name="loop[looper_246][]" value="service-policy input METER-IN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_246][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_247][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_247][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">interface GigabitEthernet0/0/0
</label><input style="display:none !important;" size="32" name="loop[looper_248][]" value="interface GigabitEthernet0/0/0
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_248][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> description Physical interface to Backhaul
</label><input style="display:none !important;" size="45" name="loop[looper_249][]" value=" description Physical interface to Backhaul
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_249][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> mtu </label><input style="display:none !important;" size="5" name="loop[looper_250][]" value=" mtu " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_250][]" value="0" type="hidden"><input size="4" name="loop[looper_250][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_250][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_250][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_250][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> bandwidth </label><input style="display:none !important;" size="11" name="loop[looper_251][]" value=" bandwidth " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_251][]" value="0" type="hidden"><input size="4" name="loop[looper_251][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_251][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_251][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_251][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> no ip address
</label><input style="display:none !important;" size="16" name="loop[looper_252][]" value=" no ip address
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_252][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> load-interval 30
</label><input style="display:none !important;" size="19" name="loop[looper_253][]" value=" load-interval 30
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_253][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> carrier-delay msec 150
</label><input style="display:none !important;" size="25" name="loop[looper_254][]" value=" carrier-delay msec 150
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_254][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> negotiation auto
</label><input style="display:none !important;" size="19" name="loop[looper_255][]" value=" negotiation auto
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_255][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> cdp enable
</label><input style="display:none !important;" size="13" name="loop[looper_256][]" value=" cdp enable
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_256][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> service-policy input METER-IN
</label><input style="display:none !important;" size="32" name="loop[looper_257][]" value=" service-policy input METER-IN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_257][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> service-policy output </label><input style="display:none !important;" size="23" name="loop[looper_258][]" value=" service-policy output " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_258][]" value="0" type="hidden"><input size="3" name="loop[looper_258][]" value="XXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_258][]" value="1" type="hidden"><label class="readonly">MB-4</label><input style="display:none !important;" size="4" name="loop[looper_258][]" value="MB-4" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_258][]" value="0" type="hidden"><input size="1" name="loop[looper_258][]" value="Y" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_258][]" value="1" type="hidden"><label class="readonly">MB
</label><input style="display:none !important;" size="5" name="loop[looper_258][]" value="MB
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_258][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> service instance </label><input style="display:none !important;" size="18" name="loop[looper_259][]" value=" service instance " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_259][]" value="0" type="hidden"><input size="4" name="loop[looper_259][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_259][]" value="1" type="hidden"><label class="readonly"> ethernet
</label><input style="display:none !important;" size="11" name="loop[looper_259][]" value=" ethernet
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_259][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  description </label><input style="display:none !important;" size="14" name="loop[looper_260][]" value="  description " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_260][]" value="0" type="hidden"><input size="8" name="loop[looper_260][]" value="XXXXXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_260][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_260][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_260][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  encapsulation dot1q </label><input style="display:none !important;" size="22" name="loop[looper_261][]" value="  encapsulation dot1q " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_261][]" value="0" type="hidden"><input size="4" name="loop[looper_261][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_261][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="3" name="loop[looper_261][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_261][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  rewrite ingress tag pop 1 symmetric
</label><input style="display:none !important;" size="39" name="loop[looper_262][]" value="  rewrite ingress tag pop 1 symmetric
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_262][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  bridge-domain </label><input style="display:none !important;" size="16" name="loop[looper_263][]" value="  bridge-domain " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_263][]" value="0" type="hidden"><input size="4" name="loop[looper_263][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_263][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_263][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_263][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  ethernet loopback permit external
</label><input style="display:none !important;" size="37" name="loop[looper_264][]" value="  ethernet loopback permit external
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_264][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> service instance </label><input style="display:none !important;" size="18" name="loop[looper_265][]" value=" service instance " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_265][]" value="0" type="hidden"><input size="4" name="loop[looper_265][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_265][]" value="1" type="hidden"><label class="readonly"> ethernet
</label><input style="display:none !important;" size="11" name="loop[looper_265][]" value=" ethernet
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_265][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  description </label><input style="display:none !important;" size="14" name="loop[looper_266][]" value="  description " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_266][]" value="0" type="hidden"><input size="8" name="loop[looper_266][]" value="XXXXXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_266][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_266][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_266][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  encapsulation dot1q </label><input style="display:none !important;" size="22" name="loop[looper_267][]" value="  encapsulation dot1q " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_267][]" value="0" type="hidden"><input size="4" name="loop[looper_267][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_267][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="3" name="loop[looper_267][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_267][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  rewrite ingress tag pop 1 symmetric
</label><input style="display:none !important;" size="39" name="loop[looper_268][]" value="  rewrite ingress tag pop 1 symmetric
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_268][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  bridge-domain </label><input style="display:none !important;" size="16" name="loop[looper_269][]" value="  bridge-domain " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_269][]" value="0" type="hidden"><input size="4" name="loop[looper_269][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_269][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_269][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_269][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  ethernet loopback permit external
</label><input style="display:none !important;" size="37" name="loop[looper_270][]" value="  ethernet loopback permit external
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_270][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_271][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_271][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">interface GigabitEthernet0/0/</label><input style="display:none !important;" size="29" name="loop[looper_272][]" value="interface GigabitEthernet0/0/" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_272][]" value="0" type="hidden"><input size="1" name="loop[looper_272][]" value="X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_272][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_272][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_272][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> description eNB - MacroNodeID -</label><input style="display:none !important;" size="32" name="loop[looper_273][]" value=" description eNB - MacroNodeID -" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_273][]" value="0" type="hidden"><input size="2" name="loop[looper_273][]" value="XX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_273][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_273][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_273][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> mtu 1956
</label><input style="display:none !important;" size="11" name="loop[looper_274][]" value=" mtu 1956
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_274][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> no ip address
</label><input style="display:none !important;" size="16" name="loop[looper_275][]" value=" no ip address
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_275][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> load-interval 30
</label><input style="display:none !important;" size="19" name="loop[looper_276][]" value=" load-interval 30
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_276][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> media-type sfp
</label><input style="display:none !important;" size="17" name="loop[looper_277][]" value=" media-type sfp
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_277][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> negotiation auto
</label><input style="display:none !important;" size="19" name="loop[looper_278][]" value=" negotiation auto
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_278][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> service-policy input METER-IN
</label><input style="display:none !important;" size="32" name="loop[looper_279][]" value=" service-policy input METER-IN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_279][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> service-policy output METER-OUT
</label><input style="display:none !important;" size="34" name="loop[looper_280][]" value=" service-policy output METER-OUT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_280][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> !
</label><input style="display:none !important;" size="4" name="loop[looper_281][]" value=" !
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_281][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> service instance 300 ethernet
</label><input style="display:none !important;" size="32" name="loop[looper_282][]" value=" service instance 300 ethernet
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_282][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  description CELL_MGMT eNB OAM
</label><input style="display:none !important;" size="33" name="loop[looper_283][]" value="  description CELL_MGMT eNB OAM
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_283][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  encapsulation dot1q 101
</label><input style="display:none !important;" size="27" name="loop[looper_284][]" value="  encapsulation dot1q 101
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_284][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  rewrite ingress tag pop 1 symmetric
</label><input style="display:none !important;" size="39" name="loop[looper_285][]" value="  rewrite ingress tag pop 1 symmetric
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_285][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  bridge-domain 300
</label><input style="display:none !important;" size="21" name="loop[looper_286][]" value="  bridge-domain 300
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_286][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> !
</label><input style="display:none !important;" size="4" name="loop[looper_287][]" value=" !
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_287][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> service instance 400 ethernet
</label><input style="display:none !important;" size="32" name="loop[looper_288][]" value=" service instance 400 ethernet
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_288][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  description LTE VLAN
</label><input style="display:none !important;" size="24" name="loop[looper_289][]" value="  description LTE VLAN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_289][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  encapsulation dot1q 100
</label><input style="display:none !important;" size="27" name="loop[looper_290][]" value="  encapsulation dot1q 100
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_290][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  rewrite ingress tag pop 1 symmetric
</label><input style="display:none !important;" size="39" name="loop[looper_291][]" value="  rewrite ingress tag pop 1 symmetric
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_291][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  bridge-domain 400
</label><input style="display:none !important;" size="21" name="loop[looper_292][]" value="  bridge-domain 400
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_292][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_293][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_293][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">interface GigabitEthernet0/0/</label><input style="display:none !important;" size="29" name="loop[looper_294][]" value="interface GigabitEthernet0/0/" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_294][]" value="0" type="hidden"><input size="1" name="loop[looper_294][]" value="X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_294][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_294][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_294][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> description Frame 1 GLI-1 </label><input style="display:none !important;" size="27" name="loop[looper_295][]" value=" description Frame 1 GLI-1 " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_295][]" value="0" type="hidden"><input size="3" name="loop[looper_295][]" value="XXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_295][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_295][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_295][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> no ip address
</label><input style="display:none !important;" size="16" name="loop[looper_296][]" value=" no ip address
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_296][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> load-interval 30
</label><input style="display:none !important;" size="19" name="loop[looper_297][]" value=" load-interval 30
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_297][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> media-type rj45
</label><input style="display:none !important;" size="18" name="loop[looper_298][]" value=" media-type rj45
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_298][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> speed 1000
</label><input style="display:none !important;" size="13" name="loop[looper_299][]" value=" speed 1000
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_299][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> no shut
</label><input style="display:none !important;" size="10" name="loop[looper_300][]" value=" no shut
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_300][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> negotiation auto
</label><input style="display:none !important;" size="19" name="loop[looper_301][]" value=" negotiation auto
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_301][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> service instance 48</label><input style="display:none !important;" size="20" name="loop[looper_302][]" value=" service instance 48" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_302][]" value="0" type="hidden"><input size="1" name="loop[looper_302][]" value="X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_302][]" value="1" type="hidden"><label class="readonly"> ethernet
</label><input style="display:none !important;" size="11" name="loop[looper_302][]" value=" ethernet
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_302][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  encapsulation untagged
</label><input style="display:none !important;" size="26" name="loop[looper_303][]" value="  encapsulation untagged
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_303][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  bridge-domain 48</label><input style="display:none !important;" size="18" name="loop[looper_304][]" value="  bridge-domain 48" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_304][]" value="0" type="hidden"><input size="1" name="loop[looper_304][]" value="X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_304][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_304][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_304][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_305][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_305][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">interface GigabitEthernet0/0/</label><input style="display:none !important;" size="29" name="loop[looper_306][]" value="interface GigabitEthernet0/0/" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_306][]" value="0" type="hidden"><input size="1" name="loop[looper_306][]" value="X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_306][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_306][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_306][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> description UBS </label><input style="display:none !important;" size="17" name="loop[looper_307][]" value=" description UBS " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_307][]" value="0" type="hidden"><input size="3" name="loop[looper_307][]" value="XXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_307][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_307][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_307][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> no ip address
</label><input style="display:none !important;" size="16" name="loop[looper_308][]" value=" no ip address
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_308][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> load-interval 30
</label><input style="display:none !important;" size="19" name="loop[looper_309][]" value=" load-interval 30
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_309][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> media-type RJ45
</label><input style="display:none !important;" size="18" name="loop[looper_310][]" value=" media-type RJ45
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_310][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> negotiation auto
</label><input style="display:none !important;" size="19" name="loop[looper_311][]" value=" negotiation auto
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_311][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> service-policy input METER-IN
</label><input style="display:none !important;" size="32" name="loop[looper_312][]" value=" service-policy input METER-IN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_312][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> service instance 4</label><input style="display:none !important;" size="19" name="loop[looper_313][]" value=" service instance 4" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_313][]" value="0" type="hidden"><input size="2" name="loop[looper_313][]" value="XX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_313][]" value="1" type="hidden"><label class="readonly"> Ethernet
</label><input style="display:none !important;" size="11" name="loop[looper_313][]" value=" Ethernet
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_313][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  encapsulation dot1q 4</label><input style="display:none !important;" size="23" name="loop[looper_314][]" value="  encapsulation dot1q 4" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_314][]" value="0" type="hidden"><input size="2" name="loop[looper_314][]" value="XX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_314][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_314][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_314][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  rewrite ingress tag pop 1 symmetric
</label><input style="display:none !important;" size="39" name="loop[looper_315][]" value="  rewrite ingress tag pop 1 symmetric
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_315][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  bridge-domain 4</label><input style="display:none !important;" size="17" name="loop[looper_316][]" value="  bridge-domain 4" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_316][]" value="0" type="hidden"><input size="2" name="loop[looper_316][]" value="XX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_316][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_316][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_316][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> service instance 4</label><input style="display:none !important;" size="19" name="loop[looper_317][]" value=" service instance 4" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_317][]" value="0" type="hidden"><input size="2" name="loop[looper_317][]" value="XX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_317][]" value="1" type="hidden"><label class="readonly"> ethernet
</label><input style="display:none !important;" size="11" name="loop[looper_317][]" value=" ethernet
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_317][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  encapsulation dot1q 4</label><input style="display:none !important;" size="23" name="loop[looper_318][]" value="  encapsulation dot1q 4" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_318][]" value="0" type="hidden"><input size="2" name="loop[looper_318][]" value="XX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_318][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_318][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_318][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  rewrite ingress tag pop 1 symmetric
</label><input style="display:none !important;" size="39" name="loop[looper_319][]" value="  rewrite ingress tag pop 1 symmetric
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_319][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  bridge-domain 4</label><input style="display:none !important;" size="17" name="loop[looper_320][]" value="  bridge-domain 4" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_320][]" value="0" type="hidden"><input size="2" name="loop[looper_320][]" value="XX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_320][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_320][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_320][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_321][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_321][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">interface Gi0/0/</label><input style="display:none !important;" size="16" name="loop[looper_322][]" value="interface Gi0/0/" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_322][]" value="0" type="hidden"><input size="1" name="loop[looper_322][]" value="Y" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_322][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_322][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_322][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> description Link to MCCDO - </label><input style="display:none !important;" size="29" name="loop[looper_323][]" value=" description Link to MCCDO - " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_323][]" value="0" type="hidden"><label class="readonly">BTS DO</label><input style="display:none !important;" size="6" name="loop[looper_323][]" value="BTS DO" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_323][]" value="0" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_323][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_323][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ip vrf forwarding RAN
</label><input style="display:none !important;" size="24" name="loop[looper_324][]" value=" ip vrf forwarding RAN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_324][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> ip address </label><input style="display:none !important;" size="12" name="loop[looper_325][]" value=" ip address " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_325][]" value="0" type="hidden"><input size="7" name="loop[looper_325][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_325][]" value="1" type="hidden"><label class="readonly"> 255.255.255.252
</label><input style="display:none !important;" size="18" name="loop[looper_325][]" value=" 255.255.255.252
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_325][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> load-interval 30
</label><input style="display:none !important;" size="19" name="loop[looper_326][]" value=" load-interval 30
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_326][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> negotiation auto
</label><input style="display:none !important;" size="19" name="loop[looper_327][]" value=" negotiation auto
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_327][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_328][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_328][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">interface GigabitEthernet0/0/11
</label><input style="display:none !important;" size="33" name="loop[looper_329][]" value="interface GigabitEthernet0/0/11
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_329][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> no ip address
</label><input style="display:none !important;" size="16" name="loop[looper_330][]" value=" no ip address
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_330][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> mtu 1970
</label><input style="display:none !important;" size="11" name="loop[looper_331][]" value=" mtu 1970
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_331][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> media-type sfp
</label><input style="display:none !important;" size="17" name="loop[looper_332][]" value=" media-type sfp
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_332][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> negotiation auto
</label><input style="display:none !important;" size="19" name="loop[looper_333][]" value=" negotiation auto
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_333][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> service instance </label><input style="display:none !important;" size="18" name="loop[looper_334][]" value=" service instance " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_334][]" value="0" type="hidden"><input size="4" name="loop[looper_334][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_334][]" value="1" type="hidden"><label class="readonly"> Ethernet EVC</label><input style="display:none !important;" size="13" name="loop[looper_334][]" value=" Ethernet EVC" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_334][]" value="0" type="hidden"><input size="4" name="loop[looper_334][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_334][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_334][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_334][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  encapsulation dot1q </label><input style="display:none !important;" size="22" name="loop[looper_335][]" value="  encapsulation dot1q " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_335][]" value="0" type="hidden"><input size="4" name="loop[looper_335][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_335][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="3" name="loop[looper_335][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_335][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  xconnect </label><input style="display:none !important;" size="11" name="loop[looper_336][]" value="  xconnect " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_336][]" value="0" type="hidden"><input size="7" name="loop[looper_336][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_336][]" value="1" type="hidden"><label class="readonly">&nbsp;</label><input style="display:none !important;" size="1" name="loop[looper_336][]" value=" " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_336][]" value="0" type="hidden"><input size="4" name="loop[looper_336][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_336][]" value="1" type="hidden"><label class="readonly"> encapsulation mpls
</label><input style="display:none !important;" size="21" name="loop[looper_336][]" value=" encapsulation mpls
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_336][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  cfm mep domain Y.1731 mpid 1
</label><input style="display:none !important;" size="32" name="loop[looper_337][]" value="  cfm mep domain Y.1731 mpid 1
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_337][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> service instance </label><input style="display:none !important;" size="18" name="loop[looper_338][]" value=" service instance " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_338][]" value="0" type="hidden"><input size="4" name="loop[looper_338][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_338][]" value="1" type="hidden"><label class="readonly"> Ethernet EVC</label><input style="display:none !important;" size="13" name="loop[looper_338][]" value=" Ethernet EVC" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_338][]" value="0" type="hidden"><input size="4" name="loop[looper_338][]" value="YYYY" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_338][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_338][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_338][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  encapsulation dot1q </label><input style="display:none !important;" size="22" name="loop[looper_339][]" value="  encapsulation dot1q " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_339][]" value="0" type="hidden"><input size="4" name="loop[looper_339][]" value="YYYY" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_339][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_339][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_339][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  xconnect </label><input style="display:none !important;" size="11" name="loop[looper_340][]" value="  xconnect " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_340][]" value="0" type="hidden"><input size="7" name="loop[looper_340][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_340][]" value="1" type="hidden"><label class="readonly">&nbsp;</label><input style="display:none !important;" size="1" name="loop[looper_340][]" value=" " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_340][]" value="0" type="hidden"><input size="4" name="loop[looper_340][]" value="YYYY" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_340][]" value="1" type="hidden"><label class="readonly"> encapsulation mpls
</label><input style="display:none !important;" size="21" name="loop[looper_340][]" value=" encapsulation mpls
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_340][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  cfm mep domain Y.1731 mpid 1
</label><input style="display:none !important;" size="32" name="loop[looper_341][]" value="  cfm mep domain Y.1731 mpid 1
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_341][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_342][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_342][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">interface BDI300
</label><input style="display:none !important;" size="18" name="loop[looper_343][]" value="interface BDI300
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_343][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> description OAM VLAN
</label><input style="display:none !important;" size="23" name="loop[looper_344][]" value=" description OAM VLAN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_344][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> vrf forwarding CELL_MGMT
</label><input style="display:none !important;" size="27" name="loop[looper_345][]" value=" vrf forwarding CELL_MGMT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_345][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> ip address </label><input style="display:none !important;" size="12" name="loop[looper_346][]" value=" ip address " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_346][]" value="0" type="hidden"><input size="7" name="loop[looper_346][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_346][]" value="1" type="hidden"><label class="readonly"> 255.255.255.248
</label><input style="display:none !important;" size="18" name="loop[looper_346][]" value=" 255.255.255.248
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_346][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ip mtu 1956
</label><input style="display:none !important;" size="14" name="loop[looper_347][]" value=" ip mtu 1956
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_347][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> load-interval 30
</label><input style="display:none !important;" size="19" name="loop[looper_348][]" value=" load-interval 30
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_348][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> ipv6 address </label><input style="display:none !important;" size="14" name="loop[looper_349][]" value=" ipv6 address " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_349][]" value="0" type="hidden"><input size="11" name="loop[looper_349][]" value="X:X:X:X:X::" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_349][]" value="1" type="hidden"><label class="readonly">/64
</label><input style="display:none !important;" size="5" name="loop[looper_349][]" value="/64
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_349][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ipv6 mtu 1956
</label><input style="display:none !important;" size="16" name="loop[looper_350][]" value=" ipv6 mtu 1956
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_350][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ipv6 traffic-filter Drop_ANI_IPv6 in
</label><input style="display:none !important;" size="39" name="loop[looper_351][]" value=" ipv6 traffic-filter Drop_ANI_IPv6 in
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_351][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> no shut
</label><input style="display:none !important;" size="10" name="loop[looper_352][]" value=" no shut
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_352][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_353][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_353][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">interface BDI400
</label><input style="display:none !important;" size="18" name="loop[looper_354][]" value="interface BDI400
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_354][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> description Bearer VLAN
</label><input style="display:none !important;" size="26" name="loop[looper_355][]" value=" description Bearer VLAN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_355][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> vrf forwarding LTE
</label><input style="display:none !important;" size="21" name="loop[looper_356][]" value=" vrf forwarding LTE
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_356][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> no ip address
</label><input style="display:none !important;" size="16" name="loop[looper_357][]" value=" no ip address
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_357][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ip mtu 1956
</label><input style="display:none !important;" size="14" name="loop[looper_358][]" value=" ip mtu 1956
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_358][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> load-interval 30
</label><input style="display:none !important;" size="19" name="loop[looper_359][]" value=" load-interval 30
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_359][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> ipv6 address </label><input style="display:none !important;" size="14" name="loop[looper_360][]" value=" ipv6 address " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_360][]" value="0" type="hidden"><input size="10" name="loop[looper_360][]" value="X:X:X:X::X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_360][]" value="1" type="hidden"><label class="readonly">/64
</label><input style="display:none !important;" size="5" name="loop[looper_360][]" value="/64
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_360][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ipv6 mtu 1956
</label><input style="display:none !important;" size="16" name="loop[looper_361][]" value=" ipv6 mtu 1956
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_361][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ipv6 traffic-filter Drop_ANI_IPv6 in
</label><input style="display:none !important;" size="39" name="loop[looper_362][]" value=" ipv6 traffic-filter Drop_ANI_IPv6 in
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_362][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> no shut
</label><input style="display:none !important;" size="10" name="loop[looper_363][]" value=" no shut
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_363][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_364][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_364][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">interface BDI</label><input style="display:none !important;" size="13" name="loop[looper_365][]" value="interface BDI" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_365][]" value="0" type="hidden"><input size="4" name="loop[looper_365][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_365][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_365][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_365][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> description Transport VLAN to </label><input style="display:none !important;" size="31" name="loop[looper_366][]" value=" description Transport VLAN to " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_366][]" value="0" type="hidden"><input size="10" name="loop[looper_366][]" value="XXXXXXXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_366][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_366][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_366][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> ip address </label><input style="display:none !important;" size="12" name="loop[looper_367][]" value=" ip address " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_367][]" value="0" type="hidden"><input size="7" name="loop[looper_367][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_367][]" value="1" type="hidden"><label class="readonly"> 255.255.255.254
</label><input style="display:none !important;" size="18" name="loop[looper_367][]" value=" 255.255.255.254
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_367][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> mpls ip
</label><input style="display:none !important;" size="10" name="loop[looper_368][]" value=" mpls ip
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_368][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> ip mtu </label><input style="display:none !important;" size="8" name="loop[looper_369][]" value=" ip mtu " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_369][]" value="0" type="hidden"><input size="4" name="loop[looper_369][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_369][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_369][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_369][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ip pim query-interval 2
</label><input style="display:none !important;" size="26" name="loop[looper_370][]" value=" ip pim query-interval 2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_370][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ip pim sparse-mode
</label><input style="display:none !important;" size="21" name="loop[looper_371][]" value=" ip pim sparse-mode
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_371][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> mpls mtu </label><input style="display:none !important;" size="10" name="loop[looper_372][]" value=" mpls mtu " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_372][]" value="0" type="hidden"><input size="4" name="loop[looper_372][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_372][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_372][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_372][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> load-interval 30
</label><input style="display:none !important;" size="19" name="loop[looper_373][]" value=" load-interval 30
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_373][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> bfd interval 100 min_rx 100 multiplier 3
</label><input style="display:none !important;" size="43" name="loop[looper_374][]" value=" bfd interval 100 min_rx 100 multiplier 3
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_374][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> no shut
</label><input style="display:none !important;" size="10" name="loop[looper_375][]" value=" no shut
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_375][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_376][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_376][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">interface BDI</label><input style="display:none !important;" size="13" name="loop[looper_377][]" value="interface BDI" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_377][]" value="0" type="hidden"><input size="4" name="loop[looper_377][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_377][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_377][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_377][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> description Transport VLAN to </label><input style="display:none !important;" size="31" name="loop[looper_378][]" value=" description Transport VLAN to " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_378][]" value="0" type="hidden"><input size="10" name="loop[looper_378][]" value="XXXXXXXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_378][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_378][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_378][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> ip address </label><input style="display:none !important;" size="12" name="loop[looper_379][]" value=" ip address " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_379][]" value="0" type="hidden"><input size="7" name="loop[looper_379][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_379][]" value="1" type="hidden"><label class="readonly"> 255.255.255.254
</label><input style="display:none !important;" size="18" name="loop[looper_379][]" value=" 255.255.255.254
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_379][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> mpls ip
</label><input style="display:none !important;" size="10" name="loop[looper_380][]" value=" mpls ip
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_380][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> ip mtu </label><input style="display:none !important;" size="8" name="loop[looper_381][]" value=" ip mtu " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_381][]" value="0" type="hidden"><input size="4" name="loop[looper_381][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_381][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_381][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_381][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ip pim query-interval 2
</label><input style="display:none !important;" size="26" name="loop[looper_382][]" value=" ip pim query-interval 2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_382][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ip pim sparse-mode
</label><input style="display:none !important;" size="21" name="loop[looper_383][]" value=" ip pim sparse-mode
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_383][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> mpls mtu </label><input style="display:none !important;" size="10" name="loop[looper_384][]" value=" mpls mtu " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_384][]" value="0" type="hidden"><input size="4" name="loop[looper_384][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_384][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_384][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_384][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> load-interval 30
</label><input style="display:none !important;" size="19" name="loop[looper_385][]" value=" load-interval 30
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_385][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> bfd interval 100 min_rx 100 multiplier 3
</label><input style="display:none !important;" size="43" name="loop[looper_386][]" value=" bfd interval 100 min_rx 100 multiplier 3
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_386][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> no shut
</label><input style="display:none !important;" size="10" name="loop[looper_387][]" value=" no shut
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_387][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_388][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_388][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">interface BDI4</label><input style="display:none !important;" size="14" name="loop[looper_389][]" value="interface BDI4" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_389][]" value="0" type="hidden"><input size="2" name="loop[looper_389][]" value="XX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_389][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_389][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_389][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> description UBS </label><input style="display:none !important;" size="17" name="loop[looper_390][]" value=" description UBS " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_390][]" value="0" type="hidden"><input size="4" name="loop[looper_390][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_390][]" value="1" type="hidden"><label class="readonly"> CDMA vlan YYY
</label><input style="display:none !important;" size="16" name="loop[looper_390][]" value=" CDMA vlan YYY
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_390][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> ip address </label><input style="display:none !important;" size="12" name="loop[looper_391][]" value=" ip address " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_391][]" value="0" type="hidden"><input size="7" name="loop[looper_391][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_391][]" value="1" type="hidden"><label class="readonly"> 255.255.255.240
</label><input style="display:none !important;" size="18" name="loop[looper_391][]" value=" 255.255.255.240
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_391][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ip pim bsr-border
</label><input style="display:none !important;" size="20" name="loop[looper_392][]" value=" ip pim bsr-border
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_392][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ip pim sparse-mode
</label><input style="display:none !important;" size="21" name="loop[looper_393][]" value=" ip pim sparse-mode
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_393][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ip mobile arp
</label><input style="display:none !important;" size="16" name="loop[looper_394][]" value=" ip mobile arp
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_394][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ip igmp query-max-response-time 5
</label><input style="display:none !important;" size="36" name="loop[looper_395][]" value=" ip igmp query-max-response-time 5
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_395][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ip igmp query-interval 7
</label><input style="display:none !important;" size="27" name="loop[looper_396][]" value=" ip igmp query-interval 7
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_396][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> load-interval 30
</label><input style="display:none !important;" size="19" name="loop[looper_397][]" value=" load-interval 30
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_397][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> no shutdown
</label><input style="display:none !important;" size="14" name="loop[looper_398][]" value=" no shutdown
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_398][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_399][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_399][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">interface BDI4</label><input style="display:none !important;" size="14" name="loop[looper_400][]" value="interface BDI4" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_400][]" value="0" type="hidden"><input size="2" name="loop[looper_400][]" value="XX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_400][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="3" name="loop[looper_400][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_400][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> description UBS </label><input style="display:none !important;" size="17" name="loop[looper_401][]" value=" description UBS " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_401][]" value="0" type="hidden"><input size="4" name="loop[looper_401][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_401][]" value="1" type="hidden"><label class="readonly"> EVDO vlan </label><input style="display:none !important;" size="11" name="loop[looper_401][]" value=" EVDO vlan " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_401][]" value="0" type="hidden"><input size="3" name="loop[looper_401][]" value="YYY" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_401][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_401][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_401][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ip vrf forwarding RAN
</label><input style="display:none !important;" size="24" name="loop[looper_402][]" value=" ip vrf forwarding RAN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_402][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> ip address </label><input style="display:none !important;" size="12" name="loop[looper_403][]" value=" ip address " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_403][]" value="0" type="hidden"><input size="7" name="loop[looper_403][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_403][]" value="1" type="hidden"><label class="readonly"> 255.255.255.240
</label><input style="display:none !important;" size="18" name="loop[looper_403][]" value=" 255.255.255.240
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_403][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_404][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_404][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">interface BDI48</label><input style="display:none !important;" size="15" name="loop[looper_405][]" value="interface BDI48" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_405][]" value="0" type="hidden"><input size="1" name="loop[looper_405][]" value="X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_405][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_405][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_405][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> description GLI BD Interfaces
</label><input style="display:none !important;" size="32" name="loop[looper_406][]" value=" description GLI BD Interfaces
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_406][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> ip address </label><input style="display:none !important;" size="12" name="loop[looper_407][]" value=" ip address " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_407][]" value="0" type="hidden"><input size="7" name="loop[looper_407][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_407][]" value="1" type="hidden"><label class="readonly"> 255.255.255.240
</label><input style="display:none !important;" size="18" name="loop[looper_407][]" value=" 255.255.255.240
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_407][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ip pim bsr-border
</label><input style="display:none !important;" size="20" name="loop[looper_408][]" value=" ip pim bsr-border
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_408][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ip pim sparse-mode
</label><input style="display:none !important;" size="21" name="loop[looper_409][]" value=" ip pim sparse-mode
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_409][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ip mobile arp
</label><input style="display:none !important;" size="16" name="loop[looper_410][]" value=" ip mobile arp
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_410][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ip igmp query-max-response-time 5
</label><input style="display:none !important;" size="36" name="loop[looper_411][]" value=" ip igmp query-max-response-time 5
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_411][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ip igmp query-interval 7
</label><input style="display:none !important;" size="27" name="loop[looper_412][]" value=" ip igmp query-interval 7
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_412][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> load-interval 30
</label><input style="display:none !important;" size="19" name="loop[looper_413][]" value=" load-interval 30
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_413][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> no shutdown
</label><input style="display:none !important;" size="14" name="loop[looper_414][]" value=" no shutdown
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_414][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> ntp broadcast
</label><input style="display:none !important;" size="16" name="loop[looper_415][]" value=" ntp broadcast
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_415][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_416][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_416][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">router bgp </label><input style="display:none !important;" size="11" name="loop[looper_417][]" value="router bgp " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_417][]" value="0" type="hidden"><input size="5" name="loop[looper_417][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_417][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_417][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_417][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> bgp router-id </label><input style="display:none !important;" size="15" name="loop[looper_418][]" value=" bgp router-id " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_418][]" value="0" type="hidden"><input size="7" name="loop[looper_418][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_418][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_418][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_418][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> bgp log-neighbor-changes
</label><input style="display:none !important;" size="27" name="loop[looper_419][]" value=" bgp log-neighbor-changes
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_419][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> bgp graceful-restart restart-time 120
</label><input style="display:none !important;" size="40" name="loop[looper_420][]" value=" bgp graceful-restart restart-time 120
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_420][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> bgp graceful-restart stalepath-time 360
</label><input style="display:none !important;" size="42" name="loop[looper_421][]" value=" bgp graceful-restart stalepath-time 360
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_421][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> bgp graceful-restart
</label><input style="display:none !important;" size="23" name="loop[looper_422][]" value=" bgp graceful-restart
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_422][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> no bgp default ipv4-unicast
</label><input style="display:none !important;" size="30" name="loop[looper_423][]" value=" no bgp default ipv4-unicast
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_423][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> neighbor CSR_PEER_GRP peer-group
</label><input style="display:none !important;" size="35" name="loop[looper_424][]" value=" neighbor CSR_PEER_GRP peer-group
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_424][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> neighbor CSR_PEER_GRP remote-as </label><input style="display:none !important;" size="33" name="loop[looper_425][]" value=" neighbor CSR_PEER_GRP remote-as " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_425][]" value="0" type="hidden"><input size="5" name="loop[looper_425][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_425][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_425][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_425][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> neighbor CSR_PEER_GRP password </label><input style="display:none !important;" size="32" name="loop[looper_426][]" value=" neighbor CSR_PEER_GRP password " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_426][]" value="0" type="hidden"><input size="10" name="loop[looper_426][]" value="XXXXXXXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_426][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_426][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_426][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> neighbor CSR_PEER_GRP update-source Loopback0
</label><input style="display:none !important;" size="48" name="loop[looper_427][]" value=" neighbor CSR_PEER_GRP update-source Loopback0
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_427][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> neighbor CSR_PEER_GRP version 4
</label><input style="display:none !important;" size="34" name="loop[looper_428][]" value=" neighbor CSR_PEER_GRP version 4
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_428][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> neighbor </label><input style="display:none !important;" size="10" name="loop[looper_429][]" value=" neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_429][]" value="0" type="hidden"><input size="7" name="loop[looper_429][]" value="A.A.A.A" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_429][]" value="1" type="hidden"><label class="readonly"> remote-as </label><input style="display:none !important;" size="11" name="loop[looper_429][]" value=" remote-as " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_429][]" value="0" type="hidden"><input size="5" name="loop[looper_429][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_429][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_429][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_429][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> neighbor </label><input style="display:none !important;" size="10" name="loop[looper_430][]" value=" neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_430][]" value="0" type="hidden"><input size="7" name="loop[looper_430][]" value="A.A.A.A" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_430][]" value="1" type="hidden"><label class="readonly"> description MP-IBGP Peering to ASR9010-1
</label><input style="display:none !important;" size="43" name="loop[looper_430][]" value=" description MP-IBGP Peering to ASR9010-1
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_430][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> neighbor </label><input style="display:none !important;" size="10" name="loop[looper_431][]" value=" neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_431][]" value="0" type="hidden"><input size="7" name="loop[looper_431][]" value="A.A.A.A" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_431][]" value="1" type="hidden"><label class="readonly"> password </label><input style="display:none !important;" size="10" name="loop[looper_431][]" value=" password " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_431][]" value="0" type="hidden"><input size="11" name="loop[looper_431][]" value="XXXXXXXXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_431][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_431][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_431][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> neighbor </label><input style="display:none !important;" size="10" name="loop[looper_432][]" value=" neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_432][]" value="0" type="hidden"><input size="7" name="loop[looper_432][]" value="A.A.A.A" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_432][]" value="1" type="hidden"><label class="readonly"> update-source Loopback0
</label><input style="display:none !important;" size="26" name="loop[looper_432][]" value=" update-source Loopback0
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_432][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> neighbor </label><input style="display:none !important;" size="10" name="loop[looper_433][]" value=" neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_433][]" value="0" type="hidden"><input size="7" name="loop[looper_433][]" value="A.A.A.A" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_433][]" value="1" type="hidden"><label class="readonly"> version 4
</label><input style="display:none !important;" size="12" name="loop[looper_433][]" value=" version 4
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_433][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> neighbor </label><input style="display:none !important;" size="10" name="loop[looper_434][]" value=" neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_434][]" value="0" type="hidden"><input size="7" name="loop[looper_434][]" value="B.B.B.B" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_434][]" value="1" type="hidden"><label class="readonly"> remote-as </label><input style="display:none !important;" size="11" name="loop[looper_434][]" value=" remote-as " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_434][]" value="0" type="hidden"><input size="5" name="loop[looper_434][]" value="XXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_434][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_434][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_434][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> neighbor </label><input style="display:none !important;" size="10" name="loop[looper_435][]" value=" neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_435][]" value="0" type="hidden"><input size="7" name="loop[looper_435][]" value="B.B.B.B" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_435][]" value="1" type="hidden"><label class="readonly"> description MP-IBGP Peering to ASR9010-2
</label><input style="display:none !important;" size="43" name="loop[looper_435][]" value=" description MP-IBGP Peering to ASR9010-2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_435][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> neighbor </label><input style="display:none !important;" size="10" name="loop[looper_436][]" value=" neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_436][]" value="0" type="hidden"><input size="7" name="loop[looper_436][]" value="B.B.B.B" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_436][]" value="1" type="hidden"><label class="readonly"> password </label><input style="display:none !important;" size="10" name="loop[looper_436][]" value=" password " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_436][]" value="0" type="hidden"><input size="11" name="loop[looper_436][]" value="XXXXXXXXXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_436][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_436][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_436][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> neighbor </label><input style="display:none !important;" size="10" name="loop[looper_437][]" value=" neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_437][]" value="0" type="hidden"><input size="7" name="loop[looper_437][]" value="B.B.B.B" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_437][]" value="1" type="hidden"><label class="readonly"> update-source Loopback0
</label><input style="display:none !important;" size="26" name="loop[looper_437][]" value=" update-source Loopback0
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_437][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> neighbor </label><input style="display:none !important;" size="10" name="loop[looper_438][]" value=" neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_438][]" value="0" type="hidden"><input size="7" name="loop[looper_438][]" value="B.B.B.B" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_438][]" value="1" type="hidden"><label class="readonly"> version 4
</label><input style="display:none !important;" size="12" name="loop[looper_438][]" value=" version 4
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_438][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_439][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_439][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> address-family vpnv4
</label><input style="display:none !important;" size="23" name="loop[looper_440][]" value=" address-family vpnv4
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_440][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  neighbor CSR_PEER_GRP send-community extended
</label><input style="display:none !important;" size="49" name="loop[looper_441][]" value="  neighbor CSR_PEER_GRP send-community extended
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_441][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  neighbor CSR_PEER_GRP route-reflector-client
</label><input style="display:none !important;" size="48" name="loop[looper_442][]" value="  neighbor CSR_PEER_GRP route-reflector-client
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_442][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  neighbor </label><input style="display:none !important;" size="11" name="loop[looper_443][]" value="  neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_443][]" value="0" type="hidden"><input size="7" name="loop[looper_443][]" value="A.A.A.A" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_443][]" value="1" type="hidden"><label class="readonly"> activate
</label><input style="display:none !important;" size="11" name="loop[looper_443][]" value=" activate
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_443][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  neighbor </label><input style="display:none !important;" size="11" name="loop[looper_444][]" value="  neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_444][]" value="0" type="hidden"><input size="7" name="loop[looper_444][]" value="A.A.A.A" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_444][]" value="1" type="hidden"><label class="readonly"> send-community extended
</label><input style="display:none !important;" size="26" name="loop[looper_444][]" value=" send-community extended
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_444][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  neighbor </label><input style="display:none !important;" size="11" name="loop[looper_445][]" value="  neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_445][]" value="0" type="hidden"><input size="7" name="loop[looper_445][]" value="A.A.A.A" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_445][]" value="1" type="hidden"><label class="readonly"> next-hop-self
</label><input style="display:none !important;" size="16" name="loop[looper_445][]" value=" next-hop-self
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_445][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  neighbor </label><input style="display:none !important;" size="11" name="loop[looper_446][]" value="  neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_446][]" value="0" type="hidden"><input size="7" name="loop[looper_446][]" value="A.A.A.A" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_446][]" value="1" type="hidden"><label class="readonly"> route-map NO_TRANSIT in
</label><input style="display:none !important;" size="26" name="loop[looper_446][]" value=" route-map NO_TRANSIT in
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_446][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  neighbor </label><input style="display:none !important;" size="11" name="loop[looper_447][]" value="  neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_447][]" value="0" type="hidden"><input size="7" name="loop[looper_447][]" value="B.B.B.B" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_447][]" value="1" type="hidden"><label class="readonly"> activate
</label><input style="display:none !important;" size="11" name="loop[looper_447][]" value=" activate
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_447][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  neighbor </label><input style="display:none !important;" size="11" name="loop[looper_448][]" value="  neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_448][]" value="0" type="hidden"><input size="7" name="loop[looper_448][]" value="B.B.B.B" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_448][]" value="1" type="hidden"><label class="readonly"> send-community extended
</label><input style="display:none !important;" size="26" name="loop[looper_448][]" value=" send-community extended
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_448][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  neighbor </label><input style="display:none !important;" size="11" name="loop[looper_449][]" value="  neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_449][]" value="0" type="hidden"><input size="7" name="loop[looper_449][]" value="B.B.B.B" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_449][]" value="1" type="hidden"><label class="readonly"> next-hop-self
</label><input style="display:none !important;" size="16" name="loop[looper_449][]" value=" next-hop-self
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_449][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  neighbor </label><input style="display:none !important;" size="11" name="loop[looper_450][]" value="  neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_450][]" value="0" type="hidden"><input size="7" name="loop[looper_450][]" value="B.B.B.B" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_450][]" value="1" type="hidden"><label class="readonly"> route-map NO_TRANSIT in
</label><input style="display:none !important;" size="26" name="loop[looper_450][]" value=" route-map NO_TRANSIT in
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_450][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> exit-address-family
</label><input style="display:none !important;" size="22" name="loop[looper_451][]" value=" exit-address-family
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_451][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_452][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_452][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> address-family vpnv6
</label><input style="display:none !important;" size="23" name="loop[looper_453][]" value=" address-family vpnv6
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_453][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  neighbor CSR_PEER_GRP send-community extended
</label><input style="display:none !important;" size="49" name="loop[looper_454][]" value="  neighbor CSR_PEER_GRP send-community extended
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_454][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  neighbor CSR_PEER_GRP route-reflector-client
</label><input style="display:none !important;" size="48" name="loop[looper_455][]" value="  neighbor CSR_PEER_GRP route-reflector-client
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_455][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  neighbor </label><input style="display:none !important;" size="11" name="loop[looper_456][]" value="  neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_456][]" value="0" type="hidden"><input size="7" name="loop[looper_456][]" value="A.A.A.A" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_456][]" value="1" type="hidden"><label class="readonly"> activate
</label><input style="display:none !important;" size="11" name="loop[looper_456][]" value=" activate
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_456][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  neighbor </label><input style="display:none !important;" size="11" name="loop[looper_457][]" value="  neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_457][]" value="0" type="hidden"><input size="7" name="loop[looper_457][]" value="A.A.A.A" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_457][]" value="1" type="hidden"><label class="readonly"> send-community extended
</label><input style="display:none !important;" size="26" name="loop[looper_457][]" value=" send-community extended
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_457][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  neighbor </label><input style="display:none !important;" size="11" name="loop[looper_458][]" value="  neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_458][]" value="0" type="hidden"><input size="7" name="loop[looper_458][]" value="A.A.A.A" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_458][]" value="1" type="hidden"><label class="readonly"> next-hop-self
</label><input style="display:none !important;" size="16" name="loop[looper_458][]" value=" next-hop-self
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_458][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  neighbor </label><input style="display:none !important;" size="11" name="loop[looper_459][]" value="  neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_459][]" value="0" type="hidden"><input size="7" name="loop[looper_459][]" value="A.A.A.A" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_459][]" value="1" type="hidden"><label class="readonly"> route-map NO_TRANSIT in
</label><input style="display:none !important;" size="26" name="loop[looper_459][]" value=" route-map NO_TRANSIT in
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_459][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  neighbor </label><input style="display:none !important;" size="11" name="loop[looper_460][]" value="  neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_460][]" value="0" type="hidden"><input size="7" name="loop[looper_460][]" value="B.B.B.B" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_460][]" value="1" type="hidden"><label class="readonly"> activate
</label><input style="display:none !important;" size="11" name="loop[looper_460][]" value=" activate
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_460][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  neighbor </label><input style="display:none !important;" size="11" name="loop[looper_461][]" value="  neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_461][]" value="0" type="hidden"><input size="7" name="loop[looper_461][]" value="B.B.B.B" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_461][]" value="1" type="hidden"><label class="readonly"> send-community extended
</label><input style="display:none !important;" size="26" name="loop[looper_461][]" value=" send-community extended
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_461][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  neighbor </label><input style="display:none !important;" size="11" name="loop[looper_462][]" value="  neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_462][]" value="0" type="hidden"><input size="7" name="loop[looper_462][]" value="B.B.B.B" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_462][]" value="1" type="hidden"><label class="readonly"> next-hop-self
</label><input style="display:none !important;" size="16" name="loop[looper_462][]" value=" next-hop-self
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_462][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">  neighbor </label><input style="display:none !important;" size="11" name="loop[looper_463][]" value="  neighbor " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_463][]" value="0" type="hidden"><input size="7" name="loop[looper_463][]" value="B.B.B.B" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_463][]" value="1" type="hidden"><label class="readonly"> route-map NO_TRANSIT in
</label><input style="display:none !important;" size="26" name="loop[looper_463][]" value=" route-map NO_TRANSIT in
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_463][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> exit-address-family
</label><input style="display:none !important;" size="22" name="loop[looper_464][]" value=" exit-address-family
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_464][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_465][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_465][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">address-family ipv4 vrf CELL_MGMT
</label><input style="display:none !important;" size="35" name="loop[looper_466][]" value="address-family ipv4 vrf CELL_MGMT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_466][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  import path selection all
</label><input style="display:none !important;" size="29" name="loop[looper_467][]" value="  import path selection all
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_467][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  import path limit 2
</label><input style="display:none !important;" size="23" name="loop[looper_468][]" value="  import path limit 2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_468][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  redistribute connected
</label><input style="display:none !important;" size="26" name="loop[looper_469][]" value="  redistribute connected
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_469][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  redistribute static
</label><input style="display:none !important;" size="23" name="loop[looper_470][]" value="  redistribute static
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_470][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  maximum-paths ibgp 2
</label><input style="display:none !important;" size="24" name="loop[looper_471][]" value="  maximum-paths ibgp 2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_471][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> exit-address-family
</label><input style="display:none !important;" size="22" name="loop[looper_472][]" value=" exit-address-family
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_472][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_473][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_473][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> address-family ipv6 vrf CELL_MGMT
</label><input style="display:none !important;" size="36" name="loop[looper_474][]" value=" address-family ipv6 vrf CELL_MGMT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_474][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  redistribute connected
</label><input style="display:none !important;" size="26" name="loop[looper_475][]" value="  redistribute connected
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_475][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  redistribute static
</label><input style="display:none !important;" size="23" name="loop[looper_476][]" value="  redistribute static
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_476][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  maximum-paths ibgp 2
</label><input style="display:none !important;" size="24" name="loop[looper_477][]" value="  maximum-paths ibgp 2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_477][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  import path selection all
</label><input style="display:none !important;" size="29" name="loop[looper_478][]" value="  import path selection all
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_478][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  import path limit 2
</label><input style="display:none !important;" size="23" name="loop[looper_479][]" value="  import path limit 2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_479][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> exit-address-family
</label><input style="display:none !important;" size="22" name="loop[looper_480][]" value=" exit-address-family
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_480][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_481][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_481][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> address-family ipv6 vrf LTE
</label><input style="display:none !important;" size="30" name="loop[looper_482][]" value=" address-family ipv6 vrf LTE
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_482][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  redistribute connected
</label><input style="display:none !important;" size="26" name="loop[looper_483][]" value="  redistribute connected
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_483][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  redistribute static
</label><input style="display:none !important;" size="23" name="loop[looper_484][]" value="  redistribute static
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_484][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  maximum-paths ibgp 2
</label><input style="display:none !important;" size="24" name="loop[looper_485][]" value="  maximum-paths ibgp 2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_485][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> exit-address-family
</label><input style="display:none !important;" size="22" name="loop[looper_486][]" value=" exit-address-family
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_486][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_487][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_487][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> address-family ipv4 vrf RAN
</label><input style="display:none !important;" size="30" name="loop[looper_488][]" value=" address-family ipv4 vrf RAN
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_488][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  import path selection all
</label><input style="display:none !important;" size="29" name="loop[looper_489][]" value="  import path selection all
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_489][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  import path limit 2
</label><input style="display:none !important;" size="23" name="loop[looper_490][]" value="  import path limit 2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_490][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  redistribute connected
</label><input style="display:none !important;" size="26" name="loop[looper_491][]" value="  redistribute connected
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_491][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  redistribute static
</label><input style="display:none !important;" size="23" name="loop[looper_492][]" value="  redistribute static
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_492][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  maximum-paths ibgp 2
</label><input style="display:none !important;" size="24" name="loop[looper_493][]" value="  maximum-paths ibgp 2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_493][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> exit-address-family
</label><input style="display:none !important;" size="22" name="loop[looper_494][]" value=" exit-address-family
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_494][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_495][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_495][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">address-family ipv4 vrf 1XRTT
</label><input style="display:none !important;" size="31" name="loop[looper_496][]" value="address-family ipv4 vrf 1XRTT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_496][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  import path selection all
</label><input style="display:none !important;" size="29" name="loop[looper_497][]" value="  import path selection all
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_497][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  import path limit 2
</label><input style="display:none !important;" size="23" name="loop[looper_498][]" value="  import path limit 2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_498][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  redistribute connected
</label><input style="display:none !important;" size="26" name="loop[looper_499][]" value="  redistribute connected
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_499][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  redistribute static
</label><input style="display:none !important;" size="23" name="loop[looper_500][]" value="  redistribute static
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_500][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  maximum-paths ibgp 2
</label><input style="display:none !important;" size="24" name="loop[looper_501][]" value="  maximum-paths ibgp 2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_501][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> exit-address-family
</label><input style="display:none !important;" size="22" name="loop[looper_502][]" value=" exit-address-family
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_502][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_503][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_503][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ip forward-protocol nd
</label><input style="display:none !important;" size="24" name="loop[looper_504][]" value="ip forward-protocol nd
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_504][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_505][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_505][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ip bgp-community new-format
</label><input style="display:none !important;" size="29" name="loop[looper_506][]" value="ip bgp-community new-format
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_506][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ip ftp source-interface Loopback300
</label><input style="display:none !important;" size="37" name="loop[looper_507][]" value="ip ftp source-interface Loopback300
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_507][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">no ip http server
</label><input style="display:none !important;" size="19" name="loop[looper_508][]" value="no ip http server
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_508][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">no ip http secure-server
</label><input style="display:none !important;" size="26" name="loop[looper_509][]" value="no ip http secure-server
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_509][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ip tftp source-interface Loopback300
</label><input style="display:none !important;" size="38" name="loop[looper_510][]" value="ip tftp source-interface Loopback300
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_510][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ip ssh time-out 60
</label><input style="display:none !important;" size="20" name="loop[looper_511][]" value="ip ssh time-out 60
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_511][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ip ssh authentication-retries 2
</label><input style="display:none !important;" size="33" name="loop[looper_512][]" value="ip ssh authentication-retries 2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_512][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ip ssh source-interface Loopback300
</label><input style="display:none !important;" size="37" name="loop[looper_513][]" value="ip ssh source-interface Loopback300
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_513][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ip ssh version 2
</label><input style="display:none !important;" size="18" name="loop[looper_514][]" value="ip ssh version 2
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_514][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ip scp server enable
</label><input style="display:none !important;" size="22" name="loop[looper_515][]" value="ip scp server enable
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_515][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ip route static bfd BDI</label><input style="display:none !important;" size="23" name="loop[looper_516][]" value="ip route static bfd BDI" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_516][]" value="0" type="hidden"><input size="4" name="loop[looper_516][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_516][]" value="1" type="hidden"><label class="readonly">&nbsp;</label><input style="display:none !important;" size="1" name="loop[looper_516][]" value=" " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_516][]" value="0" type="hidden"><input size="7" name="loop[looper_516][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_516][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="3" name="loop[looper_516][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_516][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ip route static bfd BDI</label><input style="display:none !important;" size="23" name="loop[looper_517][]" value="ip route static bfd BDI" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_517][]" value="0" type="hidden"><input size="4" name="loop[looper_517][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_517][]" value="1" type="hidden"><label class="readonly">&nbsp;</label><input style="display:none !important;" size="1" name="loop[looper_517][]" value=" " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_517][]" value="0" type="hidden"><input size="7" name="loop[looper_517][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_517][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="3" name="loop[looper_517][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_517][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ip route </label><input style="display:none !important;" size="9" name="loop[looper_518][]" value="ip route " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_518][]" value="0" type="hidden"><input size="7" name="loop[looper_518][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_518][]" value="1" type="hidden"><label class="readonly"> 255.255.255.255 BDI</label><input style="display:none !important;" size="20" name="loop[looper_518][]" value=" 255.255.255.255 BDI" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_518][]" value="0" type="hidden"><input size="4" name="loop[looper_518][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_518][]" value="1" type="hidden"><label class="readonly">&nbsp;</label><input style="display:none !important;" size="1" name="loop[looper_518][]" value=" " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_518][]" value="0" type="hidden"><input size="7" name="loop[looper_518][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_518][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="3" name="loop[looper_518][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_518][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ip route </label><input style="display:none !important;" size="9" name="loop[looper_519][]" value="ip route " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_519][]" value="0" type="hidden"><input size="7" name="loop[looper_519][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_519][]" value="1" type="hidden"><label class="readonly"> 255.255.255.255 BDI</label><input style="display:none !important;" size="20" name="loop[looper_519][]" value=" 255.255.255.255 BDI" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_519][]" value="0" type="hidden"><input size="4" name="loop[looper_519][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_519][]" value="1" type="hidden"><label class="readonly">&nbsp;</label><input style="display:none !important;" size="1" name="loop[looper_519][]" value=" " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_519][]" value="0" type="hidden"><input size="7" name="loop[looper_519][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_519][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="3" name="loop[looper_519][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_519][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ip route 0.0.0.0 0.0.0.0 BDI</label><input style="display:none !important;" size="28" name="loop[looper_520][]" value="ip route 0.0.0.0 0.0.0.0 BDI" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_520][]" value="0" type="hidden"><input size="4" name="loop[looper_520][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_520][]" value="1" type="hidden"><label class="readonly">&nbsp;</label><input style="display:none !important;" size="1" name="loop[looper_520][]" value=" " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_520][]" value="0" type="hidden"><input size="7" name="loop[looper_520][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_520][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="3" name="loop[looper_520][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_520][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ip route 0.0.0.0 0.0.0.0 BDI</label><input style="display:none !important;" size="28" name="loop[looper_521][]" value="ip route 0.0.0.0 0.0.0.0 BDI" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_521][]" value="0" type="hidden"><input size="4" name="loop[looper_521][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_521][]" value="1" type="hidden"><label class="readonly">&nbsp;</label><input style="display:none !important;" size="1" name="loop[looper_521][]" value=" " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_521][]" value="0" type="hidden"><input size="7" name="loop[looper_521][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_521][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="3" name="loop[looper_521][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_521][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ip route </label><input style="display:none !important;" size="9" name="loop[looper_522][]" value="ip route " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_522][]" value="0" type="hidden"><input size="7" name="loop[looper_522][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_522][]" value="1" type="hidden"><label class="readonly"> 255.255.255.248 </label><input style="display:none !important;" size="17" name="loop[looper_522][]" value=" 255.255.255.248 " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_522][]" value="0" type="hidden"><input size="7" name="loop[looper_522][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_522][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="3" name="loop[looper_522][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_522][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ip route </label><input style="display:none !important;" size="9" name="loop[looper_523][]" value="ip route " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_523][]" value="0" type="hidden"><input size="7" name="loop[looper_523][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_523][]" value="1" type="hidden"><label class="readonly"> 255.255.255.248 </label><input style="display:none !important;" size="17" name="loop[looper_523][]" value=" 255.255.255.248 " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_523][]" value="0" type="hidden"><input size="7" name="loop[looper_523][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_523][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="3" name="loop[looper_523][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_523][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ip route vrf RAN </label><input style="display:none !important;" size="17" name="loop[looper_524][]" value="ip route vrf RAN " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_524][]" value="0" type="hidden"><input size="7" name="loop[looper_524][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_524][]" value="1" type="hidden"><label class="readonly"> 255.255.255.248 Gig0/0/</label><input style="display:none !important;" size="24" name="loop[looper_524][]" value=" 255.255.255.248 Gig0/0/" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_524][]" value="0" type="hidden"><input size="1" name="loop[looper_524][]" value="Y" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_524][]" value="1" type="hidden"><label class="readonly">&nbsp;</label><input style="display:none !important;" size="1" name="loop[looper_524][]" value=" " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_524][]" value="0" type="hidden"><input size="7" name="loop[looper_524][]" value="Z.Z.Z.Z" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_524][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_524][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_524][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_525][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_525][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ip access-list standard LOOPBACKS
</label><input style="display:none !important;" size="35" name="loop[looper_526][]" value="ip access-list standard LOOPBACKS
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_526][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> permit </label><input style="display:none !important;" size="8" name="loop[looper_527][]" value=" permit " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_527][]" value="0" type="hidden"><input size="7" name="loop[looper_527][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_527][]" value="1" type="hidden"><label class="readonly"> 0.0.0.255
</label><input style="display:none !important;" size="12" name="loop[looper_527][]" value=" 0.0.0.255
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_527][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_528][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_528][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ip access-list standard SNMP_ACL
</label><input style="display:none !important;" size="34" name="loop[looper_529][]" value="ip access-list standard SNMP_ACL
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_529][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">remark Version_Q12017
</label><input style="display:none !important;" size="23" name="loop[looper_530][]" value="remark Version_Q12017
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_530][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit 10.132.8.0 0.0.3.255
</label><input style="display:none !important;" size="29" name="loop[looper_531][]" value="permit 10.132.8.0 0.0.3.255
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_531][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit 10.133.176.0 0.0.2.255
</label><input style="display:none !important;" size="31" name="loop[looper_532][]" value="permit 10.133.176.0 0.0.2.255
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_532][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit 10.134.168.0 0.0.3.255
</label><input style="display:none !important;" size="31" name="loop[looper_533][]" value="permit 10.134.168.0 0.0.3.255
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_533][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit 10.134.240.0 0.0.3.255
</label><input style="display:none !important;" size="31" name="loop[looper_534][]" value="permit 10.134.240.0 0.0.3.255
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_534][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit 10.139.84.0 0.0.1.255
</label><input style="display:none !important;" size="30" name="loop[looper_535][]" value="permit 10.139.84.0 0.0.1.255
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_535][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit 10.186.4.0 0.0.0.15
</label><input style="display:none !important;" size="28" name="loop[looper_536][]" value="permit 10.186.4.0 0.0.0.15
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_536][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit 10.186.203.0 0.0.0.15
</label><input style="display:none !important;" size="30" name="loop[looper_537][]" value="permit 10.186.203.0 0.0.0.15
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_537][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit 10.187.4.0 0.0.3.255
</label><input style="display:none !important;" size="29" name="loop[looper_538][]" value="permit 10.187.4.0 0.0.3.255
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_538][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit 10.194.102.0 0.0.1.255
</label><input style="display:none !important;" size="31" name="loop[looper_539][]" value="permit 10.194.102.0 0.0.1.255
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_539][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit 10.194.236.0 0.0.3.255
</label><input style="display:none !important;" size="31" name="loop[looper_540][]" value="permit 10.194.236.0 0.0.3.255
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_540][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit 10.194.92.0 0.0.3.255
</label><input style="display:none !important;" size="30" name="loop[looper_541][]" value="permit 10.194.92.0 0.0.3.255
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_541][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">deny   any
</label><input style="display:none !important;" size="12" name="loop[looper_542][]" value="deny   any
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_542][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_543][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_543][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ip prefix-list DEFAULT_ROUTE seq 5 permit 0.0.0.0/0 le 27
</label><input style="display:none !important;" size="59" name="loop[looper_544][]" value="ip prefix-list DEFAULT_ROUTE seq 5 permit 0.0.0.0/0 le 27
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_544][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ip prefix-list IPV4-EBH-MLS-LOOPBACKS seq 5 permit </label><input style="display:none !important;" size="51" name="loop[looper_545][]" value="ip prefix-list IPV4-EBH-MLS-LOOPBACKS seq 5 permit " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_545][]" value="0" type="hidden"><input size="7" name="loop[looper_545][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_545][]" value="1" type="hidden"><label class="readonly">/32
</label><input style="display:none !important;" size="5" name="loop[looper_545][]" value="/32
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_545][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ip prefix-list IPV4-EBH-MLS-LOOPBACKS seq 10 permit </label><input style="display:none !important;" size="52" name="loop[looper_546][]" value="ip prefix-list IPV4-EBH-MLS-LOOPBACKS seq 10 permit " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_546][]" value="0" type="hidden"><input size="7" name="loop[looper_546][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_546][]" value="1" type="hidden"><label class="readonly">/32
</label><input style="display:none !important;" size="5" name="loop[looper_546][]" value="/32
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_546][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ip access-list standard MCAST_GRP_AN</label><input style="display:none !important;" size="36" name="loop[looper_547][]" value="ip access-list standard MCAST_GRP_AN" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_547][]" value="0" type="hidden"><input size="4" name="loop[looper_547][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_547][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_547][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_547][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> permit 239.193.35.0 0.0.0.255
</label><input style="display:none !important;" size="32" name="loop[looper_548][]" value=" permit 239.193.35.0 0.0.0.255
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_548][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ip access-list standard MCAST_GRP_AN</label><input style="display:none !important;" size="36" name="loop[looper_549][]" value="ip access-list standard MCAST_GRP_AN" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_549][]" value="0" type="hidden"><input size="4" name="loop[looper_549][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_549][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_549][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_549][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> permit 239.193.36.0 0.0.0.255
</label><input style="display:none !important;" size="32" name="loop[looper_550][]" value=" permit 239.193.36.0 0.0.0.255
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_550][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ip access-list standard SSM
</label><input style="display:none !important;" size="29" name="loop[looper_551][]" value="ip access-list standard SSM
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_551][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> permit 239.193.0.0 0.0.0.255
</label><input style="display:none !important;" size="31" name="loop[looper_552][]" value=" permit 239.193.0.0 0.0.0.255
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_552][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_553][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_553][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ip radius source-interface Loopback300
</label><input style="display:none !important;" size="40" name="loop[looper_554][]" value="ip radius source-interface Loopback300
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_554][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">logging source-interface Loopback300 vrf CELL_MGMT
</label><input style="display:none !important;" size="52" name="loop[looper_555][]" value="logging source-interface Loopback300 vrf CELL_MGMT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_555][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_556][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_556][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">logging host ipv6 2001:4888:a01:2130:a1:fef:0:115 vrf CELL_MGMT
</label><input style="display:none !important;" size="65" name="loop[looper_557][]" value="logging host ipv6 2001:4888:a01:2130:a1:fef:0:115 vrf CELL_MGMT
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_557][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_558][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_558][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">no ipv6 pim vrf LTE rp embedded
</label><input style="display:none !important;" size="33" name="loop[looper_559][]" value="no ipv6 pim vrf LTE rp embedded
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_559][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">no ipv6 pim rp embedded
</label><input style="display:none !important;" size="25" name="loop[looper_560][]" value="no ipv6 pim rp embedded
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_560][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_561][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_561][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">route-map DENY_DEFAULT deny 10
</label><input style="display:none !important;" size="32" name="loop[looper_562][]" value="route-map DENY_DEFAULT deny 10
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_562][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> match ip address prefix-list DEFAULT_ROUTE
</label><input style="display:none !important;" size="45" name="loop[looper_563][]" value=" match ip address prefix-list DEFAULT_ROUTE
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_563][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_564][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_564][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">route-map DENY_DEFAULT permit 20
</label><input style="display:none !important;" size="34" name="loop[looper_565][]" value="route-map DENY_DEFAULT permit 20
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_565][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_566][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_566][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">route-map NO_TRANSIT permit 10
</label><input style="display:none !important;" size="32" name="loop[looper_567][]" value="route-map NO_TRANSIT permit 10
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_567][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> set community no-advertise
</label><input style="display:none !important;" size="29" name="loop[looper_568][]" value=" set community no-advertise
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_568][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_569][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_569][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">snmp-server group sev1group v3 auth
</label><input style="display:none !important;" size="37" name="loop[looper_570][]" value="snmp-server group sev1group v3 auth
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_570][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">username sev1snmpuser password CwvjqqTT5tQj
</label><input style="display:none !important;" size="45" name="loop[looper_571][]" value="username sev1snmpuser password CwvjqqTT5tQj
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_571][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">snmp-server user sev1snmpuser sev1group v3 auth md5 CwvjqqTT5tQj access ipv6 SEV1_ACLv6
</label><input style="display:none !important;" size="89" name="loop[looper_572][]" value="snmp-server user sev1snmpuser sev1group v3 auth md5 CwvjqqTT5tQj access ipv6 SEV1_ACLv6
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_572][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">snmp-server community 2Y2LHTZP31 RO SNMP_ACL
</label><input style="display:none !important;" size="46" name="loop[looper_573][]" value="snmp-server community 2Y2LHTZP31 RO SNMP_ACL
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_573][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">snmp-server community cellbackhaul RW SNMP_ACL
</label><input style="display:none !important;" size="48" name="loop[looper_574][]" value="snmp-server community cellbackhaul RW SNMP_ACL
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_574][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">snmp-server trap link ietf
</label><input style="display:none !important;" size="28" name="loop[looper_575][]" value="snmp-server trap link ietf
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_575][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">snmp-server trap-source Loopback300
</label><input style="display:none !important;" size="37" name="loop[looper_576][]" value="snmp-server trap-source Loopback300
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_576][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">snmp-server source-interface informs Loopback300
</label><input style="display:none !important;" size="50" name="loop[looper_577][]" value="snmp-server source-interface informs Loopback300
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_577][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">snmp-server enable traps
</label><input style="display:none !important;" size="26" name="loop[looper_578][]" value="snmp-server enable traps
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_578][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_579][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_579][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_580][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_580][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">snmp-server host 2001:4888:a02:2105:a0:fef:0:5 vrf CELL_MGMT version 2c 2Y2LHTZP31
</label><input style="display:none !important;" size="84" name="loop[looper_581][]" value="snmp-server host 2001:4888:a02:2105:a0:fef:0:5 vrf CELL_MGMT version 2c 2Y2LHTZP31
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_581][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">snmp-server host 2001:4888:a03:210d:c0:fef:0:16 vrf CELL_MGMT version 2c 2Y2LHTZP31
</label><input style="display:none !important;" size="85" name="loop[looper_582][]" value="snmp-server host 2001:4888:a03:210d:c0:fef:0:16 vrf CELL_MGMT version 2c 2Y2LHTZP31
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_582][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">snmp-server host 2001:4888:a01:2106:a1:fef:0:203 vrf CELL_MGMT version 2c 2Y2LHTZP31
</label><input style="display:none !important;" size="86" name="loop[looper_583][]" value="snmp-server host 2001:4888:a01:2106:a1:fef:0:203 vrf CELL_MGMT version 2c 2Y2LHTZP31
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_583][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">snmp-server host 2001:4888:a03:210a:c0:fef:0:203 vrf CELL_MGMT version 2c 2Y2LHTZP31
</label><input style="display:none !important;" size="86" name="loop[looper_584][]" value="snmp-server host 2001:4888:a03:210a:c0:fef:0:203 vrf CELL_MGMT version 2c 2Y2LHTZP31
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_584][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">snmp ifmib ifindex persist
</label><input style="display:none !important;" size="28" name="loop[looper_585][]" value="snmp ifmib ifindex persist
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_585][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">snmp mib persist cbqos
</label><input style="display:none !important;" size="24" name="loop[looper_586][]" value="snmp mib persist cbqos
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_586][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">mpls ldp router-id Loopback0 force
</label><input style="display:none !important;" size="36" name="loop[looper_587][]" value="mpls ldp router-id Loopback0 force
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_587][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_588][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_588][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ipv6 access-list Drop_ANI_IPv6
</label><input style="display:none !important;" size="32" name="loop[looper_589][]" value="ipv6 access-list Drop_ANI_IPv6
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_589][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">deny udp any host </label><input style="display:none !important;" size="18" name="loop[looper_590][]" value="deny udp any host " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_590][]" value="0" type="hidden"><input size="7" name="loop[looper_590][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_590][]" value="1" type="hidden"><label class="readonly"> eq 4936 log
</label><input style="display:none !important;" size="14" name="loop[looper_590][]" value=" eq 4936 log
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_590][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">deny udp any host </label><input style="display:none !important;" size="18" name="loop[looper_591][]" value="deny udp any host " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_591][]" value="0" type="hidden"><input size="7" name="loop[looper_591][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_591][]" value="1" type="hidden"><label class="readonly"> eq 8888 log
</label><input style="display:none !important;" size="14" name="loop[looper_591][]" value=" eq 8888 log
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_591][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit any any
</label><input style="display:none !important;" size="16" name="loop[looper_592][]" value="permit any any
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_592][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_593][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_593][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ipv6 access-list SEV1_ACLv6
</label><input style="display:none !important;" size="29" name="loop[looper_594][]" value="ipv6 access-list SEV1_ACLv6
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_594][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">remark Q22017
</label><input style="display:none !important;" size="15" name="loop[looper_595][]" value="remark Q22017
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_595][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit ipv6 2001:4888:A02:1D10::/60 any
</label><input style="display:none !important;" size="41" name="loop[looper_596][]" value="permit ipv6 2001:4888:A02:1D10::/60 any
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_596][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit ipv6 2001:4888:A06:1D50::/60 any
</label><input style="display:none !important;" size="41" name="loop[looper_597][]" value="permit ipv6 2001:4888:A06:1D50::/60 any
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_597][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit ipv6 2001:4888:A03:1D10::/60 any
</label><input style="display:none !important;" size="41" name="loop[looper_598][]" value="permit ipv6 2001:4888:A03:1D10::/60 any
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_598][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit ipv6 2001:4888:2:1D10::/60 any
</label><input style="display:none !important;" size="39" name="loop[looper_599][]" value="permit ipv6 2001:4888:2:1D10::/60 any
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_599][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit ipv6 2001:4888:6:1D50::/60 any
</label><input style="display:none !important;" size="39" name="loop[looper_600][]" value="permit ipv6 2001:4888:6:1D50::/60 any
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_600][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit ipv6 2001:4888:3:1D10::/60 any
</label><input style="display:none !important;" size="39" name="loop[looper_601][]" value="permit ipv6 2001:4888:3:1D10::/60 any
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_601][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">deny ipv6 any any
</label><input style="display:none !important;" size="19" name="loop[looper_602][]" value="deny ipv6 any any
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_602][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_603][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_603][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ipv6 access-list SNMP_ACLv6
</label><input style="display:none !important;" size="29" name="loop[looper_604][]" value="ipv6 access-list SNMP_ACLv6
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_604][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">remark Version_Q12017
</label><input style="display:none !important;" size="23" name="loop[looper_605][]" value="remark Version_Q12017
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_605][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit ipv6 2001:4888:A01:2100::/56 any
</label><input style="display:none !important;" size="41" name="loop[looper_606][]" value="permit ipv6 2001:4888:A01:2100::/56 any
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_606][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit ipv6 2001:4888:A02:2100::/56 any
</label><input style="display:none !important;" size="41" name="loop[looper_607][]" value="permit ipv6 2001:4888:A02:2100::/56 any
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_607][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit ipv6 2001:4888:A03:2100::/56 any
</label><input style="display:none !important;" size="41" name="loop[looper_608][]" value="permit ipv6 2001:4888:A03:2100::/56 any
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_608][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit ipv6 2001:4888:A04:2100::/56 any
</label><input style="display:none !important;" size="41" name="loop[looper_609][]" value="permit ipv6 2001:4888:A04:2100::/56 any
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_609][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit ipv6 2001:4888:A05:2100::/56 any
</label><input style="display:none !important;" size="41" name="loop[looper_610][]" value="permit ipv6 2001:4888:A05:2100::/56 any
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_610][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit ipv6 2001:4888:A06:2100::/56 any
</label><input style="display:none !important;" size="41" name="loop[looper_611][]" value="permit ipv6 2001:4888:A06:2100::/56 any
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_611][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit ipv6 2001:4888:A07:2100::/56 any
</label><input style="display:none !important;" size="41" name="loop[looper_612][]" value="permit ipv6 2001:4888:A07:2100::/56 any
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_612][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit ipv6 2001:4888:A08:2100::/56 any
</label><input style="display:none !important;" size="41" name="loop[looper_613][]" value="permit ipv6 2001:4888:A08:2100::/56 any
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_613][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit ipv6 2001:4888:A0E:2100::/56 any
</label><input style="display:none !important;" size="41" name="loop[looper_614][]" value="permit ipv6 2001:4888:A0E:2100::/56 any
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_614][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">permit ipv6 2001:4888:A0F:2100::/56 any
</label><input style="display:none !important;" size="41" name="loop[looper_615][]" value="permit ipv6 2001:4888:A0F:2100::/56 any
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_615][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> deny ipv6 any any
</label><input style="display:none !important;" size="20" name="loop[looper_616][]" value=" deny ipv6 any any
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_616][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_617][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_617][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">banner motd ^
</label><input style="display:none !important;" size="15" name="loop[looper_618][]" value="banner motd ^
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_618][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">***************************************************************************
</label><input style="display:none !important;" size="77" name="loop[looper_619][]" value="***************************************************************************
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_619][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">                            NOTICE TO USERS
</label><input style="display:none !important;" size="45" name="loop[looper_620][]" value="                            NOTICE TO USERS
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_620][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">This is a private computer system and is for authorized use only. Users
</label><input style="display:none !important;" size="73" name="loop[looper_621][]" value="This is a private computer system and is for authorized use only. Users
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_621][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">(authorized or unauthorized) have no explicit or implicit expectation of
</label><input style="display:none !important;" size="74" name="loop[looper_622][]" value="(authorized or unauthorized) have no explicit or implicit expectation of
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_622][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">privacy.
</label><input style="display:none !important;" size="10" name="loop[looper_623][]" value="privacy.
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_623][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">Any or all uses of this system and all files on this system may be
</label><input style="display:none !important;" size="68" name="loop[looper_624][]" value="Any or all uses of this system and all files on this system may be
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_624][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">intercepted, monitored, recorded, copied, audited, inspected, and disclosed
</label><input style="display:none !important;" size="77" name="loop[looper_625][]" value="intercepted, monitored, recorded, copied, audited, inspected, and disclosed
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_625][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">to authorized site and law enforcement personnel, as well as authorized
</label><input style="display:none !important;" size="73" name="loop[looper_626][]" value="to authorized site and law enforcement personnel, as well as authorized
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_626][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">officials of other agencies, both domestic and foreign. By using this
</label><input style="display:none !important;" size="71" name="loop[looper_627][]" value="officials of other agencies, both domestic and foreign. By using this
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_627][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">system, the user consents to such interception, monitoring, recording,
</label><input style="display:none !important;" size="72" name="loop[looper_628][]" value="system, the user consents to such interception, monitoring, recording,
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_628][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">copying, auditing, inspection, and disclosure at the discretion of the
</label><input style="display:none !important;" size="72" name="loop[looper_629][]" value="copying, auditing, inspection, and disclosure at the discretion of the
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_629][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">authorized site or personnel.
</label><input style="display:none !important;" size="31" name="loop[looper_630][]" value="authorized site or personnel.
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_630][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">Unauthorized or improper use of this system may result in administrative
</label><input style="display:none !important;" size="74" name="loop[looper_631][]" value="Unauthorized or improper use of this system may result in administrative
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_631][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">disciplinary action and civil and criminal penalties. By continuing to
</label><input style="display:none !important;" size="72" name="loop[looper_632][]" value="disciplinary action and civil and criminal penalties. By continuing to
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_632][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">use this system you indicate your awareness of and consent to these terms
</label><input style="display:none !important;" size="75" name="loop[looper_633][]" value="use this system you indicate your awareness of and consent to these terms
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_633][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">and conditions of use. LOG OFF IMMEDIATELY if you do not agree to the
</label><input style="display:none !important;" size="71" name="loop[looper_634][]" value="and conditions of use. LOG OFF IMMEDIATELY if you do not agree to the
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_634][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">conditions stated in this warning.
</label><input style="display:none !important;" size="36" name="loop[looper_635][]" value="conditions stated in this warning.
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_635][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">$(hostname) vty $(line)
</label><input style="display:none !important;" size="25" name="loop[looper_636][]" value="$(hostname) vty $(line)
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_636][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">*****************************************************************************
</label><input style="display:none !important;" size="79" name="loop[looper_637][]" value="*****************************************************************************
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_637][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">^
</label><input style="display:none !important;" size="3" name="loop[looper_638][]" value="^
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_638][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_639][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_639][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">line con 0
</label><input style="display:none !important;" size="12" name="loop[looper_640][]" value="line con 0
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_640][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> exec-timeout 90 0
</label><input style="display:none !important;" size="20" name="loop[looper_641][]" value=" exec-timeout 90 0
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_641][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> no password
</label><input style="display:none !important;" size="14" name="loop[looper_642][]" value=" no password
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_642][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> login authentication console-auth
</label><input style="display:none !important;" size="36" name="loop[looper_643][]" value=" login authentication console-auth
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_643][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> history size 256
</label><input style="display:none !important;" size="19" name="loop[looper_644][]" value=" history size 256
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_644][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> stopbits 1
</label><input style="display:none !important;" size="13" name="loop[looper_645][]" value=" stopbits 1
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_645][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> privilege level 15
</label><input style="display:none !important;" size="21" name="loop[looper_646][]" value=" privilege level 15
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_646][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">login
</label><input style="display:none !important;" size="7" name="loop[looper_647][]" value="login
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_647][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_648][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_648][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">line vty 0 15
</label><input style="display:none !important;" size="15" name="loop[looper_649][]" value="line vty 0 15
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_649][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> exec-timeout 30 0
</label><input style="display:none !important;" size="20" name="loop[looper_650][]" value=" exec-timeout 30 0
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_650][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> no password
</label><input style="display:none !important;" size="14" name="loop[looper_651][]" value=" no password
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_651][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> history size 256
</label><input style="display:none !important;" size="19" name="loop[looper_652][]" value=" history size 256
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_652][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> transport input ssh
</label><input style="display:none !important;" size="22" name="loop[looper_653][]" value=" transport input ssh
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_653][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> transport output ssh
</label><input style="display:none !important;" size="23" name="loop[looper_654][]" value=" transport output ssh
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_654][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_655][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_655][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">exception crashinfo buffersize 128
</label><input style="display:none !important;" size="36" name="loop[looper_656][]" value="exception crashinfo buffersize 128
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_656][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">ntp source Loopback300
</label><input style="display:none !important;" size="24" name="loop[looper_657][]" value="ntp source Loopback300
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_657][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ntp server vrf CELL_MGMT 2001:4888:</label><input style="display:none !important;" size="35" name="loop[looper_658][]" value="ntp server vrf CELL_MGMT 2001:4888:" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_658][]" value="0" type="hidden"><input size="14" name="loop[looper_658][]" value="XXXX:XXXX:XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_658][]" value="1" type="hidden"><label class="readonly">:22:: prefer
</label><input style="display:none !important;" size="14" name="loop[looper_658][]" value=":22:: prefer
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_658][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly">ntp server vrf CELL_MGMT </label><input style="display:none !important;" size="25" name="loop[looper_659][]" value="ntp server vrf CELL_MGMT " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_659][]" value="0" type="hidden"><input size="7" name="loop[looper_659][]" value="X.X.X.X" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_659][]" value="1" type="hidden"><label class="readonly">
</label><input style="display:none !important;" size="2" name="loop[looper_659][]" value="
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_659][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">!
</label><input style="display:none !important;" size="3" name="loop[looper_660][]" value="!
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_660][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">event manager applet LOOP_GIG authorization bypass
</label><input style="display:none !important;" size="52" name="loop[looper_661][]" value="event manager applet LOOP_GIG authorization bypass
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_661][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> event tag EVEN_BDI_UP syslog pattern "%LINEPROTO-5-UPDOWN: Line protocol on Interface BDI</label><input style="display:none !important;" size="90" name="loop[looper_662][]" value=" event tag EVEN_BDI_UP syslog pattern &quot;%LINEPROTO-5-UPDOWN: Line protocol on Interface BDI" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_662][]" value="0" type="hidden"><input size="4" name="loop[looper_662][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_662][]" value="1" type="hidden"><label class="readonly">, changed state to up.*"
</label><input style="display:none !important;" size="26" name="loop[looper_662][]" value=", changed state to up.*&quot;
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_662][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> event tag ODD_BDI_UP syslog pattern "%LINEPROTO-5-UPDOWN: Line protocol on Interface BDI</label><input style="display:none !important;" size="89" name="loop[looper_663][]" value=" event tag ODD_BDI_UP syslog pattern &quot;%LINEPROTO-5-UPDOWN: Line protocol on Interface BDI" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_663][]" value="0" type="hidden"><input size="4" name="loop[looper_663][]" value="YYYY" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_663][]" value="1" type="hidden"><label class="readonly">, changed state to up.*" maxrun 360
</label><input style="display:none !important;" size="37" name="loop[looper_663][]" value=", changed state to up.*&quot; maxrun 360
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_663][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> trigger
</label><input style="display:none !important;" size="10" name="loop[looper_664][]" value=" trigger
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_664][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly">  correlate event ODD_BDI_UP or event EVEN_BDI_UP
</label><input style="display:none !important;" size="51" name="loop[looper_665][]" value="  correlate event ODD_BDI_UP or event EVEN_BDI_UP
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_665][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> action 100 cli command "enable"
</label><input style="display:none !important;" size="34" name="loop[looper_666][]" value=" action 100 cli command &quot;enable&quot;
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_666][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> action 105 syslog priority informational msg "Applet LOOP_GIG has been triggered"
</label><input style="display:none !important;" size="84" name="loop[looper_667][]" value=" action 105 syslog priority informational msg &quot;Applet LOOP_GIG has been triggered&quot;
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_667][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> action 110 wait 180
</label><input style="display:none !important;" size="22" name="loop[looper_668][]" value=" action 110 wait 180
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_668][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> action 115 cli command "ethernet loopback start local interface GigabitEthernet0/0/0 service instance </label><input style="display:none !important;" size="103" name="loop[looper_669][]" value=" action 115 cli command &quot;ethernet loopback start local interface GigabitEthernet0/0/0 service instance " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_669][]" value="0" type="hidden"><input size="4" name="loop[looper_669][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_669][]" value="1" type="hidden"><label class="readonly"> external dot1q </label><input style="display:none !important;" size="16" name="loop[looper_669][]" value=" external dot1q " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_669][]" value="0" type="hidden"><input size="4" name="loop[looper_669][]" value="XXXX" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_669][]" value="1" type="hidden"><label class="readonly"> destination mac-address 2222.2222.2222 timeout  none" pattern "yes"
</label><input style="display:none !important;" size="70" name="loop[looper_669][]" value=" destination mac-address 2222.2222.2222 timeout  none&quot; pattern &quot;yes&quot;
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_669][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> action 120 cli command "yes"
</label><input style="display:none !important;" size="31" name="loop[looper_670][]" value=" action 120 cli command &quot;yes&quot;
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_670][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-editable-fields"><label class="readonly"> action 125 cli command "ethernet loopback start local interface GigabitEthernet0/0/0 service instance </label><input style="display:none !important;" size="103" name="loop[looper_671][]" value=" action 125 cli command &quot;ethernet loopback start local interface GigabitEthernet0/0/0 service instance " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_671][]" value="0" type="hidden"><input size="4" name="loop[looper_671][]" value="YYYY" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_671][]" value="1" type="hidden"><label class="readonly"> external dot1q </label><input style="display:none !important;" size="16" name="loop[looper_671][]" value=" external dot1q " class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_671][]" value="0" type="hidden"><input size="4" name="loop[looper_671][]" value="YYYY" class="form-control cellsitech-configtxtinp border border-dark" type="text"><input name="hidden[looper_671][]" value="1" type="hidden"><label class="readonly"> destination mac-address 2222.2222.2222 timeout  none" pattern "yes"
</label><input style="display:none !important;" size="70" name="loop[looper_671][]" value=" destination mac-address 2222.2222.2222 timeout  none&quot; pattern &quot;yes&quot;
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_671][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> action 130 cli command "yes"
</label><input style="display:none !important;" size="31" name="loop[looper_672][]" value=" action 130 cli command &quot;yes&quot;
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_672][]" value="0" type="hidden"></span></div><div class="form-group"><span class="form-non-editable-fields"><label class="readonly"> action 135 syslog priority informational msg "Applet LOOP_GIG completed"
</label><input style="display:none !important;" size="75" name="loop[looper_673][]" value=" action 135 syslog priority informational msg &quot;Applet LOOP_GIG completed&quot;
" class="form-control cellsitech-configtxtdisp" type="text"><input name="hidden[looper_673][]" value="0" type="hidden"></span></div>
                </form></div>
                <br>
                <div class="form-group"> <input class="btn" name="action" value="Download Script" type="submit"></div>

                </div>

            <p></p>
          </div>
        </div>
<!-- /template name content -->

<div class="row">
  <div class="col">
    <button type="submit" class="btn btn-primary btn-lg">DOWNLOAD</button>
  </div>
</div>
<!-- /right side -->
<!-- /script output -->

    </div>
<!-- /backup management content row -->
				</div>
			</section>
			<!-- /.content -->
		</div>
	</div>
	<!-- container-fluid -->

        <?php include ('footer.php'); ?> 
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

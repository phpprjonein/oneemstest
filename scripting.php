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
					<div class="panel panel-default">
					<!-- backup management content row -->
    <div class="row">

<!-- router selection content row -->
      <div class="col-4">
        <div class="jf-form">

<!-- router scripting selection form div -->
          <form data-licenseKey="" name="wizard-75a3c2" id="wizard-75a3c2" action='scripting2.php' method='GET' enctype='multipart/form-data' novalidate autocomplete="on">
            <h5>SELECT TEMPLATE TYPE TO CREATE:</h5>
            <input type="hidden" name="method" value="validateForm">
            <input type="hidden" id="serverValidationFields" name="serverValidationFields" value= 	"">

<!-- select purpose options -->
            <?php 
				$configtmpddwndata =getconfigtempldpdwntbl(); 
				
			?>
            <div class="form-group f4 required" data-fid="f4">
              <label class="control-label" for="f4">Select Purpose</label>
              <select class="form-control custom-select" id="f4" name="f4" data-rule-required="true">
                <option value="">- SELECT PURPOSE -</option>
				<?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
				  <!--<option value="asr920">ASR 920</option>  -->
				  <option value="<?php echo $val['purpose'];?>"><?php echo $val['purpose']; ?></option> 
				 <?php }; ?>
              </select>
            </div>
<!-- /select purpose options -->

<!-- select device series options -->
            <div class="form-group f7 required" data-fid="f7">
              <label class="control-label" for="f7">Select Device Series</label>
              <select class="form-control custom-select" id="f7" name="f7" data-rule-required="true">
			  <?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
				<option value="<?php echo $val['deviceseries'];?>"><?php echo $val['deviceseries']; ?></option> 
			 <?php }; ?>	
              </select>
            </div>
<!-- /select device series options -->

<!-- select OS version options -->
            <div class="form-group f8 required" data-fid="f8">
              <label class="control-label" for="f8">Select OS Version</label>
              <select class="form-control custom-select" id="f8" name="f8" data-rule-required="true">
                <?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
				<option value="<?php echo $val['nodeVersion'];?>"><?php echo $val['nodeVersion']; ?></option> 
			 <?php }; ?>		
              </select>
            </div>
<!-- /select OS version options -->

<!-- select RAN vendor options --> 
            <div class="form-group f9 required" data-fid="f9">
              <label class="control-label" for="f9">Select RAN vendor</label>
              <select class="form-control custom-select" id="f9" name="f9" data-rule-required="true">
			    <?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
                <option value="<?php echo $val['ranvendor'];?>"><?php echo $val['ranvendor']; ?></option> 
				<?php }; ?>		
              </select>
            </div>
<!-- /select RAN vendor options -->

<!-- select RAN vendor options -->
            <div class="form-group f10 required" data-fid="f10">
              <label class="control-label" for="f10">Select Script Type</label>
              <select class="form-control custom-select" id="f10" name="f10" data-rule-required="true">
			   <?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
                <option value="<?php echo $val['scripttype'];?>"><?php echo $val['scripttype']; ?></option> 
				<?php }; ?>		
              </select>
            </div>
<!-- /select RAN vendor options -->

<!-- select region options --> 
            <div class="form-group f11 required" data-fid="f11">
              <label class="control-label" for="f11">Select Region</label>
              <select class="form-control custom-select" id="f11" name="f11" data-rule-required="true">
			  <?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
                 <option value="<?php echo $val['region'];?>"><?php echo $val['region']; ?></option> 
			   <?php }; ?>		
              </select>
            </div>
<!-- /select region options -->

<!-- select switch type options -->
            <div class="form-group f12 required" data-fid="f12">
              <label class="control-label" for="f12">Select Switch Name</label>
              <select class="form-control custom-select" id="f12" name="f12" data-rule-required="true">
			  <?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
                <option value="<?php echo $val['switch_name'];?>"><?php echo $val['switch_name']; ?></option> 
			   <?php }; ?>			
              </select>
            </div>
<!-- /select switch type options -->

<!-- select market options -->
            <div class="form-group f13 required" data-fid="f13">
              <label class="control-label" for="f13">Select Market</label>
			  <?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
              <select class="form-control custom-select" id="f13" name="f13" data-rule-required="true">
                <option value="<?php echo $val['market'];?>"><?php echo $val['market']; ?></option> 
			  <?php }; ?>				
              </select>
            </div>
<!-- /select market options -->

<!-- submit button -->
            <div class="form-group submitf0" data-fid="f0" style="position: relative;">
              <!-- <label class="control-label sr-only" for="f0" style="display: block;">Submit Button</label> -->
              <button type="submit" class="btn btn-primary btn-lg" style="z-index: 1;">NEXT</button>
            </div>
<!-- /submit button -->

            <div class="clearfix"></div>
          </form>
<!-- /router scripting selection form div -->

        </div>
      </div>
<!-- /router selection content row -->


<!-- right side -->
<!-- script output -->
      <div class="col">

<!-- template name content -->
        <div class="row">
          <div class="col">
            <label for="inputRegion">TEMPLATE:</label>
            <small><b>Golden_ASR920_15.6_ALL_standalone_GreatLakes_AKRON_opw_021418</b></small>
          </div>
        </div>
<!-- /template name content -->


<!-- browse / upload template -->
        <div class="row">
          <div class="form-group">
            <label for="exampleInputFile">Select a file to upload</label>
            <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
            <small id="fileHelp" class="form-text text-muted">Please upload <b>.txt</b> files with a maximum size of 2 MB.</small>
          </div>
        </div>
<!-- /browse / upload template -->

        <div class="row">
          <div class="col">
            <button type="submit" class="btn btn-primary btn-lg">UPLOAD</button>
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
        "": false,
        "action": "disable",
        "selector": "f7",
        "match": "any",
        "rules": [
            {
                "": false,
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

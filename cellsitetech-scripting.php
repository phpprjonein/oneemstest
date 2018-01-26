<?php

include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';

//Static variable values set
if (isset($_GET['clear']) ) {
  if (strtolower($_GET['clear']) == 'search') {
    unset($_SESSION['search_term']);
  }
}

user_session_check();
 check_user_authentication('1'); //cellsite tech type user 

    $page_title = 'OneEMS';
 
?>
<!DOCTYPE html>
<html>
    <head>
   <?php include("includes.php");  ?>
   <script src="resources/js/cellsitetech_user_devices.js?t=".<?php echo date('his'); ?>></script>
 </head>
     <body class="hold-transition skin-blue sidebar-mini ownfont">
        <!-- Modal HTML -->
        
        <div id="mycmdModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Content will be loaded here from "remote.php" file -->
            </div>
        </div>
        </div>

        <div class="container-fluid">
            <?php include ('menu.php'); ?> 

            <!-- Content Wrapper. Contains page content -->
            <div class="content">
                <!-- Main content -->
                <section class="content"> 
                  <div class="col-md-12">
                      <div class="panel"> 
                          <div class="panel-info">
                            <!-- Page title -->
							<!---
                            <div class="panel-heading"> My Devices List </div>
							-->
                          </div>                  
                          
 							<div id="mylist" class="panel-heading" style = "height:560px;"><b>Coming soon.</b>
							
							<!-- backup management content row -->
    <div class="row">

<!-- router selection content row -->
      <div class="col-4">
        <div class="jf-form">

<!-- router scripting selection form div -->
          <form data-licenseKey="" name="wizard-75a3c2" id="wizard-75a3c2" action='admin.php' method='post' enctype='multipart/form-data' novalidate autocomplete="on">
            <input type="hidden" name="method" value="validateForm">
            <input type="hidden" id="serverValidationFields" name="serverValidationFields" value="">

<!-- select router model options -->
            <div class="form-group f4 required" data-fid="f4">
              <label class="control-label" for="f4">Select Device Model</label>
              <select class="form-control custom-select" id="f4" name="f4" data-rule-required="true">
                <option value="">- SELECT MODEL -</option>
                <option value="asr920">ASR 920</option>
              </select>
            </div>
<!-- /select router model options -->

<!-- select router model options -->
            <div class="form-group f7 required" data-fid="f7">
              <label class="control-label" for="f7">Select OS</label>
              <select class="form-control custom-select" id="f7" name="f7" data-rule-required="true">
                <option></option>
              </select>
            </div>
<!-- /select router model options -->

<!-- select template options -->
            <div class="form-group f8 required" data-fid="f8">
              <!-- <label class="control-label" for="f8">Select OS Configuration</label> -->
              <label class="control-label" for="f8">Select Template Type</label>
              <select class="form-control custom-select" id="f8" name="f8" data-rule-required="true">
                <option></option>
              </select>
            </div>
<!-- /select template options -->

<!-- select region options -->
            <div class="form-group f9 required" data-fid="f9">
              <label class="control-label" for="f9">Select Region</label>
              <select class="form-control custom-select" id="f9" name="f9" data-rule-required="true">
                <option></option>
              </select>
            </div>
<!-- /select region options -->

<!-- select RAN vendor options -->
            <div class="form-group f10 required" data-fid="f10">
              <label class="control-label" for="f10">Select RAN Vendor</label>
              <select class="form-control custom-select" id="f10" name="f10" data-rule-required="true">
                <option></option>
              </select>
            </div>
<!-- /select RAN vendor options -->

<!-- select service options -->
            <div class="form-group f11 required" data-fid="f11">
              <label class="control-label" for="f11">Select Service</label>
              <select class="form-control custom-select" id="f11" name="f11" data-rule-required="true">
                <option></option>
              </select>
            </div>
<!-- /select service options -->

<!-- select site type options -->
            <div class="form-group f12 required" data-fid="f12">
              <label class="control-label" for="f12">Select Site Type</label>
              <select class="form-control custom-select" id="f12" name="f12" data-rule-required="true">
                <option></option>
              </select>
            </div>
<!-- /select site type options -->

<!-- submit button -->
            <div class="form-group submitf0" data-fid="f0" style="position: relative;">
              <label class="control-label sr-only" for="f0" style="display: block;">Submit Button</label>
              <button type="submit" class="btn btn-primary btn-lg" style="z-index: 1;">SELECT TEMPLATE</button>
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

<!-- template table content -->
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Template Name</th>
              <th scope="col">Select Template(s)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Template ABC</td>
              <td>
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                </label>
              </td>
            </tr>
            <tr>
              <td>Template DEF</td>
              <td>
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                </label>
              </td>
            </tr>
            <tr>
              <td>Template XYZ</td>
              <td>
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                </label>
              </td>
            </tr>
            <tr>
              <td>Template 123</td>
              <td>
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                </label>
              </td>
            </tr>
            <tr>
              <td>Template ABC</td>
              <td>
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                </label>
              </td>
            </tr>
            <tr>
              <td>Template DEF</td>
              <td>
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                </label>
              </td>
            </tr>
            <tr>
              <td>Template XYZ</td>
              <td>
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                </label>
              </td>
            </tr>
            <tr>
              <td>Template 123</td>
              <td>
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                </label>
              </td>
            </tr>
          </tbody>
        </table>

<!-- pagination -->
        <nav aria-label="Pagination example">
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
              </a>
            </li>
          </ul>
        </nav>
<!-- /pagination -->

<!-- /template table content -->

<!-- /right side -->
<!-- /script output -->

    </div>
<!-- /backup management content row -->
							
							</div> 
                        <!-- /.box-body -->
                      </div>
                  </div> 
                </section> <!-- /.content -->
              </div>
            <!-- /.content-wrapper --> 
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <?php include ('footer.php'); ?> 
    </body>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
	<script src="http://localhost/oneemstest/resources/js/vendor.js" ></script>
<script src="http://localhost/oneemstest/resources/js/form-wizard.js?ver=v2.1.0&id=wizard-75a3c2"></script>


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
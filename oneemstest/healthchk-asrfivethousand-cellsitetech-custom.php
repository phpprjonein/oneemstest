<?php
include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';
global $APPCONFIG;
?>
<script type="text/javascript">
$(document).ready(function(){
			$(document).on('click', '.anchorcmd', function(event) {
            		var myModal = $('#mycmdModal');
            		myModal.find('.modal-content').css('border', 'none'); 
                    //myModal.find('.modal-content').html('<div id="ajax_loader" style="position: absolute; left: 50%; top: 50%; display: start;"><img src="resources/img/ajax-loader.gif"></img></div>');
                    myModal.find('.modal-content').html('<div id="ajax_loader" style="position: absolute; left: 30%; top: 50%; display: start;">Loading... <div class="fa fa-refresh fa-spin" style="font-size:24px; text-align:center;"></div></div>');
                    myModal.modal('show'); 
                	$.ajax({url: $(this).attr('href'), success: function(result){
                		var myModal = $('#mycmdModal');
                		myModal.find('.modal-content').css('border', '1px solid rgba(0, 0, 0, 0.2)');
                        myModal.find('.modal-content').html(result);
                        myModal.modal('show');
                        
                    }});
                     $('#mycmdModal').removeData()   
                     return false;                  
              });
            });        
</script>
<?php
$userid = $_GET['userid'];
$deviceid = $_GET['deviceid'];
$lastupdated = date('Y-m-d H:i:s');
if (count($_GET['category']) > 0) {
    $category_imp = implode(',', $_GET['category']);
    /* Custom HealthCheck API API Call */
    $devicetype = 'ios';
    $url_final = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/custom/Cisco/'.$_GET['deviceseries'].'/'.$devicetype.'/'.$_GET['version'].'/'.$deviceid.'/'.$category_imp;
    //$url_final = 'http:///njbboemsda3v.nss.vzwnet.com:8085/healthcheck/custom/Cisco/'.$_GET['deviceseries'].'/'.$devicetype.'/'.$_GET['version'].'/'.$deviceid.'/'.$category_imp;
    // $url_final = 'http://njbboemsda3v.nss.vzwnet.com:8080/healthcheck/' . $devicetype . '/custom/' . $deviceid . '/' . $category_imp;
    // $url_final = 'http://njbboemsda3v.nss.vzwnet.com:8080/healthcheck/'.$devicetype.'/custom/'.$deviceid.'/1,2,3';
   $filename = 'customhealthcheck';
     $msg = $url_final;
   logToFile($filename, $msg);
    $output = sendPostData($url_final);
    /*
      $output = '{
         "extract_redundancy": {
         "R": 0,
         "message": "extract_redundancy new"
         },
         "extract_process_cpu": {
         "R": 0,
         "message": "extract_process_cpu new"
         }
      }';
    */  
}
//print_r($output); die;
$healthchktype = 'Custom';
ems_update_healthchk_info($deviceid, $output, $lastupdated);
$output = json_decode($output, 1);
$_SESSION['deviceidswusr'] = $deviceid;
?>
<?php include_once 'healthchk-asrfivethousand-blk-inc.php';?>

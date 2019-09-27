<?php
include "classes/db2.class.php";
include 'functions.php';
global $APPCONFIG;
?>
<?php if(!isset($_GET['resultversion'])){ ?>
<script type="text/javascript">
$(document).ready(function(){
				$(document).on('click', '.anchorcmd', function(event) {
            		var myModal = $('#mycmdModal');
            		myModal.find('.modal-content').css('border', 'none');
                    myModal.find('.modal-content').html('<div id="ajax_loader" style="position: absolute; left: 50%; top: 50%; display: start;"><img src="resources/img/ajax-loader.gif"></img></div>');
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
<?php }?>
    <?php
    // Python API Request using curl Begins
    $userid = $_GET['userid'];

    if (isset($_GET['deviceid']) && ! empty($_GET['deviceid'])) {
        $deviceid = $_GET['deviceid'];
    } elseif (isset($_GET['deviceip']) && ! empty($_GET['deviceip'])) {
        $deviceid = loaddeviceidfromdeviceip($_GET['deviceip']);
    }

    $devicetype = 'TiMOS';
    //$url_send = "http://txaroemsda2z.nss.vzwnet.com:8080/healthcheck/";
    $deviceid = $_GET['deviceid'];
    //$url_final = 'http://njbboemsda3v.nss.vzwnet.com:8080/healthcheck/' . $devicetype . '/' . $deviceid;
    $url_final = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/Nokia/'.$_GET['deviceseries'].'/'.$devicetype.'/'.$_GET['version'].'/'.$deviceid;
    $output = sendPostData($url_final);
    $lastupdated = date('Y-m-d H:i:s');
    
    //$output = '{"ARP": {"message": "No of ARP Entries: 5", "R": 0}, "xconnect": {"message": "Coming Soon", "R": 0}, "Log Entries": {"message": "Log-Id 99: 93609, Log-Id 100: 4799", "R": 0}, "MPLS Interfaces": {"message": "mpls interfaces: All Ok", "R": 0}, "BFD Sessions(S)": {"message": "All 4 BFD\'s are UP", "R": 0}, "Platform": {"message": "system information: NWCSDEBGT1A-P-AL-0390-01,7705 SAR-8 v2", "R": 0}, "interfacecounters": {"message": " ", "R": 0}, "Interface States": {"message": "Interface status: All OK", "R": 0}, "bootstatement": {"message": "Bof matches the Version: TiMOS-B-7.0.R5", "R": 0}, "osversion": {"message": "TiMOS-B-7.0.R5", "R": 0}, "cpuutilization": {"message": "18.08%", "R": 0}, "Static Routes": {"message": "No. of Static Routes: 4", "R": 0}, "Service Service-using": {"message": "No of Up-Services: 8, No of Down-services: 0", "R": 0}, "MPLS Neighbors": {"message": "MPLS Neighbors: All Ok", "R": 0}}';
    
    ems_update_healthchk_info($deviceid, $output, $lastupdated);
    $output = json_decode($output, true);
    
    ?>
    <?php 
    if(isset($_GET['resultversion']) && $_GET['resultversion'] == 'short'){
        if (($output['error']) || ($healthchktype == 'Custom' && count($_GET['category']) == 0)) {
            echo 'Failed';
        } else {
            echo 'Reached';
        }
        exit;
    }
    ?>
<?php include_once 'healthchk-nokiasevensevenzerofive-blk-inc.php';?>

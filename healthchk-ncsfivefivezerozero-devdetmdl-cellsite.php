<?php
include_once 'config/global.php';
global $APPCONFIG;
$command = $_GET['commandname'];
$deviceid = $_GET['deviceid'];
$deviceseries = $_GET['deviceseries'];
$version = $_GET['version'];
// $deviceid = 2;

switch ($command) {
    
    case 'extract_version':
        // $url=$APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/2///
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/8';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_version';
        break;
    case 'extract_cpu_utilization':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/5';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_cpu_utilization';
        break;
    case 'extract_memory_statistics':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/5';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_memory_statistics';
        break;
    // case 'showversion':
    case 'extract_platform':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/2';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_platform';
        break;
    case 'extract_alarms_brief':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/3';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_alarms_brief';
        break;
    case 'extract_interfaces':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/4';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_interfaces';
        break;
    case 'extract_ping':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/6';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_ping';
        break;
    case 'extract_bfd_session':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/10';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_bfd_session';
        break;
    case 'extract_logging':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/9';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_logging';
        break;
    case 'extract_vrf_all':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/7';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_vrf_all';
        break;
    case 'extract_ip_interface_brief':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/12';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_ip_interface_brief';
        break;
    case 'extract_mpls_interfaces':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/11';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_mpls_interfaces';
        break;
    case 'extract_bgp_vpnv4_unicast_summary':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/17';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_bgp_vpnv4_unicast_summary';
        break;
    default:
        break;
}
/* Ends */
?>
<div class="modal-header">
	<h5 class="modal-title" id="exampleModalLabel">Device Console Output  - Command Issued - <?php echo $_GET['commandname'];?></h5>
	<button type="button" class="close" data-dismiss="modal"
		aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">    
<?php
if (isset($url)) {
    $data = @file_get_contents($url);
} else
    $data = "CLI command needs is in progress123." . $command . $device . $url;

echo "<span style='font-family:courier;font-size:12px;font-weight:500;'> $data</span>";
?>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

</div>

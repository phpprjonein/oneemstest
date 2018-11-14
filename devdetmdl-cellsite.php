<?php
include_once 'config/global.php';
global $APPCONFIG;
$command = $_GET['commandname'];
$deviceid = $_GET['deviceid'];
$deviceseries = $_GET['deviceseries'];
$version = $_GET['version'];
// $deviceid = 2;

switch ($command) {
    
    case 'freememory':
        // $url=$APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/2///
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/8';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_memory_statistics';
        break;
    case 'buffers':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/5';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_buffers';
        break;
    // case 'showversion':
    case 'iosversion':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/2';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_version_ios';
        break;
    case 'configregister':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/3';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_version_config';
        break;
    case 'environment':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/4';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_alarms';
        break;
    case 'platform':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/6';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_show_platform';
        break;
    case 'bfdsession':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/10';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_bfd_neighbour';
        break;
    case 'interfacestates':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/9';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_show_brief';
        break;
    case 'showinterfaces':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/7';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_count_interfaces';
        break;
    case 'mplsinterfaces':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/12';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_mlps_interfaces';
        break;
    case 'mplsneighbors':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/11';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_mlps_ldp_neighbour';
        break;
    case 'bgpvsixroutes':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/17';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_bgpv6_routes';
        break;
  /*  case 'show-running-config-|-i-boot':
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/16';
        break;
  */
    case 'cpuutilization':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/1';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_process_cpu';
        break;
    case 'vrfstates':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/23';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_show_vrf';
        break;
    case 'twothsndbyteping':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/22';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_ping';
        break;
    case 'bgpvsixneighbours':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/14';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_bgp_v6_neighbour';
        break;
    case 'bgpvfourneighbors':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/13';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_bgpv4_neighbour';
        break;
    case 'xconnect':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/20';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_xconnect_all';
        break;
    // case 'bgpvfourroutes':
    case 'ran':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/19';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_show_ip_bgp_vpnv4_vrf_ran';
        break;
    case 'bootstatement':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/16';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_show_running_config';
        break;
    case 'interfacecounters':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/7';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_count_interfaces';
        break;
    case 'logentries':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/15';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_show_logging';
        break;
    case 'bandwidth':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/15';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_bandwidth';
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

<?php
$command = $_GET['commandname'];
$deviceid = $_GET['deviceid'];
$deviceseries = $_GET['deviceseries'];
$version = $_GET['version'];
// $deviceid = 2;

switch ($command) {
    
    case 'freememory':
        // $url='http://10.134.179.82:8080/healthcheck/ios/2///
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/8';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_memory_statistics';
        break;
    case 'buffers':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/5';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_buffers';
        break;
    // case 'showversion':
    case 'iosversion':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/2';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_version_config';       //CHECK
        break;
    case 'configregister':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/3';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_version_config';
        break;
    case 'environment':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/4';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_alarms';
        break;
    case 'platform':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/6';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_show_platform';
        break;
    case 'bfdsession':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/10';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_bfd_neighbour';
        break;
    case 'interfacestates':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/9';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_count_interfaces'; //CHECK
        break;
    case 'showinterfaces':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/7';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_count_interfaces';
        break;
    case 'mplsinterfaces':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/12';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_mlps_interfaces';
        break;
    case 'mplsneighbors':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/11';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_mpls_ldp_neighbor';
        break;
    case 'bgpvsixroutes':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/17';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_bgpv6_routes';
        break;
    case 'show-running-config-|-i-boot':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/16';
        break;
    case 'cpuutilization':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/1';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_process_cpu';
        break;
    case 'vrfstates':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/23';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_show_vrf';
        break;
    case 'twothsndbyteping':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/22';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/twothsndbyteping';
        break;
    case 'bgpvsixneighbors':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/14';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_bgpv6_neighbor';
        break;
    case 'bgpvfourneighbors':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/13';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_bgpv4_neighbour';
        break;
    case 'xconnect':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/20';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_xconnect_all';
        break;
    // case 'bgpvfourroutes':
    case 'ran':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/19';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_show_ip_bgp_vpnv4_vrf_ran';
        break;
    case 'bootstatement':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/16';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_show_running_config';
        break;
    case 'interfacecounters':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/7';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_count_interfaces';
        break;
    case 'logentries':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/15';
        $url = 'http://10.134.179.82:8085/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_show_logging';
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

<?php
include_once 'config/global.php';
global $APPCONFIG;
$command = $_GET['commandname'];
$deviceid = $_GET['deviceid'];
$deviceseries = $_GET['deviceseries'];
$version = $_GET['version'];
// $deviceid = 2;

switch ($command) {

    case 'extract_process_cpu':
        // $url=$APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/2///
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/ios/' . $deviceid . '/8';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Nokia/'.$deviceseries.'/TiMOS/'.$version.'/'.$deviceid.'/extract_process_cpu';
        break;
    case 'extract_memory_statistics':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/TiMOS/' . $deviceid . '/5';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Nokia/'.$deviceseries.'/TiMOS/'.$version.'/'.$deviceid.'/extract_memory_statistics';
        break;
    // case 'showversion':
    case 'extract_version_os':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/TiMOS/' . $deviceid . '/2';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Nokia/'.$deviceseries.'/TiMOS/'.$version.'/'.$deviceid.'/extract_version_os';
        break;
    case 'extract_boot_statement':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/TiMOS/' . $deviceid . '/3';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Nokia/'.$deviceseries.'/TiMOS/'.$version.'/'.$deviceid.'/extract_boot_statement';
        break;
    case 'extract_environmental':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/TiMOS/' . $deviceid . '/4';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Nokia/'.$deviceseries.'/TiMOS/'.$version.'/'.$deviceid.'/extract_environmental';
        break;
    case 'extract_platform':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/TiMOS/' . $deviceid . '/6';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Nokia/'.$deviceseries.'/TiMOS/'.$version.'/'.$deviceid.'/extract_platform';
        break;
    case 'extract_bfd_neighbor':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/TiMOS/' . $deviceid . '/10';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Nokia/'.$deviceseries.'/TiMOS/'.$version.'/'.$deviceid.'/extract_bfd_neighbor';
        break;
    case 'extract_interface_states':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/TiMOS/' . $deviceid . '/9';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Nokia/'.$deviceseries.'/TiMOS/'.$version.'/'.$deviceid.'/extract_interface_states';
        break;
    case 'extract_count_interfaces':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/TiMOS/' . $deviceid . '/7';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Nokia/'.$deviceseries.'/TiMOS/'.$version.'/'.$deviceid.'/extract_count_interfaces';
        break;
    case 'extract_mpls_interfaces':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/TiMOS/' . $deviceid . '/12';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Nokia/'.$deviceseries.'/TiMOS/'.$version.'/'.$deviceid.'/extract_mpls_interfaces';
        break;
    case 'extract_show_logging':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/TiMOS/' . $deviceid . '/11';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Nokia/'.$deviceseries.'/TiMOS/'.$version.'/'.$deviceid.'/extract_show_logging';
        break;
    case 'extract_xconnect':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/TiMOS/' . $deviceid . '/17';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Nokia/'.$deviceseries.'/TiMOS/'.$version.'/'.$deviceid.'/extract_xconnect';
        break;
    case 'extract_router_status':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/TiMOS/' . $deviceid . '/1';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Nokia/'.$deviceseries.'/TiMOS/'.$version.'/'.$deviceid.'/extract_router_status';
        break;
    case 'extract_static_routes':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/TiMOS/' . $deviceid . '/23';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Nokia/'.$deviceseries.'/TiMOS/'.$version.'/'.$deviceid.'/extract_static_routes';
        break;
    case 'extract_service_using':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/TiMOS/' . $deviceid . '/22';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Nokia/'.$deviceseries.'/TiMOS/'.$version.'/'.$deviceid.'/extract_service_using';
        break;
    case 'extract_arp':
        //$url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/TiMOS/' . $deviceid . '/14';
        $url = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/raw/Nokia/'.$deviceseries.'/TiMOS/'.$version.'/'.$deviceid.'/extract_arp';
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

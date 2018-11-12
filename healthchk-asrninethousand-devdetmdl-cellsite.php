<?php
$command = $_GET['commandname'];
$deviceid = $_GET['deviceid'];
$deviceseries = $_GET['deviceseries'];
$version = $_GET['version'];
// $deviceid = 2;

switch ($command) {
    
    case 'extract_redundancy':
        // $url='http://10.134.179.82:8080/healthcheck/ios/2///
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/8';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_redundancy';
        break;
    case 'extract_process_cpu':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/5';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_process_cpu';
        break;
    // case 'showversion':
    case 'extract_memory_statistics':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/2';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_memory_statistics';
        break;
    case 'extract_version_rsp':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/3';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_version_rsp';
        break;
    case 'extract_version_installed_active':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/4';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_version_installed_active';
        break;
    case 'extract_version_installed_committed':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/6';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_version_installed_committed';
        break;
    case 'extract_alarms':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/10';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_alarms';
        break;
    case 'extract_power_supply':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/9';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_power_supply';
        break;
    case 'extract_platform':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/7';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_platform';
        break;
    case 'extract_fabric_status':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/12';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_fabric_status';
        break;
    case 'extract_fabric_inter_asic_drops':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/11';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_fabric_inter_asic_drops';
        break;
    case 'extract_fabric_inter_asic_errors':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/17';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_fabric_inter_asic_errors';
        break;
    case 'extract_fabric_inter_asic_link_status':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/1';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_fabric_inter_asic_link_status';
        break;
    case 'extract_up_down_status':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/23';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_up_down_status';
        break;
    case 'extract_count_interfaces':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/22';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_count_interfaces';
        break;
    case 'extract_bfd_session':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/14';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_bfd_session';
        break;
    case 'extract_vrrp':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/13';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_vrrp';
        break;
    case 'extract_ntp':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/20';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_ntp';
        break;
    // case 'bgpvfourroutes':
    case 'extract_global_ospf_neighbor':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/19';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_global_ospf_neighbor';
        break;
    case 'extract_1xrtt_ospf_neighbor':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/16';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_1xrtt_ospf_neighbor';
        break;
    case 'extract_cell_mgmt_ospf_neighbor':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/7';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_cell_mgmt_ospf_neighbor';
        break;
    case 'extract_ospf_nsr_gr':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/15';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_ospf_nsr_gr';
        break;
    case 'extract_ldp_neighbor':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/15';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_ldp_neighbor';
        break;
    case 'extract_wdn_peering':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/19';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_wdn_peering';
        break;
    case 'extract_csr_peering':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/16';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_csr_peering';
        break;
    case 'extract_crs_wdn_peering':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/7';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_crs_wdn_peering';
        break;
    case 'extract_crs_lte_peering':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/15';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_crs_lte_peering';
        break;
    case 'extract_bgp_nsr_graceful_restart':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/15';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_bgp_nsr_graceful_restart';
        break;
    case 'extract_air_filter_check':
        //$url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/15';
        $url = 'http://10.134.179.82:8080/healthcheck/raw/Cisco/'.$deviceseries.'/ios/'.$version.'/'.$deviceid.'/extract_air_filter_check';
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

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
                    myModal.find('.modal-content').html('<div id="ajax_loader" style="position: absolute; left: 50%; top: 50%; display: start;"><img src="resources/img/ajax-loader.gif"></img></div>');
                    //myModal.find('.modal-content').html('<div id="ajax_loader" style="position: absolute; left: 30%; top: 50%; display: start;"><b>Running health checks. Takes several minutes</b></div>');
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
    // Python API Request using curl Begins
    $userid = $_GET['userid'];
    
    if (isset($_GET['deviceip']) && ! empty($_GET['deviceip'])) {
        $device_details = loaddeviceidfromdeviceip($_GET['deviceip'], '');
        
    }elseif (isset($_GET['devicename']) && ! empty($_GET['devicename'])) {
        $device_details = loaddeviceidfromdevicename($_GET['devicename'], '');
    }
    
    $deviceid = $device_details['id'];
    if(isset($deviceid) && is_numeric($deviceid)) {
    $device_details['nodeVersion'] = str_replace('.','-',str_replace(')','-',str_replace('(','-',$device_details['nodeVersion'])));
    $devicetype = 'ios';
    //$url_send = " http://txaroemsda2z.nss.vzwnet.com:8080/healthcheck/";
    //$url_final = 'http://njbboemsda3v.nss.vzwnet.com:8080/healthcheck/' . $devicetype . '/' . $deviceid;
    
    //PORT 8086 - ASR 9K 
    /*
    if($device_details['deviceseries'] == 'ASR9K'){
        $url_final = 'http://10.134.179.82:8086/healthcheck/Cisco/'.$device_details['deviceseries'].'/'.$devicetype.'/'.$device_details['nodeVersion'].'/'.$deviceid;
    }*/
    
    
    $lastupdated = date('Y-m-d H:i:s');
    if($device_details['deviceseries'] == 'ASR9K'){
        $url_final = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/Cisco/'.$device_details['deviceseries'].'/'.$devicetype.'/'.$device_details['nodeVersion'].'/'.$deviceid;
        $output = sendPostData($url_final);
        /*$output = '{
     "extract_redundancy": {
     "R": 0,
     "message": "extract_redundancy new"
     },
     "extract_process_cpu": {
     "R": 0,
     "message": "extract_process_cpu new"
     },
     "extract_memory_statistics": {
     "R": 0,
     "message": "extract_memory_statistics new"
     },
     "extract_version_rsp": {
     "R": 0,
     "message": "extract_version_rsp new"
     },
     "extract_version_installed_active": {
     "R": 0,
     "message": "extract_version_installed_active new"
     },
     "extract_version_installed_committed": {
     "R": 0,
     "message": "extract_version_installed_committed new"
     },
     "extract_alarms": {
     "R": 0,
     "message": "extract_alarms new"
     },
     "extract_power_supply": {
     "R": 0,
     "message": "extract_power_supply new"
     },
     "extract_platform": {
     "R": 0,
     "message": "extract_platform new"
     },
     "extract_fbric_status": {
     "R": 0,
     "message": "extract_fbric_status new"
     },
     "extract_fabric_inter_asic_drops": {
     "R": 0,
     "message": "extract_fabric_inter_asic_drops new"
     },
     "extract_fabric_inter_asic_errors": {
     "R": 0,
     "message": "extract_fabric_inter_asic_errors new"
     },
     "extract_fabric_inter_asic_link_status": {
     "R": 0,
     "message": "extract_fabric_inter_asic_link_status new"
     },
     "extract_up_down_status": {
     "R": 0,
     "message": "extract_up_down_status new"
     },
     "extract_count_interfaces": {
     "R": 0,
     "count": 5
     },
     "extract_bfd_session": {
     "R": 0,
     "message": "extract_bfd_session new"
     },
     "extract_vrrp": {
     "R": 0,
     "message": "extract_vrrp new"
     },
     "extract_ntp": {
     "R": 0,
     "message": "extract_ntp new"
     },
     "extract_global_ospf_neighbor": {
     "R": 0,
     "message": "extract_global_ospf_neighbor new"
     },
     "extract_1xrtt_ospf_neighbor": {
     "R": 0,
     "message": "extract_1xrtt_ospf_neighbor new"
     },
     "extract_cell_mgmt_ospf_neighbor": {
     "R": 0,
     "message": "extract_cell_mgmt_ospf_neighbor new"
     },
     "extract_ospf_nsr_gr": {
     "R": 0,
     "message": "extract_ospf_nsr_gr new"
     },
     "extract_ldp_neighbor": {
     "R": 0,
     "message": "extract_ldp_neighbor new"
     },
     "extract_wdn_peering": {
     "R": 0,
     "message": "extract_wdn_peering new"
     },
     "extract_csr_peering": {
     "R": 0,
     "message": "extract_csr_peering new"
     },
     "extract_crs_wdn_peering": {
     "R": 0,
     "message": "extract_crs_wdn_peering new"
     },
     "extract_crs_lte_peering": {
     "R": 0,
     "message": "extract_crs_lte_peering new"
     },
     "extract_bgp_nsr_graceful_restart": {
     "R": 0,
     "message": "extract_bgp_nsr_graceful_restart new"
     },
     "extract_air_filter_check": {
     "R": 0,
     "message": "extract_air_filter_check new"
     }
     }';*/
        ems_update_healthchk_info($deviceid, $output, $lastupdated);
    }elseif($device_details['deviceseries'] == 'ASR3K'){
        $url_final = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/Cisco/'.$device_details['deviceseries'].'/'.$devicetype.'/'.$device_details['nodeVersion'].'/'.$deviceid;
        $output = sendPostData($url_final);
        /*$output = '{
         "extract_redundancy": {
         "R": 0,
         "message": "extract_redundancy new"
         },
         "extract_process_cpu": {
         "R": 0,
         "message": "extract_process_cpu new"
         },
         "extract_memory_statistics": {
         "R": 0,
         "message": "extract_memory_statistics new"
         },
         "extract_version_rsp": {
         "R": 0,
         "message": "extract_version_rsp new"
         },
         "extract_version_installed_active": {
         "R": 0,
         "message": "extract_version_installed_active new"
         },
         "extract_version_installed_committed": {
         "R": 0,
         "message": "extract_version_installed_committed new"
         },
         "extract_alarms": {
         "R": 0,
         "message": "extract_alarms new"
         },
         "extract_power_supply": {
         "R": 0,
         "message": "extract_power_supply new"
         },
         "extract_platform": {
         "R": 0,
         "message": "extract_platform new"
         },
         "extract_fbric_status": {
         "R": 0,
         "message": "extract_fbric_status new"
         },
         "extract_fabric_inter_asic_drops": {
         "R": 0,
         "message": "extract_fabric_inter_asic_drops new"
         },
         "extract_fabric_inter_asic_errors": {
         "R": 0,
         "message": "extract_fabric_inter_asic_errors new"
         },
         "extract_fabric_inter_asic_link_status": {
         "R": 0,
         "message": "extract_fabric_inter_asic_link_status new"
         },
         "extract_up_down_status": {
         "R": 0,
         "message": "extract_up_down_status new"
         },
         "extract_count_interfaces": {
         "R": 0,
         "count": 5
         },
         "extract_bfd_session": {
         "R": 0,
         "message": "extract_bfd_session new"
         },
         "extract_vrrp": {
         "R": 0,
         "message": "extract_vrrp new"
         },
         "extract_ntp": {
         "R": 0,
         "message": "extract_ntp new"
         },
         "extract_global_ospf_neighbor": {
         "R": 0,
         "message": "extract_global_ospf_neighbor new"
         },
         "extract_1xrtt_ospf_neighbor": {
         "R": 0,
         "message": "extract_1xrtt_ospf_neighbor new"
         },
         "extract_cell_mgmt_ospf_neighbor": {
         "R": 0,
         "message": "extract_cell_mgmt_ospf_neighbor new"
         },
         "extract_ospf_nsr_gr": {
         "R": 0,
         "message": "extract_ospf_nsr_gr new"
         },
         "extract_ldp_neighbor": {
         "R": 0,
         "message": "extract_ldp_neighbor new"
         },
         "extract_wdn_peering": {
         "R": 0,
         "message": "extract_wdn_peering new"
         },
         "extract_csr_peering": {
         "R": 0,
         "message": "extract_csr_peering new"
         },
         "extract_crs_wdn_peering": {
         "R": 0,
         "message": "extract_crs_wdn_peering new"
         },
         "extract_crs_lte_peering": {
         "R": 0,
         "message": "extract_crs_lte_peering new"
         },
         "extract_bgp_nsr_graceful_restart": {
         "R": 0,
         "message": "extract_bgp_nsr_graceful_restart new"
         },
         "extract_air_filter_check": {
         "R": 0,
         "message": "extract_air_filter_check new"
         }
         }';*/
        ems_update_healthchk_info($deviceid, $output, $lastupdated);
    }elseif($device_details['deviceseries'] == 'NCS5500'){
        $url_final = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/Cisco/'.$device_details['deviceseries'].'/'.$devicetype.'/'.$device_details['nodeVersion'].'/'.$deviceid;
        $output = sendPostData($url_final);
        /*$output = '{
         "extract_redundancy": {
         "R": 0,
         "message": "extract_redundancy new"
         },
         "extract_process_cpu": {
         "R": 0,
         "message": "extract_process_cpu new"
         },
         "extract_memory_statistics": {
         "R": 0,
         "message": "extract_memory_statistics new"
         },
         "extract_version_rsp": {
         "R": 0,
         "message": "extract_version_rsp new"
         },
         "extract_version_installed_active": {
         "R": 0,
         "message": "extract_version_installed_active new"
         },
         "extract_version_installed_committed": {
         "R": 0,
         "message": "extract_version_installed_committed new"
         },
         "extract_alarms": {
         "R": 0,
         "message": "extract_alarms new"
         },
         "extract_power_supply": {
         "R": 0,
         "message": "extract_power_supply new"
         },
         "extract_platform": {
         "R": 0,
         "message": "extract_platform new"
         },
         "extract_fbric_status": {
         "R": 0,
         "message": "extract_fbric_status new"
         },
         "extract_fabric_inter_asic_drops": {
         "R": 0,
         "message": "extract_fabric_inter_asic_drops new"
         },
         "extract_fabric_inter_asic_errors": {
         "R": 0,
         "message": "extract_fabric_inter_asic_errors new"
         },
         "extract_fabric_inter_asic_link_status": {
         "R": 0,
         "message": "extract_fabric_inter_asic_link_status new"
         },
         "extract_up_down_status": {
         "R": 0,
         "message": "extract_up_down_status new"
         },
         "extract_count_interfaces": {
         "R": 0,
         "count": 5
         },
         "extract_bfd_session": {
         "R": 0,
         "message": "extract_bfd_session new"
         },
         "extract_vrrp": {
         "R": 0,
         "message": "extract_vrrp new"
         },
         "extract_ntp": {
         "R": 0,
         "message": "extract_ntp new"
         },
         "extract_global_ospf_neighbor": {
         "R": 0,
         "message": "extract_global_ospf_neighbor new"
         },
         "extract_1xrtt_ospf_neighbor": {
         "R": 0,
         "message": "extract_1xrtt_ospf_neighbor new"
         },
         "extract_cell_mgmt_ospf_neighbor": {
         "R": 0,
         "message": "extract_cell_mgmt_ospf_neighbor new"
         },
         "extract_ospf_nsr_gr": {
         "R": 0,
         "message": "extract_ospf_nsr_gr new"
         },
         "extract_ldp_neighbor": {
         "R": 0,
         "message": "extract_ldp_neighbor new"
         },
         "extract_wdn_peering": {
         "R": 0,
         "message": "extract_wdn_peering new"
         },
         "extract_csr_peering": {
         "R": 0,
         "message": "extract_csr_peering new"
         },
         "extract_crs_wdn_peering": {
         "R": 0,
         "message": "extract_crs_wdn_peering new"
         },
         "extract_crs_lte_peering": {
         "R": 0,
         "message": "extract_crs_lte_peering new"
         },
         "extract_bgp_nsr_graceful_restart": {
         "R": 0,
         "message": "extract_bgp_nsr_graceful_restart new"
         },
         "extract_air_filter_check": {
         "R": 0,
         "message": "extract_air_filter_check new"
         }
         }';*/
        ems_update_healthchk_info($deviceid, $output, $lastupdated);
    }elseif($device_details['deviceseries'] == 'SAR7705'){
        $url_final = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/Nokia/'.$device_details['deviceseries'].'/'.$devicetype.'/'.$device_details['nodeVersion'].'/'.$deviceid;
        $output = sendPostData($url_final);
        /*
        $output = '{
   "ARP":{
      "message":"No of ARP Entries: 5",
      "R":0
   },
   "xconnect":{
      "message":"Coming Soon",
      "R":0
   },
   "Log Entries":{
      "message":"Log-Id 99: 93609, Log-Id 100: 4799",
      "R":0
   },
   "MPLS Interfaces":{
      "message":"mpls interfaces: All Ok",
      "R":0
   },
   "BFD Sessions(S)":{
      "message":"All 4 BFD\'s are UP",
      "R":0
   },
   "Platform":{
      "message":"system information: NWCSDEBGT1A-P-AL-0390-01,7705 SAR-8 v2",
      "R":0
   },
   "interfacecounters":{
      "message":" ",
      "R":0
   },
   "Interface States":{
      "message":"Interface status: All OK",
      "R":0
   },
   "bootstatement":{
      "message":"Bof matches the Version: TiMOS-B-7.0.R5",
      "R":0
   },
   "osversion":{
      "message":"TiMOS-B-7.0.R5",
      "R":0
   },
   "cpuutilization":{
      "message":"18.08%",
      "R":0
   },
   "Static Routes":{
      "message":"No. of Static Routes: 4",
      "R":0
   },
   "Service Service-using":{
      "message":"No of Up-Services: 8, No of Down-services: 0",
      "R":0
   },
   "MPLS Neighbors":{
      "message":"MPLS Neighbors: All Ok",
      "R":0
   }
}';*/
        ems_update_healthchk_info($deviceid, $output, $lastupdated);
    }else{
        $url_final = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/Cisco/'.$device_details['deviceseries'].'/'.$devicetype.'/'.$device_details['nodeVersion'].'/'.$deviceid;
        $output = json_decode(sendPostData($url_final), true);
        insertorupdate_healthchk_info($deviceid, $output, $lastupdated);
    }
    $_SESSION['deviceidcs'] = $deviceid;
    }
    ?>
<div class="panel-body">
	<table id="example" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th class="noExport">Health Check</th>
				<th>Site ID</th>
				<th>Site Name</th>
				<th>Device Name</th>
				<th>IP Address</th>
				<th>Market</th>
				<th>Device Series</th>
				<th>Version</th>
				<th class="d-none">Status</th>
				<th>Last Polled</th>
				<!-- <th>Audit Log</th>  -->
			</tr>
		</thead>
		<tbody>
			<?php if(isset($deviceid) && is_numeric($deviceid)) { ?>
			<tr id="row_<?php echo $deviceid; ?>" class="device_row odd shown"
				role="row">
				<td class=" details-control" title="Click here for health check"></td>
				<td><?php echo $device_details['csr_site_id']; ?></td>
				<td><?php echo $device_details['csr_site_name']; ?></td>
				<td><?php echo $device_details['devicename'];?></td>
				<td><?php echo $device_details['deviceIpAddr'].'<br/>'.$device_details['deviceIpAddrsix']; ?></td>
				<td><?php echo $device_details['market'];?></td>
				<td><?php echo $device_details['deviceseries'];?></td>
				<td><?php echo $device_details['nodeVersion'];?></td>
				<td class="d-none"><?php echo $device_details['status'];?></td>
				<td><?php echo $device_details['lastpolled'];?></td>
				<!--  <td class=" center"><button type="button" class="btn btn-sm auditLog" data-toggle="modal">Audit Log</button></td>  -->
			</tr>
			<tr>
				<td style="display: none;"></td>
				<td style="display: none;"></td>
				<td style="display: none;"></td>
				<td style="display: none;"></td>
				<td style="display: none;"></td>
				<td style="display: none;"></td>
				<td style="display: none;"></td>
				<td style="display: none;"></td>
				<td style="display: none;"></td>
				<td style="display: none;"></td>
				<td colspan="11"><div id="detail_<?php echo $deviceid; ?>"
						class="loaded">
								
    
<?php
$vendorId = load_node_vendor_id_from_deviceid($deviceid);
if ($vendorId == 1) {
    if($device_details['deviceseries'] == 'ASR9K'){
        $output = json_decode($output, true);
        include_once 'healthchk-asrninethousand-instant-hc-blk-inc.php';
    }else if($device_details['deviceseries'] == 'ASR3K'){
        $output = json_decode($output, true);
        include_once 'healthchk-asrthreethousand-instant-hc-blk-inc.php';
    }else if($device_details['deviceseries'] == 'NCS5500'){
        $output = json_decode($output, true);
        include_once 'healthchk-ncsfivefivezerozero-instant-hc-blk-inc.php';
    }else if($device_details['deviceseries'] == 'Nexus3K'){
        $output = json_decode($output, true);
        include_once 'healthchk-nexus3k-instant-hc-blk-inc.php';
    }else if($device_details['deviceseries'] == 'NexusETRAN3K'){
        $output = json_decode($output, true);
        include_once 'healthchk-nexusetran3k-instant-hc-blk-inc.php';
    }else if($device_details['deviceseries'] == 'StarOS'){
        $output = json_decode($output, true);
        include_once 'healthchk-staros-instant-hc-blk-inc.php';
    }else{
        include_once 'instant_hc_blk_inc.php';
    }
} elseif ($vendorId == 2) {
        $output = json_decode($output, true);
        include_once 'healthchk-nokiasevensevenzerofive-instant-hc-blk-inc.php';
} elseif ($vendorId == 3) {
    include_once 'hc_blk_inc_juniper.php';
}
?>
</div></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>


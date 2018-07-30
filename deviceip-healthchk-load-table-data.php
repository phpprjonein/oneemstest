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
include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';
$userid = $_GET['userid'];
$deviceip = $_GET['deviceip'];

$device_details = loaddeviceidfromdeviceip($deviceip);
$deviceid = $device_details['id'];
$healthchktype = 'Load Table';
// $deviceid = $_GET['deviceid'];
// $arr_res = getDetailViewData($userid, $deviceid );
// $output = $arr_res['result'][0];
// print_r($output);
?>
    <?php
    $result = select_healthchk_info($deviceid);
    $lastupdated = $result['lastupdated'];
    $output = '{"bfdsession":' . $result['bfdsession'] . ',"bgpvfourneighbors":' . $result['bgpvfourneighbors'] . ',"bgpvsixneighbours":' . $result['bgpvsixneighbours'] . ',"bgpvsixroutes":' . $result['bgpvsixroutes'] . ',"bootstatement":' . $result['bootstatement'] . ',"buffers":' . $result['buffers'] . ',"configregister":' . $result['configregister'] . ',"cpuutilization":' . $result['cpuutilization'] . ',"environmental":' . $result['environmental'] . ',"vrfstates":' . $result['vrfstates'] . ',"freememory":' . $result['freememory'] . ',"interfacecounters":' . $result['interfacecounters'] . ',"interfacestates":' . $result['interfacestates'] . ',"iosversion":' . $result['iosversion'] . ',"logentries":' . $result['logentries'] . ',"mplsinterfaces":' . $result['mplsinterfaces'] . ',"mplsneighbors":' . $result['mplsneighbors'] . ',"platform":' . $result['platform'] . ',"ran":' . $result['ran'] . ',"twothsndbyteping":' . $result['twothsndbyteping'] . ',"xconnect":' . $result['xconnect'] . '}';
    $output = json_decode($output, true);
    // print_r($output);
    // die;
    
    // Python API Request using curl Begins
    
    /*
     * $userid = $_GET['userid'];
     * $deviceid = $_GET['deviceid'];
     * $devicetype='ios';
     * $url_send =" http://txaroemsda2z.nss.vzwnet.com:8080/healthcheck/";
     * $url_final = 'http://njbboemsda1v.nss.vzwnet.com:8080/healthcheck/'.$devicetype.'/'.$deviceid;
     * $output = json_decode(sendPostData($url_final),true);
     */
    $_SESSION['deviceidswusr'] = $deviceid;
    
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
				<th>Audit Log</th>
			</tr>
		</thead>
		<tbody>
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
				<td class=" center"><button type="button"
						class="btn btn-sm auditLog" data-toggle="modal">Audit Log</button></td>
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
if (load_node_vendor_id_from_deviceid($deviceid) == 1) {
    include_once 'instant_hc_blk_inc.php';
} else {
    include_once 'hc_blk_inc2.php';
}

?>
</div></td>
			</tr>
		</tbody>
	</table>
</div>

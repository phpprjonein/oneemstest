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
include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';
ini_set('display_errors', 1);
?>
    <?php
    // Python API Request using curl Begins
    $userid = $_GET['userid'];
    
    if (isset($_GET['deviceid']) && ! empty($_GET['deviceid'])) {
        $deviceid = $_GET['deviceid'];
    } elseif (isset($_GET['deviceip']) && ! empty($_GET['deviceip'])) {
        $device_details = loaddeviceidfromdeviceip($_GET['deviceip']);
        $deviceid = $device_details['id'];
    }
    if(isset($deviceid) && is_numeric($deviceid)) {
    $device_details['nodeVersion'] = str_replace('.','-',str_replace(')','-',str_replace('(','-',$device_details['nodeVersion'])));
    $devicetype = 'ios';
    $url_send = " http://txaroemsda2z.nss.vzwnet.com:8080/healthcheck/";
    //$url_final = 'http://njbboemsda3v.nss.vzwnet.com:8080/healthcheck/' . $devicetype . '/' . $deviceid;
    $url_final = 'http://10.134.179.82:8085/healthcheck/Cisco/'.$device_details['deviceseries'].'/'.$devicetype.'/'.$device_details['nodeVersion'].'/'.$deviceid;
    $output = json_decode(sendPostData($url_final), true);
    $lastupdated = date('Y-m-d H:i:s');
    insertorupdate_healthchk_info($deviceid, $output, $lastupdated);
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
if (load_node_vendor_id_from_deviceid($deviceid) == 1) {
    include_once 'instant_hc_blk_inc.php';
} else {
    include_once 'hc_blk_inc_nokia.php';
}

?>
</div></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>


<?php
include_once "classes/db2.class.php";
include_once "classes/paginator.class.php";
include_once 'functions.php';
global $APPCONFIG;
/*
$output = json_decode(
        '{
  "data": {
    "devicename": "LWCTOH02T1A-P-CI-9999-01",
    "deviceos": "IOS-XE",
    "deviceseries": "ASR920",
    "discoverystatus": "success",
    "lastpolled": "2018-11-09 22:01",
    "market": "OPW",
    "model": "Cisco",
    "nodeVersion": "15.6(1)S1",
    "nodestatus": "K",
    "region": "GreatLakes",
    "switch_name": "LEWIS CENTER 1",
    "sys_contact": "",
    "sys_location": "Verizon Lab South Plainfield 1st floor room 208",
    "upsince": "102 days 7:39"
  },
  "deviceIpAddr": "10.202.96.191"
  }', 1);
*/
  $url = $APPCONFIG['discovery']['endpoint'].'/snmp/' . $_POST['ip-address'];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, $url);
  $result = curl_exec($ch);
  curl_close($ch);
  $output = json_decode($result, true);
  //print_r($output['data']['data']);
 
$output['data']['status'] = 1; // needs to be sorted out.
//$market_list = get_market_list_manualdisc($_POST['ip-address']);
?>
<div class="container" id="manual-disc-utils-pop">
	<div id="status" style="display: none;" class="alert"></div>
	<p>
		<b>Device Ip Address : <?php echo $_POST['ip-address']; ?></b> <input
			type="hidden" id="ip-address" value="<?php echo $_POST['ip-address']; ?>" name="ip-address" />
	</p>
	<table class="table table-striped">
		<tbody>
			<tr>
				<td><h6>Device Name</h6></td>
				<td id="devnameval"><?php echo $output['data']['devicename']; ?></td>
			</tr>
			<tr>
				<td>Device OS</td>
				<td id="devosval"><?php echo $output['data']['deviceos']; ?></td>
			</tr>
			<tr>
				<td>Device Series</td>
				<td id="devseriesval"><?php echo $output['data']['deviceseries']; ?></td>
			</tr>
			<tr>
				<td>Discovery Status</td>
				<td id="devstatusval"><?php echo $output['data']['discoverystatus']; ?></td>
			</tr>
			<tr>
				<td>Last Polled</td>
				<td id="lastpollval"><?php echo $output['data']['lastpolled']; ?></td>
			</tr>
			<tr>
				<td>Model</td>
				<td id="modelval"><?php echo $output['data']['model']; ?></td>
			</tr>
			<tr>
				<td>Node Version</td>
				<td id="nodeverval"><?php echo $output['data']['nodeVersion']; ?></td>
			</tr>
			<tr style="display: none;">
				<td>Node Status</td>
				<td id="nodestatval"><?php echo $output['data']['nodestatus']; ?></td>
			</tr>
			<tr style="display: none;">
				<td>Status</td>
				<td id="statval"><?php echo $output['data']['status']; ?></td>
			</tr>
			<tr>
				<td>System Contact</td>
				<td id="sysconval"><?php echo $output['data']['sys_contact']; ?></td>
			</tr>
			<tr>
				<td>System Location</td>
				<td id="syslocval"><?php echo $output['data']['sys_location']; ?></td>
			</tr>
			<tr>
				<td>Up Since</td>
				<td id="upsinceval"><?php echo $output['data']['upsince']; ?></td>
			</tr>
			<tr>
				<td>Switch Name</td>
				<td id="switchnameval"><?php echo $output['data']['switch_name']; ?></td>
			</tr>
			<tr>
				<td>Market</td>
				<td id="mktval"><?php echo $output['data']['market']; ?></td>
			</tr>
			<tr>
				<td>Region</td>
				<td id="rgnval"><?php echo $output['data']['region']; ?></td>
			</tr>
		</tbody>
	</table>
</div>

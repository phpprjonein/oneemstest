<?php
include_once "classes/db2.class.php";
include_once "classes/paginator.class.php";
include_once 'functions.php';
/*
 * $output = json_decode('{
 * "data": {
 * "devicename": "",
 * "deviceos": "",
 * "deviceseries": "",
 * "discoverystatus": "Failed",
 * "lastpolled": "2018-02-21 21:56",
 * "model": "",
 * "nodeVersion": "",
 * "nodestatus": "C",
 * "status": false,
 * "sys_contact": "",
 * "sys_location": "",
 * "upsince": ""
 * },
 * "deviceIpAddr": "10.198.238.19"
 * }',1);
 */
// $url = 'http://10.134.179.82:8089/snmp/10.198.238.19';
$url = 'http://10.134.179.82:8089/snmp/' . $_POST['ip-address'];
// $url = 'http://txaroemsda2z.nss.vzwnet.com:8080/snmp/10.198.238.2';
// Initiate curl
$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL, $url);
// Execute
$result = curl_exec($ch);
// Closing
curl_close($ch);

// Will dump a beauty json :3
// var_dump(json_decode($result, true));
$output = json_decode($result, true);
print_r($output['data']['data']);
$market_list = get_market_list_manualdisc();
?>
<div class="container">
	<p>
		<b>Device Ip Address : <?php echo $output['deviceIpAddr']; ?></b>
	</p>
	<table class="table table-striped">
		<tbody>
			<tr>
				<td><h6>Device Name</h6></td>
				<td id ="devnameval"><?php echo $output['data']['devicename']; ?></td>
			</tr>
			<tr>
				<td >Device OS</td>
				<td id ="devosval"><?php echo 'dummy'; //echo $output['data']['deviceos']; ?></td>
			</tr>
			<tr>
				<td>Device Series</td>
				<td id ="devseriesval"><?php echo $output['data']['deviceseries']; ?></td>
			</tr>
			<tr>
				<td>Discovery Status</td>
				<td id ="devstatusval"><?php echo $output['data']['discoverystatus']; ?></td>
			</tr>
			<tr>
				<td>Last Polled</td>
				<td id ="lastpollval"><?php echo $output['data']['lastpolled']; ?></td>
			</tr>
			<tr>
				<td>Model</td>
				<td id ="modelval"><?php echo $output['data']['model']; ?></td>
			</tr>
			<tr>
				<td>Node Version</td>
				<td id = "nodeverval"><?php echo $output['data']['nodeVersion']; ?></td>
			</tr>
			<tr>
				<td>Node Status</td>
				<td id = "nodestatval"><?php echo $output['data']['nodestatus']; ?></td>
			</tr>
			<tr>
				<td>Status</td>
				<td id = "statval"><?php echo $output['data']['status']; ?></td>
			</tr>
			<tr>
				<td>System Contact</td>
				<td id = "sysconval"><?php echo $output['data']['sys_contact']; ?></td>
			</tr>
			<tr>
				<td>System Location</td>
				<td id = "syslocval"><?php echo $output['data']['sys_location']; ?></td>
			</tr>
			<tr>
				<td>Up Since</td>
				<td id = "upsinceval"><?php echo $output['data']['upsince']; ?></td>
			</tr>
			<tr>
				<td>Market</td>
				<td><select id = "mktval"> 				 
	     	     <?php foreach ($market_list as $key=>$value) { ?>
						<option value="<?php echo $value['market_name'];?>"><?php echo $value['market_name']; ?></option>
				 <?php }; ?>
                     <!--<option value = "">Select Market </option>     
					 <option value = "1"> OPW </option>     
					 <option value = "2"> Great Lakes </option>     					 
					 </select>					 
					 -->
			   </td>
			</tr> 
		</tbody>
	</table>
</div>

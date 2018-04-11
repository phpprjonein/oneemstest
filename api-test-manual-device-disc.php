<?php
/*
$output = json_decode('{
  "data": {
    "devicename": "",
    "deviceos": "",
    "deviceseries": "",
    "discoverystatus": "Failed",
    "lastpolled": "2018-02-21 21:56",
    "model": "",
    "nodeVersion": "",
    "nodestatus": "C",
    "status": false,
    "sys_contact": "",
    "sys_location": "",
    "upsince": ""
  },
  "deviceIpAddr": "10.198.238.19"
}',1);
*/
//$url = 'http://10.134.179.82:8089/snmp/10.198.238.19';
$url = 'http://10.134.179.82:8089/snmp/'.$_POST['ip-address'];
//$url = 'http://txaroemsda2z.nss.vzwnet.com:8080/snmp/10.198.238.2';
//  Initiate curl
$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$result=curl_exec($ch);
// Closing
curl_close($ch);

// Will dump a beauty json :3
//var_dump(json_decode($result, true));
$output = json_decode($result, true);
print_r($output['data']['data']);
?>
<div class="container">
  <p><b>Device Ip Address : <?php echo $output['deviceIpAddr']; ?></b></p>            
  <table class="table table-striped">
    <tbody>
      <tr>
        <td><h6>Device Name</h6></td>
        <td><?php echo $output['data']['devicename']; ?></td>
      </tr>
      <tr>
        <td>Device OS</td>
        <td><?php echo $output['data']['deviceos']; ?></td>
      </tr>
      <tr>
        <td>Device Series</td>
        <td><?php echo $output['data']['deviceseries']; ?></td>
      </tr>
      <tr>
        <td>Discovery Status</td>
        <td><?php echo $output['data']['discoverystatus']; ?></td>
      </tr>
      <tr>
        <td>Last Polled</td>
        <td><?php echo $output['data']['lastpolled']; ?></td>
      </tr>
      <tr>
        <td>Model</td>
        <td><?php echo $output['data']['model']; ?></td>
      </tr>
      <tr>
        <td>Node Version</td>
        <td><?php echo $output['data']['nodeVersion']; ?></td>
      </tr>
      <tr>
        <td>Node Status</td>
        <td><?php echo $output['data']['nodestatus']; ?></td>
      </tr>
      <tr>
        <td>Status</td>
        <td><?php echo $output['data']['status']; ?></td>
      </tr>
      <tr>
        <td>System Contact</td>
        <td><?php echo $output['data']['sys_contact']; ?></td>
      </tr>
      <tr>
        <td>System Location</td>
        <td><?php echo $output['data']['sys_location']; ?></td>
      </tr>
      <tr>
        <td>Up Since</td>
        <td><?php echo $output['data']['upsince']; ?></td>
      </tr>
    </tbody>
  </table>
</div>

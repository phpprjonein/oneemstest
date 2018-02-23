<?php
/* Sample json output 
{
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
} 

end */
/*
if(rand(0,1)){
    $ret = true;
}else{
    $ret = false;
}
$myObject = array( 'result' => $ret ); // example
echo json_encode($myObject); // outputs JSON text
*/

/*
       $deviceid = $_POST['deviceid'];               
       $url_send = 'http://63.49.0.192:8084/configbackup/'.$deviceid;
        $json_response = sendPostData($url_send);
*/
// An associative array
$json = '{
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
  "deviceIpAddr": "10.198.238.19"}';
$output = json_decode($json,true);
echo  "<b> Device Ip Address : </b>".$output['deviceIpAddr']."<br>";
echo "<br>";
echo "<b>Device Name       : ".$output['data']['devicename']."<br>";
echo "<b>Device OS         : ".$output['data']['deviceos']."<br>";
echo "<b>Device Series     : ".$output['data']['deviceseries']."<br>";
echo "<b>Discovery Status  : ".$output['data']['discoverystatus']."<br>";
echo "<b>Last Polled       : ".$output['data']['lastpolled']."<br>";
echo "<b>Model             : ".$output['data']['model']."<br>";
echo "<b>Node Version      : ".$output['data']['nodeVersion']."<br>";
echo "<b>Node Status       : ".$output['data']['nodestatus']."<br>";
echo "<b>System Contact    : ".$output['data']['sys_contact']."<br>";
echo "<b>System Location   : ".$output['data']['sys_location']."<br>";
echo "<br>";;

/*
$deviceid = $_POST['deviceid'];               
$url_send = 'http://63.49.0.192:8084/configbackup/'.$deviceid;
$json_response = sendPostData($url_send);
$output = json_decode($json_response,true);   
echo "<br>";
echo "<b>Backup Status : ".$output['data'][0]['status']."</b>";
echo "<br/>";
echo "<b>Filename : ".$output['data'][0]['data']."</b>";
*/
?>
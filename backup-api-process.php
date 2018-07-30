<?php
include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';
?>
<?php
$deviceid = $_POST['deviceid'];
// $deviceid = 5;
$url_send = 'http://10.134.179.82:8084/configbackup/' . $deviceid;
$json_response = sendPostData($url_send);

/*
 * $json_response = '{
 * "data": [
 * {
 * "data": "AKROOH20T1A_P_CI_0021_01-10_198_238_19-running_config-2018_24_0123_31",
 * "success": true
 * }
 * ],
 * "status": "success",
 * "success": false
 * }';
 */

$output = json_decode($json_response, true);
/*
 * echo "<br>";
 * print_r($output);
 */
$response = '';
foreach ($output['data'] as $key => $val) {
    $response .= "<br>";
    $response .= "<b>Backup Status : " . $val['status'] . "</b>";
    $response .= "<br/>";
    $response .= "<b>Filename : " . $val['data'] . "</b>";
}
echo $response;
?>
 

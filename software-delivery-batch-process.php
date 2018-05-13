<?php 
include "classes/db2.class.php"; 
include 'functions.php';
$data = $_POST; 
//print_r($_POST);
$batchmaster = array(
'batchid' => $_POST['batchid'],'batchstatus' => 's','batchscheddate' => now,'region' => 'dummy','batchtype' => 'sd','priority' => $_POST['sw_selpriority'],'username' => 'debarle','batchcreated' => '2018-05-11 16:10:05','deviceseries' => $_POST['device_series'],'nodeVersion' => $_POST['node_version'],'scriptname' => $_POST['swrp_filename'],'refmop' => '');
$output = batchmaster_insert($batchmaster);
$batchmembers = array('batchid' => $_POST['batchid'],'deviceid' => '7167','status' => 's');
$output = batchmembers_insert($batchmembers);
$response = array(status=>"success insertion");
echo "inserted";
//echo json_encode($response); 
//exit(json_encode($response, 1));
function batchmaster_insert($batchmaster) {
global $db2;
$columns = implode(", ",array_keys($batchmaster));
$escaped_values = array_map('mysql_real_escape_string', array_values($batchmaster));
$values  = implode("', '", $escaped_values); 
$sql = "INSERT INTO batchmaster ($columns) VALUES ('$values')"; 
$db2->query($sql);
$result=$db2->execute(); 
return;
}; 

function batchmembers_insert($batchmembers) {
global $db2;
$columns = implode(", ",array_keys($batchmembers));
$escaped_values = array_map('mysql_real_escape_string', array_values($batchmembers));
$values  = implode("', '", $escaped_values); 
$sql = "INSERT INTO batchmembers ($columns) VALUES ('$values')"; 
$db2->query($sql);
$result=$db2->execute(); 
return;
}
?>
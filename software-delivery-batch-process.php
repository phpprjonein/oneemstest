<?php 
include "classes/db2.class.php"; 
include 'functions.php';
//$data = 'batch success';
$data = $_POST; 
  /*
  $sql = "INSERT INTO items (title,description)  
	VALUES ('".$post['title']."','".$post['description']."')"; 
  $result = $mysqli->query($sql); 
  $sql = "SELECT * FROM items Order by id desc LIMIT 1";  
  $result = $mysqli->query($sql); 
  $data = $result->fetch_assoc(); 
 */
//print_r($_POST);
$batchmaster = array(
'batchid' => $_POST['batchid'],'batchstatus' => 's','batchscheddate' => now,'region' => 'dummy','batchtype' => 'sd','priority' => $_POST['sw_selpriority'],'username' => 'debarle','batchcreated' => '2018-05-11 16:10:05','deviceseries' => $_POST['device_series'],'nodeVersion' => $_POST['node_version'],'scriptname' => $_POST['swrp_filename'],'refmop' => '');
$output = batchmaster_insert($batchmaster);
$response = array(status=>"success insertion");
echo "inserted";
//echo json_encode($response); 
//exit(json_encode($response, 1));


function batchmaster_insert($batchmaster) {
global $db2;
$columns = implode(", ",array_keys($batchmaster));
$escaped_values = array_map('mysql_real_escape_string', array_values($batchmaster));
//$values  = implode(", ", $escaped_values);
//$sql = "INSERT INTO `fbdata`($columns) VALUES ($values)";
$values  = implode("', '", $escaped_values); 
$sql = "INSERT INTO batchmaster ($columns) VALUES ('$values')"; 
$db2->query($sql);
$result=$db2->execute(); 
return;
} 
?>
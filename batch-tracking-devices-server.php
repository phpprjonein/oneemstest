<?php 
include "classes/db2.class.php"; 
include 'functions.php';
$userid = $_SESSION['userid']; 
//$device_list = get_device_list_from_nodes($_SESSION['userid']); 
//$device_list = get_device_list_from_nodes_datatable($_SESSION['userid']); 

$_GET['listname'] = empty($_GET['listname']) ? 'Default' : $_GET['listname'];

$batch_list = get_devicebatch_list_from_devicebatch_datatable($_SESSION['userid'], $_GET['listname']); 
//$batch_list = get_devicebatch_list_from_devicebatch_datatable($_SESSION['userid']); 
// print_r($device_list);
exit(json_encode($batch_list, 1));
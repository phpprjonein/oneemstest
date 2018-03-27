<?php 
include "classes/db2.class.php"; 
include 'functions.php';
$userid = $_SESSION['userid']; 
//$device_list = get_device_list_from_nodes($_SESSION['userid']); 
//$device_list = get_device_list_from_nodes_datatable($_SESSION['userid']); 
$_GET['listname'] = empty($_GET['listname']) ? '0' : $_GET['listname'];
$backup_list = get_device_list_from_backuprestore_datatable($_SESSION['userid'], $_GET['listname']); 
// print_r($device_list);
exit(json_encode($backup_list, 1));
<?php 
include "classes/db2.class.php"; 
include 'functions.php';
$userid = $_SESSION['userid'];  
//$_GET['listname'] = empty($_GET['listname']) ? '0' : $_GET['listname'];
//$backup_list = get_batch_process_datatable($_SESSION['userid'], $_GET['listname']); 
$swdelvry_dev_list = swt_get_batch_process_datatable($userid, $_GET['listname']); 
//print_r($swdelvry_dev_list);
exit(json_encode($swdelvry_dev_list, 1));
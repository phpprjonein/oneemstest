<<<<<<< HEAD
<?php

include "classes/db2.class.php"; 
include 'functions.php';
$userid = $_SESSION['userid']; 
//$device_list = get_device_list_from_nodes($_SESSION['userid']); 
$device_list = get_device_list_from_nodes_datatable($_SESSION['userid']); 
// print_r($device_list);
=======
<?php

include "classes/db2.class.php"; 
include 'functions.php';
$userid = $_SESSION['userid']; 
//$device_list = get_device_list_from_nodes($_SESSION['userid']); 
$device_list = get_device_list_from_nodes_datatable($_SESSION['userid']); 
// print_r($device_list);
>>>>>>> f925d24473e59e9234a9eee7f64f09b390f58d46
exit(json_encode($device_list, 1)); 
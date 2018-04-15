<<<<<<< HEAD
<?php

include "classes/db2.class.php"; 
include 'functions.php';
 


$userid = $_SESSION['userid'];
$listid = $_GET['listid'];
//$device_list = get_device_list_from_nodes($_SESSION['userid']); 
$resultset = user_mylist_devieslist_datatable($userid,$listid); 


=======
<?php

include "classes/db2.class.php"; 
include 'functions.php';
 


$userid = $_SESSION['userid'];
$listid = $_GET['listid'];
//$device_list = get_device_list_from_nodes($_SESSION['userid']); 
$resultset = user_mylist_devieslist_datatable($userid,$listid); 


>>>>>>> f925d24473e59e9234a9eee7f64f09b390f58d46
exit(json_encode($resultset, 1));
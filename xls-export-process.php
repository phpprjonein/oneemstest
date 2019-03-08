<?php
ini_set('display_errors',1);

// load library
require 'classes/php-excel.class.php';

include 'classes/db2.class.php';
include 'functions.php';

$resultset = user_mylist_devieslist_export($_GET['userid'], $_GET['listid']);

$data[] = array('Site ID', 'Site Name', 'Device Name', 'IP Address');

foreach ($resultset['data'] as $key => $value){
    $data[] = array($value['csr_site_id'], $value['csr_site_name'], $value['devicename'], $value['deviceIpAddr']);
}
/*
print '<pre>';
print_r($data);
die;
*/

/*
$switch_names = generic_get_csr_switch_names();

$data[] = array('Switch');
foreach ($switch_names['result'] as $key => $value){
    $data[] = array($value['switch_name']);
}*/

// generate file (constructor parameters are optional)
$xls = new Excel_XML('UTF-8', false, 'Sheet');
$xls->addArray($data);
$xls->generateXML('ONE-EMS');
?>
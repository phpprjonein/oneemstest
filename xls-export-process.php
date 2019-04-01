<?php
ini_set('display_errors', 1);

// load library
require 'classes/php-excel.class.php';
include 'classes/db2.class.php';
include 'functions.php';

if ($_GET['case'] == 'healthcheck') {
    $resultset = user_mylist_devieslist_export($_GET['userid'], $_GET['listid']);
    $data[] = array(
            'Site ID',
            'Site Name',
            'Device Name',
            'IP Address',
            'Market',
            'Device Series',
            'Version',
            'Last Polled'
    );
    foreach ($resultset['data'] as $key => $value) {
        $data[] = array(
                $value['csr_site_id'],
                $value['csr_site_name'],
                $value['devicename'],
                $value['deviceIpAddr'],
                $value['market'],
                $value['deviceseries'],
                $value['nodeVersion'],
                $value['lastpolled']
        );
    }
}

if ($_GET['case'] == 'backup') {
    $resultset = get_device_list_from_backuprestore_datatable_export($_GET['userid'], $_GET['listname']);
    $data[] = array(
            'Device Name',
            'Site ID',
            'Site Name',
            'Region',
            'Market',
            'Device Series',
            'Version',
    );
    foreach ($resultset['data'] as $key => $value) {
        $data[] = array(
                $value['devicename'],
                $value['csr_site_id'],
                $value['csr_site_name'],
                $value['region'],
                $value['market'],
                $value['deviceseries'],
                $value['nodeVersion']
        );
    }
}

if ($_GET['case'] == 'batch-tracking') {
    $resultset = get_devicebatch_list_from_devicebatch_datatable_export();
    $data[] = array(
            'Batch ID',
            'Filename',
            'Device Series',
            'Device OS',
            'Created Date',
            'Status',
    );
    foreach ($resultset['data'] as $key => $value) {
        $data[] = array(
                $value['batchid'],
                $value['scriptname'],
                $value['deviceseries'],
                $value['nodeVersion'],
                $value['batchcreated'],
                $value['batchstatus']
        );
    }
}
if ($_GET['case'] == 'sw-delivery-devices') {
    $resultset = swt_get_batch_process_datatable_export($_GET['userid'], $_GET['listname'], $_GET['deviceseries']);
    $data[] = array(
            'IP Address',
            'Device Name',
            'Device Series',
            'Market',
            'Current Version'
    );
    foreach ($resultset['data'] as $key => $value) {
        $data[] = array(
                $value['deviceIpAddr'],
                $value['devicename'],
                $value['deviceseries'],
                $value['market'],
                $value['nodeVersion']
        );
    }
}



// print '<pre>';
// print_r($data);
// die();
// generate file (constructor parameters are optional)
$xls = new Excel_XML('UTF-8', false, 'Sheet');
$xls->addArray($data);
$xls->generateXML('ONE-EMS');
?>
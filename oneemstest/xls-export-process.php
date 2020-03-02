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
if ($_GET['case'] == 'batch-tracking-rerun') {
    $resultset = get_devicebatch_list_from_devicebatch_rerun_datatable_export();
    $data[] = array(
            'Batch ID',
            'Devicename',
            'Filename',
            'Device Series',
            'Device OS',
            'Created Date',
            'Status',
    );
    foreach ($resultset['data'] as $key => $value) {
        $data[] = array(
                $value['batchid'],
                $value['devicename'],
                $value['scriptname'],
                $value['deviceseries'],
                $value['nodeVersion'],
                $value['batchcreated'],
                $value['status']
        );
    }
}
if ($_GET['case'] == 'sw-delivery-devices' || $_GET['case'] == 'reboot' ) {
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
if ($_GET['case'] == 'sw-bootorder-seq' ) {
    $resultset = swt_get_batch_process_datatable_export($_GET['userid'], $_GET['listname'], $_GET['deviceseries']);
    $data[] = array(
            'ID',
            'IP Address',
            'Device Name',
            'Device Series',
            'Market',
            'Current Version'
    );
    foreach ($resultset['data'] as $key => $value) {
        $data[] = array(
                $value['id'],
                $value['deviceIpAddr'],
                $value['devicename'],
                $value['deviceseries'],
                $value['market'],
                $value['nodeVersion']
        );
    }
}
if ($_GET['case'] == 'auditing-log' || $_GET['case'] == 'cus-auditing-log' ) {
    $userid = $_SESSION['userid'];
    $swdelvry_dev_list = swt_get_auditlog_batch_process_datatable_export($userid, $_GET['listname'], $_GET['deviceseries']);
    $data[] = array(
            'Device Name',
            'IP Address',
            'Market',
            'Device Series',
            'Version',
            'Audit Run',
            'Audit Status',
            'Compliance log',
    );
    foreach ($swdelvry_dev_list['data'] as $key => $value) {
        $data[] = array(
                $value['devicename'],
                $value['deviceIpAddr'],
                $value['market'],
                $value['deviceseries'],
                $value['nodeVersion'],
                $value['aurundate'],
                $value['austatus'],
                $value['devicename'].'.txt'
        );
    }
}

if ($_GET['case'] == 'audithistory' ) {
    $userid = $_SESSION['userid'];
    $swdelvry_dev_list = get_audithistory_datatable_export();
    $data[] = array(
            'Batch ID',
            'User Name',
            'Device Name',
            'IP Address',
            'Market',
            'Device Series',
            'Region',
            'Status',
            'Customized Audit Log',
            'Created date',
    );
    foreach ($swdelvry_dev_list['data'] as $key => $value) {
        $data[] = array(
                $value['batchid'],
                $value['username'],
                $value['devicename'],
                $value['deviceIpAddr'],
                $value['market'],
                $value['deviceseries'],
                $value['region'],
                $value['austatus'],
                $value['filename'],
                $value['createddate'],
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
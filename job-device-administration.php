<?php
// load library
require 'classes/php-excel.class.php';
include 'classes/db2.class.php';
include 'functions.php';

define('ONE_EMS_ROOT', __DIR__);
echo date('d-m-Y');
$resultset = $data = array();
$resultset = load_tab_content('ipcase1');
if (isset($resultset)) {
    // open the file "demosaved.csv" for writing
    $file = fopen(ONE_EMS_ROOT . '/upload/admin/siteid_ipv4_ipv6_same.csv', 'w');
    // save the column headers
    fputcsv($file, array(
            'ID',
            'Device Name',
            'IPv4 Address',
            'IPv6 Address'
    ));
    // Sample data. This can be fetched from mysql too
    foreach ($resultset as $key1 => $value1) {
        foreach ($value1 as $key => $value) {
            $data[] = array(
                    $value['id'],
                    $value['devicename'],
                    $value['deviceIpAddr'],
                    $value['deviceIpAddrsix']
            );
            ?>
                           		<?php
        }
    }
    // save each row of the data
    foreach ($data as $row) {
        fputcsv($file, $row);
    }
    // Close the file
    fclose($file);
}
$resultset = $data = array();
$resultset = load_tab_content('ipcase2');
if (isset($resultset)) {
    // open the file "demosaved.csv" for writing
    $file = fopen(ONE_EMS_ROOT . '/upload/admin/ipv4_ipv6_same.csv', 'w');
    // save the column headers
    fputcsv($file, array(
            'ID',
            'Device Name',
            'IPv4 Address',
            'IPv6 Address'
    ));
    // Sample data. This can be fetched from mysql too
    foreach ($resultset as $key1 => $value1) {
        foreach ($value1 as $key => $value) {
            $data[] = array(
                    $value['id'],
                    $value['devicename'],
                    $value['deviceIpAddr'],
                    $value['deviceIpAddrsix']
            );
            ?>
                           		<?php
        }
    }
    // save each row of the data
    foreach ($data as $row) {
        fputcsv($file, $row);
    }
    // Close the file
    fclose($file);
}

$resultset = $data = array();
$resultset = load_tab_content('ipcase3');
if (isset($resultset)) {
    // open the file "demosaved.csv" for writing
    $file = fopen(ONE_EMS_ROOT . '/upload/admin/siteid_ipv4_or_ipv6_same.csv',
            'w');
    // save the column headers
    fputcsv($file, array(
            'ID',
            'Device Name',
            'IPv4 Address',
            'IPv6 Address'
    ));
    // Sample data. This can be fetched from mysql too
    foreach ($resultset as $key1 => $value1) {
        foreach ($value1 as $key => $value) {
            $data[] = array(
                    $value['id'],
                    $value['devicename'],
                    $value['deviceIpAddr'],
                    $value['deviceIpAddrsix']
            );
            ?>
                           		<?php
        }
    }
    // save each row of the data
    foreach ($data as $row) {
        fputcsv($file, $row);
    }
    // Close the file
    fclose($file);
}
$resultset = $data = array();
$resultset = load_tab_content('ipcase4');
if (isset($resultset)) {
    // open the file "demosaved.csv" for writing
    $file = fopen(ONE_EMS_ROOT . '/upload/admin/ipv4_or_ipv6_same.csv', 'w');
    // save the column headers
    fputcsv($file, array(
            'ID',
            'Device Name',
            'IPv4 Address',
            'IPv6 Address'
    ));
    // Sample data. This can be fetched from mysql too
    foreach ($resultset as $key1 => $value1) {
        foreach ($value1 as $key => $value) {
            $data[] = array(
                    $value['id'],
                    $value['devicename'],
                    $value['deviceIpAddr'],
                    $value['deviceIpAddrsix']
            );
            ?>
                           		<?php
        }
    }
    // save each row of the data
    foreach ($data as $row) {
        fputcsv($file, $row);
    }
    // Close the file
    fclose($file);
}

die('Data files generated successfully');


//Email code multiple files


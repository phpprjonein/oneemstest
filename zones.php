<?php
ini_set('display_errors', 1);
include "classes/db2.class.php";
include 'functions.php';

$resp_zones_result_arr_callout_zone_list['user']['prefs']['calloutzones'] = get_user_zone_list($_SESSION['username']);

// Deleting when API not in REACH
if (count($resp_zones_result_arr_callout_zone_list) == 0) {
    $sql = "DELETE FROM userdevices WHERE userid='" . $_SESSION['userid'] ."' AND listtype = 'cz'";
    $db2->query($sql);
    $db2->execute();
}
$calloutzone_arr = $devicename_arr = $devicename_arr_top = array();
if (isset($resp_zones_result_arr_callout_zone_list['user']['prefs']['calloutzones'])) {
    foreach ($resp_zones_result_arr_callout_zone_list['user']['prefs']['calloutzones'] as $key => $val) {
        $calloutzone_arr[] = $val;
    }
}
if (count($calloutzone_arr) > 0) {
    foreach ($calloutzone_arr as $czkey => $czval) {
        $devicename_arr_top = get_user_zone_deviceslist($czval);
        foreach ($devicename_arr_top as $key => $val) {
            $devicename_arr[] = $val['csr_hostnames'];
            $records_to_update_zones[$czval][] = array('devicename' => $val['csr_hostnames']);
        }
    }
}

// if (isset($devicename_arr) && $_SESSION['zones'] == 0) {
if (isset($devicename_arr)) {
    $sql = "SELECT id, devicename from nodes where devicename in ('" .implode("','", $devicename_arr) . "')";
    $db2->query($sql);
    $resultset = $db2->resultset();
    
    foreach ($resultset as $key => $val) {
        $device_info[$val['devicename']] = $val['id'];
    }
    
    $sql = "DELETE FROM userdevices WHERE userid='" . $_SESSION['userid'] ."' AND listtype = 'cz'";
    $db2->query($sql);
    $db2->execute();
    
    $oc = 1;
    $dsql = 'INSERT INTO `userdevices` (`nodeid`, `userid`, `listid`, `listname`, `listtype`) VALUES';
    
    $current_list_id = 0;
    foreach ($records_to_update_zones as $key => $val) {
        if ($current_list_id == 0) {
            $listid[$key] = get_user_mylist_id_by_name($key);
            if (empty($listid[$key])) {
                $sql = "SELECT  max(listid) + 1  as listidmaxval FROM userdevices WHERE listid <> 0 ";
                $db2->query($sql);
                $recordset = $db2->resultset();
                $listid[$key] = $recordset[0]['listidmaxval'];
                $current_list_id = $recordset[0]['listidmaxval'];
            }
        } else {
            $listid[$key] = $current_list_id + 1;
        }
        foreach ($val as $keyd => $vald) {
            $device_info[$vald['devicename']] = empty($device_info[$vald['devicename']]) ? 0 : $device_info[$vald['devicename']];
            if (! empty($device_info[$vald['devicename']])) {
                $dsql .= "('" . $device_info[$vald['devicename']] . "'," .$_SESSION['userid'] . ",'" . $listid[$key] . "','" . $key ."','cz'),";
                $oc ++;
            }
        }
    }
    if ($oc > 1) {
        $dsql = substr_replace($dsql, '', - 1);
        $db2->query($dsql);
        $db2->execute();
    }
}
?>
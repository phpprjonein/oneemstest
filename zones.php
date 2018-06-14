<?php
include_once "classes/db2.class.php";
include_once 'functions.php';
ini_set('display_errors',1);

$sql = "SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'";
$db2->query($sql);
$recordset = $db2->resultset();

if ($recordset[0]['zones'] == 0) {
    $output_callout_zone_list = @file_get_contents('http://localhost/oneemstest/' . $_SESSION['username'] . '_callout_zone_list.php');
    $resp_zones_result_arr_callout_zone_list = json_decode($output_callout_zone_list, 1);
    $resp_zones_result_arr = array();
    if (isset($resp_zones_result_arr_callout_zone_list['user']['prefs']['calloutzones'])) {
        foreach ($resp_zones_result_arr_callout_zone_list['user']['prefs']['calloutzones'] as $key => $val) {
            $valrc = rawurlencode($val);
            $output_zones = @file_get_contents(('http://localhost/oneemstest/calloutzonesAPI/' . $_SESSION['username'] . '_callout_zone_' . $valrc . '_list.php'));
            $output_zones_resp_result_arr = json_decode($output_zones, 1);
            $resp_zones_result_arr[$val] = $output_zones_resp_result_arr['site_devices'];
        }
    }
    
    foreach ($resp_zones_result_arr as $key => $val) {
        foreach ($val as $dkey => $dval) {
            if (count($dval['csr_hostnames']) > 0) {
                foreach ($dval['csr_hostnames'] as $hkey => $hval) {
                    $_SESSION['sel_switch_name'] = ($_SESSION['sel_switch_name'] == '') ? $dval['switch'] : $_SESSION['sel_switch_name'];
                    $records_to_update_zones[$key][] = array(
                        'devicename' => $hval,
                        'csr_site_tech_name' => $dval['techname'],
                        'switch_name' => $dval['switch'],
                        'csr_site_id' => $dval['siteid']
                    );
                    $devicename_arr[] = $hval;
                    if (! in_array($dval['switch'], $swt_mswitch_arr)) {
                        $swt_mswitch_arr[] = $dval['switch'];
                    }
                }
            }
        }
    }
    
    $sql = "SELECT id, devicename from nodes where devicename in ('" . implode("','", $devicename_arr) . "')";
    $db2->query($sql);
    $resultset = $db2->resultset();
    
    foreach ($resultset as $key => $val) {
        $device_info[$val['devicename']] = $val['id'];
    }
    
    $dsql = 'INSERT INTO `userdevices` (`nodeid`, `userid`, `listid`, `listname`) VALUES';
    $oco = 1;
    foreach ($records_to_update_zones as $key => $val) {
        $sql = "DELETE FROM userdevices WHERE listname='" . $key . "'";
        $db2->query($sql);
        $db2->execute();
        $sql = "SELECT  max(listid) + 1  as listidmaxval FROM userdevices WHERE listid <> 0 ";
        $db2->query($sql);
        $recordset = $db2->resultset();
        $listid = $recordset[0]['listidmaxval'];
        
        $oc = 1;
        foreach ($val as $keyd => $vald) {
            $device_info[$vald['devicename']] = empty($device_info[$vald['devicename']]) ? 0 : $device_info[$vald['devicename']];
            if (count($val) == $oc && $oco == count($records_to_update_zones)) {
                $dsql .= "('" . $device_info[$vald['devicename']] . "'," . $_SESSION['userid'] . ",'" . $listid . "','" . $key . "')";
            } else {
                $dsql .= "('" . $device_info[$vald['devicename']] . "'," . $_SESSION['userid'] . ",'" . $listid . "','" . $key . "'),";
            }
            $oc ++;
        }
        $oco ++;
    }
    if ($oc > 1) {
        $db2->query($dsql);
        $db2->execute();
        $sql = "update users set zones = 1 WHERE username = '" . $_SESSION['username'] . "'";
        $db2->query($sql);
        $db2->execute();
    }
}

?>
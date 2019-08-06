<?php
include "classes/db2.class.php";
include 'functions.php';
$userid = $_SESSION['userid'];
ini_set('display_errors', 1);

if ($_POST['ctype'] == 'Sync Password') {
    $ip_address = $_POST['syncpass_ipaddress'];
    $devicename = get_device_name_from_ip_address($ip_address);
    $cyberarc_command = "cd /usr/apps/oneems/python/cyberark ; ./update_account.ksh " . $ip_address ." " . $devicename[0]['devicename'];
    $cyberarc_output = shell_exec($cyberarc_command);
    echo $cyberarc_output = "Sync Password Status : " . $cyberarc_output;
    
}
if ($_POST['ctype'] == 'SyncCyberArk') {
    $ip_address = $_POST['syncpass_ipaddress'];
    $devicename = get_device_name_from_ip_address($ip_address);
    //$cyberarc_command = "cd /usr/apps/oneems/python/cyber_check;"." ". "./check_cyberark.ksh " .  $ip_address; 
	$cyberarc_command = "cd /usr/apps/oneems/python/cyber_check; ./check_cyberark.ksh " .  $ip_address ." " . $devicename[0]['devicename'];
    $cyberarc_output = shell_exec($cyberarc_command);
    echo $cyberarc_output = "Sync Cyberark Status : " . $cyberarc_output;
}

if ($_POST['ctype'] ==  'CyberArkadd') {
     $ip_address = $_POST['syncpass_ipaddress'];
     $devicename = get_device_name_from_ip_address($ip_address);
     $cyberarc_command = "cd /usr/apps/oneems/python/cyber_add ; ./add_accts.ksh " .$ip_address ." " . $devicename[0]['devicename'];
     $cyberarc_output = shell_exec($cyberarc_command);
     echo $cyberarc_output =  "Status: " . $cyberarc_output;
}

if (isset($_POST['categorylist']) && $_POST['ctype'] == 'BatchTabUPdateAddAddAllDevices') {
    global $db2;
    echo $sql = "SELECT distinct(n.id), n.deviceIpAddr, n.devicename, n.deviceseries, n.market, n.nodeVersion FROM userdevices ud JOIN nodes n on ud.nodeid = n.id WHERE ud.userid = ".$_SESSION['userid']." AND(ud.listname = '".$_POST['categorylist']."') AND(n.deviceseries = '".$_SESSION['batch_vars']['deviceseries']."') AND(n.nodeVersion = '".$_SESSION['batch_vars']['deviceos']."') ORDER BY n.market asc";
    $db2->query($sql);
    $resultset = $db2->resultset();
    foreach ($resultset as $key => $val) {
        $category[] = $val['id'];
    }
    if(isset($category) && count($category) > 0){
        $category = implode(',',$category);
        $_SESSION['batchtype-dt-filter'] = 'Script Execution';
        update_dev_batch($_POST['batchid'], $category, $_POST['scriptname'], $_POST['deviceseries'], $_POST['deviceos'], $_POST['priority'], $_POST['refmop']);
    }
}



if (isset($_POST['category']) && $_POST['ctype'] == 'BatchTabUPdate') {
    $_SESSION['batchtype-dt-filter'] = 'Script Execution';
    update_dev_batch($_POST['batchid'], $_POST['category'], $_POST['scriptname'], $_POST['deviceseries'], $_POST['deviceos'], $_POST['priority'], $_POST['refmop']);
}

if (isset($_POST['category']) && $_POST['ctype'] == 'BWBatchTabUPdate') {
    $switchvarsips = get_switchvars_ips($_POST['bwswitch_type']);
    $ipaddress_arr = array($_POST['ip-address'], $switchvarsips[0]['swvarval'], $switchvarsips[1]['swvarval']);
    $scriptname_arr = explode(',',$_POST['scriptname']);
    $batchid_arr = array($_POST['batchid'], $_POST['batchid'] + 1, $_POST['batchid'] + 2);
    $_SESSION['batchtype-dt-filter'] = 'Script Execution';
    update_dev_batch_bw($batchid_arr, $ipaddress_arr, $scriptname_arr , $_POST['deviceseries'], $_POST['deviceos'], $_POST['priority'], $_POST['refmop']);
    
    
    /*
    print '<pre>';
    print_r($ipaddress);
    print_r($scriptname_arr);
    print_r($batchid_arr);
    die;
    
    $ipaddress_details = get_device_ids_from_ip_address($ipaddress);
    foreach ($ipaddress_details as $key => $val){
        $devices_selected[$val['deviceIpAddr']] = $val['id'];
    }
    
    print '<pre>';
    print_r($devices_selected);
    die;
    
    $i = 0;
    foreach ($devices_selected as $key1 => $val1){
        if(isset($key1[$ipaddress[$i]]) && !empty($key1[$ipaddress[$i]]) && isset($scriptname_arr[$i]) && !empty($scriptname_arr[$i])){
            update_dev_batch($_POST['batchid'], $key1, $scriptname_arr[$i] , $_POST['deviceseries'], $_POST['deviceos'], $_POST['priority'], $_POST['refmop']);
            $i++;
        }
    }*/
    
    
}


if (isset($_POST['type']) && $_POST['type'] == 'autocomplete' && isset($_POST['case']) && $_POST['case'] == 'refresh-switch') {
    $region = $_POST['region'];
    $market = $_POST['market'];
    $switch_names = generic_get_switch_name_by_region_market($region, $market);
    $output = '<option value="">- SELECT  Switch Name -</option>';
    foreach ($switch_names['result'] as $key => $val) :
        $output .= '<option value="' . $val['switch_name'] . '">' . $val['switch_name'] . '</option>';
    endforeach
    ;
    echo $output;
}

if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['region']) && empty($_POST['action'])) {
    $market_list = get_ipallocation_market_list($_POST['region']);
    foreach ($market_list['result'] as $mkey => $mvalue) {
        if (! empty($mvalue['market'])) {
            $output .= '<a class="dropdown-item" id="' . $mkey . '" href="#">' . $mvalue['market'] . '</a>';
        }
    }
    if ($_POST['page-id'] == 'discovery') :
        $output .= '<a class="dropdown-item" href="#">SELECT MARKET</a>';
    endif;
    
    echo $output;
}

if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'HC-IP-Validate-Disc') {
    $ipaddress = $_POST['ipaddress'];
    if (filter_var($ipaddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) || filter_var($ipaddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        echo 'success';
    }
}

if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'IP-Validate-Disc') {
    $ipaddress = $_POST['ipaddress'];
    if (filter_var($ipaddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) || filter_var($ipaddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        $ip_exist_arr = checkipexist($ipaddress);
        if($ip_exist_arr[0]['total'] > 0){
            echo 'ip-exist';
        }else{
            echo 'success';
        }
    }else{
        echo 'invalid-ip';
    }
}

if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'IP-Validate') {
    $ipaddress = $_POST['subnet'];
    $resultset = check_subnet_already_exist($ipaddress . '/' . $_POST['mask']);
    if ($resultset[0]['cnt'] > 0) {
        echo 'duplicates';
        exit();
    }
    if ($_POST['type'] == 'IPv4' && filter_var($ipaddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        echo 'success';
    } elseif ($_POST['type'] == 'IPv6' && filter_var($ipaddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        echo 'success';
    }
}

if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'COMPUTE') {
    $subnet_whole = $_POST['subnet'] . '/' . $_POST['mask'];
    $ipvfourorsix = strpos($subnet_whole, '.');
    if ($ipvfourorsix === false) {
        $ipvsix_details = getipvsix_details($subnet_whole);
        print $ipvsix_details['fromipvsix'] . ' ' . $ipvsix_details['count'] . ' ' . $ipvsix_details['toipvsix'];
    } else {
        $ipvfour_details = getipvfour_details($subnet_whole);
        print $ipvfour_details[0] . ' ' . count($ipvfour_details) . ' ' . $ipvfour_details[count($ipvfour_details) - 1];
    }
}

if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'ADD' && isset($_POST['region'])) {
    $subnet_whole = $_POST['subnet'] . '/' . $_POST['mask'];
    $values_arr = array(
        'cust_gvn_region' => '',
        'region' => $_POST['region'],
        'market' => $_POST['market'],
        'subnetmask' => $subnet_whole
    );
    insert_ip_allocation($values_arr);
    print 'success';
}

if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'Disc-OK' && isset($_POST['id']) && is_numeric(($_POST['id']))) {
    $_SESSION['disc_page_tab'] = 'OK';
    echo discovery_status_update('k', $_POST['id']);
}

if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'IP-Miss-Process' && isset($_POST['IP-address']) && isset($_POST['process'])) {
    $_SESSION['disc_page_tab'] = 'Missed';
    if ($_POST['process'] == 'OK') {
        process_missed_ip($_POST['IP-address'], 'OK');
    } elseif ($_POST['process'] == 'Remove') {
        process_missed_ip($_POST['IP-address'], 'Remove');
    }
}

if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'Add New') {
    
    $_SESSION['disc_page_tab'] = 'New';
    
    $categories = generic_get_categories();
    foreach ($categories['result'] as $key => $val) {
        $categories_arr[$val['categoryName']] = $val['id'];
    }
    $vendors = generic_get_vendors();
    foreach ($vendors['result'] as $key => $val) {
        $vendors_arr[$val['vendorName']] = $val['id'];
    }
    $_POST['csr_site_id'] = get_csr_site_id_from_csr_site_name($_POST['csr_site_name']);
    if (! is_numeric($_POST['csr_site_id'])) {
        $_POST['csr_site_id'] = 0;
    }
    $values_arr = array(
        'region' => $_POST['region'],
        'market' => $_POST['market'],
        'devicename' => $_POST['devicename'],
        'deviceIpAddr' => $_POST['deviceIpAddr'],
        'nodeAddedBy' => $_POST['nodeAddedBy'],
        'nodeCatId' => $categories_arr[$_POST['nodeCatId']],
        'vendorId' => $vendors_arr[$_POST['vendorId']],
        'deviceseries' => $_POST['deviceseries'],
        'status' => $_POST['status'],
        'csr_site_tech_name' => $_POST['csr_site_tech_name'],
        'csr_site_tech_mgr_name' => $_POST['csr_site_tech_mgr_name'],
        'csr_site_id' => $_POST['csr_site_id'],
        'systemname' => $_POST['systemname'],
        'deviceos' => $_POST['deviceos'],
        'csr_site_tech_id' => $_POST['csr_site_tech_id'],
        'csr_site_tech_mgr_id' => $_POST['csr_site_tech_mgr_id'],
        'csr_site_name' => $_POST['csr_site_name'],
        'nodeVersion' => $_POST['nodeVersion'],
        'lastpolled' => date('Y-m-d H:i:s', strtotime($_POST['lastpolled'])),
        'deviceDateAdded' => $_POST['deviceDateAdded'],
        'deviceLastUpdated' => date('Y-m-d H:i:s', strtotime($_POST['deviceLastUpdated'])),
        'upsince' => $_POST['upsince'],
        'switch_name' => $_POST['switch_name']
    );
    discovery_add_new_device($values_arr);
    echo "success";
}

if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'Tech Manager ID' && isset($_POST['csrsitetechid'])) {
    $technmgrames = get_csr_site_tech_mgr_id($_POST['csrsitetechid']);
    $output = '';
    foreach ($technmgrames['result'] as $key => $val) {
        $output .= '<option value="' . $val['csr_site_tech_mgr_id'] . '">' . $val['csr_site_tech_mgr_id'] . '</option>';
    }
    echo $output;
}

if (isset($_POST['type']) && $_POST['type'] == 'autocomplete' && isset($_POST['region']) && $_POST['market'] && isset($_POST['query']) && isset($_POST['category']) && $_POST['category'] == 'site-name') {
    echo get_csr_site_names($_POST['region'], $_POST['market']);
}

if (isset($_POST['type']) && $_POST['type'] == 'autocomplete' && isset($_POST['query']) && isset($_POST['category']) && $_POST['category'] == 'site-tech-name') {
    echo generic_get_csr_site_tech_name($query);
}

if (isset($_POST['type']) && $_POST['type'] == 'autocomplete' && isset($_POST['query']) && isset($_POST['category']) && $_POST['category'] == 'site-tech-name') {
    echo generic_get_csr_site_tech_name($query);
}

if (isset($_POST['type']) && $_POST['type'] == 'autocomplete' && isset($_POST['query']) && isset($_POST['category']) && $_POST['category'] == 'sectionheader') {
    $sectionheader = array('Interface - 1', 'Interface - 2', 'Interface - 3');
    echo json_encode($sectionheader);
}

if (isset($_POST['type']) && $_POST['type'] == 'autocomplete' && isset($_POST['query']) && isset($_POST['category']) && $_POST['category'] == 'name') {
    echo generic_get_usernames_ac_fn_ln_ro($query);
}


if (isset($_POST['type']) && $_POST['type'] == 'templduplicateschk' && isset($_POST['templname']) && $_POST['templname'] != '') {
    $resultset = check_templname_already_exist($_POST['templname']);
    if ($resultset[0]['cnt'] > 0) {
        echo 'exist';
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'loadauto' && isset($_POST['csr_tech_name'])) {
    echo get_csr_tech_mgr_name_from_tech_name($_POST['csr_tech_name']);
}
if (isset($_POST['type']) && $_POST['type'] == 'loadauto' && isset($_POST['csr_tech_id'])) {
    echo get_csr_tech_mgr_id_from_tech_id($_POST['csr_tech_id']);
}
if (isset($_POST['filename']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'GenerateScript') {
    $results = load_available_templates($_POST['filename'], $_POST['alias']);
    $output = '';
    foreach ($results as $key => $val) {
        if($_POST['scripttype'] != 'BW-Upgrade'){
            if(strpos($val['templname'], 'BW-Upgrade') !== false){
                continue;
            }
        }
        //$checked = (empty($output)) ? 'checked' : '';
        $output .= '<tr><td class="templname">' . $val['templname'] . '</td><td><input type="radio" class="rgrp" value="' . $val['templname'] . '" ' . $checked . ' name="radioGroup"></td><td><button type="submit" class="btn btn-primary btn-sm generate-script-delete">Delete</button></td></tr>';
    }
    echo $output;
    
    // echo '<tr><td>Golden_purpose1_xe_1561_ranvendor1_scripttype1_region1_switch1_market1</td><td><input type="radio" value="Golden_purpose1_xe_1561_ranvendor1_scripttype1_region1_switch1_market1" name="radioGroup"></td></tr>';
}

if (isset($_POST['tempname']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'GetUserVars') {
    
    echo get_tempate_uservars($_POST['tempname']);
    
    //echo 'BDI 400 LTE IPv6 Address,Telco Interface-ASR9010-Even';
}

if (isset($_POST['filename']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'DelGenerateScript') {
    delete_templname_already_exist($_POST['deltemp']);
    //if (file_exists(getcwd() .'/upload/'. $_POST['deltemp'] . ".txt")) {
    if (file_exists("/usr/apps/oneems/fs1/upload/". $_POST['deltemp'] . ".txt")) {
        //unlink(getcwd() .'/upload/'. $_POST['deltemp'] . ".txt");
        unlink("/usr/apps/oneems/fs1/upload/". $_POST['deltemp'] . ".txt");
    }
    $results = load_available_templates($_POST['filename'], $_POST['alias']);
    $output = '';
    foreach ($results as $key => $val) {
        $checked = (empty($output)) ? 'checked' : '';
        $output .= '<tr><td class="templname">' . $val['templname'] . '</td><td><input type="radio" class="rgrp" value="' . $val['templname'] . '" ' . $checked . ' name="radioGroup"></td><td><button type="submit" class="btn btn-primary btn-sm generate-script-delete">Delete</button></td></tr>';
    }
    echo $output;
}

if (isset($_POST['region']) && isset($_POST['category']) && ($_POST['category'] == 'cellsitetech' || $_POST['category'] == 'switchtech') && isset($_POST['act']) && $_POST['act'] == 'ip-del' && isset($_POST['subnet'])) {
    echo delete_ipallocation_by_subnet($_POST['region'], $_POST['subnet']);
}

if (isset($_POST['act']) && $_POST['act'] == 'batch-del' && isset($_POST['batchid'])) {
    $myfile = fopen('cancelledbatch/'.$_POST['batchid']."_cancelled.txt", "w") or die("Unable to open file!");
    fclose($myfile);
    echo delete_batchid($_POST['batchid']);
}

if ($_POST['ctype'] == 'SchedBakupSettings') {
    // update_schedbackup_settings($_POST['username'],$_POST['backup_occur'], $_POST['backup_day'], $_POST['backup_hours'], $_POST['backup_minutes'], $_POST['backup_timezone'],$_POST['backup_market'] );
    update_schedbackup_settings($_POST['username'], $_POST['backup_occur'], $_POST['backup_day'], $_POST['backup_hours'], $_POST['backup_minutes'], $_POST['schedbackup_type'], $_POST['backup_timezone'], $_POST['backup_market']);
    echo "success";
}
// //data: {'ctype':'manualdisc', 'devosval':$('#devosval').val(), 'devseriesval':$('#devseriesval').val(),'devstatusval':$('#devstatusval').val(), 'lastpollval':$('#lastpollval').val(), 'modelval':$('#modelval').val(), 'nodeverval': $('#nodeverval').val(),'statval':$('#statval').val(), 'sysconval':$('#sysconval').val(), syslocval : $('#syslocval').val(),upsinceval : $('#upsinceval').val(), mktval : $('#mktval').val()},
if ($_POST['ctype'] == 'manualdisc') {
    $_SESSION['disc_page_tab'] = 'Manual Discovery';
    // add_nodes_table($_POST['devosval'],$_POST['devseriesval'], $_POST['devstatusval'], $_POST['lastpollval'], $_POST['modelval'], $_POST['nodeverval'], $_POST['statval'],$_POST['sysconval'],$_POST['syslocval'],$_POST['upsinceval'],$_POST['mktval'] );
    // $test = $_POST['devosval'].$_POST['devseriesval'].$_POST['devstatusval'].$_POST['lastpollval']. $_POST['modelval'] . $_POST['nodeverval'] . $_POST['statval'] . $_POST['sysconval'] . $_POST['syslocval'] . $_POST['upsinceval'] . $_POST['mktval'];
    /*
     * $values_arr = array(
     * 'region' => "dummy",
     * 'market' => $_POST['mktval'],
     * 'devicename' => $_POST['devnameval'],
     * 'deviceIpAddr' => 'dummy',
     * 'nodeAddedBy' => $_SESSION['username'],
     * 'nodeCatId' => '',
     * 'vendorId' => '',
     * 'deviceseries' => $_POST['devseriesval'],
     * 'status' => $_POST['statval'],
     * 'csr_site_tech_name' => "",
     * 'csr_site_tech_mgr_name' => "",
     * 'csr_site_id' => "",
     * 'systemname' => "",
     * 'deviceos' => $_POST['devosval'],
     * 'csr_site_tech_id' => "",
     * 'csr_site_tech_mgr_id' => "",
     * 'csr_site_name' => "",
     * 'nodeVersion' => $_POST['nodeverval'],
     * 'lastpolled' => date('Y-m-d H:i:s',strtotime($_POST['lastpolled'])),
     * 'deviceDateAdded'=> $_POST['deviceDateAdded'],
     * 'deviceLastUpdated'=> date('Y-m-d H:i:s',strtotime($_POST['deviceLastUpdated'])),
     * 'upsince' => $_POST['upsinceval'],
     * 'switch_name' => "",
     * 'syslocation' => $_POST['syslocval'],
     * 'syscontact' => $_POST['sysconval'],
     * 'model' => $_POST['modelval']
     * );
     */
    $values_arr = array(
        'region' => $_POST['rgnval'],
        'market' => $_POST['mktval'],
        'devicename' => $_POST['devnameval'],
        'nodeAddedBy' => $_SESSION['username'],
        'nodeCatId' => '',
        'vendorId' => '',
        'deviceseries' => $_POST['devseriesval'],
        'status' => $_POST['status'],
        'csr_site_tech_name' => "",
        'csr_site_tech_mgr_name' => "",
        'csr_site_id' => "",
        'systemname' => "",
        'deviceos' => $_POST['devosval'],
        'csr_site_tech_id' => "",
        'csr_site_tech_mgr_id' => "",
        'csr_site_name' => "",
        'nodeVersion' => $_POST['nodeverval'],
        'lastpolled' => date('Y-m-d H:i:s', strtotime($_POST['lastpollval'])),
        'deviceDateAdded' => $_POST['deviceDateAdded'],
        'deviceLastUpdated' => date('Y-m-d H:i:s', strtotime($_POST['deviceLastUpdated'])),
        'upsince' => $_POST['upsinceval'],
        'switch_name' => $_POST['switchnameval'],
        'syslocation' => $_POST['syslocval'],
        'syscontact' => $_POST['sysconval'],
        'model' => $_POST['modelval']
    );
    if(filter_var($_POST['ip-address'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)){
        $values_arr['deviceIpAddrsix'] = $_POST['ip-address'];
    }else{
        $values_arr['deviceIpAddr'] = $_POST['ip-address'];
    }    
    discovery_add_new_device($values_arr);
    echo "successfrombackend";
}
if ($_POST['ctype'] == 'configtempluservar') {
    $values_arr = array(
        'usrvarname' => $_POST['usrvarname'],
        'usrvarval' => $_POST['usrvarval'],
        'deviceseries' => $_POST['deviceseries'],
        'templname' => $_POST['templname']
    );
    insert_uservars($values_arr);
}
if($_POST['ctype'] == 'BWBatchTabShow'){
    $scriptname = explode(',',$_POST['scriptname']);
    $output = '<div class="table-responsive"><table class="table"><thead><tr><th>Template</th><th>BatchID</th><th>IP Address</th></tr><tbody>';
    
    $switchvarsips = get_switchvars_ips($_POST['bwswitch_type']);
    if(count($switchvarsips) == 2){
        $status = 1;
        $ipaddress = array($_POST['ip-address'], $switchvarsips[0]['swvarval'], $switchvarsips[1]['swvarval']);
        $i = 0;
        foreach ($scriptname as $key => $val){
            $output .= '<tr>';
            $output .= '<td>'.$val.'</td><td>'.($_POST['batchid'] + $i).'</td><td>'.$ipaddress[$i].'</td>';
            $output .= '</tr>';
            $i++;
        }
    }else{
        $status = 0;
        $output .= '<tr>';
        $output .= '<td colspan="3">Batch Creation Failed, IP address for selected switch not found.</td>';
        $output .= '</tr>';
        
    }
    $output .= '</tbody></table></div>';
    $output = json_encode(array('result' => $output, 'status' => $status));
    echo $output;
}
if (isset($_POST['calltype']) && $_POST['calltype'] == 'configtrigger' && isset($_POST['select_switch']) && isset($_POST['action']) && $_POST['action'] == 'GenerateScriptDeviceLoad') {
    echo configtemplate_devicename_prefix_by_switch_name($_POST['select_switch']);    
}
if (isset($_POST['calltype']) && $_POST['calltype'] == 'inventorytrigger' && isset($_POST['select_region']) && isset($_POST['action']) && $_POST['action'] == 'LoadMarketBoxValues') {
    if($_POST['select_region'] != ''){
        $results = get_inventory_market_list($_POST['select_region']);
    }
    $output = '<option value="">- SELECT Market -</option>';
    foreach ($results['result'] as $key => $val){
        $output .= '<option value="'.$val['market'].'">'.$val['market'].'</option>';
    }
    echo $output;
    exit;
}
if (isset($_POST['calltype']) && $_POST['calltype'] == 'inventorytrigger' && isset($_POST['select_region']) && isset($_POST['action']) && $_POST['action'] == 'LoadRegionMarketFiles') {
    if($_POST['select_inventory_type'] == 'hw_inventory'){
        $path = '/usr/apps/oneems/sd/hw_inventory/';
    }elseif($_POST['select_inventory_type'] == 'sw_inventory'){
        $path = '/usr/apps/oneems/sd/sw_inventory/';
    }else{
        $path = '/usr/apps/oneems/sd/devices/';
    }

    $contents = array_values(array_diff(scandir($path), array(
            '.',
            '..'
    )));
    $output = '';
    $i=1;
    foreach ($contents as $key => $val) :
        if(strpos($val, $_POST['select_region'].'-'.$_POST['select_market']) !== false){
            $output .= '<tr id="row_'.$i.'"><td>'.$val.'</td><td><a href="download.php?file='.$path.$val.'" class="btn" role="button">download</a></td></td></tr>';
            $i++;
        }
	endforeach;
	if($i == 1){
	    $output .= '<tr id="row_'.$i.'"><td colspan="2">Files not found</td></tr>';
	}
    echo $output;
    exit;
}

// Retrieve US Files
if (isset($_POST['calltype']) && $_POST['calltype'] == 'inventorytrigger' && isset($_POST['select_region']) && isset($_POST['action']) && $_POST['action'] == 'LoadUSFiles') {
    if($_POST['select_inventory_type'] == 'hw_inventory'){
        //$path = '/usr/apps/oneems/sd/hw_inventory/';
        $path = '/usr/apps/oneems/sd/hw_inventory/';
    }elseif($_POST['select_inventory_type'] == 'sw_inventory'){
        $path = '/usr/apps/oneems/sd/sw_inventory/';
    }else{
        $path = '/usr/apps/oneems/sd/devices/';
    }

    $contents = array_values(array_diff(scandir($path), array(
            '.',
            '..'
    )));
    $output = '';
    $i=1;
    foreach ($contents as $key => $val) :
        //if(strpos($val, $_POST['select_region'].'-'.$_POST['select_market']) !== false){
            //if (strcmp($val,"USA_devices_inv.csv.zip") == 0 ) || strcmp($val,"USA_SW_inv.csv.zip") == 0 || strcmp($val,"USA_HW_inv.csv.zip") == 0) {
            if ($val == "USA_devices_inv.csv.zip" || $val == "USA_SW_inv.csv.zip" ||  $val == "USA_HW_inv.csv.zip" ) {
            $output .= '<tr id="row_'.$i.'"><td>'.$val.'</td><td><a href="download.php?file='.$path.$val.'" class="btn" role="button">download</a></td></td></tr>';
            //$output .= $val;
            $i++;
           }
        //}
        endforeach;
        if($i == 1){
            $output .= '<tr id="row_'.$i.'"><td colspan="2">Files not found</td></tr>';
        }
    echo $output;
    //if (strcmp($contents,"USA_devices_inv.csv.zip") == 0 ) {
   // print_r($contents);
    //};
    exit;
}
// Retrieve US Files

if (isset($_POST['calltype']) && $_POST['calltype'] == 'configtrigger' && isset($_POST['select_switch']) && isset($_POST['action']) && $_POST['action'] == 'GenerateScriptTimezoneLoad') {
    $results = get_market_from_node_by_switch_name($_POST['select_switch']);
    $market = ($results['result'][0]['market']);
    $results = get_market_timezone_from_marketvars($market);
    echo $results['result'][0]['mvarval']; exit;
}
if (isset($_POST['calltype']) && $_POST['calltype'] == 'configtrigger' && isset($_POST['select_switch']) && isset($_POST['action']) && $_POST['action'] == 'GenerateScriptTelcoInterfaceLoadEven') {
    $select_switch = $_POST['select_switch'];
    $select_script_type = $_POST['select_script_type'];
    $select_device_name = $_POST['select_device_name'];
    echo generate_option_button_for_configs_telco_interface($select_switch, 'even', $select_script_type, $select_device_name);
}
if (isset($_POST['calltype']) && $_POST['calltype'] == 'configtrigger' && isset($_POST['select_switch']) && isset($_POST['action']) && $_POST['action'] == 'GenerateScriptTelcoInterfaceLoadOdd') {
    $select_switch = $_POST['select_switch'];
    $select_script_type = $_POST['select_script_type'];
    $select_device_name = $_POST['select_device_name'];
    echo generate_option_button_for_configs_telco_interface($select_switch, 'odd', $select_script_type, $select_device_name);
}
if (isset($_POST['calltype']) && $_POST['calltype'] == 'configtrigger' && isset($_POST['select_switch']) && isset($_POST['action']) && $_POST['action'] == 'GenerateScriptLoadVlanEven') {
    $select_switch = $_POST['select_switch'];
    echo generate_option_button_for_configs_vlan($select_switch, 'even');
}
if (isset($_POST['calltype']) && $_POST['calltype'] == 'configtrigger' && isset($_POST['select_switch']) && isset($_POST['action']) && $_POST['action'] == 'GenerateScriptLoadVlanOdd') {
    $select_switch = $_POST['select_switch'];
    echo generate_option_button_for_configs_vlan($select_switch, 'odd');
}
if(isset($_GET['act']) && $_GET['act'] == 'delete' && isset($_GET['ntype']) && $_GET['ntype'] == 'admind' && isset($_POST['type']) && $_POST['type'] == 'api-ajax' && isset($_POST['id']) && is_numeric($_POST['id'])){
    
    $sql = "DELETE FROM nodes WHERE id='" . $_POST['id'] . "'";
    $db2->query($sql);
    $db2->execute();

    $output = '';
    $_POST['tab'] = str_replace('-table','',$_POST['tab']);
    $resultset = load_tab_content($_POST['tab']);
    
    
    
    if (isset($resultset)) {
        foreach ($resultset as $key1 => $value1) {
            foreach ($value1 as $key => $value) {
                        $output .= '<tr>
									<td>'.$value['id'].'</td>
									<td>'.$value['devicename'].'</td>
									<td>'.$value['deviceIpAddr'].'</td>
									<td>'.$value['deviceIpAddrsix'].'</td>
									<td><a href="#" class="del-device">Delete</a></td>
								</tr>';
            }
        }
        echo $output;
    }
}

if(isset($_GET['act']) && $_GET['act'] == 'delete' && isset($_GET['ntype']) && $_GET['ntype'] == 'auditd' && isset($_POST['type']) && $_POST['type'] == 'api-ajax' && isset($_POST['batchid']) && is_numeric($_POST['batchid'])){
    $sql = "DELETE FROM audithistory WHERE auhisid='" . $_POST['auhisid'] . "'";
    $db2->query($sql);
    $db2->execute();
    
    $output = '';
    
    $resultset = load_audittab_content();
    
    if (isset($resultset)) {
        foreach ($resultset as $key => $value) {
                $output .= '<tr data-auhisid="'.$value['auhisid'].'">
									<td>'.$value['batchid'].'</td>
									<td>'.$value['devicename'].'</td>
									<td>'.$value['deviceIpAddr'].'</td>
									<td>'.$value['deviceseries'].'</td>
									<td><a href="#" class="del-device">Delete</a></td>
								</tr>';
        }
        echo $output;
    }
}
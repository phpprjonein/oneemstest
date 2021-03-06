<?php
include "classes/db2.class.php";
include 'functions.php';
$userid = $_SESSION['userid'];
ini_set('display_errors',1);
if (isset($_POST['type']) && $_POST['type'] == 'autocomplete' && isset($_POST['case']) && $_POST['case'] == 'refresh-market') {
    $region = $_POST['region'];
    $markets = generic_get_market_by_region($region);
    $output = '<option value="">- SELECT  Market -</option>';
    foreach ($markets['result'] as $key => $val):
    $output .= '<option value="'.$val['market'].'">'.$val['market'].'</option>';
    endforeach;
    echo $output;
}

if (isset($_POST['type']) && $_POST['type'] == 'autocomplete' && isset($_POST['case']) && $_POST['case'] == 'refresh-switch') {
    $region = $_POST['region'];
    $market = $_POST['market'];
    $switch_names = generic_get_switch_name_by_region_market($region, $market);
    $output = '<option value="">- SELECT  Switch Name -</option>';
    foreach ($switch_names['result'] as $key => $val):
    $output .= '<option value="'.$val['switch_name'].'">'.$val['switch_name'].'</option>';
    endforeach;
    echo $output;
}

if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['region']) && empty($_POST['action'])) {
    $market_list = get_ipallocation_market_list($_POST['region']);
    foreach ($market_list['result'] as $mkey => $mvalue) {
        if (! empty($mvalue['market'])) {
            $output .= '<a class="dropdown-item" id="' . $mkey . '" href="#">' . $mvalue['market'] . '</a>';
        }
    }
    if($_POST['page-id'] == 'discovery'):
        $output .= '<a class="dropdown-item" href="#">SELECT MARKET</a>';
    endif;
    echo $output;
}

if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'IP-Validate-Disc') {
    $ipaddress = $_POST['ipaddress'];
    if(filter_var($ipaddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) || filter_var($ipaddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)){
        echo 'success';
    }
}

if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'IP-Validate') {
    $ipaddress = $_POST['subnet'];
    $resultset = check_subnet_already_exist($ipaddress.'/'.$_POST['mask']);
    if($resultset[0]['cnt'] > 0){
        echo 'duplicates'; exit();
    }
    if($_POST['type'] == 'IPv4' && filter_var($ipaddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)){
       echo 'success';
    }elseif($_POST['type'] == 'IPv6' && filter_var($ipaddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)){
        echo 'success';
    }
}   

if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'COMPUTE') {
    $subnet_whole = $_POST['subnet'].'/'.$_POST['mask'];
    $ipvfourorsix = strpos($subnet_whole, '.');
    if ($ipvfourorsix === false) {
        $ipvsix_details = getipvsix_details($subnet_whole);
        print $ipvsix_details['fromipvsix'].' '.$ipvsix_details['count'].' '.$ipvsix_details['toipvsix'];
    }else{
        $ipvfour_details = getipvfour_details($subnet_whole);
        print $ipvfour_details[0].' '.count($ipvfour_details).' '.$ipvfour_details[count($ipvfour_details)-1];
    }
}    

if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'ADD' &&  isset($_POST['region'])) {
    $subnet_whole = $_POST['subnet'].'/'.$_POST['mask'];
    $values_arr = array('cust_gvn_region' => '', 'region' => $_POST['region'], 'market' => $_POST['market'], 'subnetmask' => $subnet_whole);
    insert_ip_allocation($values_arr);
    print 'success';
}

if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'Disc-OK' && isset($_POST['id']) && is_numeric(($_POST['id']))){
    $_SESSION['disc_page_tab'] = 'OK';
    echo discovery_status_update('k', $_POST['id']);
}

if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'IP-Miss-Process' && isset($_POST['IP-address']) && isset($_POST['process'])){
    $_SESSION['disc_page_tab'] = 'Missed';
    if($_POST['process'] == 'OK'){
        process_missed_ip($_POST['IP-address'], 'OK');
    }elseif ($_POST['process'] == 'Remove'){
        process_missed_ip($_POST['IP-address'], 'Remove');
    }
}


if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'Add New'){
    
    $_SESSION['disc_page_tab'] = 'New';
    
    $categories = generic_get_categories();
    foreach ($categories['result'] as $key => $val){
        $categories_arr[$val['categoryName']] = $val['id'];
    }
    $vendors = generic_get_vendors();
    foreach ($vendors['result'] as $key => $val){
        $vendors_arr[$val['vendorName']] = $val['id'];
    }
    $_POST['csr_site_id'] = get_csr_site_id_from_csr_site_name($_POST['csr_site_name']);
    if(!is_numeric($_POST['csr_site_id'])){
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
        'lastpolled' => date('Y-m-d H:i:s',strtotime($_POST['lastpolled'])),        
        'deviceDateAdded'=>  $_POST['deviceDateAdded'],
        'deviceLastUpdated'=> date('Y-m-d H:i:s',strtotime($_POST['deviceLastUpdated'])),
        'upsince' => $_POST['upsince'],
        'switch_name' => $_POST['switch_name']
    );
    discovery_add_new_device($values_arr);
    echo "success";
}

if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'Tech Manager ID' && isset($_POST['csrsitetechid'])){
    $technmgrames = get_csr_site_tech_mgr_id($_POST['csrsitetechid']);
    $output = '';
    foreach ($technmgrames['result'] as $key => $val){
        $output .= '<option value="'.$val['csr_site_tech_mgr_id'].'">'.$val['csr_site_tech_mgr_id'].'</option>';	
    }   
    echo $output;
}

if(isset($_POST['type']) && $_POST['type'] == 'autocomplete' && isset($_POST['region']) && $_POST['market'] && isset($_POST['query']) && isset($_POST['category']) && $_POST['category'] == 'site-name'){
    echo get_csr_site_names($_POST['region'], $_POST['market']);
}

if(isset($_POST['type']) && $_POST['type'] == 'autocomplete' && isset($_POST['query']) && isset($_POST['category']) && $_POST['category'] == 'site-tech-name'){
    echo generic_get_csr_site_tech_name($query);
}

if(isset($_POST['type']) && $_POST['type'] == 'autocomplete' && isset($_POST['query']) && isset($_POST['category']) && $_POST['category'] == 'name'){
    echo generic_get_usernames_ac_fn_ln_ro($query);
}

if(isset($_POST['type']) && $_POST['type'] == 'templduplicateschk' && isset($_POST['templname']) && $_POST['templname'] != ''){
    $resultset = check_templname_already_exist($_POST['templname']);
    if($resultset[0]['cnt'] > 0){
        echo 'exist';
    }
}

if(isset($_POST['type']) && $_POST['type'] == 'loadauto' && isset($_POST['csr_tech_name'])){
    echo get_csr_tech_mgr_name_from_tech_name($_POST['csr_tech_name']);
}
if(isset($_POST['type']) && $_POST['type'] == 'loadauto' && isset($_POST['csr_tech_id'])){
    echo get_csr_tech_mgr_id_from_tech_id($_POST['csr_tech_id']);
}
if(isset($_POST['filename']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'GenerateScript'){
    $results = load_available_templates($_POST['filename']);
    $output = '';
    foreach ($results as $key=>$val){
        $checked = (empty($output)) ? 'checked':'';
        $output .= '<tr><td>'.$val['templname'].'</td><td><input type="radio" value="'.$val['templname'].'" '.$checked.' name="radioGroup"></td></tr>';
    }
    echo $output;
    
    //echo '<tr><td>Golden_purpose1_xe_1561_ranvendor1_scripttype1_region1_switch1_market1</td><td><input type="radio" value="Golden_purpose1_xe_1561_ranvendor1_scripttype1_region1_switch1_market1" name="radioGroup"></td></tr>';
}

if(isset($_POST['region']) &&  isset($_POST['category']) && ($_POST['category'] == 'cellsitetech' || $_POST['category'] == 'switchtech')  && isset($_POST['act']) && $_POST['act'] == 'ip-del' && isset($_POST['subnet'])){
    echo delete_ipallocation_by_subnet($_POST['region'], $_POST['subnet']);    
}
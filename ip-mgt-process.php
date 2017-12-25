<?php
include "classes/db2.class.php";
include 'functions.php';
$userid = $_SESSION['userid'];
ini_set('display_errors',1);
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
    echo discovery_status_update('k', $_POST['id']);
}



if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'Add New'){
    $values_arr = array(
        'devicename' => $_POST['devicename'],
        'deviceIpAddr' => $_POST['deviceIpAddr'],
        'nodeCatId' => $_POST['nodeCatId'],
        'vendorId' => $_POST['vendorId'],
        'model' => $_POST['model'],
        'nodeVersion' => $_POST['nodeVersion'],
        'nodeAddedBy' => $_POST['nodeAddedBy'],
        'status' => $_POST['status'],
        'systemname' => $_POST['systemname'],
        'severity' => $_POST['severity'],
        'unacknowledged' => $_POST['unacknowledged'],
        'investigationstate' => $_POST['investigationstate'],
        'deviceseries' => $_POST['deviceseries'],
        'upsince' => $_POST['upsince'],
        'csr_site_tech_mgr_name' => $_POST['csr_site_tech_mgr_name'],
        'csr_site_tech_mgr_id' => $_POST['csr_site_tech_mgr_id'],
        'csr_site_tech_name' => $_POST['csr_site_tech_name'],
        'csr_site_tech_id' => $_POST['csr_site_tech_id'],
        'csr_site_name' => $_POST['csr_site_name'],
        'csr_site_id' => $_POST['csr_site_id'],
        'switch_name' => $_POST['switch_name'],
        'region' => $_POST['region'],
        'market' => $_POST['market'],
        'deviceos' => $_POST['deviceos'],
    );
    discovery_add_new_device($values_arr);
    echo "success";
}
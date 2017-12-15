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
    echo $output;
}

if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'COMPUTE') {
    $subnet_whole = $_POST['subnet'].'/'.$_POST['mask'];
    $ipvfour_details = getipvfour_details($subnet_whole);
    print $ipvfour_details[0].' '.count($ipvfour_details).' '.$ipvfour_details[count($ipvfour_details)-1];
}    

if (isset($_POST['calltype']) && $_POST['calltype'] == 'trigger' && isset($_POST['action']) && $_POST['action'] == 'ADD' &&  isset($_POST['region'])) {
    $subnet_whole = $_POST['subnet'].'/'.$_POST['mask'];
    $values_arr = array('cust_gvn_region' => 'TEST', 'region' => $_POST['region'], 'market' => $_POST['market'], 'subnetmask' => $subnet_whole);
    insert_ip_allocation($values_arr);
    print 'success';
}


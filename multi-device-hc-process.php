<?php
include "classes/db2.class.php";
include 'functions.php';
$userid = $_SESSION['userid'];
if($_GET['loadtype'] == 'datatable'){
    // $_GET['listname'] = empty($_GET['listname']) ? '0' : $_GET['listname'];
    // $backup_list = get_batch_process_datatable($_SESSION['userid'], $_GET['listname']);
    $swdelvry_dev_list = multidevicehc_datatable($userid, $_GET['vendorId'], $_GET['deviceseries']);
    // print_r($swdelvry_dev_list);
    exit(json_encode($swdelvry_dev_list, 1));
}
if($_GET['loadtype'] == 'healthcheck'){
    echo $_GET['devices'];
    $output = '<div class="table-responsive" style="overflow-y:scroll;overflow-x:scroll;">
    <table class="table">
    <thead>
    <tr><th>IOS Version</th><th>CPU Utilization</th><th>Free memory</th><th>Buffers</th><th>Boot Statement</th><th>Platform</th></tr>
    </thead>
    <tbody>';
    
    $devices_selected = explode(',',$_POST['devices']);
    
    $output .= '<tr>
        <tr><td>IOS Version'.$_POST['devices'].'</td><td>CPU Utilization</td><td>Free memory</td><td>Buffers</td><td>Boot Statement</td><td>Platform</td></tr>
    </tr>';


    $output .= '</tbody>
    </table>
    </div>';	
    $output = json_encode(array('result' => $output));
    echo $output;
}

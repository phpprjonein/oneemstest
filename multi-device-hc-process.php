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
    
    $devices_selected_arr = explode(',',$_POST['devices']);
    $devices_selected = implode("','",$devices_selected_arr);
    
    $sql = "SELECT * from nodes where id in  ('" . $devices_selected . "')";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    if(count($resultset['result']) > 0){
        foreach ($resultset['result'] as $resultsetk => $resultsetv) {
            $devicetype = 'ios';
            $resultsetv['nodeVersion'] = str_replace(".","-",str_replace("(","-",str_replace(")","-",$resultsetv['nodeVersion'])));
            /*
            $url_final = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/Cisco/'.$resultsetv['deviceseries'].'/'.$devicetype.'/'.$resultsetv['nodeVersion'].'/'.$resultsetv['id'];
            $output_resp = json_decode(sendPostData($url_final), true);
            */  
            $output_resp = '{
     "iosversion": {
     "R": 0,
     "message": "extract_redundancy new"
     },
    "cpuutilization": {
     "R": 0,
     "message": "cpuutilization new"
     },
    "freememory": {
     "R": 0,
     "message": "freememory new"
     },
    "buffers": {
     "R": 0,
     "message": "buffers new"
     },
    "bootstatement": {
     "R": 1,
     "message": "bootstatement new"
     },
    "platform": {
     "R": 1,
     "message": "platform new"
     }
        }';
            
            $output_resp = json_decode($output_resp,1);
            
            $color_iosversion = ($output_resp['iosversion']['R'] == 0) ? 'green' : 'red';
            $color_cpuutilization = ($output_resp['cpuutilization']['R'] == 0) ? 'green' : 'red';
            $color_freememory = ($output_resp['freememory']['R'] == 0) ? 'green' : 'red';
            $color_buffers = ($output_resp['buffers']['R'] == 0) ? 'green' : 'red';
            $color_bootstatement = ($output_resp['bootstatement']['R'] == 0) ? 'green' : 'red';
            $color_platform = ($output_resp['platform']['R'] == 0) ? 'green' : 'red';
            
            
            $output .= '<tr>
                    <td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-cellsite.php?commandname=iosversion&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a><span style="color: '. $color_iosversion . '">' . $output_resp['iosversion']['message'] . '</span>'.'</td>
                    <td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-cellsite.php?commandname=iosversion&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a><span style="color: '. $color_cpuutilization . '">' . $output_resp['cpuutilization']['message'] . '</span>'.'</td>
                    <td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-cellsite.php?commandname=iosversion&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a><span style="color: '. $color_freememory . '">' . $output_resp['freememory']['message'] . '</span>'.'</td>
                    <td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-cellsite.php?commandname=iosversion&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a><span style="color: '. $color_buffers . '">' . $output_resp['buffers']['message'] . '</span>'.'</td>
                    <td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-cellsite.php?commandname=iosversion&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a><span style="color: '. $color_bootstatement . '">' . $output_resp['bootstatement']['message'] . '</span>'.'</td>
                    <td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-cellsite.php?commandname=iosversion&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a><span style="color: '. $color_platform . '">' . $output_resp['platform']['message'] . '</span>'.'</td>

            </tr>';
        }
    }
    $output .= '</tbody>
    </table>
    </div>';	
    $output = json_encode(array('result' => $output));
    echo $output;
}

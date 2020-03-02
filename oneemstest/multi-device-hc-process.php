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
    $output .= '<div  class="table-responsive" style="overflow-y:scroll;overflow-x:scroll;">
    <table class="table">
    <thead>
    <tr>
        <th>IOS Version</th>
        <th>CPU Utilization</th>
        <th>Free memory</th>
        <th>Buffers</th>
        <th>Boot Statement</th>
        <th>Platform</th>
        <th>Environmental</th>
        <th>Config Register</th>
        <th>Interface Counters</th>
        <th>2000 Byte Ping</th>
        <th>BFD Sessions</th>
        <th>Log Entries</th>
        <th>VRF</th>
        <th>Interface State</th>
        <th>Xconnect</th>
        <th>MPLS Interfaces</th>
        <th>IPV4 BGP Neighbors</th>
        <th>IPV4 BGP Routes</th>
        <th>MPLS Neighbors</th>
        <th>IPV6 BGP Neighbors</th>
        <th>IPV6 BGP Routes</th>
        <th>Bandwidth</th>
    </tr>
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
     },
    "environmental": {
     "R": 1,
     "message": "environmental new"
     },
     "configregister": {
     "R": 0,
     "message": "configregister new"
     },
    "interfacecounters": {
     "R": 0,
     "message": "interfacecounters new"
     },
    "twothsndbyteping": {
     "R": 0,
     "message": "twothsndbyteping new"
     },
    "bfdsession": {
     "R": 0,
     "message": "bfdsession new"
     },
    "logentries": { 
        "buffer_logging":{
            "R": 1,
            "value": "buffer_logging new"
        },
        "trap_logging":{
            "R": 1,
            "value": "trap_logging new"
        }
    },
    "vrfstates": {
     "R": 1,
     "message": "vrfstates new"
     },
    "interfacestates": {
     "R": 1,
     "message": "interfacestates new"
     },
    "xconnect": {
     "R": 1,
     "message": "xconnect new"
     },
    "mplsinterfaces": {
     "R": 1,
     "message": "mplsinterfaces new"
     },
    "bgpvfourneighbors": {
     "R": 1,
     "neighbours": "bgpvfourneighbors new"
     },
    "ran": {
     "R": 1,
     "count": "ran new"
     },
    "mplsneighbors": {
     "R": 1,
     "message": "mplsneighbors new"
     },
    "bgpvsixneighbours": {
     "R": 1,
     "neighbours": "bgpvsixneighbours new"
     },
    "bgpvsixroutes": {
     "R": 1,
     "count": "bgpvsixroutes new"
     },
    "bandwidth": {
     "R": 1,
     "message": "bandwidth new"
     }
        }';
            
            $output_resp = json_decode($output_resp,1);
            
            $color_iosversion = ($output_resp['iosversion']['R'] == 0) ? 'green' : 'red';
            $color_cpuutilization = ($output_resp['cpuutilization']['R'] == 0) ? 'green' : 'red';
            $color_freememory = ($output_resp['freememory']['R'] == 0) ? 'green' : 'red';
            $color_buffers = ($output_resp['buffers']['R'] == 0) ? 'green' : 'red';
            $color_bootstatement = ($output_resp['bootstatement']['R'] == 0) ? 'green' : 'red';
            $color_platform = ($output_resp['platform']['R'] == 0) ? 'green' : 'red';
            $color_environmental = ($output_resp['environmental']['R'] == 0) ? 'green' : 'red';
            $color_configregister = ($output_resp['configregister']['R'] == 0) ? 'green' : 'red';
            
            $color_interfacecounters = ($output_resp['interfacecounters']['R'] == 0) ? 'green' : 'red';
            $color_twothsndbyteping = ($output_resp['twothsndbyteping']['R'] == 0) ? 'green' : 'red';
            $color_bfdsession = ($output_resp['bfdsession']['R'] == 0) ? 'green' : 'red';
            $color_logentries_buffer_logging = ($output['logentries']['buffer_logging']['R'] == 0) ? 'green' : 'red';
            $color_logentries_trap_logging = ($output['logentries']['trap_logging']['R'] == 0) ? 'green' : 'red';
            $color_vrfstates = ($output_resp['vrfstates']['R'] == 0) ? 'green' : 'red';
            $color_interfacestates = ($output_resp['interfacestates']['R'] == 0) ? 'green' : 'red';
            $color_xconnect = ($output_resp['xconnect']['R'] == 0) ? 'green' : 'red';
            $color_mplsinterfaces = ($output_resp['mplsinterfaces']['R'] == 0) ? 'green' : 'red';
            $color_bgpvfourneighbors = ($output_resp['bgpvfourneighbors']['R'] == 0) ? 'green' : 'red';
            $color_ran = ($output_resp['ran']['R'] == 0) ? 'green' : 'red';
            $color_mplsneighbors = ($output_resp['mplsneighbors']['R'] == 0) ? 'green' : 'red';
            $color_bgpvsixneighbors = ($output_resp['bgpvsixneighbors']['R'] == 0) ? 'green' : 'red';
            $color_bgpvsixroutes = ($output_resp['bgpvsixroutes']['R'] == 0) ? 'green' : 'red';
            $color_bandwidth = ($output_resp['bandwidth']['R'] == 0) ? 'green' : 'red';
            
            $output .= '
                <tr><td id="test-resp" style="display:none;background-color:#CCCCCC;" colspan="20"></td></tr>

                <tr>
                    <td>
                        <table class="popup-hc-in"><tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=iosversion&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_iosversion . '">' . $output_resp['iosversion']['message'] . '</span></td></tr></table></td>
                    <td>
                        <table class="popup-hc-in"><tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=cpuutilization&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_cpuutilization . '">' . $output_resp['cpuutilization']['message'] . '</span></td></tr></table></td>
                    <td>
                        <table class="popup-hc-in"><tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=freememory&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_freememory . '">' . $output_resp['freememory']['message'] . '</span></td></tr></table></td>
                    <td>
                        <table class="popup-hc-in"><tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=buffers&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_buffers . '">' . $output_resp['buffers']['message'] . '</span></td></tr></table></td>
                    <td>
                        <table class="popup-hc-in"><tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=bootstatement&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_bootstatement . '">' . $output_resp['bootstatement']['message'] . '</span></td></tr></table></td>
                     <td>
                        <table class="popup-hc-in"><tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=platform&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_platform . '">' . $output_resp['platform']['message'] . '</span></td></tr></table></td>
                    <td>
                        <table class="popup-hc-in"><tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=environment&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_environmental . '">' . $output_resp['environmental']['message'] . '</span></td></tr></table></td>

                    <td>
                        <table class="popup-hc-in"><tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=configregister&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_configregister . '">' . $output_resp['configregister']['message'] . '</span></td></tr></table></td>

                    <td>
                        <table class="popup-hc-in"><tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=interfacecounters&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_interfacecounters . '">' . $output_resp['interfacecounters']['message'] . '</span></td></tr></table></td>

                    <td>
                        <table class="popup-hc-in"><tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=twothsndbyteping&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_twothsndbyteping . '">' . $output_resp['twothsndbyteping']['message'] . '</span></td></tr></table></td>

                    <td>
                        <table class="popup-hc-in"><tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=bfdsession&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_bfdsession . '">' . $output_resp['bfdsession']['message'] . '</span></td></tr></table></td>
                    
                    <td>
                        <table class="popup-hc-in">
                        <tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=logentries&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_logentries_buffer_logging . '"> Buffer Logging :'.  $output_resp['logentries']['buffer_logging']['value'] . '</span></td>
                        </tr>
                        <tr><td colspan="2"><span style="color: '. $color_logentries_trap_logging . '"> Trap Logging :'.$output_resp['logentries']['trap_logging']['value'].'</span></td>
                        </tr>
                    </table></td>

                    <td>
                        <table class="popup-hc-in"><tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=vrfstates&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_vrfstates . '">' . $output_resp['vrfstates']['message'] . '</span></td></tr></table></td>
                    
                    <td>
                        <table class="popup-hc-in"><tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=interfacestates&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_interfacestates . '">' . $output_resp['interfacestates']['message'] . '</span></td></tr></table></td>

                    <td>
                        <table class="popup-hc-in"><tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=xconnect&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_xconnect . '">' . $output_resp['xconnect']['message'] . '</span></td></tr></table></td>

                    <td>
                        <table class="popup-hc-in"><tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=mplsinterfaces&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_mplsinterfaces . '">' . $output_resp['mplsinterfaces']['message'] . '</span></td></tr></table></td>

                    <td>
                        <table class="popup-hc-in"><tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=bgpvfourneighbors&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_bgpvfourneighbors . '">' . $output_resp['bgpvfourneighbors']['neighbours'] . '</span></td></tr></table></td>

                    <td>
                        <table class="popup-hc-in"><tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=ran&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_ran . '">' . $output_resp['ran']['count'] . '</span></td></tr></table></td>

                    <td>
                        <table class="popup-hc-in"><tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=mplsneighbors&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_mplsneighbors . '">' . $output_resp['mplsneighbors']['message'] . '</span></td></tr></table></td>

                    <td>
                        <table class="popup-hc-in"><tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=bgpvsixneighbours&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_bgpvsixneighbors . '">' . $output_resp['bgpvsixneighbours']['neighbours'] . '</span></td></tr></table></td>

                    <td>
                        <table class="popup-hc-in"><tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=bgpvsixroutes&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_bgpvsixroutes . '">' . $output_resp['bgpvsixroutes']['count'] . '</span></td></tr></table></td>

                    <td>
                        <table class="popup-hc-in"><tr><td><a id="anchorcmd" class="anchorcmd"
                        href="devdetmdl-multi.php?commandname=bandwidth&deviceid='.$resultsetv['id'].'&deviceseries='.$resultsetv['deviceseries'].'&version='.$resultsetv['node_Version'].'">
                        <i class="fa fa-file-text-o fa-lg text-primary"></i></a></td><td><span style="color: '. $color_bandwidth . '">' . $output_resp['bandwidth']['message'] . '</span></td></tr></table></td>
            </tr>';
        }
    }
    $output .= '</tbody>
    </table>
    </div>';	
    $output = json_encode(array('result' => $output));
    echo $output;
}
if($_GET['loadtype'] == 'healthchecknew'){
    $output = array();
    if(count($_POST['devices']) > 0){
        $device_status = array('Failed','Reached');
        foreach ($_POST['devices'] as $key=>$val){
            $output[$val]['deviceid'] = $val;
            $output[$val]['error'] = $device_status[rand(0,1)];
        }
    }
    $output = json_encode(array('result' => $output));
    echo $output;
}
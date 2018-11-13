<?php
include_once "classes/db2.class.php";
include_once "classes/paginator.class.php";
include_once 'functions.php';
onerr();

$username = 'debarle';


$_SESSION['sel_switch_name'] = '';
$_SESSION['sel_region'] = array();


global $db2;
$sql = "SELECT market FROM regengnrmarket where id > 0 and username = '".$username."'";
$db2->query($sql);
$resultset = $db2->resultset();

foreach ($resultset as $key => $val){
    $_SESSION['sel_region'] = $val['market'];
    $sel_region_arr[] = $val['market'];
}

if(count($sel_region_arr) > 0){
    $sel_region_imp = implode(',', $sel_region_arr);
    $sql = "SELECT distinct(switch_name) FROM nodes where market in ('".$sel_region_imp."')";
    $db2->query($sql);
    $resultset = $db2->resultset();
    foreach ($resultset as $key => $val){
        $_SESSION['sel_switch_name'] = ($_SESSION['sel_switch_name'] == '') ? $val['switch_name'] : $_SESSION['sel_switch_name'];
        $swt_mswitch_arr[] = $val['switch_name'];
    }
    $_SESSION['swt_mswitch_arr'] = $swt_mswitch_arr;
}




print '<pre>';
print_r($_SESSION);
die;

return $resultset;






/*
$select_switch = 'AKRON 2';

echo generate_option_button_for_configs_vlan($select_switch,'even');


//echo generate_option_button_for_configs_telco_interface($select_switch,'even');


die;
*/
/*
$_POST['Bandwidth_(Mbps)'] = 50;

$bmbps = get_bandwidth_mbpsvalues($_POST['Bandwidth_(Mbps)']);

$str = "description bwmbps bwkbps password bwshpavg and bwbps";


echo $str = generatescript_str_preprocess($str, $bmbps);

function generatescript_str_preprocess($str, $bmbps){
    foreach ($bmbps as $key => $val){
        if(strpos($str, $key)!== false ){
            $str = str_replace($key, $val, $str);
        }
    }
    return $str;
}



die;

echo generate_option_button_for_configs_marketvars('marketvars', 'mvarval', 'BGP Password-ASR9010-Even');


$select_switch = 'AKRON 2';

$results = get_region_from_node_by_switch_name($select_switch);
$region = ($results['result'][0]['region']);
$results = get_region_timezone_from_marketvars($region);
return $results['result'][0]['mvarval'];
die;






        $_POST['addalldevices'] = 'Add All Devices';
        $listid = $_POST['hidd_mylistid'];
        $switchname = $_POST['hidd_switch_selected'];
        $userid = $_SESSION['userid'];

        $list_existing_devices = $list_add_new_devices = array();
        $results = get_device_list_for_user($userid, $_POST['hidd_mylistid']);
        foreach ($results['result'] as $key => $val){
            $list_existing_devices[] = $val['nodeid'];
        }
        $listname = $val['listname'];
        $results_switch_nodes = get_device_list_for_user_by_switch($switchname);
        foreach ($results_switch_nodes['result'] as $key => $val){
            $list_add_new_devices[] = $val['id'];
        }
        $new_devices_to_add = array_diff($list_add_new_devices, $list_existing_devices);
        $oc = 1;
        $dsql = 'INSERT INTO `userdevices` (`nodeid`, `userid`, `listid`, `listname`) VALUES';
        foreach ($new_devices_to_add as $key => $val) {
            if (count($new_devices_to_add) == $oc) {
                $dsql .= "('" . $val . "'," . $_SESSION['userid'] . ",$listid,'".$listname."')";
            } else {
                $dsql .= "('" . $val . "'," . $_SESSION['userid'] . ",$listid,'".$listname."'),";
            }
            $oc ++;
        }
        if ($oc > 1) {
            $db2->query($dsql);
            $db2->execute();
        }
        
        
        
        
        die;

        
        
        
        
        
        
        
        
        
        
        
        
        
        print '<pre>';
        print_r(get_device_list_for_user($userid, $_POST['hidd_mylistid']));

        die;
        
        
        
$results = get_inventory_market_list('GreatLakes');

print '<pre>';
print_r($results['result']);

$output = '<select class="form-control custom-select" id="select_region_list" name="select_region_list" data-rule-required="true">
											<option value="">- SELECT Region -</option>';
foreach ($results['result'] as $key => $val){
    $output .= '<option value="'.$val['market'].'">'.$val['market'].'</option>';
}
$output .= '</select>';
    echo $output;

die;



onerr();
    
echo generate_option_button_for_configs_sw_inventory_vlan('software_inventory', 'vlan', 'Vlan(Even)');
die;


//echo generate_option_button_for_configs_sw_inventory('software_inventory', 'interface', 'Telco Interface-ASR9010-Odd');


echo generate_option_button_for_configs_marketvars('software_inventory', 'mvarval', 'Vlan(Even)');



die;




if (rand(1, 99) % 2 == 0) {
    $ret = true;
} else {
    $ret = false;
}
$myObject = array(
    'result' => $ret
);
echo json_encode($myObject); // outputs JSON text
?>
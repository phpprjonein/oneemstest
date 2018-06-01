<?php 
include "classes/db2.class.php"; 
include 'functions.php';
$data = $_POST; 

if (isset($_POST['filenames']) && $_POST['ctype'] == 'OsRepoUPdate') {
    $dsql = 'INSERT INTO `osrepository` (`osid`, `filename`, `filesize`, `mdfive`) VALUES';
    $oc = 1;
    foreach ($_POST['filenames'] as $key=>$val):
        if(count($_POST['filenames']) == $oc){
            $dsql .= "('1','".$val."','".$_POST['filesizes'][$key]."','".md5($val)."')";
        }else{
            $dsql .= "('1','".$val."','".$_POST['filesizes'][$key]."','".md5($val)."'),";
        }
        $oc++;
    endforeach;
    if($oc > 1){
        //echo $dsql; die;
        $db2->query($dsql);
        $db2->execute();
    }
}

if (isset($_POST['category']) && $_POST['ctype'] == 'BatchTabUPdate') {
    update_dev_batch_sd(time(), $_POST['category'], $_POST['scriptname'], $_POST['deviceseries'], $_POST['node_version'],  $_POST['priority'],  $_POST['refmop'] );
}

function update_dev_batch_sd($batchid, $deviceid, $scriptname, $deviceseries, $node_version, $priority, $refmop){
    global $db2;
    $oc = 1;
    $date_op = date('Y-m-d H:i:s');
    $sql = "SELECT id, deviceIpAddr FROM nodes order by id";
    $db2->query($sql);
    $resultset = $db2->resultset();
    foreach ($resultset as $key=>$val){
        $nodes[$val['id']]['deviceIpAddr'] = $val['deviceIpAddr'];
    }

    $dsql = 'INSERT INTO `batchmembers` (`batchid`, `deviceid`, `status`, `deviceIpAddr`) VALUES';
    foreach ($deviceid as $key => $val){
        if(count($deviceid) == $oc){
            $dsql .= "('".$batchid."','".$val."','s','".$nodes[$val]['deviceIpAddr']."')";
        }else{
            $dsql .= "('".$batchid."','".$val."','s','".$nodes[$val]['deviceIpAddr']."'),";
        }
        $oc++;
    }
    if($oc > 1){
        $db2->query($dsql);
        $db2->execute();
        /*insert in to batchmaster table*/
        echo $dsql = "INSERT INTO `batchmaster` (`batchid`, `batchstatus`, `batchscheddate`, `region`, `batchtype`, `priority`, `username`, `batchcreated`, `deviceseries`, `nodeVersion`, `scriptname`, `refmop`)
        VALUES('".$batchid."','s','".$date_op."', '', 'sd', '".$priority."','".$_SESSION['username']."','".$date_op."','".$deviceseries."','".$node_version."','".$scriptname."','".$refmop."' )";
        $db2->query($dsql);
        $db2->execute();
        
        /*update sw repo table*/
        $sql = "UPDATE `swrepository` SET batchid = '".$batchid."' WHERE deviceseries = '".$deviceseries."' and nodeVersion = '".$node_version."'";
        $db2->query($sql);
        $db2->execute();
    }
}


/*
$batchmaster = array(
'batchid' => $_POST['batchid'],'batchstatus' => 's','batchscheddate' => now,'region' => 'dummy','batchtype' => 'sd','priority' => $_POST['sw_selpriority'],'username' => 'debarle','batchcreated' => '2018-05-11 16:10:05','deviceseries' => $_POST['device_series'],'nodeVersion' => $_POST['node_version'],'scriptname' => $_POST['swrp_filename'],'refmop' => '');
$output = batchmaster_insert($batchmaster);
$batchmembers = array('batchid' => $_POST['batchid'],'deviceid' => '7167','status' => 's');
$output = batchmembers_insert($batchmembers);
$response = array(status=>"success insertion");
echo "inserted";
//echo json_encode($response); 
//exit(json_encode($response, 1));
function batchmaster_insert($batchmaster) {
global $db2;
$columns = implode(", ",array_keys($batchmaster));
$escaped_values = array_map('mysql_real_escape_string', array_values($batchmaster));
$values  = implode("', '", $escaped_values); 
$sql = "INSERT INTO batchmaster ($columns) VALUES ('$values')"; 
$db2->query($sql);
$result=$db2->execute(); 
return;
}; 

function batchmembers_insert($batchmembers) {
global $db2;
$columns = implode(", ",array_keys($batchmembers));
$escaped_values = array_map('mysql_real_escape_string', array_values($batchmembers));
$values  = implode("', '", $escaped_values); 
$sql = "INSERT INTO batchmembers ($columns) VALUES ('$values')"; 
$db2->query($sql);
$result=$db2->execute(); 
return;
}*/
?>
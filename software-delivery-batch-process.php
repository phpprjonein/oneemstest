<?php
include "classes/db2.class.php";
include 'functions.php';
ini_set('display_errors', 1);
$data = $_POST;

if (isset($_POST['ctype']) && $_POST['ctype'] == 'MasterDeviceSeries' && $_POST['deviceseries'] != '' && $_POST['osid'] != '') {
    $dsql = "INSERT INTO `deviceseries` (`deviceseries`, `osid`, `vendorname`)VALUES ('" . $_POST['deviceseries'] . "','" . $_POST['osid'] . "','')";
    $db2->query($dsql);
    $db2->execute();
    echo "success";
}

if (isset($_POST['ctype']) && $_POST['ctype'] == 'MasterOSVersion' && $_POST['vendorname'] != '' && $_POST['ospatch'] != '' && $_POST['minverreq'] != '' && $_POST['applydate'] != '' && $_POST['ospatch'] != '') {
    $applydate_arr = explode('/', $_POST['applydate']);
    $applydate = $applydate_arr[2] . '-' . $applydate_arr[1] . '-' . $applydate_arr[0];
    $dsql = "INSERT INTO `osversion` (`osversion`, `vendorname`, `ospatch`,`minverreq`, `applydate`, `retired`) VALUES ('" . $_POST['osversion'] . "','" . $_POST['vendorname'] . "','" . $_POST['ospatch'] . "','" . $_POST['minverreq'] . "','" . $applydate . "','" . $_POST['retired'] . "')";
    $db2->query($dsql);
    $db2->execute();
    echo "success";
}

if (isset($_POST['fileid']) && $_POST['case'] == 'delete-os-repo-by-fileid') {
    $sql = "UPDATE `osrepository` SET status = 'd' WHERE fileid = '" . $_POST['fileid'] . "'";
    $db2->query($sql);
    $db2->execute();
    echo "success";
}

if (isset($_POST['fileid']) && $_POST['case'] == 'reload-os-repo') {
    $records = os_repository_get_records();
    $output = '<table id="retrosrepository" class="display" style="width: 100%">
    											<thead>
    												<tr>
    													<th>Filename</th>
    													<th>Deviceseries</th>
    													<th>newosversion</th>
    													<th>Delete</th>
    												</tr>
    											</thead>
    											<tbody>';
    
    foreach ($records as $key => $val) :
        $output .= '<tr id="row_' . $val['fileid'] . '"><td>' . $val['filename'] . '</td><td>' . $val['deviceseries'] . '</td><td>' . $val['newosversion'] . '</td><td><button type="button" class="btn retModaldelete">Delete</button></td></tr>';
    endforeach
    ;
    $output .= '</tbody></table>';
    echo $output;
}

if (isset($_POST['type']) && $_POST['type'] == 'autocomplete' && isset($_POST['query']) && isset($_POST['category']) && $_POST['category'] == 'osdate') {
    echo get_os_ver_applydate($_POST['csrsitetechid']);
}

if (isset($_POST['filenames']) && $_POST['ctype'] == 'OsRepoUPdate') {
    $_POST['filesizes'] = array_sum($_POST['filesizes']);
    $dsql = "INSERT INTO `osrepository` (`osid`, `filename`, `filesize`, `mdfive`, `vendorname`, `ospatch`, `applydate`, `deviceseries`, `minverreq`,`username`, `uploadeddate`, `status`, `batchid`, `newosversion`)VALUES ('1','" . implode('|', $_POST['filenames']) . "','" . $_POST['filesizes'] . "','" . md5(time()) . "','" . $_POST['vendorname'] . "','" . $_POST['ospatch'] . "','2018-07-06','" . implode('|', $_POST['deviceseries']) . "','" . $_POST['minverreq'] . "', '" . $_SESSION['username'] . "', '" . date("Y-m-d H:i:s") . "', 's', '','" . $_POST['newosversion'] . "')";
    $db2->query($dsql);
    $db2->execute();
    
    /*
     * $oc = 1;
     * foreach ($_POST['filenames'] as $key=>$val):
     * if(count($_POST['filenames']) == $oc){
     * $dsql .= "('1','".$val."','".$_POST['filesizes'][$key]."','".md5($val)."')";
     * }else{
     * $dsql .= "('1','".$val."','".$_POST['filesizes'][$key]."','".md5($val)."'),";
     * }
     * $oc++;
     * endforeach;
     * if($oc > 1){
     * //echo $dsql; die;
     * $db2->query($dsql);
     * $db2->execute();
     * }
     */
}

if (isset($_POST['category']) && $_POST['ctype'] == 'BatchTabUPdate' && $_POST['batchtype'] == 'swdelivery') {
    $_POST['scriptname'] = implode(',', $_POST['scriptname']);
    $_SESSION['batch_vars']['batchid'] = $batchid = $_POST['batchid'];
    update_dev_batch_sd($batchid, $_POST['category'], $_POST['scriptname'], $_POST['deviceseries'], $_POST['node_version'], $_POST['priority'], $_POST['refmop'], $_POST['destdrive']);
}
if (isset($_POST['category']) && $_POST['ctype'] == 'BatchTabUPdate' && $_POST['batchtype'] == 'showtech') {
    $_POST['scriptname'] = implode(',', $_POST['scriptname']);
    $_SESSION['batch_vars']['batchid'] = $batchid = $_POST['batchid'];
    update_dev_batch_st($batchid, $_POST['category'], $_POST['scriptname'], $_POST['deviceseries'], $_POST['node_version'], $_POST['priority'], $_POST['refmop'], $_POST['destdrive']);
}

if (isset($_POST['category']) && $_POST['ctype'] == 'BatchTabUPdate' && $_POST['batchtype'] == 'auditinglog') {
    $_POST['scriptname'] = implode(',', $_POST['scriptname']);
    $_SESSION['batch_vars']['batchid'] = $batchid = $_POST['batchid'];
    update_dev_batch_al($batchid, $_POST['category'], $_POST['scriptname'], $_POST['deviceseries'], $_POST['node_version'], $_POST['priority'], $_POST['refmop'], $_POST['destdrive']);
}
if (isset($_POST['category']) && $_POST['ctype'] == 'BatchTabUPdate' && $_POST['batchtype'] == 'cusauditinglog') {
    $_POST['scriptname'] = implode(',', $_POST['scriptname']);
    $_SESSION['batch_vars']['batchid'] = $batchid = $_POST['batchid'];
    update_dev_batch_cusal($batchid, $_POST['category'], $_POST['scriptname'], $_POST['deviceseries'], $_POST['node_version'], $_POST['priority'], $_POST['refmop'], $_POST['destdrive'], $_POST['filtercriteria'], $_POST['sectionheader'], $_POST['skpaddcfgln']);
}

if (isset($_POST['category']) && $_POST['ctype'] == 'BatchTabUPdate' && $_POST['batchtype'] == 'bootorder') {
    $_POST['scriptname'] = implode(',', $_POST['scriptname']);
    $_SESSION['batch_vars']['batchid'] = $batchid = $_POST['batchid'];
    update_dev_batch_bo($batchid, $_POST['category'], $_POST['scriptname'], $_POST['deviceseries'], $_POST['node_version'], $_POST['priority'], $_POST['refmop'], $_POST['destdrive']);
}

if (isset($_POST['category']) && $_POST['ctype'] == 'BatchTabUPdate' && $_POST['batchtype'] == 'reboot') {
    $_POST['scriptname'] = implode(',', $_POST['scriptname']);
    $_SESSION['batch_vars']['batchid'] = $batchid = $_POST['batchid'];
    update_dev_batch_rb($batchid, $_POST['category'], $_POST['scriptname'], $_POST['deviceseries'], $_POST['node_version'], $_POST['priority'], $_POST['refmop'], $_POST['destdrive']);
}

function update_dev_batch_al($batchid, $deviceid, $scriptname, $deviceseries, $node_version, $priority, $refmop, $destdrive)
{
    global $db2;
    $oc = 1;
    $date_op = date('Y-m-d H:i:s');
    $sql = "SELECT id, deviceIpAddr FROM nodes order by id";
    $db2->query($sql);
    $resultset = $db2->resultset();
    foreach ($resultset as $key => $val) {
        $nodes[$val['id']]['deviceIpAddr'] = $val['deviceIpAddr'];
    }
    $deviceid = explode(',', $deviceid);
    $dsql = 'INSERT INTO `batchmembers` (`batchid`, `deviceid`, `status`, `deviceIpAddr`, `comment`) VALUES';
    foreach ($deviceid as $key => $val) {
        if (count($deviceid) == $oc) {
            $dsql .= "('" . $batchid . "','" . $val . "','s','" . $nodes[$val]['deviceIpAddr'] . "','')";
        } else {
            $dsql .= "('" . $batchid . "','" . $val . "','s','" . $nodes[$val]['deviceIpAddr'] . "',''),";
        }
        $oc ++;
    }
    
    if ($oc > 1) {
        $db2->query($dsql);
        $db2->execute();
        /* insert in to batchmaster table */
        $dsql = "INSERT INTO `batchmaster` (`batchid`, `batchstatus`, `batchscheddate`, `region`, `batchtype`, `priority`, `username`, `batchcreated`, `deviceseries`, `nodeVersion`, `scriptname`, `refmop`,`destinationpath`,`comment`)
        VALUES('" . $batchid . "','s','" . $date_op . "', '', 'al', '" . $priority . "','" . $_SESSION['username'] . "','" . $date_op . "','" . $deviceseries . "','" . $node_version . "','" . $scriptname . "','" . $refmop . "','" . $destdrive . "','' )";
        $db2->query($dsql);
        $db2->execute();
    }
}

function update_dev_batch_cusal($batchid, $deviceid, $scriptname, $deviceseries, $node_version, $priority, $refmop, $destdrive, $filtercriteria, $sectionheader, $skpaddcfgln)
{
    global $db2;
    $oc = 1;
    $date_op = date('Y-m-d H:i:s');
    $sql = "SELECT id, deviceIpAddr, region, market, devicename, deviceseries  FROM nodes order by id";
    $db2->query($sql);
    $resultset = $db2->resultset();
    foreach ($resultset as $key => $val) {
        $nodes[$val['id']]['deviceIpAddr'] = $val['deviceIpAddr'];
        $nodes[$val['id']]['market'] = $val['market'];
        $nodes[$val['id']]['region'] = $val['region'];
        $nodes[$val['id']]['devicename'] = $val['devicename'];
        $nodes[$val['id']]['deviceseries'] = $val['deviceseries'];
    }
    $deviceid = explode(',', $deviceid);
    $dsql = 'INSERT INTO `batchmembers` (`batchid`, `deviceid`, `status`, `deviceIpAddr`, `comment`) VALUES';
    $cusalsql = 'INSERT INTO `audithistory` (`batchid`, `username`, `region`, `market`, `devicename`, `deviceIpAddr`, `deviceseries`, `filtercriteria`, `sectionheader`, `skpaddcfgln`, `austatus`, `filename`) VALUES';
    if(!empty($filtercriteria)){
        $filtercriteria = nl2br($filtercriteria).'<br />';
    }
    
    foreach ($deviceid as $key => $val) {
        if (count($deviceid) == $oc) {
            $dsql .= "('" . $batchid . "','" . $val . "','s','" . $nodes[$val]['deviceIpAddr'] . "','')";
            $cusalsql .= "('" . $batchid . "','" . $_SESSION['username'] . "','" . $nodes[$val]['region'] . "','" . $nodes[$val]['market'] . "','" . $nodes[$val]['devicename'] . "','" . $nodes[$val]['deviceIpAddr'] . "','" . $nodes[$val]['deviceseries'] . "','" . $filtercriteria . "','" . $sectionheader . "','" . $skpaddcfgln . "','NULL', '')";
        } else {
            $dsql .= "('" . $batchid . "','" . $val . "','s','" . $nodes[$val]['deviceIpAddr'] . "',''),";
            $cusalsql .= "('" . $batchid . "','" . $_SESSION['username'] . "','" . $nodes[$val]['region'] . "','" . $nodes[$val]['market'] . "','" . $nodes[$val]['devicename'] . "','" . $nodes[$val]['deviceIpAddr'] . "','" . $nodes[$val]['deviceseries'] . "','" . $filtercriteria . "','" . $sectionheader . "','" . $skpaddcfgln . "','NULL', ''),";
        }
        $oc ++;
    }
    
    if ($oc > 1) {
        $db2->query($dsql);
        $db2->execute();
        $db2->query($cusalsql);
        $db2->execute();
        /* insert in to batchmaster table */
        $dsql = "INSERT INTO `batchmaster` (`batchid`, `batchstatus`, `batchscheddate`, `region`, `batchtype`, `priority`, `username`, `batchcreated`, `deviceseries`, `nodeVersion`, `scriptname`, `refmop`,`destinationpath`,`comment`)
        VALUES('" . $batchid . "','s','" . $date_op . "', '', 'cusal', '" . $priority . "','" . $_SESSION['username'] . "','" . $date_op . "','" . $deviceseries . "','" . $node_version . "','" . $scriptname . "','" . $refmop . "','" . $destdrive . "','' )";
        $db2->query($dsql);
        $db2->execute();
    }
}


function update_dev_batch_sd($batchid, $deviceid, $scriptname, $deviceseries, $node_version, $priority, $refmop, $destdrive)
{
    global $db2;
    $oc = 1;
    $date_op = date('Y-m-d H:i:s');
    $sql = "SELECT id, deviceIpAddr FROM nodes order by id";
    $db2->query($sql);
    $resultset = $db2->resultset();
    foreach ($resultset as $key => $val) {
        $nodes[$val['id']]['deviceIpAddr'] = $val['deviceIpAddr'];
    }
    $deviceid = explode(',', $deviceid);
    $dsql = 'INSERT INTO `batchmembers` (`batchid`, `deviceid`, `status`, `deviceIpAddr`, `comment`) VALUES';
    foreach ($deviceid as $key => $val) {
        if (count($deviceid) == $oc) {
            $dsql .= "('" . $batchid . "','" . $val . "','s','" . $nodes[$val]['deviceIpAddr'] . "','')";
        } else {
            $dsql .= "('" . $batchid . "','" . $val . "','s','" . $nodes[$val]['deviceIpAddr'] . "',''),";
        }
        $oc ++;
    }
    
    if ($oc > 1) {
        $db2->query($dsql);
        $db2->execute();
        /* insert in to batchmaster table */
        $dsql = "INSERT INTO `batchmaster` (`batchid`, `batchstatus`, `batchscheddate`, `region`, `batchtype`, `priority`, `username`, `batchcreated`, `deviceseries`, `nodeVersion`, `scriptname`, `refmop`,`destinationpath`,`comment`)
        VALUES('" . $batchid . "','s','" . $date_op . "', '', 'sd', '" . $priority . "','" . $_SESSION['username'] . "','" . $date_op . "','" . $deviceseries . "','" . $node_version . "','" . $scriptname . "','" . $refmop . "','" . $destdrive . "','' )";
        $db2->query($dsql);
        $db2->execute();
    }
}
function update_dev_batch_st($batchid, $deviceid, $scriptname, $deviceseries, $node_version, $priority, $refmop, $destdrive)
{
    global $db2;
    $oc = 1;
    $date_op = date('Y-m-d H:i:s');
    //$sql = "SELECT id, deviceIpAddr, devicename FROM nodes order by id";
    $sql = "SELECT id, deviceIpAddr FROM nodes order by id";
    $db2->query($sql);
    $resultset = $db2->resultset();
    foreach ($resultset as $key => $val) {
        $nodes[$val['id']]['deviceIpAddr'] = $val['deviceIpAddr'];
        //$nodes[$val['id']]['devicename'] = $val['devicename'];
    }
    $deviceid = explode(',', $deviceid);
    //$scriptname_arr = array();
    $dsql = 'INSERT INTO `batchmembers` (`batchid`, `deviceid`, `status`, `deviceIpAddr`, `comment`) VALUES';
    foreach ($deviceid as $key => $val) {
        if (count($deviceid) == $oc) {
            $dsql .= "('" . $batchid . "','" . $val . "','s','" . $nodes[$val]['deviceIpAddr'] . "','')";
        } else {
            $dsql .= "('" . $batchid . "','" . $val . "','s','" . $nodes[$val]['deviceIpAddr'] . "',''),";
        }
        $oc ++;
        //$scriptname_arr[$batchid][] = $nodes[$val]['devicename'].'.txt';
    }
    
    if ($oc > 1) {
        $db2->query($dsql);
        $db2->execute();
        /* insert in to batchmaster table */
        $priority = 1;
        /*
        if(count($scriptname_arr[$batchid]) > 1){
            $scriptname_arr_imp = implode(' | ',$scriptname_arr[$batchid]);
        }else{
            $scriptname_arr_imp = $scriptname_arr[$batchid];
        }
        */
        //$dsql = "INSERT INTO `batchmaster` (`batchid`, `batchstatus`, `batchscheddate`, `region`, `batchtype`, `priority`, `username`, `batchcreated`, `deviceseries`, `nodeVersion`, `scriptname`, `refmop`,`destinationpath`,`comment`)
        //VALUES('" . $batchid . "','s','" . $date_op . "', '', 'st', '" . $priority . "','" . $_SESSION['username'] . "','" . $date_op . "','" . $deviceseries . "','" . $node_version . "','" . $scriptname_arr_imp . "','" . $refmop . "','" . $destdrive . "','' )";
        $dsql = "INSERT INTO `batchmaster` (`batchid`, `batchstatus`, `batchscheddate`, `region`, `batchtype`, `priority`, `username`, `batchcreated`, `deviceseries`, `nodeVersion`, `scriptname`, `refmop`,`destinationpath`,`comment`)
        VALUES('" . $batchid . "','s','" . $date_op . "', '', 'st', '" . $priority . "','" . $_SESSION['username'] . "','" . $date_op . "','" . $deviceseries . "','" . $node_version . "','" . $scriptname . "','" . $refmop . "','" . $destdrive . "','' )";
        $db2->query($dsql);
        $db2->execute();
    }
}

function update_dev_batch_bo($batchid, $deviceid, $scriptname, $deviceseries, $node_version = "", $priority, $refmop = "", $destdrive = "")
{
    global $db2;
    $oc = 1;
    $date_op = date('Y-m-d H:i:s');
    $sql = "SELECT id, deviceIpAddr FROM nodes order by id";
    $db2->query($sql);
    $resultset = $db2->resultset();
    foreach ($resultset as $key => $val) {
        $nodes[$val['id']]['deviceIpAddr'] = $val['deviceIpAddr'];
    }
    $deviceid = explode(',', $deviceid);
    $dsql = 'INSERT INTO `batchmembers` (`batchid`, `deviceid`, `status`, `deviceIpAddr`, `comment`) VALUES';
    foreach ($deviceid as $key => $val) {
        if (count($deviceid) == $oc) {
            $dsql .= "('" . $batchid . "','" . $val . "','s','" . $nodes[$val]['deviceIpAddr'] . "','')";
        } else {
            $dsql .= "('" . $batchid . "','" . $val . "','s','" . $nodes[$val]['deviceIpAddr'] . "',''),";
        }
        $oc ++;
    }
    if ($oc > 1) {
        $db2->query($dsql);
        $db2->execute();
        /* insert in to batchmaster table */
        $dsql = "INSERT INTO `batchmaster` (`batchid`, `batchstatus`, `batchscheddate`, `region`, `batchtype`, `priority`, `username`, `batchcreated`, `deviceseries`, `nodeVersion`, `scriptname`, `refmop`,`destinationpath`,`comment`)
        VALUES('" . $batchid . "','s','" . $date_op . "', '', 'bo', '" . $priority . "','" . $_SESSION['username'] . "','" . $date_op . "','" . $deviceseries . "','" . $node_version . "','" . $scriptname . "','" . $refmop . "','" . $destdrive . "','' )";
        $db2->query($dsql);
        $db2->execute();
    }
}

function update_dev_batch_rb($batchid, $deviceid, $scriptname, $deviceseries, $node_version = "", $priority, $refmop = "", $destdrive = "")
{
    global $db2;
    $oc = 1;
    $date_op = date('Y-m-d H:i:s');
    $sql = "SELECT id, deviceIpAddr FROM nodes order by id";
    $db2->query($sql);
    $resultset = $db2->resultset();
    foreach ($resultset as $key => $val) {
        $nodes[$val['id']]['deviceIpAddr'] = $val['deviceIpAddr'];
    }
    $deviceid = explode(',', $deviceid);
    $dsql = 'INSERT INTO `batchmembers` (`batchid`, `deviceid`, `status`, `deviceIpAddr`, `comment`) VALUES';
    foreach ($deviceid as $key => $val) {
        if (count($deviceid) == $oc) {
            $dsql .= "('" . $batchid . "','" . $val . "','s','" . $nodes[$val]['deviceIpAddr'] . "','')";
        } else {
            $dsql .= "('" . $batchid . "','" . $val . "','s','" . $nodes[$val]['deviceIpAddr'] . "',''),";
        }
        $oc ++;
    }
    if ($oc > 1) {
        $db2->query($dsql);
        $db2->execute();
        /* insert in to batchmaster table */
        $dsql = "INSERT INTO `batchmaster` (`batchid`, `batchstatus`, `batchscheddate`, `region`, `batchtype`, `priority`, `username`, `batchcreated`, `deviceseries`, `nodeVersion`, `scriptname`, `refmop`,`destinationpath`,`comment`)
        VALUES('" . $batchid . "','s','" . $date_op . "', '', 'rb', '" . $priority . "','" . $_SESSION['username'] . "','" . $date_op . "','" . $deviceseries . "','" . $node_version . "','" . $scriptname . "','" . $refmop . "','" . $destdrive . "','' )";
        $db2->query($dsql);
        $db2->execute();
    }
}

/*
 * $batchmaster = array(
 * 'batchid' => $_POST['batchid'],'batchstatus' => 's','batchscheddate' => now,'region' => 'dummy','batchtype' => 'sd','priority' => $_POST['sw_selpriority'],'username' => 'debarle','batchcreated' => '2018-05-11 16:10:05','deviceseries' => $_POST['device_series'],'nodeVersion' => $_POST['node_version'],'scriptname' => $_POST['swrp_filename'],'refmop' => '');
 * $output = batchmaster_insert($batchmaster);
 * $batchmembers = array('batchid' => $_POST['batchid'],'deviceid' => '7167','status' => 's');
 * $output = batchmembers_insert($batchmembers);
 * $response = array(status=>"success insertion");
 * echo "inserted";
 * //echo json_encode($response);
 * //exit(json_encode($response, 1));
 * function batchmaster_insert($batchmaster) {
 * global $db2;
 * $columns = implode(", ",array_keys($batchmaster));
 * $escaped_values = array_map('mysql_real_escape_string', array_values($batchmaster));
 * $values = implode("', '", $escaped_values);
 * $sql = "INSERT INTO batchmaster ($columns) VALUES ('$values')";
 * $db2->query($sql);
 * $result=$db2->execute();
 * return;
 * };
 *
 * function batchmembers_insert($batchmembers) {
 * global $db2;
 * $columns = implode(", ",array_keys($batchmembers));
 * $escaped_values = array_map('mysql_real_escape_string', array_values($batchmembers));
 * $values = implode("', '", $escaped_values);
 * $sql = "INSERT INTO batchmembers ($columns) VALUES ('$values')";
 * $db2->query($sql);
 * $result=$db2->execute();
 * return;
 * }
 */
?>
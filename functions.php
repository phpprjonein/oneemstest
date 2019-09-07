<?php
include_once 'config/global.php';
/**
 * @param unknown $filename
 * @param unknown $msg
 */
function logToFile($filename, $msg)
{
    // open file
    $fd = fopen($filename, "a");
    // append date/time to message
    $str = "[" . date("Y/m/d h:i:s", mktime()) . "] " . $msg;
    // write string
    fwrite($fd, $str . "\n");
    // close file
    fclose($fd);
}

/**
 * debug usage
 */
function onerr(){
    ini_set('display_errors',1);
}

/**
 *
 * @param unknown $username
 * @param unknown $password
 * @return unknown|boolean
 */
function get_user_info($username, $password)
{
    global $db2;
    
    if (trim($username) != '' && trim($password) != '') {
        $password = md5($password);
        $sql = "SELECT u.*,ul.userlevel as role FROM users u, userlevels ul WHERE u.username='" . $username . "' AND 
        u.password='" . $password . "' AND ul.id = u.userlevel AND u.status = 1";
        $db2->query($sql);
        $rows = $db2->resultset();
        $result = $rows[0];
        
        return $result;
    }
    return false;
}

/**
 *
 * @param unknown $username
 * @return unknown|boolean
 */
function get_user_info_sso($username)
{
    global $db2;
    
    if (trim($username) != '') {
        $sql = "SELECT u.*,ul.userlevel as role FROM users u, userlevels ul WHERE u.username='" . $username . "' AND ul.id = u.userlevel AND
u.status = 1";
        $db2->query($sql);
        $rows = $db2->resultset();
        $result = $rows[0];
        return $result;
    }
    return false;
}

/**
 *
 * @param unknown $fname
 * @param unknown $lname
 * @param unknown $userlevel
 * @return unknown|boolean
 */
function get_user_info_sso_imp($fname, $lname, $userlevel)
{
    global $db2;
    
    if($userlevel == 'NA_Field_Assurance')
        $userlevel = str_replace('NA_Field_Assurance', 'CellTech User',$userlevel);
        if($userlevel == 'NA_Systems_Assurance')
        $userlevel = str_replace('NA_Systems_Assurance', 'SwitchTech User',$userlevel);
    
    if (trim($fname) != '' && trim($lname) != '' && trim($userlevel)) {
        $sql = "SELECT u.*,ul.userlevel as role FROM users u, userlevels ul WHERE u.fname='" . trim($fname) . "' AND  u.lname='" . trim($lname) . "' 
        AND  ul.userlevel='" . trim($userlevel) . "' AND ul.id = u.userlevel AND u.status = 1";
        $db2->query($sql);
        $rows = $db2->resultset();
        $result = $rows[0];
        return $result;
    }
    return false;
}

/**
 *
 * @param array $usertype
 * @return boolean
 */
function check_user_authentication($usertype = array())
{
    global $db2;
    
    if ($_SESSION['userid']) {
        if (in_array($_SESSION['userlevel'], $usertype)) {
            return true;
        } else {
            header('Location: access.php?msg=You are not authorized to access this page');
        }
    }
}

/**
 *
 * @return string
 */
function get_landing_page()
{
    if (! $_SESSION['userlevel']) {
        return 'index.php';
    } else {
        if (in_array($_SESSION['userlevel'], array(
            1,
            3,
            4
        ))) { // fieldsite technician
            $location_href = "cellsitetech-dashboard.php";
        }
        if (in_array($_SESSION['userlevel'], array(
            2,
            5,
            6,
            7,
            9,
            10    
        ))) {
            $location_href = "switchtech-dashboard.php";
        }
        if (in_array($_SESSION['userlevel'], array(
            8
        ))) {
            $location_href = "login-impersonate.php";
        }
        return $location_href;
    }
}

/**
 *
 * @param unknown $filename
 * @return string
 */
function activemenu($filename)
{
    $active = '';
    
    $current_file = $_SERVER['SCRIPT_NAME'];
    if (! is_array($filename)) {
        if (strpos($current_file, $filename)) {
            $active = 'active';
        } else {
            $active = '';
        }
    } else {
        foreach ($filename as $flnm) {
            if (strpos($current_file, $flnm)) {
                $active = 'active';
                break;
            } else {
                $active = '';
            }
        }
    }
    
    return $active;
}

/*
 * User Login check and user session creation
 */
/**
 */
function user_session_check()
{
    global $db2;
    if (isset($_POST['username']) && $_POST['password']) {
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if (trim($username) != '' && trim($password) != '') {
            $password = md5($password);
            $sql = "SELECT * FROM users WHERE username='" . $username . "' AND password='" . $password . "'";
            $db2->query($sql);
            $rows = $db2->resultset();
            $result = $rows[0];
            
            if (! $result) {
                header("Location: index.php?msg=Username and Password is wrong");
                exit();
            }
            $userid = $_SESSION['userid'] = $result['id'];
            $_SESSION['username'] = $username;
        } else {
            header("Location: index.php");
            exit();
        }
    } else {
        
        if (! isset($_SESSION['userid'])) {
            
            header("Location: index.php?msg=User session expired");
            exit();
        }
    }
}

/**
 *
 * @return unknown
 */
function get_user_type()
{
    global $db2;
    
    $db2->query("SELECT userlevel FROM users WHERE id=" . $_SESSION['userid']);
    $db2->query($sql);
    $rows = $db2->resultset();
    $result = $rows[0];
    return $result;
}

/*
 * Checks for session live or not
 */
/**
 *
 * @param unknown $sessid
 * @return unknown
 */
function is_live_session($sessid)
{
    $db2 = new db2();
    // exit("SELECT COUNT(*) FROM sessions WHERE sessionid=" .$sessid );
    $db2->query("SELECT COUNT(*) FROM sessions WHERE sessionid='" . $sessid . "'");
    $row = $db2->resultsetCols();
    $sess_record_count = $row[0];
    
    return $sess_record_count;
}

/*
 * Nodes table for devices list
 */
/**
 *
 * @param unknown $user_id
 * @return unknown
 */
function get_device_list_from_nodes($user_id)
{
    global $db2, $pages;
    $pages->paginate();
    if ($user_id > 0) {
        $sql_count = "SELECT COUNT(*) ";
        $sql_select = "SELECT n.id, n.custom_Location, n.devicename, n.deviceIpAddr, n.model, v.vendorName, n.investigationstate, n.status, n.upsince, n.nodeVersion, n.severity, n.deviceseries ";
        
        $sql_condition = " FROM userdevices ud
         JOIN nodes n on ud.nodeid = n.id

         LEFT JOIN vendors v on v.id = n.vendorId
         WHERE ud.userid = " . $user_id;
        
        $sql_search_cond = '';
        if ($_SESSION['search_term'] != '') {
            $search_term = $_SESSION['search_term'];
            
            $sql_search_cond = " AND ( n.devicename LIKE '%" . $search_term . "%' ";
            $sql_search_cond .= " OR n.deviceIpAddr LIKE '%" . $search_term . "%' ";
            $sql_search_cond .= " OR n.custom_Location LIKE '%" . $search_term . "%' ";
            
            /* Other fields temporarely excluded */
            
            // $status_val = (strtolower(trim($search_term)) == 'reachable') ? '1' : '0';
            // $sql_search_cond .= " OR n.status = " . $status_val;
            
            // $sql_search_cond .= " OR n.upsince LIKE '%" . $search_term . "%' ";
            // $sql_search_cond .= " OR n.nodeVersion LIKE '%" . $search_term . "%' ";
            
            $sql_search_cond .= " OR n.investigationstate LIKE '%" . $search_term . "%' ";
            $sql_search_cond .= " OR n.model LIKE '%" . $search_term . "%' ) ";
        }
    }
    $count_sql = $sql_count . $sql_condition . $sql_search_cond;
    
    // echo $count_sql;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    $total_rec = $row[0];
    
    $sql = $sql_select . $sql_condition . $sql_search_cond;
    $sql .= $pages->limit;
    // echo "value of sql inside the get_device_list".$sql; exit(0);
    // echo '<br>';
    // echo $sql;
    $db2->query($sql);
    
    $resultset['result'] = $db2->resultset();
    $resultset['total_rec'] = $total_rec;
    
    return $resultset;
}

/**
 *
 * @param unknown $userid
 * @return number|unknown
 */
function get_device_list_from_nodes_datatable($userid)
{
    global $db2, $pages;
    
    // print_r($_GET);
    $draw = $_GET['draw'];
    $start = isset($_GET['start']) ? $_GET['start'] : 0;
    $length = isset($_GET['length']) ? $_GET['length'] : 10;
    $search = trim($_GET['search']['value']) ? addslashes(trim($_GET['search']['value'])) : null;
    $order_col = $_GET['order'][0]['column'];
    $order_dir = $_GET['order'][0]['dir'];
    
    $columns = array(
        'distinct(n.id)',
        'n.devicename',
        'n.csr_site_id',
        'n.csr_site_name',
        'n.region',
        'n.market',
        'n.deviceseries',
        'n.nodeVersion'
    );
    
    $sql_count = "SELECT COUNT(DISTINCT(n.id)) ";
    $sql_select = "SELECT " . implode(", ", $columns);
    
    $sql_condition = " FROM userdevices ud
       JOIN nodes n on ud.nodeid = n.id
       WHERE ud.userid = " . $userid . " AND status = 3";
    if ($search) {
        $sql_condition .= " AND ( ";
        $sql_condition .= " n.devicename LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.csr_site_id  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.csr_site_name  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.market  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.deviceseries  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.nodeVersion  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.lastpolled  LIKE '%" . $search . "%'";
        $sql_condition .= " ) ";
    }
    $count_sql = $sql_count . $sql_condition;
    // echo $count_sql; die;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $total_rec = $row[0];
    
    $sql_order = "";
    if ($order_col != '') {
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != '') {
        $sql_order .= $order_dir != '' ? " $order_dir " : " asc ";
    }
    
    $sql_limit = " LIMIT $start, $length ";
    
    $sql = $sql_select . $sql_condition . $sql_order . $sql_limit;
    // echo '<br>';
    // echo $sql;
    
    $db2->query($sql);
    
    $resultset['draw'] = $draw;
    
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'];
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    } else {
        $resultset['data'] = array();
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] = 0;
    }
    
    return $resultset;
}

function get_device_list_for_user($userid, $listid){
    global $db2;
    $sql = "select ud.nodeid, ud.listname FROM userdevices ud WHERE ud.userid = " . $userid . " and ud.listid = " . $listid ." and nodeid = 0";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
function get_device_list_for_user_by_switch($switchname, $market = ''){
    global $db2;
    
    $sql = "select n.id FROM nodes n WHERE n.switch_name = '" . $switchname . "'";
    
    if($market != ''){
        $sql .= " AND trim(lower(REPLACE(n.market,' ',''))) ='$market'";
    }
        
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}


/*
 * get device details for the current users
 */
/**
 *
 * @param unknown $user_id
 * @param string $usertype
 * @return unknown
 */
function get_device_list($user_id, $usertype = 'ME')
{
    $db2 = new db2();
    $pages = new Paginator();
    $pages->paginate();
    
    if ($user_id > 0) {
        
        $sql = "SELECT dd.* FROM currentusers cu
				 JOIN devicedetails dd on cu.deviceId = dd.id
				 WHERE cu.userid = " . $user_id . " AND cu.usertype='" . $usertype . "' ";
    } else {
        $sql = "SELECT dd.* FROM currentusers cu
				 JOIN devicedetails dd on cu.deviceId = dd.id ";
    }
    
    $count_sql = str_replace("dd.*", 'count(*)', $sql);
    
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    $total_rec = $row[0];
    // $pages->items_total = $count_result['total'];
    // $pages->mid_range = 7; // Number of pages to display. Must be odd and > 3
    
    $sql .= $pages->limit;
    
    // exit($sql);
    $db2->query($sql);
    // print_R($sql);
    
    $resultset['result'] = $db2->resultset();
    $resultset['total_rec'] = $total_rec;
    
    return $resultset;
}

/*
 * Updates the device_details table and
 * current_users table
 */
/**
 *
 * @param unknown $userid
 * @param unknown $usertype
 * @param unknown $device_details
 */
function update_devicedetails($userid, $usertype, $device_details)
{
    $db2 = new db2();
    
    // Swich Tech API and Field Tech API calls are handled here
    // for device_details information
    foreach ($device_details as $key => $device) {
        
        $devicename = $device['name'];
        $ipaddress = $device['ipaddress'];
        $vendor = $device['vendor'];
        $prompt = $device['prompt'];
        $username = $device['username'];
        $password = $device['password'];
        $port = $device['port'];
        $access_type = $device['access_type'];
        
        $sql = "INSERT INTO `devicedetails` (`name`, `ipaddress`, `vendor`, `prompt`, `username`, `password`, `port`,
				`access_type`) VALUES
				('$devicename', '$ipaddress', '$vendor', '$prompt', '$username', '$password', '$port', '$access_type')";
        
        $db2->query($sql);
        $db2->execute();
        $lastInsertId = $db2->lastInsertId();
        
        $sql = "INSERT INTO currentusers (userId, deviceId, userType)
				VALUES ('$userid', $lastInsertId, '$usertype' )";
        
        $db2->query($sql);
        $db2->execute();
    }
}

/*
 * Updates the sessions table
 *
 */
/**
 *
 * @param unknown $userid
 * @param unknown $usertype
 * @param unknown $sessionid
 */
function update_sessions($userid, $usertype, $sessionid)
{
    $db2 = new db2();
    
    $sql = "SELECT * FROM sessions WHERE sessionId = '" . $sessionid . "'";
    $db2->query($sql);
    $recordset = $db2->resultset();
    
    if (! $recordset) {
        $sql = "INSERT INTO `sessions` (`userId`, `userType`, `sessionId`, `initLogged`, `LastLogged`) VALUES
					('$userid', '$usertype', '$sessionid', now(), now() )";
        $db2->query($sql);
        $db2->execute();
    } else {
        
        $sql = "UPDATE `sessions` SET lastLogged = now() WHERE sessionId = '" . $sessionid . "'";
        // exit ($sql);
        $db2->query($sql);
        $db2->execute();
    }
}

/*
 * Deletes users from sessions table where users are idle for last 20 mins or more
 *
 */
/**
 *
 * @return unknown[]
 */
function delete_idleuser()
{
    $db2 = new db2();
    
    $sql = "select * from sessions T where TIMESTAMPDIFF(MINUTE,T.initLogged,T.lastLogged) > " . CRON_TIME_INTERVAL;
    
    $db2->query($sql);
    $recset = $db2->resultset();
    $deleted_users = array();
    foreach ($recset as $key => $value) {
        
        $userid = $value['userId'];
        
        $sql = "DELETE FROM currentusers WHERE userId=$userid ";
        $db2->query($sql);
        $db2->execute();
        
        $sql = "DELETE FROM sessions WHERE userId=$userid ";
        $db2->query($sql);
        $db2->execute();
        
        $deleted_users[] = $userid;
    }
    return $deleted_users;
}

/*
 * Deletes users from sessions table where users are idle for last 20 mins or more
 *
 */
/**
 */
function delete_alluser()
{
    $db2 = new db2();
    
    $sql = "select * from sessions T where TIMESTAMPDIFF(MINUTE,T.initLogged,T.lastLogged) > " . CRON_TIME_INTERVAL;
    $sql = "DELETE FROM sessions";
    $db2->query($sql);
    $db2->execute();
    
    $sql = "DELETE FROM currentusers";
    $db2->query($sql);
    $db2->execute();
    
    $sql = "DELETE FROM devicedetails";
    $db2->query($sql);
    $db2->execute();
}

/*
 * Api call
 */
/**
 *
 * @param unknown $url
 * @return unknown
 */
function sendPostData($url)
{
    // exit($url);
    // Curl GET methods begins
    // echo "Inside the sendpostdata method value of url is $url";;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_HTTPGET, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt($ch, CURLOPT_POSTFIELDS,$query);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    
    // error handling for cURL
    if ($reply === false) {
        // throw new Exception('Curl error: ' . curl_error($crl));
        print_r('Curl error: ' . curl_error($crl));
    }
    ;
    curl_close($crl);
    
    return $result;
    // cURL ends
    // Curl GET method ends
}

/**
 *
 * @param unknown $userid
 * @param unknown $deviceid
 * @return unknown
 */
function getDetailViewData($userid, $deviceid)
{
    $db2 = new db2();
    $sql_select = "SELECT hk.deviceid, hk.cpuutilization, hk.freememory, hk.buffers, hk.iosversion, hk.bootstatement, hk.configregister, hk.environmental, hk.platform, hk.bfdsession, hk.interfacestates, hk.interfacecounters, hk.mplsinterfaces, hk.mplsneighbors, hk.bgpvfourneighbors, hk.bgpvsixneighbors, hk.bgpvfourroutes, hk.bgpvsixroutes, hk.twothsndbyteping, hk.vrfstates, hk.logentries, hk.xconnect, hk.lightlevel, hk.bandwidth, hk.userid ";
    $sql_condition = "
	FROM
	healthcheck hk
	JOIN nodes n on n.id = hk.deviceid
	JOIN userdevices ud on ud.nodeid = hk.deviceid AND ud.userid = hk.userid
	WHERE hk.userid = $userid and hk.deviceid = " . $deviceid;
    
    $sql = $sql_select . $sql_condition;
    
    $db2->query($sql);
    
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/*
 * Function to get the Switches list of user
 */
/**
 *
 * @param unknown $userid
 * @return unknown
 */
function getSwitchDevicesList($userid)
{
    global $db2;
    
    $sql = "SELECT n.id, n.devicename, n.custom_Location, n.submarket  FROM userdevices ud
          JOIN nodes n ON n.id = ud.nodeid
          WHERE ud.userid = $userid AND n.submarket != ''
          ORDER BY ud.nodeid
          ";
    $db2->query($sql);
    
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/*
 * Functin to get the switch devices list by city wise for the user
 */
/**
 *
 * @param unknown $userid
 * @param unknown $city
 * @return unknown
 */
function getSwitchDevicesListByCity($userid, $city)
{
    global $db2, $pages;
    
    $sql_count = " SELECT count(*) ";
    $sql_select = " SELECT n.id, n.devicename, n.custom_Location, n.submarket ";
    
    $sql_condition = " FROM userdevices ud
                    JOIN nodes n ON n.id = ud.nodeid
                    WHERE ud.userid = $userid AND n.submarket = '$city' ";
    $sql_order = " ORDER BY ud.nodeid ";
    
    $count_sql = $sql_count . $sql_condition;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $resultset['total_rec'] = $row[0];
    
    $sql = $sql_select . $sql_condition . $sql_order;
    $sql .= $pages->limit;
    $db2->query($sql);
    
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/*
 * Functin to get the switch devices list by market and subregion wise for the user
 */
/**
 *
 * @param unknown $userid
 * @param unknown $market
 * @param unknown $subregion
 * @return unknown
 */
function get_switchlist_for_market_subregion($userid, $market, $subregion)
{
    global $db2, $pages;
    $pages->paginate();
    
    $sql_count = " SELECT count(*) ";
    $sql_select = " SELECT n.id, n.devicename, n.custom_Location, n.submarket, n.market as 'subregion' ";
    
    $sql_join = " FROM userdevices ud
                    JOIN nodes n ON n.id = ud.nodeid ";
    
    // JOIN mst_market mm on mm.subregion = n.subregion ";
    
    $sql_where_condition = " WHERE ud.userid = $userid and n.switch_name !='' ";
    
    if ($market != '') {
        $sql_where_condition .= " AND n.market  = '$market' ";
    }
    if ($subregion != '') {
        $sql_where_condition .= " AND n.submarket = '$subregion' ";
    }
    
    $sql_order = " ORDER BY ud.nodeid ";
    
    $count_sql = $sql_count . $sql_join . $sql_where_condition;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $resultset['total_rec'] = $row[0];
    
    $sql = $sql_select . $sql_join . $sql_where_condition . $sql_order;
    $sql .= $pages->limit;
    
    $db2->query($sql);
    
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/*
 *
 */
/**
 *
 * @param unknown $deviceid
 * @param unknown $userid
 * @return unknown
 */
function getSWroutersDetails($deviceid, $userid)
{
    global $db2;
    
    $sql_select = " SELECT n2.id,n2.devicename,n2.deviceIpAddr, n2.custom_Location, n2.connPort, n2.model, n2.systemname ";
    $sql_condition = " FROM nodes n
                    JOIN userdevices ud ON ud.nodeid = n.id
                    JOIN connectingdevices cd ON cd.swname = n.switch_name
                    JOIN nodes n2 ON cd.swrtrconnodeid = n2.id
                    WHERE n.id = $deviceid AND ud.userid = $userid  ";
    
    $sql = $sql_select . $sql_condition;
    $db2->query($sql);
    
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/*
 * Function to get the Switch Technician city list
 */
/**
 *
 * @param unknown $userid
 * @return unknown
 */
function getSEuserCityList($userid)
{
    global $db2;
    
    $sql = "SELECT  n.submarket  FROM userdevices ud
          JOIN nodes n ON n.id = ud.nodeid
          WHERE ud.userid = $userid AND n.submarket != ''
          group BY n.submarket
          ORDER BY n.submarket ";
    $db2->query($sql);
    
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $userid
 * @return unknown
 */
function usrfavritelist_display($userid)
{
    $db2 = new db2();
    $sql_select = " SELECT listname, listid ";
    $sql_condition = "
  FROM
  userdevices
  WHERE userid = $userid  and listid <> 0
  group by listname, listid
  order by listid desc ";
    
    $sql = $sql_select . $sql_condition;
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $userid
 * @return unknown
 */
function usrcellsitefavritelist_display($userid)
{
    $db2 = new db2();
    $sql_select = " SELECT listname, listid, listtype ";
    $sql_condition = "
  FROM
  userdevices
  WHERE userid = $userid
  group by listname, listid, listtype
  order by listid desc ";
    
    $sql = $sql_select . $sql_condition;
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $data
 * @return unknown
 */
function insert_my_device_record($data)
{
    $db2 = new db2();
    $listid = $data['listid'];
    $userid = $data['userid'];
    $nodeid = $data['deviceid'];
    
    $sql = "SELECT  listname FROM userdevices WHERE listid = $listid group by listname ";
    
    $db2->query($sql);
    $recordset = $db2->resultset();
    $listname = addslashes($recordset[0]['listname']);
    
    $sql = "INSERT INTO userdevices (nodeid, userid, listid, listname)
           VALUES($nodeid,$userid,$listid,'$listname')";
    // echo $sql;
    $db2->query($sql);
    $result = $db2->execute();
    
    return $result;
}

/**
 *
 * @param unknown $data
 * @return unknown
 */
function insert_ipaddrmgmt_record($data)
{
    $db2 = new db2();
    
    $sql = "INSERT INTO ipaddrmgmt (market, fromipvfour, toipvfour, fromipvsix, toipvsix)
           VALUES('" . $data['market'] . "','" . $data['fromipvfour'] . "','" . $data['toipvfour'] . "','" . $data['fromipvsix'] . "','" . $data['toipvsix'] . "')";
    
    $db2->query($sql);
    $result = $db2->execute();
    
    return $result;
}

/**
 *
 * @param unknown $data
 */
function insert_usrfavritedev($data)
{
    $db2 = new db2();
    $lname = addslashes($data['listname']);
    $userid = $data['userid'];
    $nodes = array(
        $data['deviceid']
    );
    $sql = "SELECT  max(listid) + 1  as listidmaxval FROM userdevices WHERE listid <> 0 ";
    $db2->query($sql);
    $recordset = $db2->resultset();
    $listid = $recordset[0]['listidmaxval'] + 1;
    
    $sql = "INSERT INTO userdevices (nodeid, userid, listid, listname)
           VALUES(0,$userid,$listid,'$lname')";
    // echo $sql ;
    $_SESSION['mylistname'] = $lname;
    $_SESSION['switchlistid'] = $listid;
    $db2->query($sql);
    $result = $db2->execute();
    if (in_array($_SESSION['userlevel'], array(
        1,
        3,
        4
    ))) {
        header("Location: cellsitetech-dashboard.php");
    } elseif (in_array($_SESSION['userlevel'], array(
        2,
        5,
        6,
        7,
        9,
        10    
    ))) {
        header("Location: switchtech-dashboard.php");
    } elseif (in_array($_SESSION['userlevel'], array(
        8
    ))) {
        header("Location: login-impersonate.php");
    }
    // return $result;
}

/**
 *
 * @param unknown $userid
 * @param unknown $listid
 * @return unknown
 */
function usrfavritecondev_display($userid, $listid)
{
    $db2 = new db2();
    $sql_select = " SELECT distinct(ud.id), ud.listid, ud.listname, ud.nodeid, n.devicename ";
    $sql_condition = "
  FROM
  userdevices ud
  LEFT JOIN nodes n on ud.nodeid = n.id
  WHERE ud.listid = $listid and ud.userid = $userid and ud.listid != 0 and ud.nodeid !=0 order by ud.id desc ";
    $sql = $sql_select . $sql_condition;
    
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    
    $resultset['mylistname'] = $resultset['result'][0]['listname'];
    
    return $resultset;
}

/**
 *
 * @param unknown $userid
 * @param unknown $listid
 * @return unknown
 */
function usrfavritecondev_celt_display($userid, $listid)
{
    $db2 = new db2();
    $sql_select = " SELECT ud.id, ud.listid, ud.listname, ud.nodeid, n.devicename ";
    $sql_condition = "
  FROM
  userdevices ud
  LEFT JOIN nodes n on ud.nodeid = n.id
  WHERE ud.listid = $listid and ud.userid = $userid and ud.listid >= 0 and ud.nodeid !=0  order by ud.id desc ";
    $sql = $sql_select . $sql_condition;
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    $resultset['mylistname'] = $resultset['result'][0]['listname'];
    return $resultset;
}

/**
 *
 * @param unknown $userid
 * @param unknown $listid
 * @return unknown
 */
function user_mylist_devieslist($userid, $listid)
{
    global $db2, $pages;
    $pages->paginate();
    if ($userid > 0) {
        $sql_count = "SELECT COUNT(*) ";
        $sql_select = "SELECT n.id, n.custom_Location, n.devicename, n.deviceIpAddr, n.model, v.vendorName, n.investigationstate, n.status, n.upsince, n.nodeVersion, ud.listname, n.severity, n.deviceseries ";
        
        $sql_condition = " FROM userdevices ud
         JOIN nodes n on ud.nodeid = n.id

         LEFT JOIN vendors v on v.id = n.vendorId
         WHERE ud.userid = " . $userid . " and ud.listid = " . $listid;
    }
    $count_sql = $sql_count . $sql_condition;
    // echo "$count_sql";
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    $total_rec = $row[0];
    
    $sql = $sql_select . $sql_condition;
    $sql .= $pages->limit;
    // echo "$sql";
    $db2->query($sql);
    
    $resultset['result'] = $db2->resultset();
    $resultset['total_rec'] = $total_rec;
    return $resultset;
}

/**
 *
 * @param unknown $userid
 * @param unknown $listid
 * @return void|unknown
 */
function get_user_mylist_name($userid, $listid)
{
    global $db2;
    
    $sql = "SELECT ud.listname  FROM userdevices ud
         JOIN nodes n on ud.nodeid = n.id

         WHERE ud.userid = " . $userid . " and ud.listid = " . $listid . "
         limit 0,1 ";
    
    $db2->query($sql);
    
    $resultset = $db2->resultset();
    if (isset($resultset[0]['listname'])) {
        return ($resultset[0]['listname']);
    } else {
        return;
    }
}

/**
 *
 * @param unknown $listid
 * @return void|unknown
 */
function get_user_mylist_name_by_id($listid,$userid)
{
    global $db2;
    
    $sql = "SELECT ud.listname  FROM userdevices ud
          WHERE ud.listid = " . $listid . " and ud.userid = ".$userid."
         limit 0,1 ";
    $db2->query($sql);
    $resultset = $db2->resultset();
    
    $sql1 = "SELECT count(*) as count  FROM userdevices ud join nodes n on n.id = ud.nodeid
          WHERE ud.listid = " . $listid . " and ud.userid = ".$userid.' and ud.nodeid != 0';
    $db2->query($sql1);
    $resultset1 = $db2->resultset();
    
    $resultset[0]['count'] = ($resultset1[0]['count'] == '') ? 0 : $resultset1[0]['count'];
    
    return ($resultset[0]);
    
}

function get_list_by_count($userid){
    global $db2;
    $sql = "SELECT DISTINCT ud.listname, count(*) AS count
    FROM userdevices ud join nodes n on n.id = ud.nodeid where ud.userid = ".$userid."  and ud.nodeid != 0 GROUP BY listname";
    $db2->query($sql);
    $resultset = $db2->resultset();
    $result = array();
    foreach ($resultset as $key => $val){
        $val['count'] = ($val['count'] == 0) ? 0 : $val['count'];
        $result[$val['listname']] = $val['count'];
    }
    
//     print '<pre>';
//     print_r($result);
//     die;
    
    return $result;
}


/**
 *
 * @param unknown $userid
 * @param unknown $listid
 * @return boolean|number|unknown
 */
function user_mylist_devieslist_datatable($userid, $listid)
{
    global $db2, $pages;
    
    if (! $userid) {
        return false;
    }
    // print_r($_GET);
    $draw = $_GET['draw'];
    $start = isset($_GET['start']) ? $_GET['start'] : 0;
    $length = isset($_GET['length']) ? $_GET['length'] : 10;
    $search = trim($_GET['search']['value']) ? addslashes(trim($_GET['search']['value'])) : null;
    $order_col = $_GET['order'][0]['column'];
    $order_dir = $_GET['order'][0]['dir'];
    
    $columns = array(
        'CONCAT(IFNULL(n.deviceIpAddr,""),"<br/>",IFNULL(n.deviceIpAddrsix,"")) as deviceIpAddr',
        'n.model',
        'n.id',
        'n.csr_site_id',
        'n.csr_site_name',
        'n.csr_site_tech_id',
        'n.devicename',
        'n.market',
        'n.deviceseries',
        'n.nodeVersion',
        'n.lastpolled',
        'n.status'
    );
    
    $sql_count = "SELECT COUNT(*) ";
    $sql_select = "SELECT " . implode(", ", $columns);
    
    $sql_condition = " FROM userdevices ud
       JOIN nodes n on ud.nodeid = n.id
       WHERE ud.userid = " . $userid . " and ud.listid = " . $listid;
    
    /*
     * if (in_array($_SESSION['userlevel'], array(1,2))){
     * $sql_condition = " FROM nodes n where n.csr_site_tech_id = '".$_SESSION['username']."' OR n.swt_tech_id = '".$_SESSION['username']."'";
     * }else{
     * $sql_condition = " FROM userdevices ud
     * JOIN nodes n on ud.nodeid = n.id
     * WHERE ud.userid = " . $userid ." and ud.listid = " . $listid;
     * }
     */
    
    if ($search) {
        $sql_condition .= " AND ( ";
        $sql_condition .= " n.devicename LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.csr_site_id LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.csr_site_name  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.market  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.deviceseries  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.nodeVersion  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.lastpolled  LIKE '%" . $search . "%'";
        $sql_condition .= "  OR n.deviceIpAddr LIKE '%" . addslashes($search) . "%' ";
        $sql_condition .= "  OR n.deviceIpAddrsix LIKE '%" . addslashes($search) . "%' ";
        $sql_condition .= " ) ";
    }
    $count_sql = $sql_count . $sql_condition;
    // echo $count_sql;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $total_rec = $row[0];
    
    $sql_order = "";
    if ($order_col != '') {
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != '') {
        $sql_order .= $order_dir != '' ? " $order_dir " : " asc ";
    }
    
    $sql_limit = " LIMIT $start, $length ";
    
    $sql = $sql_select . $sql_condition . $sql_order . $sql_limit;
    
    $db2->query($sql);
    
    $resultset['draw'] = $draw;
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'];
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    } else {
        $resultset['data'] = '';
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] = 0;
    }
    return $resultset;
}








/**
 *
 * @param unknown $userid
 * @param unknown $listid
 * @return boolean|number|unknown
 */
function user_mylist_devieslist_export($userid, $listid)
{
    global $db2, $pages;
    
    if (! $userid) {
        return false;
    }
    //print '<pre>'; print_r($_GET);die;
    $search = trim($_GET['search']) ? addslashes(trim($_GET['search'])) : null;
    $order_col = $_GET['column'];
    $order_dir = $_GET['dir'];
    
    $columns = array(
            'CONCAT(IFNULL(n.deviceIpAddr,""),"<br/>",IFNULL(n.deviceIpAddrsix,"")) as deviceIpAddr',
            'n.model',
            'n.id',
            'n.csr_site_id',
            'n.csr_site_name',
            'n.csr_site_tech_id',
            'n.devicename',
            'n.market',
            'n.deviceseries',
            'n.nodeVersion',
            'n.lastpolled',
            'n.status'
    );
    $sql_select = "SELECT " . implode(", ", $columns);
    $sql_condition = " FROM userdevices ud
       JOIN nodes n on ud.nodeid = n.id
       WHERE ud.userid = " . $userid . " and ud.listid = " . $listid;
    if ($search) {
        $sql_condition .= " AND ( ";
        $sql_condition .= " n.devicename LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.csr_site_id LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.csr_site_name  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.market  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.deviceseries  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.nodeVersion  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.lastpolled  LIKE '%" . $search . "%'";
        $sql_condition .= "  OR n.deviceIpAddr LIKE '%" . addslashes($search) . "%' ";
        $sql_condition .= "  OR n.deviceIpAddrsix LIKE '%" . addslashes($search) . "%' ";
        $sql_condition .= " ) ";
    }
    $sql_order = "";
    if ($order_col != '') {
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    if ($order_dir != '') {
        $sql_order .= $order_dir != '' ? " $order_dir " : " asc ";
    }
    $sql = $sql_select . $sql_condition . $sql_order . $sql_limit;
    $db2->query($sql);
    
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'];
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    } else {
        $resultset['data'] = '';
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] = 0;
    }
    return $resultset;
}














/**
 *
 * @param unknown $userid
 * @param unknown $switchlistid
 */
function usrfavritelistdel($userid, $switchlistid)
{
    $db2 = new db2();
    $sql = "delete from userdevices where userid = $userid and listid = $switchlistid and listname !='My Routers'";
    $db2->query($sql);
    $db2->execute();
    return;
}

/**
 *
 * @param unknown $userid
 * @param unknown $switchlistid
 * @param unknown $switchid
 */
function usrfavritelistswdel($userid, $switchlistid, $switchid)
{
    $db2 = new db2();
    $sql = "delete from userdevices where listid = $switchlistid and nodeid = $switchid and userid = $userid and listname !='My Routers'";
    $db2->query($sql);
    $db2->execute();
    return;
}

/**
 *
 * @param unknown $market_name
 * @return unknown
 */
function get_market_subregion_list($market_name)
{
    global $db2;
    $sql_select = "SELECT submarket as subregion ";
    $sql_condition = " FROM
                     nodes
                     WHERE market = '$market_name'
                     group by subregion
                     order by submarket ";
    $sql = $sql_select . $sql_condition;
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $emailid
 * @return unknown
 */
function userexist($emailid)
{
    $db2 = new db2();
    $sql = "SELECT COUNT(*) FROM users WHERE email ='" . $emailid . "'";
    $db2->query($sql);
    $row = $db2->resultsetCols();
    $resultset['result'] = $db2->resultset();
    
    return $row;
}

function checkipexist($ipaddress)
{
    global $db2;
    $sql = "SELECT COUNT(*) as total FROM nodes WHERE deviceIpAddr ='" . $ipaddress . "' OR deviceIpAddrsix ='" . $ipaddress . "'";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}


/**
 *
 * @param unknown $mailbody
 * @param unknown $pwrurl
 */
function sendmail($mailbody, $pwrurl)
{
    $mail = new PHPMailer();
    $mail->IsSMTP(); // send via SMTP
    $mail->SMTPAuth = true; // turn on SMTP authentication
    $mail->Username = "oneemsadministrator@gmail.com"; // SMTP username
    $mail->Password = "oneemsadministratorpassword"; // SMTP password
    $webmaster_email = "oneemsadministrator@gmail.com"; // Reply to this email ID
    $email = "enduser@gmail.com"; // Recipients email ID
    $name = "enduser"; // Recipient's name
    $mail->From = $webmaster_email;
    $mail->FromName = "OneEMS Administrator";
    $mail->AddAddress($email, $name);
    $mail->AddReplyTo($webmaster_email, "oneemsadministrator@gmail.com");
    $mail->WordWrap = 50; // set word wrap
                          // $mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment
                          // $mail->AddAttachment("/tmp/image.jpg", "new.jpg"); // attachment
    $mail->IsHTML(true); // send as HTML
    $mail->Subject = "OneEMS Password Reset";
    // $mail->Body = "Hi,
    // This is the HTML BODY "; //HTML Body
    $mail->Body = file_get_contents('emailcontent.php') . $mailbody . $pwrurl;
    $mail->AltBody = "This is the body when user views in plain text format"; // Text Body
    if (! $mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        // echo "Message has been sent";
    }
    // echo "<br>"."sendmail completed";
}

/**
 *
 * @param unknown $emailid
 * @param unknown $password
 * @return boolean
 */
function updateuserpassword($emailid, $password)
{
    // Update the user's password
    $db2 = new db2();
    $sql = "SELECT * FROM users WHERE email = '" . $emailid . "'";
    $db2->query($sql);
    $recordset = $db2->resultset();
    if (! $recordset) {
        echo "Username not found in our records.";
    } else {
        $sql = "UPDATE `users` SET password = '" . $password . "' WHERE email = '" . $emailid . "'";
        $db2->query($sql);
        $db2->execute();
        return true;
    }
}

/**
 *
 * @return unknown
 */
function get_market_list()
{
    global $db2;
    
    $sql_select = "SELECT market as market_name ";
    $sql_condition = " FROM nodes
                      where market != ''
                      GROUP BY market ";
    $sql = $sql_select . $sql_condition;
    $db2->query($sql);
    // echo $sql;
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/*
 * Functin to get the switch devices list by market and subregion wise for the user
 */
/**
 *
 * @param unknown $userid
 * @return unknown
 */
function get_switchlist_all_market($userid)
{
    global $db2;
    
    $sql_count = " SELECT count(*) ";
    $sql_select = " SELECT n.switch_name ";
    
    $sql_join = " FROM  nodes n
                      JOIN users u on u.username = n.swt_tech_id ";
    
    $sql_where_condition = " WHERE u.id = $userid and n.switch_name !='' limit 0,1 ";
    
    /*
     * if ($market != '') {
     * $sql_where_condition .= " AND n.market = '$market' ";
     * }
     * if ($subregion != '') {
     * $sql_where_condition .= " AND n.submarket = '$subregion' ";
     * }
     */
    
    $sql_order = " ";
    
    $count_sql = $sql_count . $sql_join . $sql_where_condition;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $resultset['total_rec'] = $row[0];
    
    $sql = $sql_select . $sql_join . $sql_where_condition . $sql_order;
    // $sql .= $pages->limit;
    
    $db2->query($sql);
    
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/*
 *
 */
/**
 *
 * @param unknown $swich_devince_name
 * @param string $search_term
 * @param unknown $userid
 * @param unknown $page_limit
 * @return unknown
 */
function getSWroutersDetails_all($swich_devince_name, $search_term = '', $userid, $page_limit)
{
    global $db2;
    
    $high_limit = HIGH_LIMIT;
    $low_limit = LOW_LIMIT;
    $pages = new Paginator();
    $pages->default_ipp = $page_limit;
    $temp_page_var = (isset($_GET['page'])) ? $_GET['page'] : 1;
    
    if (isset($_GET['page'])) {
        
        if ($_GET['ipp'] == $high_limit) {
            $_SESSION['high_page'] = $_GET['page'];
        }
        
        if ($_GET['ipp'] == $low_limit) {
            $_SESSION['low_page'] = $_GET['page'];
        }
        
        if ($page_limit == $high_limit) {
            $_GET['page'] = ($_SESSION['high_page']) ? $_SESSION['high_page'] : '1';
        }
        
        if ($page_limit == $low_limit) {
            $_GET['page'] = ($_SESSION['low_page']) ? $_SESSION['low_page'] : '1';
        }
    } else {
        unset($_SESSION['low_page']);
        unset($_SESSION['high_page']);
        
        $_SESSION['low_page'] = 1;
        $_GET['ipp'] = LOW_LIMIT;
        $_GET['page'] = 1;
    }
    $pages->paginate();
    $_GET['page'] = $temp_page_var;
    
    $sql_count = " SELECT count(*) ";
    $sql_select = " SELECT n2.id,n2.devicename,n2.deviceIpAddr, n2.custom_Location, n2.connPort, n2.model, n2.systemname ";
    $sql_condition = " FROM nodes n2
                      join userdevices ud on ud.nodeid = n2.id
                      join users u on u.id = ud.userid
                    WHERE n2.switch_name ='$swich_devince_name' AND u.id = $userid  ";
    
    if ($search_term != '') {
        $sql_condition .= " AND ( ";
        $sql_condition .= "  n2.devicename LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= "  OR n2.deviceIpAddr LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= "  OR n2.market LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= "  OR n2.submarket LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= " ) ";
    }
    $count_sql = $sql_count . $sql_condition;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $resultset['total_rec'] = $row[0];
    
    $sql = $sql_select . $sql_condition;
    $sql .= $pages->limit;
    
    $db2->query($sql);
    
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/*
 *
 */
/**
 *
 * @param unknown $list_for
 * @param unknown $list_type
 * @param unknown $selswitch
 * @return number|unknown
 */
function get_swt_user_routers_list_datatable($list_for, $list_type, $selswitch)
{
    global $db2;
    
    // print_r($_GET);
    $draw = $_GET['draw'];
    $start = isset($_GET['start']) ? $_GET['start'] : 0;
    $length = isset($_GET['length']) ? $_GET['length'] : 10;
    $search_term = trim($_GET['search']['value']) ? addslashes(trim($_GET['search']['value'])) : null;
    $order_col = $_GET['order'][0]['column'];
    $order_dir = $_GET['order'][0]['dir'];
    
    $columns = array(
        'DISTINCT(n.id)',
        'n.id',
        'n.csr_site_tech_name',
        'CONCAT(n.csr_site_id,"/",n.switch_name) as csr_site_id',
        'n.csr_site_name',
        'n.devicename',
        'CONCAT(IFNULL(n.deviceIpAddr,""),"<br/>",IFNULL(n.deviceIpAddrsix,"")) as deviceIpAddr'
    );
    
    $sql_count = " SELECT COUNT(DISTINCT(n.id)) as count ";
    $sql_select = " SELECT distinct " . implode(", ", $columns);
    
    if ($list_type == 'user') {
        $userid = $_SESSION['userid'];
        $switch_device_name = addslashes($list_for);
        $sql_condition = " FROM nodes n
                      join userdevices ud on ud.nodeid = n.id
                      join users u on u.id = ud.userid
                      WHERE n.switch_name ='$switch_device_name' AND u.id = $userid"; // AND csr_site_name != 'None' ";
    } else {
        $market = addslashes($list_for);
        $sql_condition = " FROM nodes n
                        WHERE trim(lower(REPLACE(n.market,' ',''))) ='$market'"; // AND csr_site_name != 'None' ";
        
        if ($selswitch != '') {
            $sql_condition .= " AND switch_name ='$selswitch'";
        }
    }
    
    if ($search_term != '') {
        $sql_condition .= " AND ( ";
        $sql_condition .= "  n.csr_site_tech_name LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= "  OR csr_site_id LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= "  OR n.csr_site_name LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= "  OR n.devicename LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= "  OR n.deviceIpAddr LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= "  OR n.deviceIpAddrsix LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= "  OR n.market LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= " ) ";
    }
    
    $count_sql = $sql_count . $sql_condition;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $total_rec = $row[0];
    
    $sql_order = "";
    if ($order_col != '') {
        if ($order_col == 3) {
            $sql_order = " ORDER BY csr_site_id";
        } else {
            $sql_order = " ORDER BY " . $columns[$order_col];
        }
    }
    
    if ($order_dir != '') {
        $sql_order .= $order_dir != '' ? " $order_dir " : " asc ";
    }
    
    $sql_limit = " LIMIT $start, $length ";
    
    $sql = $sql_select . $sql_condition . $sql_order . $sql_limit;
    $db2->query($sql);
    
    $resultset['draw'] = $draw;
    
    if (count($db2->resultset())) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'];
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    } else {
        $resultset['data'] = '';
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] = 0;
    }
    
    return $resultset;
}

/**
 *
 * @param unknown $list_for
 * @param unknown $list_type
 * @param unknown $selswitch
 * @return number|unknown
 */
function get_cellsitetech_user_routers_list_datatable($list_for, $list_type, $selswitch)
{
    global $db2;
    
    // print_r($_GET);
    $draw = $_GET['draw'];
    $start = isset($_GET['start']) ? $_GET['start'] : 0;
    $length = isset($_GET['length']) ? $_GET['length'] : 10;
    $search_term = trim($_GET['search']['value']) ? addslashes(trim($_GET['search']['value'])) : null;
    $order_col = $_GET['order'][0]['column'];
    $order_dir = $_GET['order'][0]['dir'];
    
    $columns = array(
        'DISTINCT(n.id)',
        'n.id',
        'n.csr_site_tech_name',
        'CONCAT(n.csr_site_id,"/",n.switch_name) as csr_site_id',
        'n.csr_site_name',
        'n.devicename',
        'CONCAT(IFNULL(n.deviceIpAddr,""),"<br/>",IFNULL(n.deviceIpAddrsix,"")) as deviceIpAddr'
    );
    
    $sql_count = " SELECT COUNT(DISTINCT(n.id)) as count ";
    $sql_select = " SELECT distinct " . implode(", ", $columns);
    
    if ($list_type == 'user') {
        $userid = $_SESSION['userid'];
        $switch_device_name = addslashes($list_for);
        $sql_condition = " FROM nodes n
                      join userdevices ud on ud.nodeid = n.id
                      join users u on u.id = ud.userid
                      WHERE n.switch_name ='$switch_device_name' AND n.status = 3"; // AND csr_site_name != 'None' ";
    } else {
        $market = addslashes($list_for);
        $sql_condition = " FROM nodes n
                        WHERE trim(lower(REPLACE(n.market,' ',''))) ='$market'"; // AND csr_site_name != 'None' ";
                                                                 // WHERE trim(lower(REPLACE(n.market,' ',''))) ='$market' AND n.status = 3";
        if ($selswitch != '') {
            $sql_condition .= " AND switch_name ='$selswitch'";
        }
    }
    
    if ($search_term != '') {
        $sql_condition .= " AND ( ";
        $sql_condition .= "  n.csr_site_tech_name LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= "  OR csr_site_id LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= "  OR n.csr_site_name LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= "  OR n.devicename LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= "  OR n.deviceIpAddr LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= "  OR n.deviceIpAddrsix LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= "  OR n.market LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= " ) ";
    }
    
    $count_sql = $sql_count . $sql_condition;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $total_rec = $row[0];
    
    $sql_order = "";
    if ($order_col != '') {
        if ($order_col == 3) {
            $sql_order = " ORDER BY csr_site_id";
        } else {
            $sql_order = " ORDER BY " . $columns[$order_col];
        }
    }
    
    if ($order_dir != '') {
        $sql_order .= $order_dir != '' ? " $order_dir " : " asc ";
    }
    
    $sql_limit = " LIMIT $start, $length ";
    
    $sql = $sql_select . $sql_condition . $sql_order . $sql_limit;
    $db2->query($sql);
    
    $resultset['draw'] = $draw;
    
    if (count($db2->resultset())) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'];
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    } else {
        $resultset['data'] = '';
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] = 0;
    }
    
    return $resultset;
}

/**
 *
 * @return unknown
 */
function get_market_list_new()
{
    global $db2;
    
    $sql_select = "SELECT market as market_name ";
    $sql_condition = " FROM nodes
                      where market != ''
                      GROUP BY market ";
    $sql = $sql_select . $sql_condition;
    $db2->query($sql);
    
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $market
 * @param unknown $search_term
 * @param unknown $page_limit
 * @return unknown
 */
function getmarketroutersDetails_all($market, $search_term, $page_limit)
{
    global $db2;
    $pages = new Paginator();
    
    $high_limit = HIGH_LIMIT;
    $low_limit = LOW_LIMIT;
    $pages->default_ipp = $page_limit;
    $temp_page_var = (isset($_GET['page'])) ? $_GET['page'] : 1;
    
    if (isset($_GET['page'])) {
        
        if ($_GET['ipp'] == $high_limit) {
            $_SESSION['high_page'] = $_GET['page'];
        }
        
        if ($_GET['ipp'] == $low_limit) {
            $_SESSION['low_page'] = $_GET['page'];
        }
        
        if ($page_limit == $high_limit) {
            $_GET['page'] = ($_SESSION['high_page']) ? $_SESSION['high_page'] : '1';
        }
        
        if ($page_limit == $low_limit) {
            $_GET['page'] = ($_SESSION['low_page']) ? $_SESSION['low_page'] : '1';
        }
    } else {
        unset($_SESSION['low_page']);
        unset($_SESSION['high_page']);
        
        $_SESSION['low_page'] = 1;
        $_GET['ipp'] = LOW_LIMIT;
        $_GET['page'] = 1;
    }
    $pages->paginate();
    $_GET['page'] = $temp_page_var;
    
    $sql_count = " SELECT count(*) ";
    $sql_select = " SELECT n2.id,n2.devicename,n2.deviceIpAddr, n2.custom_Location, n2.connPort, n2.model, n2.systemname ";
    $sql_condition = " FROM nodes n2
                        WHERE trim(lower(REPLACE(n2.market,' ',''))) ='$market'";
    
    if ($search_term != '') {
        $sql_condition .= " AND ( ";
        $sql_condition .= "  n2.devicename LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= "  OR n2.deviceIpAddr LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= "  OR n2.market LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= "  OR n2.submarket LIKE '%" . addslashes($search_term) . "%' ";
        $sql_condition .= " ) ";
    }
    $count_sql = $sql_count . $sql_condition;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $resultset['total_rec'] = $row[0];
    
    $sql = $sql_select . $sql_condition;
    $sql .= $pages->limit;
    // echo $sql;;
    // echo $sql; exit(0);
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $table_name
 * @param array $table_fields
 * @return unknown
 */
function export_table($table_name, $table_fields = array())
{
    global $db2;
    
    $sql_select = " SELECT * FROM ";
    $sql_where .= " nodes ";
    
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/*
 * Function to get the Switches list of user
 */
/**
 *
 * @param unknown $userid
 * @return unknown
 */
function getIpAddrMgmtList($userid)
{
    global $db2;
    $sql = "SELECT market,fromipvfour,toipvfour,fromipvsix,toipvsix FROM ipaddrmgmt as ipmgt ORDER BY ipmgt.id";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $userid
 * @return number|unknown
 */
function get_discovery_list_datatable($userid)
{
    global $db2, $pages;
    $draw = $_GET['draw'];
    $start = isset($_GET['start']) ? $_GET['start'] : 0;
    $length = isset($_GET['length']) ? $_GET['length'] : 10;
    $search = trim($_GET['search']['value']) ? addslashes(trim($_GET['search']['value'])) : null;
    $order_col = $_GET['order'][0]['column'];
    $order_dir = $_GET['order'][0]['dir'];
    
    $columns = array(
        'n.id',
        'n.scantime',
        'n.deviceipaddr',
        'n.ping',
        'n.deviceid',
        'n.deviceos',
        'n.nodeVersion',
        'n.deviceseries',
        'n.processed'
    );
    
    $sql_count = "SELECT COUNT(*) ";
    $sql_select = "SELECT " . implode(", ", $columns);
    
    $sql_condition = " FROM  discoveryres n";
    if ($search) {
        $sql_condition .= " where ( ";
        $sql_condition .= " n.scantime  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.deviceipaddr  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.ping  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.deviceid  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.deviceos  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.nodeVersion  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.deviceseries  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.processed  LIKE '%" . $search . "%'";
        $sql_condition .= " ) ";
    }
    $count_sql = $sql_count . $sql_condition;
    // echo $count_sql;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $total_rec = $row[0];
    
    $sql_order = "";
    if ($order_col != '') {
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != '') {
        $sql_order .= $order_dir != '' ? " $order_dir " : " asc ";
    }
    
    $sql_limit = " LIMIT $start, $length ";
    
    $sql = $sql_select . $sql_condition . $sql_order . $sql_limit;
    
    $db2->query($sql);
    $resultset['draw'] = $draw;
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'];
            $records[$key] = $value;
        }
        
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    } else {
        $resultset['data'] = array();
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] = 0;
    }
    
    return $resultset;
}

/**
 *
 * @param unknown $type
 * @return unknown
 */
function load_ipv_dataset($type)
{
    global $db2;
    $condition = ($type == 'ipv4') ? '.' : ':';
    $sql = "SELECT * FROM ipallocation  as ipa  where subnetmask like '%" . $condition . "%' and market !=''  ORDER BY ipa.id";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/*
 * function getipvfour_details($snm)
 * {
 * $parts=explode("/",$snm);
 * $exponent = 32 - $parts[1].'-';
 * $count = pow(2,$exponent);
 * $start = ip2long($parts[0]);
 * $end = $start+$count;
 * $ip['fromipvfour'] = long2ip($start) ;
 * $ip['toipvfour'] = long2ip($end) ;
 * $ip['count'] = $count;
 * return $ip;
 * }
 */
/**
 *
 * @param unknown $range
 * @return unknown
 */
function getipvfour_details($range)
{
    $range = rtrim($range);
    if (preg_match("/\//", $range)) { // if cidr type mask
        $dq_host = strtok("$range", "/");
        $cdr_nmask = strtok("/");
        if (! ($cdr_nmask >= 0 && $cdr_nmask <= 32)) {
            tr("Invalid CIDR value. Try an integer 0 - 32.");
            print "$end";
            exit();
        }
        $bin_nmask = cdrtobin($cdr_nmask);
        $bin_wmask = binnmtowm($bin_nmask);
    } else { // Dotted quad mask?
        $dqs = explode(" ", $range);
        $dq_host = $dqs[0];
        $bin_nmask = dqtobin($dqs[1]);
        $bin_wmask = binnmtowm($bin_nmask);
        if (preg_match("/0/", rtrim($bin_nmask, "0"))) { // Wildcard mask then? hmm?
            $bin_wmask = dqtobin($dqs[1]);
            $bin_nmask = binwmtonm($bin_wmask);
            if (preg_match("/0/", rtrim($bin_nmask, "0"))) { // If it's not wcard, whussup?
                print("Invalid Netmask.");
                print "$end";
                exit();
            }
        }
        $cdr_nmask = bintocdr($bin_nmask);
    }
    
    // Check for valid $dq_host
    if (! preg_match('/^0./', $dq_host)) {
        foreach (explode(".", $dq_host) as $octet) {
            if ($octet > 255) {
                print("Invalid IP Address");
                print $end;
                exit();
            }
        }
    }
    
    $bin_host = dqtobin($dq_host);
    $bin_bcast = (str_pad(substr($bin_host, 0, $cdr_nmask), 32, 1));
    $bin_net = (str_pad(substr($bin_host, 0, $cdr_nmask), 32, 0));
    $bin_first = (str_pad(substr($bin_net, 0, 31), 32, 1));
    $bin_last = (str_pad(substr($bin_bcast, 0, 31), 32, 0));
    $host_total = (bindec(str_pad("", (32 - $cdr_nmask), 1)) - 1);
    
    if ($host_total <= 0) { // Takes care of 31 and 32 bit masks.
        $bin_first = "N/A";
        $bin_last = "N/A";
        $host_total = "N/A";
        if ($bin_net === $bin_bcast)
            $bin_bcast = "N/A";
    }
    
    // Determine Class
    if (preg_match('/^0/', $bin_net)) {
        $class = "A";
        $dotbin_net = "<font color=\"Green\">0</font>" . substr(dotbin($bin_net, $cdr_nmask), 1);
    } elseif (preg_match('/^10/', $bin_net)) {
        $class = "B";
        $dotbin_net = "<font color=\"Green\">10</font>" . substr(dotbin($bin_net, $cdr_nmask), 2);
    } elseif (preg_match('/^110/', $bin_net)) {
        $class = "C";
        $dotbin_net = "<font color=\"Green\">110</font>" . substr(dotbin($bin_net, $cdr_nmask), 3);
    } elseif (preg_match('/^1110/', $bin_net)) {
        $class = "D";
        $dotbin_net = "<font color=\"Green\">1110</font>" . substr(dotbin($bin_net, $cdr_nmask), 4);
        $special = "<font color=\"Green\">Class D = Multicast Address Space.</font>";
    } else {
        $class = "E";
        $dotbin_net = "<font color=\"Green\">1111</font>" . substr(dotbin($bin_net, $cdr_nmask), 4);
        $special = "<font color=\"Green\">Class E = Experimental Address Space.</font>";
    }
    
    if (preg_match('/^(00001010)|(101011000001)|(1100000010101000)/', $bin_net)) {
        $special = '<a href="http://www.ietf.org/rfc/rfc1918.txt">( RFC-1918 Private Internet Address. )</a>';
    }
    
    return array_map('long2ip', range(ip2long(bintodq($bin_first)), ip2long(bintodq($bin_last))));
}

/**
 *
 * @param unknown $binin
 * @return unknown|string
 */
function binnmtowm($binin)
{
    $binin = rtrim($binin, "0");
    if (! preg_match("/0/", $binin)) {
        return str_pad(str_replace("1", "0", $binin), 32, "1");
    } else
        return "1010101010101010101010101010101010101010";
}

/**
 *
 * @param unknown $binin
 * @return unknown
 */
function bintocdr($binin)
{
    return strlen(rtrim($binin, "0"));
}

/**
 *
 * @param unknown $binin
 * @return unknown
 */
function bintodq($binin)
{
    if ($binin == "N/A")
        return $binin;
    $binin = explode(".", chunk_split($binin, 8, "."));
    for ($i = 0; $i < 4; $i ++) {
        $dq[$i] = bindec($binin[$i]);
    }
    return implode(".", $dq);
}

/**
 *
 * @param unknown $binin
 * @return unknown
 */
function bintoint($binin)
{
    return bindec($binin);
}

/**
 *
 * @param unknown $binin
 * @return unknown|string
 */
function binwmtonm($binin)
{
    $binin = rtrim($binin, "1");
    if (! preg_match("/1/", $binin)) {
        return str_pad(str_replace("0", "1", $binin), 32, "0");
    } else
        return "1010101010101010101010101010101010101010";
}

/**
 *
 * @param unknown $cdrin
 * @return unknown
 */
function cdrtobin($cdrin)
{
    return str_pad(str_pad("", $cdrin, "1"), 32, "0");
}

/**
 *
 * @param unknown $binin
 * @param unknown $cdr_nmask
 * @return unknown|string
 */
function dotbin($binin, $cdr_nmask)
{
    // splits 32 bit bin into dotted bin octets
    if ($binin == "N/A")
        return $binin;
    $oct = rtrim(chunk_split($binin, 8, "."), ".");
    if ($cdr_nmask > 0) {
        $offset = sprintf("%u", $cdr_nmask / 8) + $cdr_nmask;
        return substr($oct, 0, $offset) . "&nbsp;&nbsp;&nbsp;" . substr($oct, $offset);
    } else {
        return $oct;
    }
}

/**
 *
 * @param unknown $dqin
 * @return unknown
 */
function dqtobin($dqin)
{
    $dq = explode(".", $dqin);
    for ($i = 0; $i < 4; $i ++) {
        $bin[$i] = str_pad(decbin($dq[$i]), 8, "0", STR_PAD_LEFT);
    }
    return implode("", $bin);
}

/**
 *
 * @param unknown $intin
 * @return unknown
 */
function inttobin($intin)
{
    return str_pad(decbin($intin), 32, "0", STR_PAD_LEFT);
}

/**
 *
 * @param unknown $range
 * @return unknown
 */
function getipvsix_details($range)
{
    // Split in address and prefix length
    list ($firstaddrstr, $prefixlen) = explode('/', $range);
    
    // Parse the address into a binary string
    $firstaddrbin = inet_pton($firstaddrstr);
    
    // Convert the binary string to a string with hexadecimal characters
    // unpack() can be replaced with bin2hex()
    // unpack() is used for symmetry with pack() below
    $firstaddrhex = reset(unpack('H*', $firstaddrbin));
    
    // Overwriting first address string to make sure notation is optimal
    $firstaddrstr = inet_ntop($firstaddrbin);
    
    // Calculate the number of 'flexible' bits
    $flexbits = 128 - $prefixlen;
    
    // Build the hexadecimal string of the last address
    $lastaddrhex = $firstaddrhex;
    
    // We start at the end of the string (which is always 32 characters long)
    $pos = 31;
    while ($flexbits > 0) {
        // Get the character at this position
        $orig = substr($lastaddrhex, $pos, 1);
        
        // Convert it to an integer
        $origval = hexdec($orig);
        
        // OR it with (2^flexbits)-1, with flexbits limited to 4 at a time
        $newval = $origval | (pow(2, min(4, $flexbits)) - 1);
        
        // Convert it back to a hexadecimal character
        $new = dechex($newval);
        
        // And put that character back in the string
        $lastaddrhex = substr_replace($lastaddrhex, $new, $pos, 1);
        
        // We processed one nibble, move to previous position
        $flexbits -= 4;
        $pos -= 1;
    }
    
    // Convert the hexadecimal string to a binary string
    // Using pack() here
    // Newer PHP version can use hex2bin()
    $lastaddrbin = pack('H*', $lastaddrhex);
    
    // And create an IPv6 address from the binary string
    $lastaddrstr = inet_ntop($lastaddrbin);
    
    // Report to user
    $ip['fromipvsix'] = $firstaddrstr;
    $ip['toipvsix'] = $lastaddrstr;
    $ip['count'] = (ipv6_numeric($lastaddrstr) - ipv6_numeric($firstaddrstr));
    return $ip;
}

/**
 *
 * @param unknown $ip
 * @return unknown
 */
function ipv6_numeric($ip)
{
    $binNum = '';
    foreach (unpack('C*', inet_pton($ip)) as $byte) {
        $binNum .= str_pad(decbin($byte), 8, "0", STR_PAD_LEFT);
    }
    return base_convert(ltrim($binNum, '0'), 2, 10);
}

/**
 *
 * @param unknown $cidr
 * @return NULL[]
 */
function cidrToRange($cidr)
{
    $range = array();
    $cidr = explode('/', $cidr);
    $range[0] = long2ip((ip2long($cidr[0])) & ((- 1 << (32 - (int) $cidr[1]))));
    $range[1] = long2ip((ip2long($range[0])) + pow(2, (32 - (int) $cidr[1])) - 1);
    return $range;
}

/**
 *
 * @param unknown $ip
 * @param unknown $range
 * @return boolean
 */
function ip_in_range($ip, $range)
{
    if (strpos($range, '/') == false) {
        $range .= '/32';
    }
    // $range is in IP/CIDR format eg 127.0.0.1/24
    list ($range, $netmask) = explode('/', $range, 2);
    $range_decimal = ip2long($range);
    $ip_decimal = ip2long($ip);
    $wildcard_decimal = pow(2, (32 - $netmask)) - 1;
    $netmask_decimal = ~ $wildcard_decimal;
    return (($ip_decimal & $netmask_decimal) == ($range_decimal & $netmask_decimal));
}

/**
 *
 * @param unknown $region
 * @param unknown $market
 * @param unknown $subnetmask
 * @return unknown
 */
function get_nodes_list_ipmgmt($region, $market, $subnetmask)
{
    global $db2;
    // echo 'value of region'.$region.'market'.$market.'subnetmask'.$subnetmask.'<br>';
    $ipvfour_details = getipvfour_details($subnetmask);
    $sql_select = "SELECT n.id, deviceIpAddr, n.devicename, n.csr_site_id, n.csr_site_name, n.deviceseries, n.deviceos, n.nodeVersion,n.lastpolled ";
    $sql_condition = " FROM  nodes n
                     WHERE n.market = '$market' and n.region = '$region'
                    ";
    $sql = $sql_select . $sql_condition;
    // echo '<br>'.$sql.'<br>';
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset['result'];
}

/**
 *
 * @param unknown $region
 * @param unknown $market
 * @param unknown $subnetmask
 * @return unknown
 */
function get_nodes_list_ipmgmtv6($region, $market, $subnetmask)
{
    global $db2;
    $sql_select = "SELECT n.id, deviceIpAddr, n.devicename, n.csr_site_id, n.csr_site_name, n.deviceseries, n.deviceos, n.nodeVersion,n.lastpolled ";
    $sql_condition = " FROM  nodes n
                     WHERE n.market = '$market' and n.region = '$region'
                    ";
    $sql = $sql_select . $sql_condition;
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    $ip = getipvsix_details($subnetmask);
    foreach ($resultset['result'] as $key => $val) {
        if (filter_var($val['deviceIpAddr'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) && ($val['deviceIpAddr'] <= $ip['toipvsix'] && $ip['fromipvsix'] <= $val['deviceIpAddr'])) {
            $outputres[] = $val;
        }
    }
    return $outputres;
}

/**
 *
 * @return unknown
 */
function get_ipallocation_region_list()
{
    global $db2;
    $sql = "select distinct(region) from ipallocation order by region";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $region
 * @return unknown
 */
function get_ipallocation_market_list($region)
{
    global $db2;
    $sql = "select distinct(market) from ipallocation where region = '" . $region . "' order by market";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $values
 */
function insert_ip_allocation($values)
{
    global $db2;
    $sql = "INSERT INTO ipallocation (cust_gvn_region, region, market, subnetmask)
				VALUES ('" . $values[cust_gvn_region] . "','" . $values[region] . "','" . $values[market] . "','" . $values[subnetmask] . "')";
    
    $db2->query($sql);
    $db2->execute();
}

/**
 *
 * @param unknown $values
 */
function insert_vendor($values)
{
    global $db2;
    $sql = "INSERT INTO vendors (vendorName,vendorLogo,status) VALUES ('" . $values['vendorName'] . "','',1)";
    $db2->query($sql);
    $db2->execute();
}

/**
 *
 * @param unknown $values
 */
function insert_user_variable($values)
{
    global $db2;
	$sql = "SELECT * FROM import_usrvars WHERE usrvarname LIKE '" . $values['usrvarname'] . "' and username LIKE '".$values['username']."'";
    $db2->query($sql);
    $recordset = $db2->resultset();
	
	if(!($recordset)){
		$sql = "INSERT INTO import_usrvars (usrvarname,usrvarval,deviceseries,templname,username) VALUES ('" . $values['usrvarname'] . "','" . $values['value'] . "','" . $values['deviceseries'] . "','" . $values['template'] . "','" . $values['username'] . "')";
		$db2->query($sql);
		$db2->execute();
	}
	else{
		$sql = "UPDATE `import_usrvars` SET usrvarval = '" . $values['value'] . "' WHERE usrvarname LIKE '" . $values['usrvarname'] . "' and username LIKE '".$values['username']."'";
        $db2->query($sql);
        $db2->execute();
	}
}

/**
 *
 * @param unknown $values
 */
function insert_user_level($values)
{
    global $db2;
    $sql = "INSERT INTO userlevels (userlevel) VALUES ('" . $values['userlevel'] . "')";
    $db2->query($sql);
    $db2->execute();
}


/**
 *
 * @param unknown $values
 */
function insert_user($values)
{
    global $db2;
    $sql = "INSERT INTO users (username,password,userlevel,email,timestamp,status,fname,lname,phone,zones) VALUES
     ('" . $values['username'] . "','" . $values['password'] . "'," . $values['role'] . ",'" . $values['email'] . "',
     '" . date('m-d-Y') . "'," . $values['status'] . ",'" . $values['fname'] . "','" . $values['lname'] . "','" . $values['phone'] . "',
     ".$values['zones'].")";
    $db2->query($sql);
    $db2->execute();
}

/**
 *
 * @param unknown $values
 */
function update_vendor($values)
{
    global $db2;
    $sql = "update vendors set vendorName = '" . $values['vendorName'] . "' where id = ". $values['id'];
    $db2->query($sql);
    $db2->execute();
}


/**
 *
 * @param unknown $values
 */
function update_user_level($values)
{
    global $db2;
    
    $sql = "update userlevels set userlevel = '" . $values['userlevel'] . "' where id = ". $values['id'];
    
    $db2->query($sql);
    $db2->execute();
}

/**
 *
 * @param unknown $values
 */
function update_user($values)
{
    global $db2;
    $pass_update = '';
    if($values['password'] != ''){
        $pass_update = ", password = '" . $values['password'] . "'";
    }
    
    $sql = "update users set username = '" . $values['username'] . "', username = '" . $values['username'] . "'".$pass_update.",
        userlevel = " . $values['userlevel'] . ", email = '" . $values['email'] . "', username = '" . $values['username'] . "',
        status = " . $values['status'] . ", phone = '" . $values['phone'] . "', zones = " . $values['zones'] . " where id = ". $values['id'];
    $db2->query($sql);
    $db2->execute();
}



/**
 *
 * @param unknown $values
 */
function delete_vendor($values)
{
    global $db2;
    $sql = "delete from vendors where id = ". $values['id'];
    $db2->query($sql);
    $db2->execute();
}
/**
 *
 * @param unknown $values
 */
function delete_user($values)
{
    global $db2;
    $sql = "update users set status=0 where id = ". $values['id'];
    $db2->query($sql);
    $db2->execute();
    
    $sql = "delete from userdevices where userid = ". $values['id'];
    $db2->query($sql);
    $db2->execute();
    
    $sql = "delete from batchconfigtemplate where userid = ". $values['id'];
    $db2->query($sql);
    $db2->execute();
    
    $sql = "delete from tmpbatchconfigtemplate where userid = ". $values['id'];
    $db2->query($sql);
    $db2->execute();
    
    $sql = "delete from nodes where csr_site_tech_id = '". $values['username']."' or swt_tech_id = '". $values['username']."'";
    $db2->query($sql);
    $db2->execute();
    
}

/**
 *
 * @param unknown $values
 */
function delete_user_level($values)
{
    global $db2;
    $sql = "delete from userlevels where id = ". $values['id'];
    $db2->query($sql);
    $db2->execute();
}


/**
 *
 * @param string $class
 * @return unknown|string
 */
function load_discovery_dataset_new($class = 'C')
{
    global $db2, $pages;
    $draw = $_GET['draw'];
    $start = isset($_GET['start']) ? $_GET['start'] : 0;
    $length = isset($_GET['length']) ? $_GET['length'] : 10;
    $search = trim($_GET['search']['value']) ? addslashes(trim($_GET['search']['value'])) : null;
    $order_col = $_GET['order'][0]['column'];
    $order_dir = $_GET['order'][0]['dir'];
    
    $columns = array(
            'd.deviceIpAddr',
            'd.devicename',
            'd.csr_site_id',
            'd.csr_site_name',
            'd.deviceseries',
            'd.deviceos',
            'd.nodeVersion',
            'd.timepolled',
            'd.timepolled',
            'd.region',
            'd.market',
            'd.upsince',
            
    );
    $sql_count = "SELECT COUNT(distinct(d.id)) ";
    $sql_select = "SELECT " . implode(", ", $columns);
    
    $sql_condition = " FROM discoveryres d where class = '" . $class ."'";
    if(!in_array($_SESSION['userlevel'], array(9))){
        $sqlm = "select GROUP_CONCAT(DISTINCT(CONCAT('''', (market), '''' ))) as market from nodes where csr_site_tech_id like '" . $_SESSION['username'] . "'";
        $db2->query($sqlm);
        $mrecordset = $db2->resultset();
        if (isset($mrecordset[0]['market'])) {
            $market = $mrecordset[0]['market'];
            $sql_condition .= " AND d.market in (" . $market . ")";
        }
    }
    if ($search) {
        $sql_condition .= " AND ( ";
        $sql_condition .= " d.deviceIpAddr LIKE '%" . $search . "%'";
        $sql_condition .= " OR d.devicename  LIKE '%" . $search . "%'";
        $sql_condition .= " OR d.csr_site_name LIKE '%" . $search . "%'";
        $sql_condition .= " OR d.deviceseries  LIKE '%" . $search . "%'";
        $sql_condition .= " OR d.deviceos  LIKE '%" . $search . "%'";
        $sql_condition .= " OR d.deviceos  LIKE '%" . $search . "%'";
        $sql_condition .= " OR d.nodeVersion  LIKE '%" . $search . "%'";
        $sql_condition .= " OR d.timepolled  LIKE '%" . $search . "%'";
        $sql_condition .= " OR d.region  LIKE '%" . $search . "%'";
        $sql_condition .= " OR d.market  LIKE '%" . $search . "%'";
        $sql_condition .= " OR d.upsince  LIKE '%" . $search . "%'";
        $sql_condition .= " ) ";
    }
    $count_sql = $sql_count . $sql_condition;
    //echo $count_sql; die;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $total_rec = $row[0];
    
    $sql_order = "";
    if ($order_col != '') {
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != '') {
        $sql_order .= $order_dir != '' ? " $order_dir " : " asc ";
    }
    
    $sql_limit = " LIMIT $start, $length ";
    
    $sql = $sql_select . $sql_condition . $sql_order . $sql_limit;
    // echo '<br>';
    // echo $sql;
    
    $db2->query($sql);
    
    $resultset['draw'] = $draw;
    
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'];
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    } else {
        $resultset['data'] = array();
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] = 0;
    }
    return $resultset;
}


/**
 *
 * @param string $class
 * @return unknown|string
 */
function load_discovery_dataset($class = 'C')
{
    global $db2;
    if(!in_array($_SESSION['userlevel'], array(9))){
        $sqlm = "select GROUP_CONCAT(DISTINCT(CONCAT('''', (market), '''' ))) as market from nodes where csr_site_tech_id like '" . $_SESSION['username'] . "'";
        $db2->query($sqlm);
        $mrecordset = $db2->resultset();
        if (isset($mrecordset[0]['market'])) {
            $market = $mrecordset[0]['market'];
            $sql = "SELECT * FROM discoveryres where class ='" . strtolower($class) . "' AND market in (" . $market . ") ORDER BY id";
            $db2->query($sql);
            $resultset['result'] = $db2->resultset();
            return $resultset;
        } else {
            return '';
        }
    }else{
        $sql = "SELECT * FROM discoveryres where class ='" . strtolower($class) . "' ORDER BY id";
        $db2->query($sql);
        $resultset['result'] = $db2->resultset();
        return $resultset;
    }
}

/**
 *
 * @param unknown $status
 * @param unknown $id
 * @return string
 */
function discovery_status_update($status, $id)
{
    global $db2;
    if ($id != 0) {
        $sql = "UPDATE `discoveryres` SET class = 'd' WHERE id = '" . $id . "' AND class = '" . $status . "'";
    } else {
        $sql = "UPDATE `discoveryres` SET class = 'd' WHERE class = '" . $status . "'";
    }
    $db2->query($sql);
    $db2->execute();
    return success;
}

/**
 *
 * @param string $ipaddress
 * @return unknown
 */
function test_ipv6_address($ipaddress = '')
{
    return filter_var($ipaddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
}

/**
 *
 * @param unknown $values
 */
function discovery_add_new_device($values)
{
    global $db2;
    /*
     * $sqlc = "SELECT max(id) + 1 as id FROM nodes WHERE id <> 0 ";
     * $db2->query($sqlc);
     * $recordset = $db2->resultset();
     * $values['id'] = $recordset[0]['id'];
     * $sql = "INSERT INTO nodes (id, region, market, devicename, deviceIpAddr, nodeAddedBy, nodeCatId, vendorId, deviceseries, status,
     * csr_site_tech_name, csr_site_tech_mgr_name, csr_site_id, systemname, deviceos, csr_site_tech_id, csr_site_tech_mgr_id,
     * csr_site_name, nodeVersion, lastpolled, deviceDateAdded, deviceLastUpdated, upsince, switch_name, submarket)
     * VALUES (
     * " . $values['id'] . ",'" . $values['region'] . "','" . $values['market'] . "','" . $values['devicename'] . "','" . $values['deviceIpAddr'] . "',
     * '" . $values['nodeAddedBy'] . "','" . $values['nodeCatId'] . "','" . $values['vendorId'] . "','" . $values['deviceseries'] . "','" . $values['status'] . "',
     * '" . $values['csr_site_tech_name'] . "','" . $values['csr_site_tech_mgr_name'] . "','" . $values['csr_site_id'] . "','" . $values['systemname'] . "',
     * '" . $values['deviceos'] . "','" . $values['csr_site_tech_id'] . "', '" . $values['csr_site_tech_mgr_id'] . "','" . $values['csr_site_name'] . "',
     * '" . $values['nodeVersion'] . "', '" . $values['lastpolled'] . "', '" . $values['deviceDateAdded'] . "', '" . $values['deviceLastUpdated'] . "',
     * '" . $values['upsince'] . "','" . $values['switch_name'] . "','')";
     */
    
    if(loaddeviceidfromdevicename($values['devicename'])){
        if(test_ipv6_address($values['deviceIpAddrsix'])){
            $sql = "UPDATE `nodes` SET deviceIpAddrsix = '" . $values['deviceIpAddrsix'] . "' WHERE devicename = '" . $values['devicename'] . "'";
        }else{
            $sql = "UPDATE `nodes` SET deviceIpAddr = '" . $values['deviceIpAddr'] . "' WHERE devicename = '" . $values['devicename'] . "'";
        }
        $db2->query($sql);
        $db2->execute();
    }else{
        $sql = "insert into nodes(devicename,deviceos,deviceseries,status,lastpolled,model,nodeVersion,sys_contact,sys_location,market,switch_name,region,deviceIpAddr,deviceIpAddrsix)" . "values ('" . $values['devicename'] . "','" . $values['deviceos'] . "','" . $values['deviceseries'] . "',1,'" . $values['lastpolled'] . "','" . $values['model'] . "','" . $values['nodeVersion'] . "','" . $values['sys_contact'] . "','" . $values['sys_location'] . "','" . $values['market'] . "','" . $values['switch_name'] . "','" . $values['region'] . "','" . $values['deviceIpAddr'] . "','" . $values['deviceIpAddrsix'] . "')";
        $db2->query($sql);
        $db2->execute();
    }
}

/**
 *
 * @return unknown
 */
function get_managers()
{
    global $db2;
    $sql = "SELECT distinct(csr_site_tech_mgr_id),csr_site_tech_mgr_name FROM nodes ORDER BY csr_site_tech_mgr_name";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function get_csr_technames()
{
    global $db2;
    $sql = "SELECT distinct(csr_site_tech_id),csr_site_tech_name FROM nodes ORDER BY csr_site_tech_name";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $username
 * @return unknown
 */
function get_csr_site_tech_mgr_id($username)
{
    global $db2;
    $sql = "SELECT distinct(csr_site_tech_mgr_id),csr_site_tech_mgr_name FROM nodes where csr_site_tech_id = '" . $username . "' ORDER BY csr_site_tech_mgr_name";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $batchid
 * @return unknown
 */
function batch_accordion_details($batchid)
{
    global $db2;
    $sql = 'SELECT CONCAT(IFNULL(n.deviceIpAddr,""),"<br/>",IFNULL(n.deviceIpAddrsix,"")) as deviceIpAddr,n.systemname,n.devicename, bm.status, bm.comment  FROM nodes n JOIN batchmembers bm on bm.deviceid = n.id where bm.batchid = ' . $batchid;
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function generic_get_usrvars()
{
    global $db2;
    $sql = "SELECT usrvarid, usrvarname, usrvarval, deviceseries FROM import_usrvars ORDER BY usrvarid";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function generic_getall_usrvars()
{
    global $db2;
    $sql = "SELECT usrvarid, usrvarname, usrvarval, deviceseries FROM usrvars ORDER BY usrvarid";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

function getuservar($usrvarname, $username)
{
	global $db2;
    $sql = "SELECT * FROM usrvars where usrvarname like '".$usrvarname."' and username like '".$username."'";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
/**
*
*/
function exportUsrvars($username)
{
	global $db2;
    $sql = "SELECT usrvarid, usrvarname, usrvarval, deviceseries FROM import_usrvars where username like '" . $username . "' ORDER BY usrvarid";  
    $db2->query($sql);
	$resultset['result']=$db2->resultset();
	//$setRec1 = mysqli_query($db2, $sql);
	//echo '<pre>';print_r($resultset);
	//echo '<pre>';
	$columnHeader = '';  
	$columnHeader = "Sr NO" . "\t" . "User Variable Name" . "\t" . "Value" . "\t". "Device Series" . "\t";  
	  
	$setData = '';
	foreach($resultset as $result)
	{
		foreach($result as $rec)
		{
			$rowData = '';  
			foreach ($rec as $value) {  
				$value = '"' . $value . '"' . "\t";  
				$rowData .= $value;  
			}  
			$setData .= trim($rowData) . "\n";  
		}		
	}
	
	/* $conn = new mysqli('localhost', 'root', '');  
	mysqli_select_db($conn, 'oneems_all'); 
	//exportUsrvars($Usrvars);
	$setSql = "SELECT usrvarid, usrvarname, usrvarval, deviceseries FROM import_usrvars where username like '" . $username . "' ORDER BY usrvarid";  
	$setRec = mysqli_query($conn, $setSql);
	//echo '<pre>';print_r($setRec);exit;
	$columnHeader = '';  
	$columnHeader = "Sr NO" . "\t" . "User Variable Name" . "\t" . "Value" . "\t". "Device Series" . "\t";  
	  
	$setData = '';  
	  echo '<pre>';
	while ($rec = mysqli_fetch_row($setRec)) {  print_r($rec);
		$rowData = '';  
		foreach ($rec as $value) {  
			$value = '"' . $value . '"' . "\t";  
			$rowData .= $value;  
		}  
		$setData .= trim($rowData) . "\n";  
	}  exit; */
	$timestamp = time();
	$filename = 'Export_usrvars_' . $timestamp . '.xls';  
	  
	header("Content-type: application/octet-stream");  
	header("Content-Disposition: attachment; filename=\"$filename\"");
	header("Pragma: no-cache");  
	header("Expires: 0");  
	  
	echo ucwords($columnHeader) . "\n" . $setData . "\n";exit;
}

/**
 *
 * @return unknown
 */
function generic_get_userlevels()
{
    global $db2;
    $sql = "SELECT id,userlevel FROM userlevels ORDER BY id";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function generic_get_categories()
{
    global $db2;
    $sql = "SELECT id,categoryName FROM categories where status = 1 ORDER BY categoryName";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function generic_get_vendors()
{
    global $db2;
    $sql = "SELECT id,vendorName FROM vendors  where status = 1 ORDER BY vendorName";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function generic_get_user_levels()
{
    global $db2;
    $sql = "SELECT id,userlevel FROM userlevels";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function generic_get_users()
{
    global $db2;
    $sql = "SELECT * FROM users where status = 1 ORDER BY username";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function generic_get_site_ids()
{
    global $db2;
    $sql = "SELECT distinct(csr_site_id) FROM nodes ORDER BY csr_site_id";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function generic_get_csr_site_names()
{
    global $db2;
    $sql = "SELECT distinct(csr_site_name) FROM nodes ORDER BY csr_site_name";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function generic_get_csr_switch_names()
{
    global $db2;
    $sql = "SELECT distinct(switch_name) FROM nodes ORDER BY switch_name";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function generic_get_region()
{
    global $db2;
    $sql = "SELECT distinct(region) FROM nodes ORDER BY region";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function generic_get_market()
{
    global $db2;
    $sql = "SELECT distinct(market) FROM nodes ORDER BY market";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $region
 * @return unknown
 */
function generic_get_market_by_region($region)
{
    global $db2;
    $sql = "SELECT distinct(market) FROM nodes where region like '" . $region . "' ORDER BY market";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function generic_get_deviceseries()
{
    // Temporary commented dynamic deviceseries populate and hard coded
    /*
     * global $db2;
     * $sql = "SELECT distinct(deviceseries) FROM nodes where deviceseries != 'None' and deviceseries != '' ORDER BY deviceseries";
     * $db2->query($sql);
     * $resultset['result'] = $db2->resultset();
     */
    $resultset['result'] = array(
        array(
            'deviceseries' => 'ASR1000'
        ),
        array(
            'deviceseries' => 'ASR920'
        ),
        array(
            'deviceseries' => 'ASR900'
        ),
	 array(
            'deviceseries' => 'NCS5500'
        )
    );
    return $resultset;
}

/**
 *
 * @return unknown
 */
function generic_get_switch_name()
{
    global $db2;
    $sql = "SELECT distinct(switch_name) FROM nodes ORDER BY switch_name";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param string $region
 * @param string $market
 * @return unknown
 */
function generic_get_switch_name_by_region_market($region = '', $market = '')
{
    global $db2;
    
    $sql_condition = 'where 1';
    
    if (! empty($region))
        $sql_condition .= " AND region like '" . $region . "' ";
    
    if (! empty($market))
        $sql_condition .= " AND market like '" . $market . "' ";
    
    $sql = "SELECT distinct(switch_name) FROM nodes " . $sql_condition . " ORDER BY switch_name";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $market
 * @return unknown
 */
function generic_get_switch_name_by_market($market)
{
    global $db2;
    $sql = "SELECT distinct(switch_name) FROM nodes where REPLACE(market,' ','') = '" . str_replace(' ', '', $market) . "' ORDER BY switch_name";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/* nodeVersion or OSVersion */
/**
 *
 * @return unknown
 */
function generic_get_nodeVersion()
{
    global $db2;
    $sql = "SELECT distinct(nodeVersion) FROM nodes where nodeVersion != 'None' and nodeVersion != '' ORDER BY nodeVersion";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $username
 * @return unknown
 */
function generic_get_market_by_username($username)
{
    global $db2;
    $sql = "SELECT distinct(market) FROM nodes where csr_site_tech_id = '" . $username . "' ORDER BY market";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $query
 * @return unknown
 */
function generic_get_csr_site_tech_name($query)
{
    global $db2;
    $sql = "SELECT distinct(csr_site_tech_name) FROM nodes WHERE csr_site_tech_name LIKE '" . $query . "%'";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    foreach ($resultset['result'] as $key => $val) {
        $Result[] = $val["csr_site_tech_name"];
    }
    return json_encode($Result);
}

/**
 *
 * @param unknown $query
 * @return unknown
 */
function generic_get_usernames_ac($query)
{
    global $db2;
    $sql = "SELECT distinct(username) FROM users WHERE username LIKE '" . $query . "%'";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    foreach ($resultset['result'] as $key => $val) {
        $Result[] = $val["username"];
    }
    return json_encode($Result);
}

/**
 *
 * @param unknown $query
 * @return unknown
 */
function generic_get_usernames_ac_fn_ln_ro($query)
{
    global $db2;
    $sql = "SELECT u.fname, u.lname, ul.userlevel FROM users u, userlevels ul WHERE (u.fname LIKE '%" . $query . "%' OR u.lname LIKE '%" . $query . "%' OR ul.userlevel LIKE '%" . $query . "%') AND u.userlevel = ul.id";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    foreach ($resultset['result'] as $key => $val) {
        if($val["userlevel"] == 'CellTech User')
        $val["userlevel"] = str_replace('CellTech User','NA_Field_Assurance',$val["userlevel"]);
        if($val["userlevel"] == 'SwitchTech User')
        $val["userlevel"] = str_replace('SwitchTech User','NA_Systems_Assurance',$val["userlevel"]);
        
        $Result[] = $val["fname"] . ' ' . $val["lname"] . ' <' . $val["userlevel"] . '>';
    }
    return json_encode($Result);
}

/**
 *
 * @param unknown $region
 * @param unknown $market
 * @return unknown
 */
function get_csr_site_names($region, $market)
{
    global $db2;
    $sql = "SELECT distinct(csr_site_name) FROM nodes where region like '" . $region . "' AND market like '" . $market . "' ORDER BY csr_site_name";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    foreach ($resultset['result'] as $key => $val) {
        $Result[] = $val["csr_site_name"];
    }
    return json_encode($Result);
}

/**
 *
 * @param unknown $csr_tech_name
 * @return unknown
 */
function get_csr_tech_mgr_name_from_tech_name($csr_tech_name)
{
    global $db2;
    $db2->query("SELECT csr_site_tech_mgr_name, csr_site_tech_mgr_id, csr_site_tech_id  FROM nodes WHERE csr_site_tech_name='" . $csr_tech_name . "'");
    $resultset['result'] = $db2->resultset();
    foreach ($resultset['result'] as $key => $val) {
        $Result['csr_site_tech_mgr_id'] = $val['csr_site_tech_mgr_id'];
        $Result['csr_site_tech_mgr_name'] = $val["csr_site_tech_mgr_name"];
        $Result['csr_site_tech_id'] = $val["csr_site_tech_id"];
    }
    return json_encode($Result);
}

/**
 *
 * @param unknown $csr_tech_id
 * @return unknown
 */
function get_csr_tech_mgr_id_from_tech_id($csr_tech_id)
{
    global $db2;
    $db2->query("SELECT csr_site_tech_mgr_id FROM nodes WHERE csr_site_tech_id='" . $csr_tech_id . "'");
    $row = $db2->resultsetCols();
    return $row[0];
}

/**
 *
 * @param unknown $csr_site_name
 * @return unknown
 */
function get_csr_site_id_from_csr_site_name($csr_site_name)
{
    global $db2;
    $db2->query("SELECT csr_site_id FROM nodes WHERE csr_site_name='" . $csr_site_name . "'");
    $row = $db2->resultsetCols();
    return $row[0];
}

/**
 *
 * @param unknown $ip_address
 * @param unknown $process
 * @return string
 */
function process_missed_ip($ip_address, $process)
{
    global $db2;
    if ($process == 'OK' && ! empty($ip_address)) {
        $sql = "UPDATE `discoveryres` SET class = 'k' WHERE deviceIpAddr = '" . $ip_address . "'";
        $db2->query($sql);
        $db2->execute();
    } elseif ($process == 'Remove' && ! empty($ip_address)) {
        $sql = "UPDATE `discoveryres` SET class = 'd' WHERE deviceIpAddr = '" . $ip_address . "'";
        $db2->query($sql);
        $db2->execute();
        $sql = "DELETE FROM nodes WHERE deviceIpAddr = '" . $ip_address . "'";
        $db2->query($sql);
        $db2->execute();
    }
    return success;
}

/**
 *
 * @param unknown $trigger
 * @param unknown $path
 * @param array $allowed_ext
 * @param string $append
 * @return boolean|string
 */
function upload_file_to_disk($trigger, $path, $allowed_ext = array('jpg','jpeg','png','gif'), $append = '')
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST[$trigger]) && $_POST[$trigger] == 'Upload') {
        $name = $_FILES['file']['name'];
        $tmpName = $_FILES['file']['tmp_name'];
        $error = $_FILES['file']['error'];
        $size = $_FILES['file']['size'];
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        
        switch ($error) {
            case UPLOAD_ERR_OK:
                $valid = true;
                // validate file extensions
                if (! in_array($ext, $allowed_ext)) {
                    $valid = false;
                    $response = 'Invalid file extension.';
                }
                // validate file size
                if ($size / 1024 / 1024 > 2) {
                    $valid = false;
                    $response = 'File size is exceeding maximum allowed size.';
                }
                // upload file
                if ($valid) {
                    $targetPath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . $append . '_config.txt';
                    move_uploaded_file($tmpName, $targetPath);
                    return true;
                    exit();
                }
                break;
            case UPLOAD_ERR_INI_SIZE:
                $response = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
                break;
            case UPLOAD_ERR_PARTIAL:
                $response = 'The uploaded file was only partially uploaded.';
                break;
            case UPLOAD_ERR_NO_FILE:
                $response = 'No file was uploaded.';
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $response = 'Missing a temporary folder.';
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $response = 'Failed to write file to disk.';
                break;
            default:
                $response = 'Unknown error';
                break;
        }
        return $response;
    } else {
        $response = 'Required parameter is missing.';
        return $response;
    }
}

/**
 *
 * @param number $length
 * @return string
 */
function generateRandomString($length = 10)
{
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i ++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 *
 * @param unknown $userid
 * @param string $listname
 * @return number|unknown
 */
function get_device_list_from_backuprestore_datatable_export($userid, $listname = '')
{
    global $db2, $pages;

    $search = trim($_GET['search']) ? addslashes(trim($_GET['search'])) : null;
    $order_col = $_GET['column'];
    $order_dir = $_GET['dir'];
    
    $columns = array(
        'distinct(n.id)',
        'n.devicename',
        'n.csr_site_id',
        'n.csr_site_name',
        'n.region',
        'n.market',
        'n.deviceseries',
        'n.nodeVersion'
    );
    $sql_select = "SELECT " . implode(", ", $columns);
    
    $sql_condition = " FROM userdevices ud
       JOIN nodes n on ud.nodeid = n.id
       WHERE ud.userid = " . $userid;
    
    if ($listname != '') {
        $sql_condition .= " AND(ud.listname = '" . $listname . "')";
    }
    // die;
    
    if ($search) {
        $sql_condition .= " AND ( ";
        $sql_condition .= " n.devicename LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.csr_site_id  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.csr_site_name  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.market  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.deviceseries  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.nodeVersion  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.lastpolled  LIKE '%" . $search . "%'";
        $sql_condition .= " ) ";
    }
    $sql_order = "";
    if ($order_col != '') {
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != '') {
        $sql_order .= $order_dir != '' ? " $order_dir " : " asc ";
    }
    
    $sql = $sql_select . $sql_condition . $sql_order . $sql_limit;
    // echo '<br>';
    // echo $sql;
    
    $db2->query($sql);
    
    
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'];
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    } else {
        $resultset['data'] = array();
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] = 0;
    }
    return $resultset;
}
/**
 *
 * @param unknown $userid
 * @param string $listname
 * @return number|unknown
 */
function get_device_list_from_backuprestore_datatable($userid, $listname = '')
{
    global $db2, $pages;
    
    // print_r($_GET);
    $draw = $_GET['draw'];
    $start = isset($_GET['start']) ? $_GET['start'] : 0;
    $length = isset($_GET['length']) ? $_GET['length'] : 10;
    $search = trim($_GET['search']['value']) ? addslashes(trim($_GET['search']['value'])) : null;
    $order_col = $_GET['order'][0]['column'];
    $order_dir = $_GET['order'][0]['dir'];
    
    $columns = array(
            'distinct(n.id)',
            'n.devicename',
            'n.csr_site_id',
            'n.csr_site_name',
            'n.region',
            'n.market',
            'n.deviceseries',
            'n.nodeVersion'
    );
    $sql_count = "SELECT COUNT(distinct(n.id)) ";
    $sql_select = "SELECT " . implode(", ", $columns);
    
    $sql_condition = " FROM userdevices ud
       JOIN nodes n on ud.nodeid = n.id
       WHERE ud.userid = " . $userid;
    
    if ($listname != '') {
        $sql_condition .= " AND(ud.listname = '" . $listname . "')";
    }
    // die;
    
    if ($search) {
        $sql_condition .= " AND ( ";
        $sql_condition .= " n.devicename LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.csr_site_id  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.csr_site_name  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.market  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.deviceseries  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.nodeVersion  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.lastpolled  LIKE '%" . $search . "%'";
        $sql_condition .= " ) ";
    }
    $count_sql = $sql_count . $sql_condition;
    // echo $count_sql;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $total_rec = $row[0];
    
    $sql_order = "";
    if ($order_col != '') {
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != '') {
        $sql_order .= $order_dir != '' ? " $order_dir " : " asc ";
    }
    
    $sql_limit = " LIMIT $start, $length ";
    
    $sql = $sql_select . $sql_condition . $sql_order . $sql_limit;
    // echo '<br>';
    // echo $sql;
    
    $db2->query($sql);
    
    $resultset['draw'] = $draw;
    
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'];
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    } else {
        $resultset['data'] = array();
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] = 0;
    }
    return $resultset;
}


/**
 *
 * @param unknown $userid
 * @return unknown
 */
function get_celltechusers_list($userid)
{
    global $db2;
    $sql = "select distinct(listid), listname from userdevices where userid=" . $userid;
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset['result'];
}

/**
 *
 * @param unknown $userid
 * @return unknown
 */
function get_switchtechusers_list($userid)
{
    global $db2;
    $sql = "select distinct(listid), listname from userdevices where userid=" . $userid;
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset['result'];
}

/**
 *
 * @param unknown $batchid
 * @param unknown $deviceid
 * @param unknown $scriptname
 * @param unknown $deviceseries
 * @param unknown $deviceos
 * @param unknown $priority
 * @param unknown $refmop
 */
function update_dev_batch_bw($batchid_arr, $ipaddress_arr, $scriptname_arr, $deviceseries, $deviceos, $priority, $refmop)
{
    global $db2;
    $oc = 1;
    $date_op = date('Y-m-d H:i:s');
    $ipaddress = implode("','",$ipaddress_arr);
    echo $sql = "SELECT id, deviceIpAddr FROM nodes where deviceIpAddr in ('".$ipaddress."')";
    $db2->query($sql);
    $resultset = $db2->resultset();
    foreach ($resultset as $key => $val) {
        $nodes[$val['deviceIpAddr']] = $val['id'];
    }
    foreach ($ipaddress_arr as $key1 => $val1){
        $deviceid_arr[] = $nodes[$val1];
    }
    
    $i = 0;
    foreach ($batchid_arr as $key => $val){
        if(empty($deviceid_arr[$i])){
            $deviceid_arr[$i] = 0;
        }
        $dsql = 'INSERT INTO `batchmembers` (`batchid`, `deviceid`, `status`, `deviceIpAddr`, `comment`) VALUES';
        $dsql .= "('" . $val . "','" . $deviceid_arr[$i] . "','s','" . $ipaddress_arr[$i] . "','')";
        $db2->query($dsql);
        $db2->execute();
        
        $dsql = "INSERT INTO `batchmaster` (`batchid`, `batchstatus`, `batchscheddate`, `region`, `batchtype`, `priority`, `username`, `batchcreated`, `deviceseries`, `nodeVersion`, `scriptname`, `refmop`,`destinationpath`,`comment`, `scriptfilemame`)
        VALUES('" . $val . "','s','" . $date_op . "', '', 'se', '" . $priority . "','" . $_SESSION['username'] . "','" . $date_op . "','" . $_SESSION['batch_vars']['deviceseries'] . "','" . $_SESSION['batch_vars']['deviceos'] . "','" . $scriptname_arr[$i] . "','" . $refmop . "', '', '','" . $_SESSION['batch_vars']['scriptfilemame'] . "')";
        $db2->query($dsql);
        $db2->execute();
        $i++;
    }
    /*
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
        $dsql = "INSERT INTO `batchmaster` (`batchid`, `batchstatus`, `batchscheddate`, `region`, `batchtype`, `priority`, `username`, `batchcreated`, `deviceseries`, `nodeVersion`, `scriptname`, `refmop`,`destinationpath`,`comment`)
        VALUES('" . $batchid . "','s','" . $date_op . "', '', 'se', '" . $priority . "','" . $_SESSION['username'] . "','" . $date_op . "','" . $_SESSION['batch_vars']['deviceseries'] . "','" . $_SESSION['batch_vars']['deviceos'] . "','" . $scriptname . "','" . $refmop . "', '', '')";
        $db2->query($dsql);
        $db2->execute();
    }
    */
    
}


/**
 *
 * @param unknown $batchid
 * @param unknown $deviceid
 * @param unknown $scriptname
 * @param unknown $deviceseries
 * @param unknown $deviceos
 * @param unknown $priority
 * @param unknown $refmop
 */
function update_dev_batch($batchid, $deviceid, $scriptname, $deviceseries, $deviceos, $priority, $refmop)
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
        $dsql = "INSERT INTO `batchmaster` (`batchid`, `batchstatus`, `batchscheddate`, `region`, `batchtype`, `priority`, `username`, `batchcreated`, `deviceseries`, `nodeVersion`, `scriptname`, `refmop`,`destinationpath`,`comment`,`scriptfilemame`)
        VALUES('" . $batchid . "','s','" . $date_op . "', '', 'se', '" . $priority . "','" . $_SESSION['username'] . "','" . $date_op . "','" . $_SESSION['batch_vars']['deviceseries'] . "','" . $_SESSION['batch_vars']['deviceos'] . "','" . $scriptname . "','" . $refmop . "', '', '','" . $_SESSION['batch_vars']['scriptfilemame'] . "')";
        $db2->query($dsql);
        $db2->execute();
    }
}

/**
 *
 * @param unknown $username
 * @param unknown $eid
 * @param unknown $email
 * @param unknown $fname
 * @param unknown $lname
 * @param unknown $vzid
 * @return string
 */
function get_landing_page_sso($username, $eid, $email, $fname, $lname, $vzid)
{
    // echo 'inside the get_landing_page_sso function' . $username, $eid, $email, $fname, $lname, $vzid . '<br>';
    /*
     *
     * $userinfo = array('id'=>159,'username' => $username,'userlevel'=>1,'fname'=>$fname,'lname'=>$lname');
     * $userinfo['id'] = 159;
     * $userinfo['username'] = $username;
     * $userinfo['userlevel'] = 1;
     * $userinfo['fname'] = $fname;
     * $userinfo['lname'] = $lname;
     *
     * echo '<br>'."Username : $username, EID: $eid, EMAIL: $email, FIRSTNAME: $fname, LAST NAME :$lname,VZID: $vzid".'<br>';
     *
     * die;
     * if (strtolower($username) == 'mohilpa' || strtolower($username) == 'edward') { // fieldsite technician
     * $_SESSION['userlevel'] = "2" ;
     * } else {
     * $_SESSION['userlevel'] = "1" ;
     * };
     * if ($_SESSION['userlevel'] === "1") { // fieldsite technician
     * $userinfo = array('id' => 159,'username' => 'debarle','userlevel' =>'1','fname' => $fname, 'lname' => $lname);
     * } elseif ($_SESSION['userlevel'] === "2") {
     * $userinfo = array('id' => 503,'username' => 'swt_womaha','userlevel' =>'2','fname' => $fname, 'lname' => $lname);
     * };
     *
     */
    $_SESSION['userid'] = $userinfo['id'];
    $_SESSION['username'] = $userinfo['username'];
    $_SESSION['userlevel'] = $userinfo['userlevel'];
    $_SESSION['welcome_username'] = $userinfo['fname'] . ' ' . $userinfo['lname'];
    echo 'value of userlevel in session' . $_SESSION['userlevel'] . '<br>';
    if (! $_SESSION['userlevel']) {
        return 'index.php';
    } else {
        if (in_array($_SESSION['userlevel'], array(
            1,
            3,
            4
        ))) { // fieldsite technician
              // echo 'inside the cellsite tech url';
            $location_href = "cellsitetech-dashboard.php";
        }
        if (in_array($_SESSION['userlevel'], array(
            2,
            5,
            6,
            7,
            9,
            10    
        ))) {
            $location_href = "switchtech-dashboard.php";
        }
        if (in_array($_SESSION['userlevel'], array(
            8
        ))) {
            $location_href = "login-impersonate.php";
        }
        // echo '<br>'.'value of location href inside the function'.$location_href.'<br>';
        return $location_href;
    }
}

/**
 *
 * @param unknown $deviceid
 * @return unknown
 */
function load_backup_information($deviceid)
{
    global $db2;
    $sql = "select * from backup_information where deviceid=" . $deviceid;
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset['result'];
}

/**
 *
 * @param unknown $filename
 * @param string $alias
 * @return unknown
 */
function load_available_templates($filename, $alias = '')
{
    global $db2;
    $filename_arr = explode('_', $filename);
    if (count($filename_arr) > 0) {
        $condition = '';
        foreach ($filename_arr as $key => $val) :
            if ($condition == '' && isset($val)) {
                $condition .= "templname like '%" . $val . "%'";
            } elseif ($condition != '' && isset($val)) {
                $condition .= "AND templname like '%" . $val . "%'";
            }
        endforeach
        ;
    }
    
    if (! empty($alias)) {
        $condition .= "AND alias like '%" . $alias . "%'";
    }
    
    $sql = "SELECT distinct(templname) FROM configtemplate where $condition";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset['result'];
}

/**
 *
 * @param unknown $name
 * @return unknown
 */
function getUser($name)
{
    global $db2;
    // $sql = "SELECT id, p.name, p.description, p.price, p.created FROM items p WHERE p.name LIKE '%".$name."%' ORDER BY p.created DESC";
    $sql = "select id, username, password, userlevel,fname,lname,phone from users p WHERE p.username = '" . $name . "'";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset['result'];
}

// [username] => ssf [password] => k [usertype] => k [firstname] => k [lastname] => k [phoneno] => k [emailid] => k )
/**
 *
 * @param unknown $data
 * @return unknown
 */
function addUser($data)
{
    global $db2;
    $sql = "insert into users (username, password, userid, userlevel, email, fname, lname, phone ) values ('" . $data['username'] . "','" . md5($data['password']) . "','" . $data['username'] . "','" . $data['usertype'] . "','" . $data['emailid'] . "','" . $data['firstname'] . "','" . $data['lastname'] . "','" . $data['phoneno'] . "')";
    // $data = array("username" => $_POST['uname'],"password" => $_POST['passwd'],"usertype" => $_POST['usertype'],"firstname"=>$_POST['firstname'],"lastname" => $_POST['lname'],"phoneno" => $_POST['phoneno'],"emailid" => $_POST['emailid']);
    // $sql = "insert into users ( username, password, userid, userlevel, email, fname, lname, phone ) values ('".$data['username']."''".$data['password']."''"..$data['userid']."''".$data['userlevel']."''".$data['email']."''".$data['fname']."''".$data['lname']."''".$data['phoneno']."')";
    $db2->query($sql);
    $result = $db2->execute();
    
    // $resultset['result'] = $db2->resultset();
    // return $resultset['result'];
    return $result;
    // $data = json_decode($data);
    // echo $result;
    // print_r($data);
    // echo json_encode($sql);
}

/**
 *
 * @param unknown $data
 * @return unknown
 */
function deleteUser($data)
{
    global $db2;
    $sql = "delete from users where username = '" . $data['username'] . "'";
    $db2->query($sql);
    $result = $db2->execute();
    return $result;
}

/*
 * function getconfigtempldpdwntbl() {
 * global $db2;
 * $sql = "SELECT * FROM configtempldpdwntbl";
 * $db2->query($sql);
 * $resultset['result'] = $db2->resultset();
 * return $resultset;
 *
 * }
 */
/**
 *
 * @param unknown $table
 * @param string $order
 * @return unknown
 */
function getconfigtempldpdwntbl($table, $order = 'desc')
{
    global $db2;
    $sql = "SELECT * FROM " . $table . " order by `" . $order . "` asc";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function getconfigtemplscriptddwntbl()
{
    global $db2;
    $sql = "SELECT * FROM configtmpscriptddwntbl";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $deviceid
 * @return unknown
 */
function select_healthchk_info($deviceid)
{
    global $db2;
    $sql = "SELECT * FROM healthcheck where deviceid = $deviceid";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset[0];
}

/**
 *
 * @param unknown $deviceid
 * @return unknown
 */
function select_emshealthchk_info($deviceid)
{
    global $db2;
    $sql = "SELECT * FROM emshealthcheck where deviceid = $deviceid";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset[0];
}

/**
 *
 * @return unknown
 */
function config_get_templates()
{
    global $db2;
    $sql = "SELECT distinct templname FROM configtemplate order by templname asc";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $templname
 * @return unknown
 */
function check_templname_already_exist($templname)
{
    global $db2;
    $sql = "SELECT count(*) as cnt FROM configtemplate where templname = '" . $templname . "'";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $ipaddress
 * @return unknown
 */
function check_subnet_already_exist($ipaddress)
{
    global $db2;
    $sql = "SELECT count(*) as cnt FROM ipallocation where subnetmask = '" . $ipaddress . "'";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $templname
 */
function delete_templname_already_exist($templname)
{
    global $db2;
    $sql = "DELETE FROM configtemplate where templname = '" . $templname . "'";
    $db2->query($sql);
    $db2->execute();
}

/**
 *
 * @param unknown $templname
 * @return unknown
 */
function config_get_templates_from_templname($templname)
{
    global $db2;
    $sql = "SELECT distinct(elemid),elemvalue, editable,tabname FROM configtemplate where templname='$templname' order by elemid asc";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}
/**
 *
 * @param unknown $templname
 * @return unknown
 */
function config_get_templates_templname()
{
    global $db2;
    $sql = "SELECT distinct(templname) FROM configtemplate order by templname asc";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}
/**
 *
 * @param unknown $templname
 * @return unknown
 */
function get_tempate_uservars($tempname){
    global $db2;
    $sql = "SELECT elemvalue FROM configtemplate where templname = '".$tempname."' and tabname='usrvars'";
    $db2->query($sql);
    $resultset = $db2->resultset();
    $result = array();
    foreach ($resultset as $key => $val){
        $result[] = $val['elemvalue'];
    }
    return implode(',',$result);
}

/**
 *
 * @param unknown $deviceid
 * @param unknown $output
 * @param unknown $lastupdated
 */
function update_healthchk_info($deviceid, $output, $lastupdated)
{
    global $db2;
    unset($output['error']);
    unset($output['message']);
    if (count($output) > 0 && isset($output)) :
        $cols = array();
        foreach ($output as $key => $val) {
            $val = json_encode($val);
            $cols[] = "$key = '$val'";
        }
        $sql = "UPDATE  `healthcheck` SET " . implode(', ', $cols) . ",lastupdated='" . $lastupdated . "' WHERE deviceid = '" . $deviceid . "'";
        $db2->query($sql);
        $db2->execute();
    endif;
    
}

/**
 *
 * @param unknown $deviceid
 * @param unknown $output
 * @param unknown $lastupdated
 */
function ems_update_healthchk_info($deviceid, $output, $lastupdated)
{
    global $db2;
    $sql = "UPDATE  `emshealthcheck` SET  content='" . $output . "',lastupdated='" . $lastupdated . "' WHERE deviceid = '" . $deviceid . "'";
    $db2->query($sql);
    $db2->execute();
}

/**
 *
 * @param unknown $deviceid
 * @param unknown $output
 * @param unknown $lastupdated
 */
function insertorupdate_healthchk_info($deviceid, $output, $lastupdated)
{
    global $db2;
    if (count($output) > 0 && isset($output)) :
        $sql = "SELECT id FROM healthcheck WHERE deviceid = $deviceid";
        $db2->query($sql);
        $recordset = $db2->resultset();
        $cpuutilization = json_encode($output['cpuutilization']);
        $freememory = json_encode($output['freememory']);
        $buffers = json_encode($output['buffers']);
        $iosversion = json_encode($output['iosversion']);
        $bootstatement = json_encode($output['bootstatement']);
        $configregister = json_encode($output['configregister']);
        $environmental = json_encode($output['environmental']);
        $platform = json_encode($output['platform']);
        $bfdsession = json_encode($output['bfdsession']);
        $interfacestates = json_encode($output['interfacestates']);
        $interfacecounters = json_encode($output['interfacecounters']);
        $mplsinterfaces = json_encode($output['mplsinterfaces']);
        $mplsneighbors = json_encode($output['mplsneighbors']);
        $bgpvfourneighbors = json_encode($output['bgpvfourneighbors']);
        $bgpvsixneighbours = json_encode($output['bgpvsixneighbours']);
        $ran = json_encode($output['ran']);
        $bgpvsixroutes = json_encode($output['bgpvsixroutes']);
        $twothsndbyteping = json_encode($output['twothsndbyteping']);
        $vrfstates = json_encode($output['vrfstates']);
        $logentries = json_encode($output['logentries']);
        $xconnect = json_encode($output['xconnect']);
        $lightlevel = json_encode($output['lightlevel']);
        $bandwidth = json_encode($output['bandwidth']);
        $userid = 1;
        if ($recordset[0]['id'] == "") {
            $sql = "INSERT INTO `healthcheck` (`deviceid`, `cpuutilization`, `freememory`, `buffers`, `iosversion`, `bootstatement`, `configregister`, `environmental`, `platform`, `bfdsession`, `interfacestates`, `interfacecounters`, `mplsinterfaces`, `mplsneighbors`, `bgpvfourneighbors`, `bgpvsixneighbours`, `ran`, `bgpvsixroutes`, `twothsndbyteping`, `vrfstates`, `logentries`, `xconnect`, `lightlevel`, `bandwidth`, `userid`, `lastupdated` )
            VALUES($deviceid, '" . $cpuutilization . "','" . $freememory . "','" . $buffers . "','" . $iosversion . "','" . $bootstatement . "','" . $configregister . "',
            '" . $environmental . "','" . $platform . "','" . $bfdsession . "','" . $interfacestates . "','" . $interfacecounters . "','" . $mplsinterfaces . "',
            '" . $mplsneighbors . "','" . $bgpvfourneighbors . "','" . $bgpvsixneighbours . "','" . $ran . "','" . $bgpvsixroutes . "','" . $twothsndbyteping . "',
            '" . $vrfstates . "','" . $logentries . "','" . $xconnect . "','" . $lightlevel . "','" . $bandwidth . "',$userid,'" . $lastupdated . "')";
            $db2->query($sql);
            $db2->execute();
        } else {
            $sql = "UPDATE `healthcheck` SET cpuutilization='" . $cpuutilization . "', freememory='" . $freememory . "', buffers='" . $buffers . "', iosversion='" . $iosversion . "', bootstatement='" . $bootstatement . "', configregister='" . $configregister . "', environmental='" . $environmental . "',
            platform='" . $platform . "', bfdsession='" . $bfdsession . "', interfacestates='" . $interfacestates . "', interfacecounters='" . $interfacecounters . "', mplsinterfaces='" . $mplsinterfaces . "', mplsneighbors='" . $mplsneighbors . "', bgpvfourneighbors='" . $bgpvfourneighbors . "',
            bgpvsixneighbours='" . $bgpvsixneighbours . "', ran='" . $ran . "', bgpvsixroutes='" . $bgpvsixroutes . "', twothsndbyteping='" . $twothsndbyteping . "', vrfstates='" . $vrfstates . "', logentries='" . $logentries . "', xconnect='" . $xconnect . "',
            lightlevel='" . $lightlevel . "', bandwidth='" . $bandwidth . "', lastupdated='" . $lastupdated . "' WHERE deviceid = '" . $deviceid . "'";
            $db2->query($sql);
            $db2->execute();
        }
    endif;
    
}

/**
 *
 * @param unknown $region
 * @param unknown $subnetmask
 */
function delete_ipallocation_by_subnet($region, $subnetmask)
{
    global $db2;
    $sql = "DELETE FROM ipallocation WHERE region='$region' and subnetmask='$subnetmask'";
    $db2->query($sql);
    $db2->execute();
}

/**
 *
 * @param unknown $batchid
 */
function delete_batchid($batchid)
{
    global $db2;
    $sql = "UPDATE `batchmaster` SET batchstatus = 'd' WHERE batchid = '" . $batchid . "'";
    $db2->query($sql);
    $db2->execute();
    $sql = "UPDATE `batchmembers` SET status = 'd' WHERE batchid = '" . $batchid . "' and status != 'Success' and status != 'Completed'";
    $db2->query($sql);
    $db2->execute();
}

/**
 *
 * @param unknown $message
 * @param string $logfile
 * @return boolean[]|string[]|boolean[]
 */
function write_log($message, $logfile = '')
{
    if (isset($_SESSION['impusername']) && ! empty($_SESSION['impusername'])) {
        $message = $message . ', Impersonate Set, Admin User name:' . $_SESSION['impusername'];
    }
    
    // Determine log file
    // Filename of log to use when none is given to write_log
    $default_log = "/usr/apps/oneems/logs/oneemsdefault_" . date(m_d_Y) . ".log";
    $upload_log = "/usr/apps/oneems/logs/oneems_" . date(m_d_Y) . ".log";
    // $default_log = "O:\wamp\www\oneems\logs\oneemsdefault_" . date(m_d_Y) . ".log";
    // $upload_log = "O:\wamp\www\oneems\logs\oneems_" . date(m_d_Y) . ".log";
    // echo 'reach here inside the write_log function';
    
    if ($logfile == '') {
        // checking if the constant for the log file is defined
        if (isset($default_log)) {
            $logfile = $default_log;
        } // the constant is not defined and there is no log file given as input
        else {
            error_log('No log file defined!', 0);
            return array(
                status => false,
                message => 'No log file defined!'
            );
        }
    }
    
    // Get time of request
    if (($time = $_SERVER['REQUEST_TIME']) == '') {
        $time = time();
    }
    
    // Get IP address
    if (($remote_addr = $_SERVER['REMOTE_ADDR']) == '') {
        $remote_addr = "REMOTE_ADDR_UNKNOWN";
    }
    
    // Get requested script
    if (($request_uri = $_SERVER['REQUEST_URI']) == '') {
        $request_uri = "REQUEST_URI_UNKNOWN";
    }
    
    // Format the date and time
    $date = date("Y-m-d H:i:s", $time);
    
    // Append to the log file
    if ($fd = @fopen($logfile, "a")) {
        $result = fputcsv($fd, array(
            $date,
            $remote_addr,
            $request_uri,
            $message
        ), '|');
        fclose($fd);
        
        if ($result > 0)
            return array(
                status => true
            );
        else
            return array(
                status => false,
                message => 'Unable to write to ' . $logfile . '!'
            );
    } else {
        return array(
            status => false,
            message => 'Unable to open log ' . $logfile . '!'
        );
    }
}

/**
 *
 * @param unknown $userid
 * @param string $listname
 * @return number|unknown
 */
function get_batch_process_datatable($userid, $listname = '')
{
    global $db2, $pages;
    
    // print_r($_GET);
    $draw = $_GET['draw'];
    $start = isset($_GET['start']) ? $_GET['start'] : 0;
    $length = isset($_GET['length']) ? $_GET['length'] : 10;
    $search = trim($_GET['search']['value']) ? addslashes(trim($_GET['search']['value'])) : null;
    $order_col = $_GET['order'][0]['column'];
    $order_dir = $_GET['order'][0]['dir'];
    
    $columns = array(
        'distinct(n.id)',
        'n.deviceIpAddr',
        'n.devicename',
        'n.deviceseries',
        'n.market',
        'n.nodeVersion'
    );
    $sql_count = "SELECT COUNT(distinct(n.id)) ";
    $sql_select = "SELECT " . implode(", ", $columns);
    
    $sql_condition = " FROM userdevices ud
       JOIN nodes n on ud.nodeid = n.id
       WHERE ud.userid = " . $userid;
    
    if ($listname != '') {
        $sql_condition .= " AND(ud.listname = '" . $listname . "')";
    }
    
    if ($_SESSION['batch_vars']['deviceseries'] != '') {
        $sql_condition .= " AND(n.deviceseries = '" . $_SESSION['batch_vars']['deviceseries'] . "')";
    }
    
    if ($_SESSION['batch_vars']['deviceos'] != '') {
        $sql_condition .= " AND(n.nodeVersion = '" . $_SESSION['batch_vars']['deviceos'] . "')";
    }
    
    // die;
    
    if ($search) {
        $sql_condition .= " AND ( ";
        $sql_condition .= " n.deviceIpAddr LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.devicename  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.deviceseries  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.market  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.nodeVersion  LIKE '%" . $search . "%'";
        $sql_condition .= " ) ";
    }
    $count_sql = $sql_count . $sql_condition;
    // echo $count_sql;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $total_rec = $row[0];
    
    $sql_order = "";
    if ($order_col != '') {
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != '') {
        $sql_order .= $order_dir != '' ? " $order_dir " : " asc ";
    }
    
    $sql_limit = " LIMIT $start, $length ";
    
    $sql = $sql_select . $sql_condition . $sql_order . $sql_limit;
    // echo '<br>';
    // echo $sql;
    
    $db2->query($sql);
    
    $resultset['draw'] = $draw;
    
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'];
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    } else {
        $resultset['data'] = array();
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] = 0;
    }
    return $resultset;
}

/**
 *
 * @return number|unknown
 */
function get_devicebatch_list_from_devicebatch_datatable_export()
{
    global $db2, $pages;
    $search = trim($_GET['search']) ? addslashes(trim($_GET['search'])) : null;
    $order_col = $_GET['column'];
    $order_dir = $_GET['dir'];
    
    $columns = array(
            'distinct(bm.batchid)',
            'bm.batchid',
            'bm.scriptname',
            'bm.deviceseries',
            'bm.nodeVersion',
            'bm.batchcreated',
            'bm.batchstatus',
            'bm.scriptfilemame',
            
    );
    
    $sql_select = "SELECT " . implode(", ", $columns);
    /*
     * if ($_GET['batchtype'] == 'se') {
     * $sql_condition = " FROM batchmaster bm where bm.batchtype like 'se'";
     * } else {
     * $sql_condition = " FROM batchmaster bm where bm.batchtype like 'sd'";
     * }
     *
     */
    if ($_GET['batchtype'] == 'se') {
        $sql_condition = " FROM batchmaster bm where bm.batchtype like 'se'";
    } else if ($_GET['batchtype'] == 'sd') {
        $sql_condition = " FROM batchmaster bm where bm.batchtype like 'sd'";
    } else if ($_GET['batchtype'] == 'bo') {
        $sql_condition = " FROM batchmaster bm where bm.batchtype like 'bo'";
    } else if ($_GET['batchtype'] == 'rb') {
        $sql_condition = " FROM batchmaster bm where bm.batchtype like 'rb'";
    } else if ($_GET['batchtype'] == 'al') {
        $sql_condition = " FROM batchmaster bm where bm.batchtype like 'al'";
    }else if ($_GET['batchtype'] == 'cusal') {
        $sql_condition = " FROM batchmaster bm where bm.batchtype like 'cusal'";
    }else if ($_GET['batchtype'] == 'st') {
        $sql_condition = " FROM batchmaster bm where bm.batchtype like 'st'";
    }
    if ($search) {
        $sql_condition .= " AND ( ";
        $sql_condition .= " bm.batchid LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.scriptname  LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.deviceseries LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.nodeVersion  LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.batchcreated  LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.batchstatus  LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.scriptfilemame  LIKE '%" . $search . "%'";
        $sql_condition .= " ) ";
    }
    
    $sql_order = "";
    if ($order_col != '') {
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != '') {
        $sql_order .= $order_dir != '' ? " $order_dir " : " asc ";
    }
    
    $sql = $sql_select . $sql_condition . $sql_order;
    $db2->query($sql);
    
    $resultset['draw'] = $draw;
    
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['batchid'];
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    } else {
        $resultset['data'] = array();
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] = 0;
    }
    return $resultset;
}

/**
 *
 * @return number|unknown
 */
function get_devicebatch_list_from_devicebatch_datatable()
{
    global $db2, $pages;
    
    $draw = $_GET['draw'];
    $start = isset($_GET['start']) ? $_GET['start'] : 0;
    $length = isset($_GET['length']) ? $_GET['length'] : 10;
    $search = trim($_GET['search']['value']) ? addslashes(trim($_GET['search']['value'])) : null;
    $order_col = $_GET['order'][0]['column'];
    $order_dir = $_GET['order'][0]['dir'];
    
    $columns = array(
        'distinct(bm.batchid)',
        'bm.batchid',
        'bm.scriptname',
        'bm.deviceseries',
        'bm.nodeVersion',
        'bm.batchcreated',
        'bm.batchstatus',
        'bm.scriptfilemame',
            
    );
    $sql_count = "SELECT COUNT(distinct(bm.batchid)) ";
    $sql_select = "SELECT " . implode(", ", $columns);
    /*
     * if ($_GET['batchtype'] == 'se') {
     * $sql_condition = " FROM batchmaster bm where bm.batchtype like 'se'";
     * } else {
     * $sql_condition = " FROM batchmaster bm where bm.batchtype like 'sd'";
     * }
     *
     */
    if ($_GET['batchtype'] == 'se') {
        $sql_condition = " FROM batchmaster bm where bm.batchtype like 'se'";
    } else if ($_GET['batchtype'] == 'sd') {
        $sql_condition = " FROM batchmaster bm where bm.batchtype like 'sd'";
    } else if ($_GET['batchtype'] == 'bo') {
        $sql_condition = " FROM batchmaster bm where bm.batchtype like 'bo'";
    } else if ($_GET['batchtype'] == 'rb') {
        $sql_condition = " FROM batchmaster bm where bm.batchtype like 'rb'";
    } else if ($_GET['batchtype'] == 'al') {
        $sql_condition = " FROM batchmaster bm where bm.batchtype like 'al'";
    }else if ($_GET['batchtype'] == 'cusal') {
        $sql_condition = " FROM batchmaster bm where bm.batchtype like 'cusal'";
    }else if ($_GET['batchtype'] == 'st') {
        $sql_condition = " FROM batchmaster bm where bm.batchtype like 'st'";
    }
    if ($search) {
        $sql_condition .= " AND ( ";
        $sql_condition .= " bm.batchid LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.scriptname  LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.deviceseries LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.nodeVersion  LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.batchcreated  LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.batchstatus  LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.scriptfilemame  LIKE '%" . $search . "%'";
        $sql_condition .= " ) ";
    }
    $count_sql = $sql_count . $sql_condition;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $total_rec = $row[0];
    
    $sql_order = "";
    if ($order_col != '') {
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != '') {
        $sql_order .= $order_dir != '' ? " $order_dir " : " asc ";
    }
    
    $sql_limit = " LIMIT $start, $length ";
    
    $sql = $sql_select . $sql_condition . $sql_order . $sql_limit;
    $db2->query($sql);
    
    $resultset['draw'] = $draw;
    
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['batchid'];
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    } else {
        $resultset['data'] = array();
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] = 0;
    }
    return $resultset;
}

/**
 *
 * @param array $values
 * @return string
 */
function generate_site_breadcrumb($values = array())
{
    $output = '<nav class="breadcrumb real-crumb">';
    if (in_array($_SESSION['userlevel'], array(
        1,
        3,
        4
    ))) {
        $output .= '<a class="breadcrumb-item" href="cellsitetech-dashboard.php"><b>Home</b></a>';
    } elseif (in_array($_SESSION['userlevel'], array(
        2,
        5,
        6,
        7,
        9, 
        10    
    ))) {
        $output .= '<a class="breadcrumb-item" href="switchtech-dashboard.php">Home</a>';
    }
    foreach ($values as $key => $val) :
        $output .= '<span class="breadcrumb-item">' . $key . '</span>';
    endforeach
    ;
    $output .= '</nav>';
    return $output;
}

/**
 *
 * @param unknown $deviceid
 * @return unknown
 */
function load_node_vendor_id_from_deviceid($deviceid)
{
    global $db2;
    $sql = "SELECT vendorId FROM nodes where id = " . $deviceid;
    $db2->query($sql);
    $resultset = $db2->resultset();
    $resultset[0]['vendorId'] = empty($resultset[0]['vendorId']) ? 1 : $resultset[0]['vendorId'];
    return $resultset[0]['vendorId'];
}

/**
 *
 * @param unknown $batchid
 * @return unknown
 */
function batch_accordion_details_new($batchid)
{
    global $db2;
    $sql = 'SELECT CONCAT(IFNULL(n.deviceIpAddr,""),"<br/>",IFNULL(n.deviceIpAddrsix,"")) as deviceIpAddr,n.systemname,d.status  FROM nodes n JOIN batchmembers d on d.deviceid = n.id where d.batchid = ' . $batchid;
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function get_batch_details()
{
    global $db2;
    $sql = "SELECT d.id, d.batchid, d.deviceid, d.scriptname, d.deviceseries, d.deviceos, d.batchcreated, bm.batchstatus FROM batchmembers d JOIN batchmaster bm on bm.batchid = d.batchid ORDER BY d.deviceseries asc";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}

/*
 * @param (string) SQL Query
 * @return multidim array containing data array(array('column1'=>value2,'column2'=>value2...))
 *
 */
/**
 *
 * @param unknown $sql
 * @return unknown
 */
function getData($sql)
{
    global $db2;
    $db2->query($sql);
    $rows = $db2->resultset();
    $result = $rows;
    return $result;
}

/**
 *
 * @return NULL[]|unknown[]
 */
function get_swdelvry_process_datatable()
{
    define("MyTable", "nodes");
    /* IF Query comes from DataTables do the following */
    if (! empty($_POST)) {
        /* Useful $_POST Variables coming from the plugin */
        $draw = $_POST["draw"]; // counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables
        $orderByColumnIndex = $_POST['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        $orderBy = $_POST['columns'][$orderByColumnIndex]['data']; // Get name of the sorting column from its index
        $orderType = $_POST['order'][0]['dir']; // ASC or DESC
        $start = $_POST["start"]; // Paging first record indicator.
        $length = $_POST['length']; // Number of records that the table can display in the current draw
        /* END of POST variables */
        
        $recordsTotal = count(getData("SELECT id, deviceIpAddr, devicename, deviceseries, market, nodeVersion  FROM " . MyTable));
        
        /* SEARCH CASE : Filtered data */
        if (! empty($_POST['search']['value'])) {
            
            /* WHERE Clause for searching */
            for ($i = 1; $i < count($_POST['columns']); $i ++) {
                $column = $_POST['columns'][$i]['data']; // we get the name of each column using its index from POST request
                $where[] = "$column like '%" . $_POST['search']['value'] . "%'";
            }
            $where = "WHERE " . implode(" OR ", $where); // id like '%searchValue%' or name like '%searchValue%' ....
            /* End WHERE */
            
            $sql = sprintf("SELECT id, deviceIpAddr, devicename, deviceseries, market, nodeVersion FROM %s %s", MyTable, $where); // Search query without limit clause (No pagination)
            
            $recordsFiltered = count(getData($sql)); // Count of search result
            
            /* SQL Query for search with limit and orderBy clauses */
            $sql = sprintf("SELECT id, deviceIpAddr, devicename, deviceseries, market, nodeVersion FROM %s %s ORDER BY %s %s limit %d , %d ", MyTable, $where, $orderBy, $orderType, $start, $length);
            $data = getData($sql);
        } /* END SEARCH */
        else {
            $sql = sprintf("SELECT id, deviceIpAddr, devicename, deviceseries, market, nodeVersion FROM %s ORDER BY %s %s limit %d , %d ", MyTable, $orderBy, $orderType, $start, $length);
            $data = getData($sql);
            
            $recordsFiltered = $recordsTotal;
        }
        
        /* Response to client before JSON encoding */
        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $data
        );
        return $response;
        // echo json_encode($response);
    } else {
        echo "NO POST Query from DataTable";
    }
}

/**
 *
 * @param unknown $userid
 * @param string $listname
 * @param string $deviceseries
 * @param string $nodeVersion
 * @return number|unknown
 */
function swt_get_auditlog_batch_process_datatable($userid, $listname = '', $deviceseries = '')
{
    global $db2, $pages;
    
    // print_r($_GET);
    $draw = $_GET['draw'];
    $start = isset($_GET['start']) ? $_GET['start'] : 0;
    $length = isset($_GET['length']) ? $_GET['length'] : 10;
    $search = trim($_GET['search']['value']) ? addslashes(trim($_GET['search']['value'])) : null;
    $order_col = $_GET['order'][0]['column'];
    $order_dir = $_GET['order'][0]['dir'];
    
    $columns = array(
            'distinct(n.id)',
            'n.id',
            'n.deviceIpAddr',
            'n.devicename',
            'n.deviceseries',
            'n.market',
            'n.nodeVersion',
            'n.aurundate',
            'n.austatus',
            'n.austatus',
            'n.region',
    );
    $sql_count = "SELECT COUNT(distinct(n.id)) ";
    $sql_select = "SELECT " . implode(", ", $columns);
    
    $sql_condition = " FROM userdevices ud
       JOIN nodes n on ud.nodeid = n.id
       WHERE ud.userid = " . $userid;
    
    if ($listname != '') {
        $sql_condition .= " AND(ud.listname = '" . $listname . "')";
    }
    
    if ($deviceseries != '') {
        $sql_condition .= " AND(n.deviceseries = '" . $deviceseries . "')";
    }
    
    // die;
    
    if ($search) {
        $sql_condition .= " AND ( ";
        $sql_condition .= " n.deviceIpAddr LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.devicename  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.deviceseries  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.market  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.nodeVersion  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.aurundate  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.austatus  LIKE '%" . $search . "%'";
        $sql_condition .= " ) ";
    }
    $count_sql = $sql_count . $sql_condition;
    // echo $count_sql; die;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $total_rec = $row[0];
    
    $sql_order = "";
    if ($order_col != '') {
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != '') {
        $sql_order .= $order_dir != '' ? " $order_dir " : " asc ";
    }
    
    $sql_limit = " LIMIT $start, $length ";
    
    $sql = $sql_select . $sql_condition . $sql_order . $sql_limit;
    // echo '<br>';
    // echo $sql;
    
    $db2->query($sql);
    
    $resultset['draw'] = $draw;
    
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'];
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    } else {
        $resultset['data'] = array();
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] = 0;
    }
    return $resultset;
}


/**
 *
 * @param unknown $userid
 * @param string $listname
 * @param string $deviceseries
 * @param string $nodeVersion
 * @return number|unknown
 */
function swt_get_auditlog_batch_process_datatable_export($userid, $listname = '', $deviceseries = '')
{
    global $db2, $pages;
    
    // print_r($_GET);
    
    $search = trim($_GET['search']) ? addslashes(trim($_GET['search'])) : null;
    $order_col = $_GET['column'];
    $order_dir = $_GET['dir'];
    
    $columns = array(
            'distinct(n.id)',
            'n.id',
            'n.deviceIpAddr',
            'n.devicename',
            'n.deviceseries',
            'n.market',
            'n.nodeVersion',
            'n.aurundate',
            'n.austatus',
            'n.austatus',
            'n.region',
    );
    $sql_select = "SELECT " . implode(", ", $columns);
    
    $sql_condition = " FROM userdevices ud
       JOIN nodes n on ud.nodeid = n.id
       WHERE ud.userid = " . $userid;
    
    if ($listname != '') {
        $sql_condition .= " AND(ud.listname = '" . $listname . "')";
    }
    
    if ($deviceseries != '') {
        $sql_condition .= " AND(n.deviceseries = '" . $deviceseries . "')";
    }
    
    // die;
    
    if ($search) {
        $sql_condition .= " AND ( ";
        $sql_condition .= " n.deviceIpAddr LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.devicename  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.deviceseries  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.market  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.nodeVersion  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.aurundate  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.austatus  LIKE '%" . $search . "%'";
        $sql_condition .= " ) ";
    }
    
    
    $sql_order = "";
    if ($order_col != '') {
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != '') {
        $sql_order .= $order_dir != '' ? " $order_dir " : " asc ";
    }
    
    
    $sql = $sql_select . $sql_condition . $sql_order;
    // echo '<br>';
    // echo $sql;
    
    $db2->query($sql);
    
    $resultset['draw'] = $draw;
    
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'];
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    } else {
        $resultset['data'] = array();
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] = 0;
    }
    return $resultset;
}



/**
 *
 * @param unknown $userid
 * @param string $listname
 * @param string $deviceseries
 * @param string $nodeVersion
 * @return number|unknown
 */
function get_audithistory_datatable()
{
    global $db2, $pages;
    
    // print_r($_GET);
    $draw = $_GET['draw'];
    $start = isset($_GET['start']) ? $_GET['start'] : 0;
    $length = isset($_GET['length']) ? $_GET['length'] : 10;
    $search = trim($_GET['search']['value']) ? addslashes(trim($_GET['search']['value'])) : null;
    $order_col = $_GET['order'][0]['column'];
    $order_dir = $_GET['order'][0]['dir'];
    
    $columns = array(
            'ah.batchid',
            'ah.username',
            'ah.region',
            'ah.market',
            'ah.devicename',
            'ah.deviceIpAddr',
            'ah.deviceseries',
            'ah.filtercriteria',
            'ah.austatus',
            'ah.filename',
            'ah.createddate'
    );
    $sql_count = "SELECT COUNT(ah.batchid) ";
    $sql_select = "SELECT " . implode(", ", $columns);
    
    $sql_condition = " FROM audithistory ah";
    
    if ($search) {
        $sql_condition .= " where ( ";
        $sql_condition .= " ah.batchid LIKE '%" . $search . "%'";
        $sql_condition .= " OR ah.username  LIKE '%" . $search . "%'";
        $sql_condition .= " OR ah.region  LIKE '%" . $search . "%'";
        $sql_condition .= " OR ah.market  LIKE '%" . $search . "%'";
        $sql_condition .= " OR ah.devicename  LIKE '%" . $search . "%'";
        $sql_condition .= " OR ah.deviceIpAddr  LIKE '%" . $search . "%'";
        $sql_condition .= " OR ah.deviceseries  LIKE '%" . $search . "%'";
        $sql_condition .= " OR ah.filtercriteria  LIKE '%" . $search . "%'";
        $sql_condition .= " OR ah.austatus  LIKE '%" . $search . "%'";
        $sql_condition .= " OR ah.filename  LIKE '%" . $search . "%'";
        $sql_condition .= " OR ah.createddate  LIKE '%" . $search . "%'";
        $sql_condition .= " ) ";
    }
    $count_sql = $sql_count . $sql_condition;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $total_rec = $row[0];
    
    $sql_order = "";
    if ($order_col != '') {
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != '') {
        $sql_order .= $order_dir != '' ? " $order_dir " : " asc ";
    }
    
    $sql_limit = " LIMIT $start, $length ";
    
    $sql = $sql_select . $sql_condition . $sql_order . $sql_limit;
    
    $db2->query($sql);
    
    $resultset['draw'] = $draw;
    
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'];
            $source_file = '/usr/apps/oneems/config/bkup/'. strtolower($value['region']) . '/custaudit/'. $value['market'] . '/' . $value['batchid'] . '_' . $value['devicename'] . '.txt';
            if(file_exists($source_file)){
                $value['austatus_exist'] = $source_file;
            }else{
                $value['austatus_exist'] = 0;
            }
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    } else {
        $resultset['data'] = array();
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] = 0;
    }
    return $resultset;
}




/**
 *
 * @param unknown $userid
 * @param string $listname
 * @param string $deviceseries
 * @param string $nodeVersion
 * @return number|unknown
 */
function get_audithistory_datatable_export()
{
    global $db2, $pages;
    
    
    $search = trim($_GET['search']) ? addslashes(trim($_GET['search'])) : null;
    $order_col = $_GET['column'];
    $order_dir = $_GET['dir'];
    
    $columns = array(
            'ah.batchid',
            'ah.username',
            'ah.region',
            'ah.market',
            'ah.devicename',
            'ah.deviceIpAddr',
            'ah.deviceseries',
            'ah.filtercriteria',
            'ah.austatus',
            'ah.filename',
            'ah.createddate'
    );
    $sql_count = "SELECT COUNT(ah.batchid) ";
    $sql_select = "SELECT " . implode(", ", $columns);
    
    $sql_condition = " FROM audithistory ah";
    
    if ($search) {
        $sql_condition .= " where ( ";
        $sql_condition .= " ah.batchid LIKE '%" . $search . "%'";
        $sql_condition .= " OR ah.username  LIKE '%" . $search . "%'";
        $sql_condition .= " OR ah.region  LIKE '%" . $search . "%'";
        $sql_condition .= " OR ah.market  LIKE '%" . $search . "%'";
        $sql_condition .= " OR ah.devicename  LIKE '%" . $search . "%'";
        $sql_condition .= " OR ah.deviceIpAddr  LIKE '%" . $search . "%'";
        $sql_condition .= " OR ah.deviceseries  LIKE '%" . $search . "%'";
        $sql_condition .= " OR ah.filtercriteria  LIKE '%" . $search . "%'";
        $sql_condition .= " OR ah.austatus  LIKE '%" . $search . "%'";
        $sql_condition .= " OR ah.filename  LIKE '%" . $search . "%'";
        $sql_condition .= " OR ah.createddate  LIKE '%" . $search . "%'";
        $sql_condition .= " ) ";
    }
    
    $sql_order = "";
    if ($order_col != '') {
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != '') {
        $sql_order .= $order_dir != '' ? " $order_dir " : " asc ";
    }
    
    $sql = $sql_select . $sql_condition . $sql_order;
    
    $db2->query($sql);
    
    $resultset['draw'] = $draw;
    
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'];
            $source_file = '/usr/apps/oneems/config/bkup/'. strtolower($value['region']) . '/custaudit/'. $value['market'] . '/' . $value['batchid'] . '_' . $value['devicename'] . '.txt';
            if(file_exists($source_file)){
                $value['austatus_exist'] = $source_file;
            }else{
                $value['austatus_exist'] = 0;
            }
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    } else {
        $resultset['data'] = array();
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] = 0;
    }
    return $resultset;
}




/**
 *
 * @param unknown $userid
 * @param string $listname
 * @param string $deviceseries
 * @param string $nodeVersion
 * @return number|unknown
 */
function swt_get_batch_process_datatable($userid, $listname = '', $deviceseries = '')
{
    global $db2, $pages;
    
    // print_r($_GET);
    $draw = $_GET['draw'];
    $start = isset($_GET['start']) ? $_GET['start'] : 0;
    $length = isset($_GET['length']) ? $_GET['length'] : 10;
    $search = trim($_GET['search']['value']) ? addslashes(trim($_GET['search']['value'])) : null;
    $order_col = $_GET['order'][0]['column'];
    $order_dir = $_GET['order'][0]['dir'];
    
    $columns = array(
        'distinct(n.id)',
        'n.id',    
        //'n.deviceIpAddr',
        'CONCAT(IFNULL(n.deviceIpAddr,""),"<br/>",IFNULL(n.deviceIpAddrsix,"")) as deviceIpAddr',
        'n.devicename',
        'n.deviceseries',
        'n.market',
        'n.nodeVersion'
    );
    $sql_count = "SELECT COUNT(distinct(n.id)) ";
    $sql_select = "SELECT " . implode(", ", $columns);
    
    $sql_condition = " FROM userdevices ud
       JOIN nodes n on ud.nodeid = n.id
       WHERE ud.userid = " . $userid;
    
    if ($listname != '') {
        $sql_condition .= " AND(ud.listname = '" . $listname . "')";
    }
    
    if ($deviceseries != '') {
        $sql_condition .= " AND(n.deviceseries = '" . $deviceseries . "')";
    }
    
    // die;
    
    if ($search) {
        $sql_condition .= " AND ( ";
        $sql_condition .= " n.deviceIpAddr LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.devicename  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.deviceseries  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.market  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.nodeVersion  LIKE '%" . $search . "%'";
        $sql_condition .= " ) ";
    }
    $count_sql = $sql_count . $sql_condition;
    // echo $count_sql; die;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $total_rec = $row[0];
    
    $sql_order = "";
    if ($order_col != '') {
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != '') {
        $sql_order .= $order_dir != '' ? " $order_dir " : " asc ";
    }
    
    $sql_limit = " LIMIT $start, $length ";
    
    $sql = $sql_select . $sql_condition . $sql_order . $sql_limit;
    // echo '<br>';
    // echo $sql;
    
    $db2->query($sql);
    
    $resultset['draw'] = $draw;
    
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'];
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    } else {
        $resultset['data'] = array();
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] = 0;
    }
    return $resultset;
}

function multidevicehc_datatable($userid, $vendorId = '', $deviceseries = ''){
    
    global $db2, $pages;
    
    // print_r($_GET);
    $draw = $_GET['draw'];
    $start = isset($_GET['start']) ? $_GET['start'] : 0;
    $length = isset($_GET['length']) ? $_GET['length'] : 10;
    $search = trim($_GET['search']['value']) ? addslashes(trim($_GET['search']['value'])) : null;
    $order_col = $_GET['order'][0]['column'];
    $order_dir = $_GET['order'][0]['dir'];
    
    $columns = array(
            'distinct(n.id)',
            'n.id',
            'n.deviceIpAddr',
            'n.devicename',
            'n.deviceseries',
            'n.market',
            'n.nodeVersion'
    );
    $sql_count = "SELECT COUNT(distinct(n.id)) ";
    $sql_select = "SELECT " . implode(", ", $columns);
    
    $sql_condition = " FROM userdevices ud
       JOIN nodes n on ud.nodeid = n.id
       WHERE ud.userid = " . $userid;
    
    if ($vendorId != '') {
        $sql_condition .= " AND(n.vendorId = '" . $vendorId . "')";
    }
    
    if ($deviceseries != '') {
        $sql_condition .= " AND(n.deviceseries = '" . $deviceseries . "')";
    }
    
    // die;
    
    if ($search) {
        $sql_condition .= " AND ( ";
        $sql_condition .= " n.deviceIpAddr LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.devicename  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.deviceseries  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.market  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.nodeVersion  LIKE '%" . $search . "%'";
        $sql_condition .= " ) ";
    }
    $count_sql = $sql_count . $sql_condition;
    // echo $count_sql; die;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $total_rec = $row[0];
    
    $sql_order = "";
    if ($order_col != '') {
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != '') {
        $sql_order .= $order_dir != '' ? " $order_dir " : " asc ";
    }
    
    $sql_limit = " LIMIT $start, $length ";
    
    $sql = $sql_select . $sql_condition . $sql_order . $sql_limit;
    // echo '<br>';
    //echo $sql;
    //die;
    $db2->query($sql);
    
    $resultset['draw'] = $draw;
    
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'];
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    } else {
        $resultset['data'] = array();
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] = 0;
    }
    return $resultset;
    
}



/**
 *
 * @param unknown $userid
 * @param string $listname
 * @param string $deviceseries
 * @param string $nodeVersion
 * @return number|unknown
 */
function swt_get_batch_process_datatable_export($userid, $listname = '', $deviceseries = '')
{
    global $db2, $pages;
    
    $search = trim($_GET['search']) ? addslashes(trim($_GET['search'])) : null;
    $order_col = $_GET['column'];
    $order_dir = $_GET['dir'];
    
    $columns = array(
            'distinct(n.id)',
            'n.id',
            'n.deviceIpAddr',
            'n.devicename',
            'n.deviceseries',
            'n.market',
            'n.nodeVersion'
    );
    $sql_select = "SELECT " . implode(", ", $columns);
    
    $sql_condition = " FROM userdevices ud
       JOIN nodes n on ud.nodeid = n.id
       WHERE ud.userid = " . $userid;
    
    if ($listname != '') {
        $sql_condition .= " AND(ud.listname = '" . $listname . "')";
    }
    
    if ($deviceseries != '') {
        $sql_condition .= " AND(n.deviceseries = '" . $deviceseries . "')";
    }
    
    // die;
    
    if ($search) {
        $sql_condition .= " AND ( ";
        $sql_condition .= " n.deviceIpAddr LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.devicename  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.deviceseries  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.market  LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.nodeVersion  LIKE '%" . $search . "%'";
        $sql_condition .= " ) ";
    }
    
    $sql_order = "";
    if ($order_col != '') {
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != '') {
        $sql_order .= $order_dir != '' ? " $order_dir " : " asc ";
    }
    
    
    $sql = $sql_select . $sql_condition . $sql_order;
    // echo '<br>';
    // echo $sql;
    
    $db2->query($sql);
    
    $resultset['draw'] = $draw;
    
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'];
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    } else {
        $resultset['data'] = array();
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] = 0;
    }
    return $resultset;
}




/**
 *
 * @return unknown
 */
function swrepo_get_deviceseries()
{
    // Temporary commented dynamic deviceseries populate and hard coded
    /*
     * global $db2;
     * // $sql = "SELECT distinct(deviceseries) FROM deviceseries";
     * $sql = "SELECT distinct(deviceseries) FROM nodes where deviceseries != 'None' and deviceseries != ''";
     * $db2->query($sql);
     * $resultset = $db2->resultset();
     */
    $resultset = array(
        array(
            'deviceseries' => 'ASR1000'
        ),
        array(
            'deviceseries' => 'ASR920'
        ),
        array(
            'deviceseries' => 'ASR900'
        ),
        array(
            'deviceseries' => 'NCS540'
        ),
        array(
            'deviceseries' => 'NCS5500'
        )
    );
    return $resultset;
}

/**
 *
 * @return unknown
 */
function swrepo_get_osversion()
{
    global $db2;
    $sql = "SELECT distinct(osversion), osid FROM osversion";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function os_repository_vendor()
{
    global $db2;
    $sql = "SELECT distinct(vendorname) FROM osversion";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function os_repository_deviceseries()
{
    global $db2;
    // $sql = "SELECT distinct(deviceseries) FROM deviceseries";
    $sql = "SELECT distinct(deviceseries) FROM nodes where deviceseries != 'None' and deviceseries != ''";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function os_repository_patches()
{
    global $db2;
    $sql = "SELECT distinct(ospatch) FROM osversion";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function os_repository_minverreq()
{
    global $db2;
    $sql = "SELECT distinct(minverreq) FROM osversion";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function os_repository_versions()
{
    global $db2;
    $sql = "SELECT distinct(osversion) FROM osversion";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function os_repository_get_existing_filenames()
{
    global $db2;
    $filenames = array();
    $sql = "SELECT distinct(filename) FROM osrepository where status != 'd'";
    $db2->query($sql);
    $resultset = $db2->resultset();
    foreach ($resultset as $key => $val) :
        $filenames_arr = explode('|', $val['filename']);
        foreach ($filenames_arr as $key => $val) :
            $filenames[] = $val;
        endforeach
        ;
    endforeach
    ;
    return array_unique($filenames);
}

/**
 *
 * @return unknown
 */
function os_repository_get_records()
{
    global $db2;
    $filenames = array();
    $sql = "SELECT * FROM osrepository where status = 's'";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $query
 * @return unknown
 */
function get_os_ver_applydate($query)
{
    global $db2;
    $sql = "SELECT distinct(applydate) FROM osversion WHERE (applydate LIKE '%" . $query . "%')";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    foreach ($resultset['result'] as $key => $val) {
        $Result[] = $val["applydate"];
    }
    return json_encode($Result);
}

/**
 *
 * @param unknown $username
 * @param unknown $backup_occur
 * @param unknown $backup_day
 * @param unknown $backup_hours
 * @param unknown $backup_minutes
 * @param unknown $schedbackup_type
 * @param unknown $backup_timezone
 * @param unknown $backup_market
 */
function update_schedbackup_settings($username, $backup_occur, $backup_day, $backup_hours, $backup_minutes, $schedbackup_type, $backup_timezone, $backup_market)
{
    global $db2;
    $dsql = 'INSERT INTO `schedbackupsettings` (`username`,`occurence`, `day`, `hours`, `minutes`, `backuptype`,`timezone`, `market`) VALUES';
    $dsql .= "('" . $username . "','" . $backup_occur . "','" . $backup_day . "','" . $backup_hours . "','" . $backup_minutes . "','" . $schedbackup_type . "','" . $backup_timezone . "','" . $backup_market . "')";
    $db2->query($dsql);
    $db2->execute();
}

/**
 *
 * @return unknown
 */
function get_market_list_backup()
{
    global $db2;
    
    $sql_select = "SELECT market as market_name ";
    $sql_condition = " FROM nodes
                      where market != ''
                      GROUP BY market ";
    $sql = $sql_select . $sql_condition;
    $db2->query($sql);
    // echo $sql;
    $resultset = $db2->resultset();
    return $resultset;
}


/**
 *
 * @param unknown $sso_flag
 * @param unknown $username
 */
function update_login_api_rules($sso_flag, $username)
{
    global $db2, $APPCONFIG;
    if (in_array($_SESSION['userlevel'], array(
        1,
        3,
        4
    ))) {
        if($_SERVER['SERVER_NAME'] == 'localhost'){
          $output = @file_get_contents($APPCONFIG['login']['cellsitetechloginapi']);
        }else{
          $output = @file_get_contents($APPCONFIG['login']['cellsitetechloginapi'].'/site/devices/user/'.$username.'/csrinfo');
        }
        $resp_result_arr = json_decode($output, 1);
        $_SESSION['sel_switch_name'] = '';
        $swt_mswitch_arr = array();
        for ($i = 0; $i < count($resp_result_arr['site_devices']); $i ++) {
            if (count($resp_result_arr['site_devices'][$i]['csr_hostnames']) > 0) {
                foreach ($resp_result_arr['site_devices'][$i]['csr_hostnames'] as $key => $val) {
                    $_SESSION['sel_switch_name'] = ($_SESSION['sel_switch_name'] == '') ? $resp_result_arr['site_devices'][$i]['switch'] : $_SESSION['sel_switch_name'];
                    $records_to_update[] = array(
                        'devicename' => $val,
                        'csr_site_tech_name' => $resp_result_arr['site_devices'][$i]['techname'],
                        'switch_name' => $resp_result_arr['site_devices'][$i]['switch'],
                        'csr_site_id' => $resp_result_arr['site_devices'][$i]['siteid']
                    );
                    // Node table status 3 added for live API active
                    $sql = "UPDATE `nodes` SET csr_site_tech_name = '" . addslashes($resp_result_arr['site_devices'][$i]['techname']) . "', csr_site_name = '" . addslashes($resp_result_arr['site_devices'][$i]['name']) . "',switch_name ='" . addslashes($resp_result_arr['site_devices'][$i]['switch']) . "', csr_site_tech_id = '" . $_SESSION['username'] . "',csr_site_id ='" . $resp_result_arr['site_devices'][$i]['siteid'] . "', status=3 WHERE devicename = '" . $val . "'";
                    $db2->query($sql);
                    $db2->execute();
                    $devicename_arr[] = $val;
                    if (! in_array($resp_result_arr['site_devices'][$i]['switch'], $swt_mswitch_arr)) {
                        $swt_mswitch_arr[] = $resp_result_arr['site_devices'][$i]['switch'];
                    }
                }
            }
        }
        
        $sql = "update nodes set csr_site_tech_id = '' where devicename not in ('" . implode("','", $devicename_arr) . "') and csr_site_tech_id = '" . $_SESSION['username'] . "'";
        $db2->query($sql);
        $db2->execute();
        
        $sql = "DELETE FROM userdevices WHERE listname='0' and userid = " . $_SESSION['userid'];
        $db2->query($sql);
        $db2->execute();
        $sql = " SELECT * from nodes where status=3 and devicename in  ('" . implode("','", $devicename_arr) . "') and csr_site_tech_id = '" . $_SESSION['username'] . "'";
        $db2->query($sql);
        $resultset['result'] = $db2->resultset();
        
        $oc = 1;
        $dsql = 'INSERT INTO `userdevices` (`nodeid`, `userid`, `listid`, `listname`) VALUES';
        foreach ($resultset['result'] as $resultsetk => $resultsetv) {
            if (count($resultset['result']) == $oc) {
                $dsql .= "('" . $resultsetv['id'] . "'," . $_SESSION['userid'] . ",'0','0')";
            } else {
                $dsql .= "('" . $resultsetv['id'] . "'," . $_SESSION['userid'] . ",'0','0'),";
            }
            $oc ++;
        }
        if ($oc > 1) {
            $db2->query($dsql);
            $db2->execute();
        }
        
        /*
        if($zone_region == 'sg'){
			//$base_url = 'http://txsliopsa1v.nss.vzwnet.com:8080';
			$base_url = 'https://iop.vh.vzwnet.com:8080';
            $calloutzone = $base_url.'/user/' . $_SESSION['username'] . '/prefs/czone';
        }elseif($zone_region == 'pr'){
            $base_url = 'https://iop.vh.vzwnet.com:8080';
            $calloutzone = $base_url.'/user/' . $_SESSION['username'] . '/prefs/czone';
        }else{
            $base_url = 'http://njbboemsda1v/oneems';
            $calloutzone = $base_url.'/user/' . $_SESSION['username'] . '/prefs/czone';
        }
        // Zones API calls
        //ZONE flag temp comment
        //if ($_SESSION['zones'] == 0) {
        $output_callout_zone_list = @file_get_contents($calloutzone);
        $resp_zones_result_arr_callout_zone_list = json_decode($output_callout_zone_list, 1);
        
        //Deleting when API not in REACH    
        if(count($resp_zones_result_arr_callout_zone_list) == 0){
            $sql = "DELETE FROM userdevices WHERE userid='" . $_SESSION['userid'] . "' AND listtype = 'cz'";
            $db2->query($sql);
            $db2->execute();
        }
        $resp_zones_result_arr = array();
        if (isset($resp_zones_result_arr_callout_zone_list['user']['prefs']['calloutzones'])) {
            foreach ($resp_zones_result_arr_callout_zone_list['user']['prefs']['calloutzones'] as $key => $val) {
                $valrc = rawurlencode($val);
                if($zone_region == 'sg' || $zone_region == 'pr'){
                    $output_zones = @file_get_contents($base_url.'/site/devices/czone/' . $valrc . '/csrinfo');
                }else{
                    $output_zones = @file_get_contents($base_url.'/site/devices/czone/' . $_SESSION['username'] . '_callout_zone_' . $valrc . '_list.php');
                }
                $output_zones_resp_result_arr = json_decode($output_zones, 1);
                $resp_zones_result_arr[$val] = $output_zones_resp_result_arr['site_devices'];
            }
        }
        
        
        foreach ($resp_zones_result_arr as $key => $val) {
            foreach ($val as $dkey => $dval) {
                if (count($dval['csr_hostnames']) > 0) {
                    foreach ($dval['csr_hostnames'] as $hkey => $hval) {
                        $_SESSION['sel_switch_name'] = ($_SESSION['sel_switch_name'] == '') ? $dval['switch'] : $_SESSION['sel_switch_name'];
                        //ZONE flag temp comment
                        //if ($_SESSION['zones'] == 0) {
                            $records_to_update_zones[$key][] = array(
                                'devicename' => $hval,
                                'csr_site_tech_name' => $dval['techname'],
                                'switch_name' => $dval['switch'],
                                'csr_site_id' => $dval['siteid']
                            );
                            
                            $sql = "UPDATE `nodes` SET csr_site_tech_name = '" . $dval['techname'] . "', switch_name ='" . $dval['switch'] . "', csr_site_tech_id = '" . $_SESSION['username'] . "',csr_site_id ='" . $dval['siteid'] . "', status=3 WHERE devicename = '" . $hval . "'";
                            $db2->query($sql);
                            $db2->execute();
                            
                            $devicename_arr[] = $hval;
                        //}
                        if (! in_array($dval['switch'], $swt_mswitch_arr)) {
                            $swt_mswitch_arr[] = $dval['switch'];
                        }
                    }
                }
            }
        }
        
        
        
        
        
        //ZONE flag temp comment
        //if (isset($devicename_arr) && $_SESSION['zones'] == 0) {
        if (isset($devicename_arr)) {
            $sql = "SELECT id, devicename from nodes where devicename in ('" . implode("','", $devicename_arr) . "')";
            $db2->query($sql);
            $resultset = $db2->resultset();
            
            foreach ($resultset as $key => $val) {
                $device_info[$val['devicename']] = $val['id'];
            }

            $sql = "DELETE FROM userdevices WHERE userid='" . $_SESSION['userid'] . "' AND listtype = 'cz'";
            $db2->query($sql);
            $db2->execute();
            
            $oc = 1;
            $dsql = 'INSERT INTO `userdevices` (`nodeid`, `userid`, `listid`, `listname`, `listtype`) VALUES';
            
            $current_list_id = 0;
            foreach ($records_to_update_zones as $key => $val) {
                if($current_list_id == 0){
                    $listid[$key] = get_user_mylist_id_by_name($key);
                    if(empty($listid[$key])){
                        $sql = "SELECT  max(listid) + 1  as listidmaxval FROM userdevices WHERE listid <> 0 ";
                        $db2->query($sql);
                        $recordset = $db2->resultset();
                        $listid[$key] = $recordset[0]['listidmaxval'];
                        $current_list_id = $recordset[0]['listidmaxval'];
                    }
                }else{
                    $listid[$key] = $current_list_id+1;
                }
                
                foreach ($val as $keyd => $vald) {
                    $device_info[$vald['devicename']] = empty($device_info[$vald['devicename']]) ? 0 : $device_info[$vald['devicename']];
                    if (! empty($device_info[$vald['devicename']])) {
                        $dsql .= "('" . $device_info[$vald['devicename']] . "'," . $_SESSION['userid'] . ",'" . $listid[$key] . "','" . $key . "','cz'),";
                        $oc ++;
                    }
                }
            }
            if ($oc > 1) {
                $dsql = substr_replace($dsql, '', - 1);
                $db2->query($dsql);
                $db2->execute();
                
                //ZONE flag temp comment
                //$sql = "update users set zones = 1 WHERE username = '" . $_SESSION['username'] . "'";
                //$_SESSION['zones'] = 1;
                //$db2->query($sql);
                //$db2->execute();
            }
        }
     //}
       */
        
        $resp_zones_result_arr_callout_zone_list['user']['prefs']['calloutzones'] = get_user_zone_list($_SESSION['username']);
        
        // Deleting when API not in REACH
        if (count($resp_zones_result_arr_callout_zone_list) == 0) {
            $sql = "DELETE FROM userdevices WHERE userid='" . $_SESSION['userid'] ."' AND listtype = 'cz'";
            $db2->query($sql);
            $db2->execute();
        }
        $calloutzone_arr = $devicename_arr = $devicename_arr_top = array();
        if (isset($resp_zones_result_arr_callout_zone_list['user']['prefs']['calloutzones'])) {
            foreach ($resp_zones_result_arr_callout_zone_list['user']['prefs']['calloutzones'] as $key => $val) {
                $calloutzone_arr[] = $val;
            }
        }
        if (count($calloutzone_arr) > 0) {
            foreach ($calloutzone_arr as $czkey => $czval) {
                $devicename_arr_top = get_user_zone_deviceslist($czval);
                foreach ($devicename_arr_top as $key => $val) {
                    $devicename_arr[] = $val['csr_hostnames'];
                    $records_to_update_zones[$czval][] = array('devicename' => $val['csr_hostnames']);
                }
            }
        }
        
        // if (isset($devicename_arr) && $_SESSION['zones'] == 0) {
        if (isset($devicename_arr)) {
            $sql = "SELECT id, devicename from nodes where devicename in ('" .implode("','", $devicename_arr) . "')";
            $db2->query($sql);
            $resultset = $db2->resultset();
            
            foreach ($resultset as $key => $val) {
                $device_info[$val['devicename']] = $val['id'];
            }
            
            $sql = "DELETE FROM userdevices WHERE userid='" . $_SESSION['userid'] ."' AND listtype = 'cz'";
            $db2->query($sql);
            $db2->execute();
            
            $oc = 1;
            $dsql = 'INSERT INTO `userdevices` (`nodeid`, `userid`, `listid`, `listname`, `listtype`) VALUES';

            $sql = "SELECT  max(listid) + 1  as listidmaxval FROM userdevices WHERE userid = ".$_SESSION['userid']." and  listid <> 0 ";
            $db2->query($sql);
            $recordset = $db2->resultset();
            $listid = $recordset[0]['listidmaxval'];
            
            foreach ($records_to_update_zones as $key => $val) {
                $listid++;
                foreach ($val as $keyd => $vald) {
                    $device_info[$vald['devicename']] = empty($device_info[$vald['devicename']]) ? 0 : $device_info[$vald['devicename']];
                    if (! empty($device_info[$vald['devicename']])) {
                        $dsql .= "('" . $device_info[$vald['devicename']] . "'," .$_SESSION['userid'] . ",'" . $listid . "','" . $key ."','cz'),";
                        $oc ++;
                    }
                }
            }
            if ($oc > 1) {
                $dsql = substr_replace($dsql, '', - 1);
                $db2->query($dsql);
                $db2->execute();
            }
        }
        
        
        
        $_SESSION['swt_mswitch_arr'] = $swt_mswitch_arr;
    } elseif (in_array($_SESSION['userlevel'], array(
            5,
    ))) {
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
    }elseif (in_array($_SESSION['userlevel'], array(
        2,
        5,
        6,
        7,
        9,
        10    
    ))) {
        if($_SERVER['SERVER_NAME'] == 'localhost'){
            $output = @file_get_contents($APPCONFIG['login']['switchtechloginapi']);
        }else{
          
         /*	 Usin old API 
    		$token_url = $APPCONFIG['login']['switchtechloginapi'].'/token?grant_type=password&username=kesavsr&password=Verizon4';
            $ch = curl_init($token_url);
            $header = array(
                    'Accept: application/json',
                    'Content-Type: application/x-www-form-urlencoded',
                    'Authorization: Basic ZkFqd1lDSnpvdDRSX2FnRUw2ZGFta0dmUjNzYTptTlJwQnBfblVkOVJzdXVMM0YzZmNCWUpRdjhh'
            );
            // pass header variable in curl method
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = array(
                    "grant_type" => 'password',
                    'username' => 'kesavsr',
                    'password' => 'Verizon4'
            );
            $data_string = urlencode(json_encode($data));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, array(
                    $data_string
            ));
            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Curl error: ' . curl_error($ch);
                die();
            }
            $result = json_decode($response, 1);
            $opts = array(
                    'http' => array(
                            'method' => "GET",
                            'header' => "Accept-language: en\r\n" .
                            "Authorization: Bearer " . $result['access_token'] . "\r\n"
                    )
            );
            $context = stream_context_create($opts);
            $output = file_get_contents($APPCONFIG['login']['switchtechloginapi'].'/iop/switchbytech/v1.0.0/switch/tech/' . $username, false, $context);
		*/
		$output = @file_get_contents($APPCONFIG['login']['switchtechloginapi'].'/switch/tech/'.$username);   // New API;
        }
        $resp_result_arr = json_decode($output, 1);
        $_SESSION['sel_switch_name'] = '';
        $_SESSION['sel_region'] = array();
        for ($i = 0; $i < count($resp_result_arr['switches']); $i ++) {
            $_SESSION['sel_switch_name'] = ($_SESSION['sel_switch_name'] == '') ? $resp_result_arr['switches'][$i]['switch_name'] : $_SESSION['sel_switch_name'];
            if(!in_array($resp_result_arr['switches'][$i]['region'], $_SESSION['sel_region'])){
                $_SESSION['sel_region'][] = $resp_result_arr['switches'][$i]['region'];
            }
            // Node table status 3 added for live API active
            $sql = "UPDATE `nodes` SET status=3, swt_tech_id = '" . $_SESSION['username'] . "' WHERE switch_name = '" . $resp_result_arr['switches'][$i]['switch_name'] . "'";
            $db2->query($sql);
            $db2->execute();
            $swt_mswitch_arr[] = $resp_result_arr['switches'][$i]['switch_name'];
        }
        $_SESSION['swt_mswitch_arr'] = $swt_mswitch_arr;
        
        /* Updating user devices table based on switch from API */
        foreach ($swt_mswitch_arr as $key => $val) {
            $sql = "DELETE FROM userdevices WHERE listname='" . $val . "'";
            $db2->query($sql);
            $db2->execute();
            $sql = " SELECT * from nodes where status=3 and switch_name = '" . $val . "'";
            $db2->query($sql);
            $resultset['result'] = $db2->resultset();
            $sql = "SELECT  max(listid) + 1  as listidmaxval FROM userdevices WHERE listid <> 0 ";
            $db2->query($sql);
            $recordset = $db2->resultset();
            $listid = $recordset[0]['listidmaxval'];
            $oc = 1;
            $dsql = 'INSERT INTO `userdevices` (`nodeid`, `userid`, `listid`, `listname`) VALUES';
            foreach ($resultset['result'] as $resultsetk => $resultsetv) {
                if (count($resultset['result']) == $oc) {
                    $dsql .= "('" . $resultsetv['id'] . "'," . $_SESSION['userid'] . ",'" . $listid . "','" . $resultsetv['switch_name'] . "')";
                } else {
                    $dsql .= "('" . $resultsetv['id'] . "'," . $_SESSION['userid'] . ",'" . $listid . "','" . $resultsetv['switch_name'] . "'),";
                }
                $oc ++;
            }
            if ($oc > 1) {
                $db2->query($dsql);
                $db2->execute();
            }
        }
        
        if (in_array($_SESSION['userlevel'], array(
                10
        ))) {
            $sql = "DELETE FROM userdevices WHERE listname='MITG Devices' and userid=".$_SESSION['userid'];
            $db2->query($sql);
            $db2->execute();
            $sql = " SELECT * from nodes where deviceseries = 'ASR5K'";
            $db2->query($sql);
            $resultset['result'] = $db2->resultset();
            $sql = "SELECT  max(listid) + 1  as listidmaxval FROM userdevices WHERE listid <> 0 ";
            $db2->query($sql);
            $recordset = $db2->resultset();
            $listid = $recordset[0]['listidmaxval'];
            $oc = 1;
            $dsql = 'INSERT INTO `userdevices` (`nodeid`, `userid`, `listid`, `listname`) VALUES';
            foreach ($resultset['result'] as $resultsetk => $resultsetv) {
                if (count($resultset['result']) == $oc) {
                    $dsql .= "('" . $resultsetv['id'] . "'," . $_SESSION['userid'] . ",'" . $listid . "','MITG Devices')";
                } else {
                    $dsql .= "('" . $resultsetv['id'] . "'," . $_SESSION['userid'] . ",'" . $listid . "','MITG Devices'),";
                }
                $oc ++;
            }
            if ($oc > 1) {
                $db2->query($dsql);
                $db2->execute();
            }
        }
    }
    //Test data add
    $sql = "DELETE FROM userdevices WHERE listname='Test data' and userid = " . $_SESSION['userid'];
    $db2->query($sql);
    $db2->execute();
    $default_devicename = $APPCONFIG['default_list']['devicenames'];
    $default_devicename_arr = explode(',', $default_devicename);
    if(count($default_devicename_arr)>0){
        $default_devicenames = implode("','",$default_devicename_arr);
        $sql = "SELECT * from nodes where devicename in  ('" . $default_devicenames . "')";
        $db2->query($sql);
        $resultset['result'] = $db2->resultset();
        if(count($resultset['result']) > 0){
            $sql = "SELECT  max(listid) + 1  as listidmaxval FROM userdevices WHERE listid <> 0 ";
            $db2->query($sql);
            $recordset = $db2->resultset();
            $listid = $recordset[0]['listidmaxval'];
            
            
            $oc = 1;
            $dsql = 'INSERT INTO `userdevices` (`nodeid`, `userid`, `listid`, `listname`) VALUES';
            foreach ($resultset['result'] as $resultsetk => $resultsetv) {
                if (count($resultset['result']) == $oc) {
                    $dsql .= "('" . $resultsetv['id'] . "'," . $_SESSION['userid'] . ",'" . $listid . "','Test data')";
                } else {
                    $dsql .= "('" . $resultsetv['id'] . "'," . $_SESSION['userid'] . ",'" . $listid . "','Test data'),";
                }
                $oc ++;
            }
            if ($oc > 1) {
                $db2->query($dsql);
                $db2->execute();
            }
        }
    }
}

/**
 *
 * @return unknown
 */
function get_market_list_manualdisc($ipaddress)
{
    global $db2;
    
    $sql_select = "SELECT market as market_name ";
    $sql_condition = " FROM nodes
                      where market != '' and deviceIpAddr = '".$ipaddress."'
                      GROUP BY market ";
    $sql = $sql_select . $sql_condition;
    $db2->query($sql);
    // echo $sql;
    $resultset = $db2->resultset();
    
    if(count($resultset) == 0){
        $sql_select = "SELECT market as market_name ";
        $sql_condition = " FROM nodes
                      where market != ''
                      GROUP BY market ";
        $sql = $sql_select . $sql_condition;
        $db2->query($sql);
        // echo $sql;
        $resultset = $db2->resultset();
    }
    
    return $resultset;
}

/**
 *
 * @return unknown
 */
function configtemplate_elemvalue($posttabname, $field, $switch_name = '')
{
    global $db2;
    // $_SESSION['ct_switch_name'] = 'switch_name5';
    /*
     * if(isset($switch_name) && $switch_name!= '' && $posttabname == 'switchvars'){
     * $whr = " where switch_name like '".$switch_name."' ";
     * }
     */
    
    $sql = "SELECT distinct(" . $field . ") FROM " . $posttabname . $whr . " order by " . $field;
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function configtemplate_elemvalue_pos_script($posttabname, $field, $value)
{
    global $db2;
    
    $sql = "SELECT distinct(" . $field . ")," . $value . "  FROM " . $posttabname . $whr . " order by " . $field;
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function configtemplate_elemvalue_pos_script_market($posttabname, $field, $value, $switch_name)
{
    global $db2;
    $sql = "SELECT GROUP_CONCAT(DISTINCT(CONCAT('''', (market), '''' ))) as market FROM `nodes` WHERE switch_name like '".$switch_name."'";
    $db2->query($sql);
    $resultset = $db2->resultset();
    if(isset($resultset[0]['market']) && !empty($resultset[0]['market'])){
        $whr = " where market in (".$resultset[0]['market'].")";
        $sql = "SELECT distinct(" . $field . ")," . $value . "  FROM " . $posttabname . $whr . " order by " . $field;
        $db2->query($sql);
        $resultset = $db2->resultset();
        return $resultset;
    }
}



/**
 *
 * @return unknown
 */
function golden_modification_configtemplate_elemvalue_pos_script($posttabname, $field, $value)
{
    global $db2;
    
    $sql = "SELECT distinct(" . $field . ")," . $value . ", deviceseries  FROM " . $posttabname . $whr . " order by deviceseries";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}

/**
 *
 * @return unknown
 */
function configtemplate_elemvalue_pos_script_switch_name($switch_name)
{
    global $db2;
    
    $sql = "SELECT * FROM switchvars where switch_name = '" . $switch_name . "' order by switch_name,swvarname";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}
/**
 *
 * @return unknown
 */
function configtemplate_devicename_prefix_by_switch_name($switch_name)
{
    global $db2;
    
    $sql = "SELECT * FROM switchvars where switch_name = '" . $switch_name . "' and swvarname = 'devicename_prefix'";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset[0]['swvarval'];
}

/**
 *
 * @return unknown
 */
function configtemplate_switches_from_switchvars()
{
    global $db2;
    $sql = "SELECT distinct(switch_name) FROM switchvars order by switch_name";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}

function insert_uservars($values)
{
    global $db2;
    $values_arr = array(
        'usrvarname' => $_POST['usrvarname'],
        'usrvarval' => $_POST['usrvarval'],
        'deviceseries' => $_POST['deviceseries'],
        'templname' => $_POST['templname']
    );
    // $sql = "insert into nodes(devicename,deviceos,deviceseries,status,lastpolled,model,nodeVersion,sys_contact,sys_location,market)" . "values ('" . $values['devicename'] . "','" . $values['deviceos'] . "','" . $valus['deviceseries'] . "',1,'" . $values['lastpolled'] . "','" . $values['model'] . "','" . $values['nodeVersion'] . "','" . $values['sys_contact'] . "','" . $values['sys_location'] . "','" . $values['market'] . "')";
    $sql = "insert into usrvars(usrvarname,usrvarval,deviceseries,templname)" . "values ('" . $values['usrvarname'] . "','" . $values['usrvarval'] . "','" . $values['deviceseries'] . "','" . $values['templname'] . "')";
    $db2->query($sql);
    $db2->execute();
}
;

function valid_admin_usr_by_password($password)
{
    $userinfo = get_user_info($_SESSION['username'], $password);
    if (! $userinfo) {
        return false;
    } else {
        return true;
    }
}

function loaddeviceidfromdeviceip($deviceip)
{
    global $db2;
    $sql = "SELECT * FROM nodes where deviceIpAddr = '" . $deviceip . "' OR deviceIpAddrsix  = '" . $deviceip . "'";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset[0];
}

function loaddeviceidfromdevicename($devicename)
{
    global $db2;
    $sql = "SELECT * FROM nodes where devicename = '" . $devicename . "'";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset[0];
}


function get_user_mylist_id_by_name($listname)
{
    global $db2;
    
    $sql = "SELECT ud.listname  FROM userdevices ud WHERE ud.listname = '". $listname."' limit 0,1 ";
    $db2->query($sql);
    
    $resultset = $db2->resultset();
    if (isset($resultset[0]['listid'])) {
        return ($resultset[0]['listid']);
    } else {
        return;
    }
}

function get_user_zone_list($username){
    global $db2;
    $sql = "SELECT * FROM userzones  where username = '".$username."'";
    $db2->query($sql);
    $resultset = $db2->resultset();
    
    foreach ($resultset as $key => $val){
        $output_callout_zone_list[] = $val['calloutzone'];
    }
    return $output_callout_zone_list;
}

function get_user_zone_deviceslist($calloutzones){
    global $db2;
    $sql = "SELECT * FROM userzones_devices  where calloutzone in ('".$calloutzones."')";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $ipaddress
 * @return unknown
 */
function get_switchvars_ips($switch_name)
{
    global $db2;
    //$sql = "SELECT swvarname, swvarval,switch_name FROM switchvars where (swvarname = 'Asr9k-1 Loopback0 IP' OR swvarname = 'Asr9k-2 Loopback10 IP') AND switch_name = '".$switch_name."' order by swvarname";
	$sql = "SELECT swvarname, swvarval,switch_name FROM switchvars where (swvarname = 'Asr9k-1 Loopback10 IP' OR swvarname = 'Asr9k-2 Loopback10 IP') AND switch_name = '".$switch_name."' order by swvarname";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}

/**
 *
 * @param unknown $ipaddress
 * @return unknown
 */
function get_device_ids_from_ip_address($ipaddress = array())
{
    $ipaddress = implode("','",$ipaddress);
    global $db2;
    $sql = "SELECT id, deviceIpAddr FROM nodes where deviceIpAddr in ('".$ipaddress."')";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}
/**
 *
 * @param unknown $ipaddress
 * @return unknown
 */
function get_device_name_from_ip_address($ipaddress)
{
    global $db2;
    $sql = "SELECT devicename FROM nodes where deviceIpAddrsix = '".$ipaddress."'";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}
/**
 *
 * @param unknown $ipaddress
 * @return unknown
 */

function generate_option_button_for_configs_sw_inventory($tablename, $column, $varname, $deviceseries){
    $varnameid = str_replace(' ', '-', $varname);
    $output = '<label class="control-label" for="'.$varname.'">'.$varname.'</label>';
    if($deviceseries != 'Bandwidth'){
        $output .= '<select id="'.$varnameid.'" class="form-control '.$varnameid.'" name="'.$varname.'" data-rule-required="true">';
        $output .= '<option value="">-- Select -- </option>';
        $output .= '</select>';
    }else{
        $output .= '<input type="'.$varname.'"
									name="'.$varname.'"
									class="form-control '.$varnameid.'"
									id="'.$varnameid.'"
									value=""
									placeholder="">';
    }
    return $output;
    /*
    global $db2;
    $options_arr = array();
    $varname_lower = strtolower($varname);
    if(strpos($varname_lower, 'odd') !== false){
        $type = 'D%-01';
    }else{
        $type = 'D%-02';
    }
    $sql = "SELECT distinct(".$column."), devicename FROM ".$tablename." where ".$column." like 'TenGigabitEthernet0/0/%' and devicename like '".$type."' and  NOT interface LIKE '%.%' and ".$column." != '' and ".$column." != 'None'  order by ".$column;
    $db2->query($sql);
    $resultset = $db2->resultset();
    $output = '<label class="control-label" for="'.$varname.'">'.$varname.'</label>';
    $output .= '<select id="'.$varname.'" class="form-control" name="'.$varname.'" data-rule-required="true">';
    foreach ($resultset as $key => $val){
        if(!in_array($val[$column], $options_arr)){
            $output .= '<option value="'.$val[$column].'">'.$val[$column].'</option>';
            $options_arr[] = $val[$column];
        }
    }
    $output .= '</select>';
    return $output;
    */
}
function generate_option_button_for_configs_telco_interface($switchname, $type, $script_type, $device_name){
    global $db2;
    if($script_type != 'BW-Upgrade'){
        $options_arr = array();
        $swvarname = ($type == 'even') ? 'Asr9k-2  Hostname':'Asr9k-1 Hostname';
        $sql = "select switch_name,swvarname,swvarval from switchvars where switch_name = '".$switchname."' and swvarname = '".$swvarname."'";
        $db2->query($sql);
        $resultset = $db2->resultset();
        $output = '<option value="">-- Select -- </option>';
        if(isset($resultset[0]['swvarval'])){
            $devicename = $resultset[0]['swvarval'];
            /*
            if($script_type != 'BW-Upgrade'){
                $sql = "SELECT distinct(interface), devicename FROM software_inventory where interface like 'TenGigE%' and devicename like '".$devicename."' and NOT interface LIKE '%.%' and interface != '' and interface != 'None' order by interface";
            }else{
                $sql = "select interface,description from software_inventory where devicename = '".$devicename."' and description like '".$device_name."%'";
            }*/
            $sql = "SELECT distinct(interface), devicename FROM software_inventory where interface like 'TenGigE%' and devicename like '".$devicename."' and NOT interface LIKE '%.%' and interface != '' and interface != 'None' order by interface";
            $db2->query($sql);
            $resultset = $db2->resultset();
            foreach ($resultset as $key => $val){
                if(!in_array($val[$column], $options_arr)){
                    $output .= '<option value="'.$val['interface'].'">'.$val['interface'].'</option>';
                }
            }
        }
        }else{
            $tabcolname = ($type == 'even') ? 'telcointerfaceeven':'telcointerfaceodd';
            $sql = "SELECT distinct(".$tabcolname.") as interface, devicename FROM swinventoryinterface where devicename = '".$device_name."' and ".$tabcolname." != '' and ".$tabcolname." != 'None' order by ".$tabcolname;
            $db2->query($sql);
            $resultset = $db2->resultset();
            
            $output = $resultset[0]['interface'];
            /*
            foreach ($resultset as $key => $val){
                if(!in_array($val[$column], $options_arr)){
                    $output .= '<option value="'.$val['interface'].'">'.$val['interface'].'</option>';
                }
            }*/
            
        }
    
    return $output;
}
    



/**
 *
 * @param unknown $ipaddress
 * @return unknown
 */

function generate_option_button_for_configs_sw_inventory_vlan($tablename, $column, $varname){
    $varnameid = str_replace('(', '', str_replace(')', '', str_replace(' ', '-', $varname)));
    $output = '<label class="control-label" for="'.$varname.'">'.$varname.'</label>';
    $output .= '<select id="'.$varnameid.'" class="form-control '.$varnameid.'" name="'.$varname.'" data-rule-required="true">';
    $output .= '<option value="">-- Select -- </option>';
    $output .= '</select>';
    return $output;
    /*
    global $db2;
    $varname_lower = strtolower($varname);
    if(strpos($varname_lower, 'odd') !== false){
        $type = 'D%-01';
    }else{
        $type = 'D%-02';
    }
    $sql = "SELECT max(".$column.") as maximum FROM ".$tablename." where devicename like '".$type."'";
    $db2->query($sql);
    $resultset = $db2->resultset();
    
    $maximum = $resultset[0]['maximum'] + 2;
    
    $output = '<label class="control-label" for="'.$varname.'">'.$varname.'</label>
									<input type="'.$varname.'"
									name="'.$varname.'"
									class="form-control"
									id="'.$varname.'"
									value="'.$maximum.'"
									placeholder="">';
    return $output;
    */
}

function generate_option_button_for_configs_vlan($switchname, $type){
    global $db2;
    $options_arr = array();
    $swvarname = ($type == 'even') ? 'Asr9k-2  Hostname':'Asr9k-1 Hostname';
    $sql = "select switch_name,swvarname,swvarval from switchvars where switch_name = '".$switchname."' and swvarname = '".$swvarname."'";
    $db2->query($sql);
    $resultset = $db2->resultset();
    $output = '<option value="">-- Select -- </option>';
    if(isset($resultset[0]['swvarval'])){
        $devicename = $resultset[0]['swvarval'];
        $sql = "SELECT max(vlan) + 2 as maximum FROM software_inventory where devicename like '".$devicename."' and vlan < 4000";
        $db2->query($sql);
        $resultset = $db2->resultset();
        $start = $resultset[0]['maximum'];
        $end = $resultset[0]['maximum'] + 20;
        for($i=$start; $i<$end;$i=$i+2){
            $output .= '<option value="'.$i.'">'.$i.'</option>';
        }
    }
    return $output;
}

/**
 *
 * @param unknown $ipaddress
 * @return unknown
 */
function generate_option_button_for_configs_marketvars($tablename, $column, $varname){
    global $db2;
    $options_arr = array();
	$sql = "SELECT distinct(".$column.") ".$addcolumn." FROM ".$tablename." where ".$column." != '' and ".$column." != 'None'"." and mvarname = 'BGP Password'"."  order by ".$column;
    $db2->query($sql);
    $resultset = $db2->resultset();

    /*
    $output = '<label class="control-label" for="'.$varname.'">'.$varname.'</label>';
    $output .= '<select id="'.$varname.'" class="form-control" name="'.$varname.'" data-rule-required="true">';
    foreach ($resultset as $key => $val){
        if(!in_array($val[$column], $options_arr)){
            $output .= '<option value="'.$val[$column].'">'.$val[$column].'</option>';
            $options_arr[] = $val[$column];
        }
    }
    $output .= '</select>';
    */
    $output = '<label class="control-label" for="'.$varname.'">'.$varname.'</label>
									<input type="'.$varname.'"
									name="'.$varname.'"
									class="form-control"
									id="'.str_replace(' ','-',$varname).'"
									value="'.$resultset[0][$column].'"
									placeholder="">';
    return $output;
}


/**
 *
 * @param unknown $ipaddress
 * @return unknown
 */
function generate_option_button_for_configs_marketvars_timezone($tablename, $column, $varname){
    global $db2;
    $options_arr = array();
    //$sql = "SELECT distinct(".$column.") ".$addcolumn." FROM ".$tablename." where ".$column." != '' and ".$column." != 'None'  order by ".$column;
//	if ($varname == )
		$sql = "SELECT distinct(".$column.") ".$addcolumn." FROM ".$tablename." where ".$column." != '' and ".$column." != 'None'"." and mvarname = 'Time Zone'"."  order by ".$column;
 //   else if ($varname == )
	//	$sql = "SELECT distinct(".$column.") ".$addcolumn." FROM ".$tablename." where ".$column." != '' and ".$column." != 'None'  order by ".$column;
	//echo $sql;	
    $db2->query($sql);
    $resultset = $db2->resultset();
    $varname_lower = strtolower($varname);
    $output = '<label class="control-label" for="'.$varname.'">'.$varname.'</label>';
    $output .= '<select id="'.$varname.'" class="form-control" name="'.$varname.'" data-rule-required="true">';
    foreach ($resultset as $key => $val){
        if(!in_array($val[$column], $options_arr)){
            $output .= '<option value="'.$val[$column].'">'.$val[$column].'</option>';
            $options_arr[] = $val[$column];
        }
    }
    $output .= '</select>';
    return $output;
}


/**
 *
 * @param unknown $ipaddress
 * @return unknown
 */

function generate_option_button_for_configs($tablename, $column, $varname){
    global $db2;
    $options_arr = array();
    $sql = "SELECT distinct(".$column.") ".$addcolumn." FROM ".$tablename." where ".$column." != '' and ".$column." != 'None'  order by ".$column;
    $db2->query($sql);	
    $resultset = $db2->resultset();
    $varname_lower = strtolower($varname);
    $output = '<label class="control-label" for="'.$varname.'">'.$varname.'</label>';
    $output .= '<select id="'.$varname.'" class="form-control" name="'.$varname.'" data-rule-required="true">';
    foreach ($resultset as $key => $val){
        $devicename_lower = strtolower($val['devicename']);
        if(strpos($varname_lower, 'asr') !== false && ((strpos($varname_lower, 'even') !== false) || (strpos($varname_lower, 'odd') !== false))){
            if(strpos($varname_lower, 'asr') !== false && strpos($varname_lower, 'even') !== false && strpos($devicename_lower, 'asr') !== false &&  strpos($devicename_lower, '-02') !== false){
                if(!in_array($val[$column], $options_arr)){
                    $output .= '<option value="'.$val[$column].'">'.$val[$column].'</option>';
                    $options_arr[] = $val[$column];
                }
            }elseif(strpos($varname_lower, 'asr') !== false && strpos($varname_lower, 'odd') !== false  && strpos($devicename_lower, 'asr') !== false &&  strpos($devicename_lower, '-01')  !== false ){
                if(!in_array($val[$column], $options_arr)){
                    $output .= '<option value="'.$val[$column].'">'.$val[$column].'</option>';
                    $options_arr[] = $val[$column];
                }
            }
        }else{
            if(!in_array($val[$column], $options_arr)){
                $output .= '<option value="'.$val[$column].'">'.$val[$column].'</option>';
                $options_arr[] = $val[$column];
            }
        }
    }
    $output .= '</select>';
    return $output;
}

function generate_option_button_for_configs_enable($tablename, $column, $varname){
    global $db2;
    $options_arr = array();
    //$sql = "SELECT distinct(".$column.") ".$addcolumn." FROM ".$tablename." where ".$column." != '' and ".$column." != 'None'  order by ".$column;
	$sql = "SELECT distinct(".$column.") ".$addcolumn." FROM ".$tablename." where ".$column." != '' and ".$column." != 'None'"." and mvarname = 'Enable Secret'"."  order by ".$column;
    $db2->query($sql);	
    $resultset = $db2->resultset();
    
    $output = '<label class="control-label" for="'.$varname.'">'.$varname.'</label>
									<input type="'.$varname.'"
									name="'.$varname.'"
									class="form-control"
									id="'.str_replace(' ','-',$varname).'"
									value="'.$resultset[0][$column].'"
									placeholder="">';
    
    
    /*
    $varname_lower = strtolower($varname);
    $output = '<label class="control-label" for="'.$varname.'">'.$varname.'</label>';
    $output .= '<select id="'.$varname.'" class="form-control" name="'.$varname.'" data-rule-required="true">';
    foreach ($resultset as $key => $val){
        $devicename_lower = strtolower($val['devicename']);
        if(strpos($varname_lower, 'asr') !== false && ((strpos($varname_lower, 'even') !== false) || (strpos($varname_lower, 'odd') !== false))){
            if(strpos($varname_lower, 'asr') !== false && strpos($varname_lower, 'even') !== false && strpos($devicename_lower, 'asr') !== false &&  strpos($devicename_lower, '-02') !== false){
                if(!in_array($val[$column], $options_arr)){
                    $output .= '<option value="'.$val[$column].'">'.$val[$column].'</option>';
                    $options_arr[] = $val[$column];
                }
            }elseif(strpos($varname_lower, 'asr') !== false && strpos($varname_lower, 'odd') !== false  && strpos($devicename_lower, 'asr') !== false &&  strpos($devicename_lower, '-01')  !== false ){
                if(!in_array($val[$column], $options_arr)){
                    $output .= '<option value="'.$val[$column].'">'.$val[$column].'</option>';
                    $options_arr[] = $val[$column];
                }
            }
        }else{
            if(!in_array($val[$column], $options_arr)){
                $output .= '<option value="'.$val[$column].'">'.$val[$column].'</option>';
                $options_arr[] = $val[$column];
            }
        }
    }
    $output .= '</select>';
    */
    return $output;
}

function generate_option_button_for_configs_enable_usrvar($tablename, $column, $varname){
    global $db2;
    $options_arr = array();
    //$sql = "SELECT distinct(".$column.") ".$addcolumn." FROM ".$tablename." where ".$column." != '' and ".$column." != 'None'  order by ".$column;
	$sql = "SELECT distinct(".$column.") ".$addcolumn." FROM ".$tablename." where ".$column." != '' and ".$column." != 'None'"." and usrvarname = 'Enable Secret'"."  order by ".$column;
    $db2->query($sql);	
    $resultset = $db2->resultset();
    
    $output = '<label class="control-label" for="'.$varname.'">'.$varname.'</label>
									<input type="'.$varname.'"
									name="'.$varname.'"
									class="form-control"
									id="'.str_replace(' ','-',$varname).'"
									value="'.$resultset[0][$column].'"
									placeholder="">';
									
	return $output;
}

function generate_option_button_for_configs_defaultbox_type($usrvarname, $deviceseries){
    $uservarsreq = ($deviceseries != 'Bandwidth') ? 'uservarsreq' : '';
    $output = '<label class="control-label" for="'.$usrvarname.'">'.$usrvarname.'</label>
									<input type="'.$usrvarname.'"
									name="'.$usrvarname.'"
									class="form-control '.$uservarsreq.'"
									id="'.str_replace(' ','-',$usrvarname).'"
									value=""
									placeholder="">';
    return $output;
}

function generate_option_button_for_configs_defaultbox_type_usrvars($usrvarname, $deviceseries, $usrvarval){
    $uservarsreq = ($deviceseries != 'Bandwidth') ? 'uservarsreq' : '';
    $output = '<label class="control-label" for="'.$usrvarname.'">'.$usrvarname.'</label>
									<input type="'.$usrvarname.'"
									name="'.$usrvarname.'"
									class="form-control '.$uservarsreq.'"
									id="'.str_replace(' ','-',$usrvarname).'"
									value="'.$usrvarval.'"
									placeholder="">';
    return $output;
}

function generate_option_button_for_configs_static_type($usrvarname){
    if($usrvarname == 'MTU'){
        $option_arr = array(1970 => '1970', 4350 => '4350' );
    }else{
        $option_arr = array(6 => 'BW Type - 6', 8 => 'BW Type - 8' );
    }
    $output = '<label class="control-label" for="'.$usrvarname.'">'.$usrvarname.'</label>
										<select id="'.$usrvarname.'" class="form-control" name="'.$usrvarname.'" data-rule-required="true">';
    foreach ($option_arr as $key => $val){
        $output .= '<option value="'.$key.'">'.$val.'</option>';
    }
    $output .= '</select>';
    return $output;
}

// Inventory db queries
function get_inventory_region_list()
{
    global $db2;
    $sql = "select distinct(region) from switch_map order by region";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
function get_inventory_market_list($region)
{
    global $db2;
    $sql = "select distinct(market) from switch_map where region = '".$region."' order by market";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
function get_market_from_node_by_switch_name($switch){
    global $db2;
    $sql = "select market from nodes where switch_name like '".$switch."' limit 0,1";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
function get_market_timezone_from_marketvars($market){
    global $db2;
    $sql = "SELECT distinct(mvarval) FROM marketvars where market != '' and market != 'None' and market='".$market."' and mvarname = 'Time Zone' limit 0,1";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
function get_bandwidth_mbpsvalues($bwid){
    global $db2;
    $sql = "SELECT bwid, bwmbps, bwkbps, bwshpavg, bwbps FROM bandwidth where bwid = ".$bwid;
    $db2->query($sql);
    $resultset = $db2->resultset();
    if(!empty($resultset)){
        $resultset = array_shift($resultset);
    }    
    return $resultset;
}
function generatescript_str_preprocess($str, $bmbps){
    foreach ($bmbps as $key => $val){
        if(strpos($str, $key)!== false ){
            $str = str_replace($key, '<span title="'.$key.'" class="bwbits">'.$val.'</span>', $str) .'||'. str_replace($key, $val, $str);
        }
    }
    return $str;
}

function load_audittab_content(){
    global $db2;
    $sql = "SELECT auhisid, batchid, devicename, deviceIpAddr, deviceseries, austatus FROM audithistory where austatus = 'Fail'";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}

function load_tab_content($type){
    global $db2;
    if($type == 'ipcase1' || $type == 'ipcase2'){
        $sql = "SELECT CONCAT(deviceIpAddr, ', ', deviceIpAddrsix) AS ipaddress, count(*) as cnt FROM nodes  where deviceIpAddr != 'None' GROUP BY ipaddress HAVING cnt > 1";
        $db2->query($sql);
        $resultset = $db2->resultset();
        
        $ipv4 = $ipv6 = array();
        foreach ($resultset as $key=>$val){
            if(isset($val['ipaddress'])){
                $ipaddress_arr = explode(',',$val['ipaddress']);
                $ipv4[] = $ipaddress_arr[0];
                $ipv6[] = $ipaddress_arr[1];
            }
        }
        
        if(count($ipv4) > 0){
            $ipv4inquery = implode("','", $ipv4);
            $sql = "SELECT id, devicename, deviceIpAddr, deviceIpAddrsix, csr_site_tech_name FROM nodes where deviceIpAddr in ('".$ipv4inquery."')  order by deviceIpAddr asc";
            $db2->query($sql);
            $resultset = $db2->resultset();
            
            for($i=0; $i<count($resultset); $i++){
                $devicename_arr = explode('-',$resultset[$i]['devicename']);
                if(count($devicename_arr) > 3){
                    $case[trim($resultset[$i]['deviceIpAddr'].'~~~'.$resultset[$i]['deviceIpAddrsix'])][$devicename_arr[0].$devicename_arr[1].'-'.$devicename_arr[2].'-'.$devicename_arr[3]][] = $resultset[$i];
                }
            }
            
            foreach ($case as $key => $val){
                foreach ($val as $key1 => $val1){
                    if(count($val1)>1){
                        $case1_arr[] = $val1;
                    }else{
                        $case2_arr[] = $val1;
                    }
                }
            }
        }
        if($type == 'ipcase1'){
            return $case1_arr;
        }
        if($type == 'ipcase2'){
            return $case2_arr;
        }
    }
    if($type == 'ipcase3' || $type == 'ipcase4'){
        $ipv4 = $ipv6 = array();
        $sql = "SELECT deviceIpAddr AS ipaddress, count(*) as cnt FROM nodes where deviceIpAddr != 'None' and deviceIpAddr != '' GROUP BY ipaddress HAVING cnt > 1";
        $db2->query($sql);
        $resultset = $db2->resultset();
        
        foreach ($resultset as $key=>$val){
            if(isset($val['ipaddress']) && !empty($val['ipaddress'])){
                $ipv4[] = $val['ipaddress'];
            }
        }
        
        $sql = "SELECT deviceIpAddrsix AS ipaddress, count(*) as cnt FROM nodes where deviceIpAddrsix != 'None' and deviceIpAddrsix != '' GROUP BY ipaddress HAVING cnt > 1";
        $db2->query($sql);
        $resultset = $db2->resultset();
        
        foreach ($resultset as $key=>$val){
            if(isset($val['ipaddress']) && !empty($val['ipaddress'])){
                $ipv6[] = $val['ipaddress'];
            }
        }
        if(count($ipv4) > 0 || count($ipv6) > 0 ){
            $where = '';
            $case = $case3_arr = $case4_arr = array();
            if(count($ipv4) > 0){
                $ipv4inquery = implode("','", $ipv4);
                $where = " deviceIpAddr in ('".$ipv4inquery."')";
                $sql = "SELECT id, devicename, deviceIpAddr, deviceIpAddrsix, csr_site_tech_name FROM nodes where ".$where."  order by deviceIpAddr asc";
                $db2->query($sql);
                $resultset = $db2->resultset();
                
                for($i=0; $i<count($resultset); $i++){
                    $devicename_arr = explode('-',$resultset[$i]['devicename']);
                    if(count($devicename_arr) > 3){
                        $case[trim($resultset[$i]['deviceIpAddr'].'~~~'.$resultset[$i]['deviceIpAddrsix'])][] = $resultset[$i];
                        $ipv4_arr_result[] = trim($resultset[$i]['deviceIpAddr'].$resultset[$i]['deviceIpAddrsix']);
                    }
                }
            }
            
            if(count($ipv6) > 0){
                $ipv6inquery = implode("','", $ipv6);
                $where = " deviceIpAddrsix in ('".$ipv6inquery."') ";
                $sql = "SELECT id, devicename, deviceIpAddr, deviceIpAddrsix, csr_site_tech_name FROM nodes where ".$where."  order by deviceIpAddr asc";
                $db2->query($sql);
                $resultset = $db2->resultset();
                
                for($i=0; $i<count($resultset); $i++){
                    $devicename_arr = explode('-',$resultset[$i]['devicename']);
                    if(count($devicename_arr) > 3){
                        $case[trim($resultset[$i]['deviceIpAddr'].'~~~'.$resultset[$i]['deviceIpAddrsix'])][] = $resultset[$i];
                        $ipv6_arr_result[] = trim($resultset[$i]['deviceIpAddr'].$resultset[$i]['deviceIpAddrsix']);
                    }
                }
            }
            $ncase = array();
            //both ipv4 and ipv6 shd not match
            foreach ($case as $key => $val){
                    $ipv4_arr_exist = in_array(trim($val[0]['deviceIpAddr'].$val[0]['deviceIpAddrsix']), $ipv4_arr_result) ? true : false;
                    $ipv6_arr_exist = in_array(trim($val[0]['deviceIpAddr'].$val[0]['deviceIpAddrsix']), $ipv6_arr_result) ? true : false;
                if($ipv4_arr_exist === false || $ipv6_arr_exist === false){
                    $devicename_arr = explode('-',$val[0]['devicename']);
                    $ncase[$devicename_arr[0].$devicename_arr[1].'-'.$devicename_arr[2].'-'.$devicename_arr[3]][] = $val[0];
                }
            }
            foreach ($ncase as $key => $val){
                if(count($val)>1){
                    $case3_arr[] = $val;
                }else{
                    $case4_arr[] = $val;
                }
            }
        }
        if($type == 'ipcase3'){
            return $case3_arr;
        }
        if($type == 'ipcase4'){
            return $case4_arr;
        }
    }elseif($type == 'ipcase5'){
        $case5_arr = array();
        $sql = "SELECT * FROM nodes where deviceIpAddr != 'None' OR deviceIpAddrsix != 'None' order by id";
        $db2->query($sql);
        $resultset = $db2->resultset();
        for($i=0; $i<count($resultset); $i++){
            $devicename_arr = explode('-',$resultset[$i]['devicename']);
            if(count($devicename_arr) < 4){
                $case5_arr[] = $resultset[$i];
            }
            
        }
        if($type == 'ipcase5'){
            return $case5_arr;
        }
    }
}
function load_tab_content_cellsite($type){
    global $db2;
    if($type == 'ipcase1' || $type == 'ipcase2'){
        $sql = "SELECT CONCAT(deviceIpAddr, ', ', deviceIpAddrsix) AS ipaddress, count(*) as cnt FROM nodes  where csr_site_tech_name = '".$_SESSION['welcome_mechname']."' and deviceIpAddr != 'None' GROUP BY ipaddress HAVING cnt > 1";
        $db2->query($sql);
        $resultset = $db2->resultset();
        
        $ipv4 = $ipv6 = array();
        foreach ($resultset as $key=>$val){
            if(isset($val['ipaddress'])){
                $ipaddress_arr = explode(',',$val['ipaddress']);
                $ipv4[] = $ipaddress_arr[0];
                $ipv6[] = $ipaddress_arr[1];
            }
        }
        
        if(count($ipv4) > 0){
            $ipv4inquery = implode("','", $ipv4);
            $sql = "SELECT id, devicename, deviceIpAddr, deviceIpAddrsix, csr_site_tech_name FROM nodes where csr_site_tech_name = '".$_SESSION['welcome_mechname']."' and deviceIpAddr in ('".$ipv4inquery."')  order by deviceIpAddr asc";
            $db2->query($sql);
            $resultset = $db2->resultset();
            
            for($i=0; $i<count($resultset); $i++){
                $devicename_arr = explode('-',$resultset[$i]['devicename']);
                if(count($devicename_arr) > 3){
                    $case[trim($resultset[$i]['deviceIpAddr'].'~~~'.$resultset[$i]['deviceIpAddrsix'])][$devicename_arr[0].$devicename_arr[1].'-'.$devicename_arr[2].'-'.$devicename_arr[3]][] = $resultset[$i];
                }
            }
            
            foreach ($case as $key => $val){
                foreach ($val as $key1 => $val1){
                    if(count($val1)>1){
                        $case1_arr[] = $val1;
                    }else{
                        $case2_arr[] = $val1;
                    }
                }
            }
        }
        if($type == 'ipcase1'){
            return $case1_arr;
        }
        if($type == 'ipcase2'){
            return $case2_arr;
        }
    }
    if($type == 'ipcase3' || $type == 'ipcase4'){
        $ipv4 = $ipv6 = array();
        $sql = "SELECT deviceIpAddr AS ipaddress, count(*) as cnt FROM nodes where csr_site_tech_name = '".$_SESSION['welcome_mechname']."' and deviceIpAddr != 'None' and deviceIpAddr != '' GROUP BY ipaddress HAVING cnt > 1";
        $db2->query($sql);
        $resultset = $db2->resultset();
        
        foreach ($resultset as $key=>$val){
            if(isset($val['ipaddress']) && !empty($val['ipaddress'])){
                $ipv4[] = $val['ipaddress'];
            }
        }
        
        $sql = "SELECT deviceIpAddrsix AS ipaddress, count(*) as cnt FROM nodes where csr_site_tech_name = '".$_SESSION['welcome_mechname']."' and deviceIpAddrsix != 'None' and deviceIpAddrsix != '' GROUP BY ipaddress HAVING cnt > 1";
        $db2->query($sql);
        $resultset = $db2->resultset();
        
        foreach ($resultset as $key=>$val){
            if(isset($val['ipaddress']) && !empty($val['ipaddress'])){
                $ipv6[] = $val['ipaddress'];
            }
        }
        if(count($ipv4) > 0 || count($ipv6) > 0 ){
            $where = '';
            $case = $case3_arr = $case4_arr = array();
            if(count($ipv4) > 0){
                $ipv4inquery = implode("','", $ipv4);
                $where = " deviceIpAddr in ('".$ipv4inquery."')";
                $sql = "SELECT id, devicename, deviceIpAddr, deviceIpAddrsix, csr_site_tech_name FROM nodes where csr_site_tech_name = '".$_SESSION['welcome_mechname']."' and ".$where."  order by deviceIpAddr asc";
                $db2->query($sql);
                $resultset = $db2->resultset();
                
                for($i=0; $i<count($resultset); $i++){
                    $devicename_arr = explode('-',$resultset[$i]['devicename']);
                    if(count($devicename_arr) > 3){
                        $case[trim($resultset[$i]['deviceIpAddr'].'~~~'.$resultset[$i]['deviceIpAddrsix'])][] = $resultset[$i];
                        $ipv4_arr_result[] = trim($resultset[$i]['deviceIpAddr'].$resultset[$i]['deviceIpAddrsix']);
                    }
                }
            }
            
            if(count($ipv6) > 0){
                $ipv6inquery = implode("','", $ipv6);
                $where = " deviceIpAddrsix in ('".$ipv6inquery."') ";
                $sql = "SELECT id, devicename, deviceIpAddr, deviceIpAddrsix, csr_site_tech_name FROM nodes where csr_site_tech_name = '".$_SESSION['welcome_mechname']."' and ".$where."  order by deviceIpAddr asc";
                $db2->query($sql);
                $resultset = $db2->resultset();
                
                for($i=0; $i<count($resultset); $i++){
                    $devicename_arr = explode('-',$resultset[$i]['devicename']);
                    if(count($devicename_arr) > 3){
                        $case[trim($resultset[$i]['deviceIpAddr'].'~~~'.$resultset[$i]['deviceIpAddrsix'])][] = $resultset[$i];
                        $ipv6_arr_result[] = trim($resultset[$i]['deviceIpAddr'].$resultset[$i]['deviceIpAddrsix']);
                    }
                }
            }
            $ncase = array();
            //both ipv4 and ipv6 shd not match
            foreach ($case as $key => $val){
                $ipv4_arr_exist = in_array(trim($val[0]['deviceIpAddr'].$val[0]['deviceIpAddrsix']), $ipv4_arr_result) ? true : false;
                $ipv6_arr_exist = in_array(trim($val[0]['deviceIpAddr'].$val[0]['deviceIpAddrsix']), $ipv6_arr_result) ? true : false;
                if($ipv4_arr_exist === false || $ipv6_arr_exist === false){
                    $devicename_arr = explode('-',$val[0]['devicename']);
                    $ncase[$devicename_arr[0].$devicename_arr[1].'-'.$devicename_arr[2].'-'.$devicename_arr[3]][] = $val[0];
                }
            }
            foreach ($ncase as $key => $val){
                if(count($val)>1){
                    $case3_arr[] = $val;
                }else{
                    $case4_arr[] = $val;
                }
            }
        }
        if($type == 'ipcase3'){
            return $case3_arr;
        }
        if($type == 'ipcase4'){
            return $case4_arr;
        }
    }elseif($type == 'ipcase5'){
        $case5_arr = array();
        $sql = "SELECT * FROM nodes where csr_site_tech_name = '".$_SESSION['welcome_mechname']."' and deviceIpAddr != 'None' OR deviceIpAddrsix != 'None' order by id";
        $db2->query($sql);
        $resultset = $db2->resultset();
        for($i=0; $i<count($resultset); $i++){
            $devicename_arr = explode('-',$resultset[$i]['devicename']);
            if(count($devicename_arr) < 4){
                $case5_arr[] = $resultset[$i];
            }
            
        }
        if($type == 'ipcase5'){
            return $case5_arr;
        }
    }
}
function load_tab_content_old($type){
    global $db2;
    if($type == 'ipcase1' || $type == 'ipcase2'){
        $sql = "SELECT CONCAT(deviceIpAddr, ', ', deviceIpAddrsix) AS ipaddress, count(*) as cnt FROM nodes GROUP BY ipaddress HAVING cnt > 1";
        $db2->query($sql);
        $resultset = $db2->resultset();
        
        $ipv4 = $ipv6 = array();
        foreach ($resultset as $key=>$val){
            if(isset($val['ipaddress'])){
                $ipaddress_arr = explode(',',$val['ipaddress']);
                $ipv4[] = $ipaddress_arr[0];
                $ipv6[] = $ipaddress_arr[1];
            }
        }
        
        if(count($ipv4) > 0){
            $ipv4inquery = implode("','", $ipv4);
            $sql = "SELECT id, devicename, deviceIpAddr, deviceIpAddrsix FROM nodes where deviceIpAddr in ('".$ipv4inquery."')  order by deviceIpAddr asc";
            $db2->query($sql);
            $resultset = $db2->resultset();
            
            for($i=0; $i<count($resultset); $i = $i+2){
                $dn_first = explode('-',$resultset[$i]['devicename']);
                $dn_second = explode('-',$resultset[$i+1]['devicename']);
                if(count($dn_first) > 3 && count($dn_second) > 3){
                    if(($dn_first[0] == $dn_second[0]) && ($dn_first[1] == $dn_second[1]) && ($dn_first[2] == $dn_second[2]) && ($dn_first[3] == $dn_second[3])){
                        $case1_arr[] = $resultset[$i];
                        $case1_arr[] = $resultset[$i+1];
                    }else{
                        $case2_arr[] = $resultset[$i];
                        $case2_arr[] = $resultset[$i+1];
                    }
                }else{
                    $case2_arr[] = $resultset[$i];
                    $case2_arr[] = $resultset[$i+1];
                }
            }
            
            if($type == 'ipcase1'){
                return $case1_arr;
            }
            if($type == 'ipcase2'){
                return $case2_arr;
            }
        }
    }
    if($type == 'ipcase3' || $type == 'ipcase4'){
        $ipv4 = $ipv6 = array();
        $sql = "SELECT deviceIpAddr AS ipaddress, count(*) as cnt FROM nodes GROUP BY ipaddress HAVING cnt > 1";
        $db2->query($sql);
        $resultset = $db2->resultset();
        
        foreach ($resultset as $key=>$val){
            if(isset($val['ipaddress']) && !empty($val['ipaddress']) && $val['ipaddress'] != 'None'){
                $ipv4[] = $val['ipaddress'];
            }
        }
        
        $sql = "SELECT deviceIpAddrsix AS ipaddress, count(*) as cnt FROM nodes GROUP BY ipaddress HAVING cnt > 1";
        $db2->query($sql);
        $resultset = $db2->resultset();
        
        foreach ($resultset as $key=>$val){
            if(isset($val['ipaddress']) && !empty($val['ipaddress']) && $val['ipaddress'] != 'None'){
                $ipv6[] = $val['ipaddress'];
            }
        }
        
        if(count($ipv4) > 0 || count($ipv6) > 0 ){
            $where = '';
            $case3_arr = $case4_arr = array();
            if(count($ipv4) > 0){
                $ipv4inquery = implode("','", $ipv4);
                $where = " deviceIpAddr in ('".$ipv4inquery."') ";
                $sql = "SELECT id, devicename, deviceIpAddr, deviceIpAddrsix FROM nodes where ".$where."  order by deviceIpAddr asc";
                $db2->query($sql);
                $resultset = $db2->resultset();
                
                for($i=0; $i<count($resultset); $i = $i+2){
                    if($resultset[$i]['deviceIpAddr'] != $resultset[$i+1]['deviceIpAddr'] || $resultset[$i]['deviceIpAddrsix'] != $resultset[$i+1]['deviceIpAddrsix']){
                        $dn_first = explode('-',$resultset[$i]['devicename']);
                        $dn_second = explode('-',$resultset[$i+1]['devicename']);
                        if(count($dn_first) > 3 && count($dn_second) > 3){
                            if(($dn_first[0] == $dn_second[0]) && ($dn_first[1] == $dn_second[1]) && ($dn_first[2] == $dn_second[2]) && ($dn_first[3] == $dn_second[3])){
                                $case3_arr[] = $resultset[$i];
                                $case3_arr[] = $resultset[$i+1];
                            }else{
                                $case4_arr[] = $resultset[$i];
                                $case4_arr[] = $resultset[$i+1];
                            }
                        }else{
                            $case4_arr[] = $resultset[$i];
                            $case4_arr[] = $resultset[$i+1];
                        }
                    }
                }
            }
            
            if(count($ipv6) > 0){
                $ipv6inquery = implode("','", $ipv6);
                $where = " deviceIpAddrsix in ('".$ipv6inquery."') ";
                $sql = "SELECT id, devicename, deviceIpAddr, deviceIpAddrsix FROM nodes where ".$where."  order by deviceIpAddr asc";
                $db2->query($sql);
                $resultset = $db2->resultset();
                for($i=0; $i<count($resultset); $i = $i+2){
                    if($resultset[$i]['deviceIpAddr'] != $resultset[$i+1]['deviceIpAddr'] || $resultset[$i]['deviceIpAddrsix'] != $resultset[$i+1]['deviceIpAddrsix']){
                        $dn_first = explode('-',$resultset[$i]['devicename']);
                        $dn_second = explode('-',$resultset[$i+1]['devicename']);
                        if(count($dn_first) > 3 && count($dn_second) > 3){
                            if(($dn_first[0] == $dn_second[0]) && ($dn_first[1] == $dn_second[1]) && ($dn_first[2] == $dn_second[2]) && ($dn_first[3] == $dn_second[3])){
                                $case3_arr[] = $resultset[$i];
                                $case3_arr[] = $resultset[$i+1];
                            }else{
                                $case4_arr[] = $resultset[$i];
                                $case4_arr[] = $resultset[$i+1];
                            }
                        }else{
                            $case4_arr[] = $resultset[$i];
                            $case4_arr[] = $resultset[$i+1];
                        }
                    }
                }
            }
        }
        if($type == 'ipcase3'){
            return $case3_arr;
        }
        if($type == 'ipcase4'){
            return $case4_arr;
        }
    }
}

/**
 *
 * @return number|unknown
 */
function get_devicebatch_list_from_devicebatch_rerun_datatable()
{
    global $db2, $pages;
    
    $draw = $_GET['draw'];
    $start = isset($_GET['start']) ? $_GET['start'] : 0;
    $length = isset($_GET['length']) ? $_GET['length'] : 10;
    $search = trim($_GET['search']['value']) ? addslashes(trim($_GET['search']['value'])) : null;
    $order_col = $_GET['order'][0]['column'];
    $order_dir = $_GET['order'][0]['dir'];
    
    $columns = array(
            'distinct(bm.batchid)',
            'bm.batchid',
            'bm.scriptname',
            'bm.deviceseries',
            'bm.nodeVersion',
            'bm.batchcreated',
            'ba.status',
            'bm.scriptfilemame',
            'n.devicename',
            'n.id',
    );
    $sql_count = "SELECT COUNT(distinct(bm.batchid)) ";
    $sql_select = "SELECT " . implode(", ", $columns);
    
    if ($_GET['batchtype'] == 'se') {
        $sql_condition = " FROM batchmaster bm join batchmembers ba join nodes n where bm.batchtype like 'se' AND ba.batchid = bm.batchid and n.id=ba.deviceid";
    } else if ($_GET['batchtype'] == 'sd') {
        $sql_condition = " FROM batchmaster bm join batchmembers ba join nodes n where bm.batchtype like 'sd' AND ba.batchid = bm.batchid and n.id=ba.deviceid";
    } else if ($_GET['batchtype'] == 'bo') {
        $sql_condition = " FROM batchmaster bm join batchmembers ba join nodes n where bm.batchtype like 'bo' AND ba.batchid = bm.batchid and n.id=ba.deviceid";
    } else if ($_GET['batchtype'] == 'rb') {
        $sql_condition = " FROM batchmaster bm join batchmembers ba join nodes n where bm.batchtype like 'rb' AND ba.batchid = bm.batchid and n.id=ba.deviceid";
    } else if ($_GET['batchtype'] == 'al') {
        $sql_condition = " FROM batchmaster bm join batchmembers ba join nodes n where bm.batchtype like 'al' AND ba.batchid = bm.batchid and n.id=ba.deviceid";
    }else if ($_GET['batchtype'] == 'cusal') {
        $sql_condition = " FROM batchmaster bm join batchmembers ba join nodes n where bm.batchtype like 'cusal' AND ba.batchid = bm.batchid and n.id=ba.deviceid";
    }else if ($_GET['batchtype'] == 'st') {
        $sql_condition = " FROM batchmaster bm join batchmembers ba join nodes n where bm.batchtype like 'st' AND ba.batchid = bm.batchid and n.id=ba.deviceid";
    }
    if ($search) {
        $sql_condition .= " AND ( ";
        $sql_condition .= " bm.batchid LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.devicename  LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.scriptname  LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.deviceseries LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.nodeVersion  LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.batchcreated  LIKE '%" . $search . "%'";
        $sql_condition .= " OR ba.status  LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.scriptfilemame  LIKE '%" . $search . "%'";
        $sql_condition .= " ) ";
    }
    $count_sql = $sql_count . $sql_condition;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $total_rec = $row[0];
    
    $sql_order = "";
    if ($order_col != '') {
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != '') {
        $sql_order .= $order_dir != '' ? " $order_dir " : " asc ";
    }
    
    $sql_limit = " LIMIT $start, $length ";
    
    $sql = $sql_select . $sql_condition . $sql_order . $sql_limit;
    $db2->query($sql);
    
    $resultset['draw'] = $draw;
    
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['batchid'].'_'.$value['id'];
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    } else {
        $resultset['data'] = array();
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] = 0;
    }
    return $resultset;
}

function get_devicebatch_list_from_devicebatch_rerun_datatable_export()
{
    global $db2, $pages;
    $search = trim($_GET['search']) ? addslashes(trim($_GET['search'])) : null;
    $order_col = $_GET['column'];
    $order_dir = $_GET['dir'];
    
    $columns = array(
            'distinct(bm.batchid)',
            'bm.batchid',
            'bm.scriptname',
            'bm.deviceseries',
            'bm.nodeVersion',
            'bm.batchcreated',
            'ba.status',
            'bm.scriptfilemame',
            'n.devicename',
            'n.id',
    );
    $sql_select = "SELECT " . implode(", ", $columns);
    
    if ($_GET['batchtype'] == 'se') {
        $sql_condition = " FROM batchmaster bm join batchmembers ba join nodes n where bm.batchtype like 'se' AND ba.batchid = bm.batchid and n.id=ba.deviceid";
    } else if ($_GET['batchtype'] == 'sd') {
        $sql_condition = " FROM batchmaster bm join batchmembers ba join nodes n where bm.batchtype like 'sd' AND ba.batchid = bm.batchid and n.id=ba.deviceid";
    } else if ($_GET['batchtype'] == 'bo') {
        $sql_condition = " FROM batchmaster bm join batchmembers ba join nodes n where bm.batchtype like 'bo' AND ba.batchid = bm.batchid and n.id=ba.deviceid";
    } else if ($_GET['batchtype'] == 'rb') {
        $sql_condition = " FROM batchmaster bm join batchmembers ba join nodes n where bm.batchtype like 'rb' AND ba.batchid = bm.batchid and n.id=ba.deviceid";
    } else if ($_GET['batchtype'] == 'al') {
        $sql_condition = " FROM batchmaster bm join batchmembers ba join nodes n where bm.batchtype like 'al' AND ba.batchid = bm.batchid and n.id=ba.deviceid";
    }else if ($_GET['batchtype'] == 'cusal') {
        $sql_condition = " FROM batchmaster bm join batchmembers ba join nodes n where bm.batchtype like 'cusal' AND ba.batchid = bm.batchid and n.id=ba.deviceid";
    }else if ($_GET['batchtype'] == 'st') {
        $sql_condition = " FROM batchmaster bm join batchmembers ba join nodes n where bm.batchtype like 'st' AND ba.batchid = bm.batchid and n.id=ba.deviceid";
    }
    if ($search) {
        $sql_condition .= " AND ( ";
        $sql_condition .= " bm.batchid LIKE '%" . $search . "%'";
        $sql_condition .= " OR n.devicename  LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.scriptname  LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.deviceseries LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.nodeVersion  LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.batchcreated  LIKE '%" . $search . "%'";
        $sql_condition .= " OR ba.status  LIKE '%" . $search . "%'";
        $sql_condition .= " OR bm.scriptfilemame  LIKE '%" . $search . "%'";
        $sql_condition .= " ) ";
    }

    $sql_order = "";
    if ($order_col != '') {
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != '') {
        $sql_order .= $order_dir != '' ? " $order_dir " : " asc ";
    }
    
    $sql_limit = " LIMIT $start, $length ";
    
    $sql = $sql_select . $sql_condition . $sql_order;
    $db2->query($sql);
    
    $resultset['draw'] = $draw;
    
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['batchid'].'_'.$value['id'];
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    } else {
        $resultset['data'] = array();
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] = 0;
    }
    return $resultset;
}
/**
*
* @param unknown $ipaddress
* @return unknown
*/
function get_device_series_from_ip_address($ipaddress)
{
   global $db2;
   $sql = "SELECT deviceseries FROM nodes where deviceIpAddrsix = '".$ipaddress."'";
   $db2->query($sql);
   $resultset = $db2->resultset();
   return $resultset;
}

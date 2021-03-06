<?php

function logToFile($filename, $msg) {
    // open file
    $fd = fopen($filename, "a");
    // append date/time to message
    $str = "[" . date("Y/m/d h:i:s", mktime()) . "] " . $msg;
    // write string
    fwrite($fd, $str . "\n");
    // close file
    fclose($fd);
}

function get_user_info($username, $password) {
    
    global $db2;
    
    if (trim($username) !='' && trim($password) != '') {
        $password= md5($password);
        $sql = "SELECT u.*,ul.userlevel as role FROM users u, userlevels ul WHERE u.username='" .$username. "' AND u.password='" .$password. "' AND ul.id = u.userlevel";
        
        $db2->query($sql);
        $rows = $db2->resultset();
        $result = $rows[0];
        
        return $result;
    }
    return false;
    
}


function get_user_info_sso($username) {
    
    global $db2;
    
    if (trim($username) !='') {
        $sql = "SELECT u.*,ul.userlevel as role FROM users u, userlevels ul WHERE u.username='" .$username. "' AND ul.id = u.userlevel";
        $db2->query($sql);
        $rows = $db2->resultset();
        $result = $rows[0];
        return $result;
    }
    return false;
}

function get_user_info_sso_imp($fname, $lname, $userlevel) {
    
    global $db2;
    
    if (trim($fname) !='' && trim($lname) !='' && trim($userlevel)) {
        $sql = "SELECT u.*,ul.userlevel as role FROM users u, userlevels ul WHERE u.fname='" .trim($fname). "' AND  u.lname='" .trim($lname). "' AND  ul.userlevel='" .trim($userlevel). "' AND ul.id = u.userlevel"; 
        $db2->query($sql);
        $rows = $db2->resultset();
        $result = $rows[0];
        return $result;
    }
    return false;
}

function check_user_authentication($usertype = array()) {
    global $db2;
    
    if ($_SESSION['userid']) {
        if (in_array($_SESSION['userlevel'], $usertype)) {
            return true;
        }
        else {
            header('Location: access.php?msg=You are not authorized to access this page');
        }
    }
}

function get_landing_page() {
    
    if (!$_SESSION['userlevel']) {
        return 'index.php';
    }
    else {
        if (in_array($_SESSION['userlevel'], array(1,3,4))) { // fieldsite technician
            $location_href = "cellsitetech-dashboard.php";
        }
        if (in_array($_SESSION['userlevel'], array(2,5,6,7))) { 
            $location_href = "switchtech-dashboard.php";
        }
        if (in_array($_SESSION['userlevel'], array(8))) {
            $location_href = "login-impersonate.php";
        }
        return $location_href;
    }
    
}
function activemenu($filename) {
    $active = '';
    
    $current_file = $_SERVER['SCRIPT_NAME'];
    if(!is_array($filename)){
        if(strpos($current_file, $filename)){
            $active =  'active';
        }
        else {
            $active = '';
        }
    }
    else {
        foreach($filename as $flnm) {
            if(strpos($current_file, $flnm)){
                $active = 'active';
                break;
            }
            else {
                $active = '';
            }
        }
    }
    
    return $active;
}

/*
 * User Login check and user session creation
 */
function user_session_check() {
    global $db2;
    if (isset($_POST['username']) && $_POST['password']){
        
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if (trim($username) !='' && trim($password) != '') {
            $password= md5($password);
            $sql = "SELECT * FROM users WHERE username='" .$username. "' AND password='" .$password. "'";
            $db2->query($sql);
            $rows = $db2->resultset();
            $result = $rows[0];
            
            if ( ! $result ) {
                header("Location: index.php?msg=Username and Password is wrong");
                exit();
            }
            $userid = $_SESSION['userid'] = $result['id'];
            $_SESSION['username'] = $username;
        }
        else {
            header("Location: index.php");
            exit();
        }
        
    }
    else {
        
        if ( ! isset($_SESSION['userid'])) {
            
            header("Location: index.php?msg=User session expired");
            exit();
        }
    }
    
}

function get_user_type(){
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
function is_live_session($sessid) {
    
    $db2 = new db2();
    //exit("SELECT COUNT(*) FROM sessions WHERE sessionid=" .$sessid );
    $db2->query( "SELECT COUNT(*) FROM sessions WHERE sessionid='" .$sessid ."'");
    $row = $db2->resultsetCols();
    $sess_record_count = $row[0];
    
    return $sess_record_count;
}

/*
 * Nodes table for devices list
 */

function get_device_list_from_nodes($user_id) {
    
    global $db2, $pages;
    $pages->paginate();
    if ($user_id > 0) {
        $sql_count = "SELECT COUNT(*) ";
        $sql_select = "SELECT n.id, n.custom_Location, n.devicename, n.deviceIpAddr, n.model, v.vendorName, n.investigationstate, n.status, n.upsince, n.nodeVersion, n.severity, n.deviceseries ";
        
        $sql_condition = " FROM userdevices ud
         JOIN nodes n on ud.nodeid = n.id
            
         LEFT JOIN vendors v on v.id = n.vendorId
         WHERE ud.userid = " . $user_id ;
        
        $sql_search_cond = '';
        if ( $_SESSION['search_term'] != ''){
            $search_term = $_SESSION['search_term'];
            
            $sql_search_cond = " AND ( n.devicename LIKE '%" . $search_term . "%' ";
            $sql_search_cond .= " OR n.deviceIpAddr LIKE '%" . $search_term . "%' ";
            $sql_search_cond .= " OR n.custom_Location LIKE '%" . $search_term . "%' ";
            
            /* Other fields temporarely excluded*/
            
            // $status_val = (strtolower(trim($search_term))  == 'reachable') ? '1' : '0';
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
    // echo "value of sql inside the get_device_list".$sql;  exit(0);
    // echo '<br>';
    // echo $sql;
    $db2->query($sql);
    
    $resultset['result'] = $db2->resultset();
    $resultset['total_rec'] = $total_rec;
    
    return $resultset;
}


function get_device_list_from_nodes_datatable($userid) {
    
    global $db2, $pages;
    
    //print_r($_GET);
    $draw = $_GET['draw'];
    $start = isset($_GET['start']) ? $_GET['start'] : 0;
    $length = isset($_GET['length']) ? $_GET['length'] : 10;
    $search = trim($_GET['search']['value']) ? addslashes(trim($_GET['search']['value'])) : null;
    $order_col = $_GET['order'][0]['column'];
    $order_dir = $_GET['order'][0]['dir'];
    
    $columns = array(
        'DISTINCT(n.id)',
        'n.csr_site_id',
        'n.csr_site_name',
        'n.devicename',
        'n.market',
        'n.deviceseries',
        'n.nodeVersion',
        'n.lastpolled'
    ); 
	
    $sql_count = "SELECT COUNT(DISTINCT(n.id)) ";
    $sql_select = "SELECT " . implode(", ", $columns);
    
    $sql_condition = " FROM userdevices ud
       JOIN nodes n on ud.nodeid = n.id
       WHERE ud.userid = " . $userid ." AND status = 3";
    if ($search) {
        $sql_condition .=  " AND ( ";
        $sql_condition .=  " n.devicename LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.csr_site_id  LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.csr_site_name  LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.market  LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.deviceseries  LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.nodeVersion  LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.lastpolled  LIKE '%". $search ."%'";
        $sql_condition .=  " ) ";
    }
    $count_sql = $sql_count . $sql_condition;
    //echo $count_sql; die;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $total_rec = $row[0];
    
    
    $sql_order = "";
    if ($order_col != ''){
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != ''){
        $sql_order .= $order_dir != '' ? " $order_dir ": " asc ";
    }
    
    $sql_limit = " LIMIT $start, $length ";
    
    $sql = $sql_select . $sql_condition  . $sql_order . $sql_limit ;
    // echo '<br>';
    // echo $sql;
    
    $db2->query($sql);
    
    
    $resultset['draw'] = $draw;
    
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'] ;
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    }
    else {
        $resultset['data'] = array();
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] =0;
    }
    
    return $resultset;
}

/*
 *  get device details for the current users
 */
function get_device_list($user_id, $usertype='ME') {
    
    $db2 = new db2();
    $pages = new Paginator;
    $pages->paginate();
    
    if ($user_id > 0) {
        
        $sql = "SELECT dd.* FROM currentusers cu
				 JOIN devicedetails dd on cu.deviceId = dd.id
				 WHERE cu.userid = " . $user_id . " AND cu.usertype='" . $usertype . "' ";
    }
    else {
        $sql = "SELECT dd.* FROM currentusers cu
				 JOIN devicedetails dd on cu.deviceId = dd.id ";
    }
    
    $count_sql = str_replace("dd.*", 'count(*)', $sql);
    
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    $total_rec = $row[0];
    //$pages->items_total = $count_result['total'];
    //$pages->mid_range = 7; // Number of pages to display. Must be odd and > 3
    
    $sql .= $pages->limit;
    
    // exit($sql);
    $db2->query($sql);
    // print_R($sql);
    
    $resultset['result'] = $db2->resultset();
    $resultset['total_rec'] = $total_rec;
    
    return $resultset;
}

/*
 *	Updates the device_details table and
 *  current_users table
 */
function update_devicedetails($userid, $usertype, $device_details){
    
    $db2 = new db2();
    
    //Swich Tech API and Field Tech API calls are handled here
    //for device_details information
    foreach ($device_details as $key => $device) {
        
        $devicename = $device['name'];
        $ipaddress  = $device['ipaddress'];
        $vendor	= $device['vendor'];
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
        $lastInsertId  = $db2->lastInsertId();
        
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
function update_sessions($userid, $usertype, $sessionid) {
    
    $db2   = new db2();
    
    $sql = "SELECT * FROM sessions WHERE sessionId = '".$sessionid."'";
    $db2->query($sql);
    $recordset = $db2->resultset();
    
    if (!$recordset) {
        $sql = "INSERT INTO `sessions` (`userId`, `userType`, `sessionId`, `initLogged`, `LastLogged`) VALUES
					('$userid', '$usertype', '$sessionid', now(), now() )";
        $db2->query($sql);
        $db2->execute();
    }
    else {
        
        $sql = "UPDATE `sessions` SET lastLogged = now() WHERE sessionId = '".$sessionid."'";
        // exit ($sql);
        $db2->query($sql);
        $db2->execute();
    }
}

/*
 * Deletes users from sessions table where users are idle for last 20 mins or more
 *
 */
function delete_idleuser() {
    
    $db2 = new db2();
    
    $sql = "select * from sessions T where TIMESTAMPDIFF(MINUTE,T.initLogged,T.lastLogged) > " . CRON_TIME_INTERVAL;
    
    $db2->query($sql);
    $recset = $db2->resultset();
    $deleted_users = array();
    foreach ($recset as $key => $value) {
        
        $userid =  $value['userId'];
        
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
function delete_alluser() {
    
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

function sendPostData ($url) {
    //exit($url);
    // Curl GET methods begins
    //echo "Inside the sendpostdata method value of url is $url";;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_HTTPGET, 1);
    curl_setopt($ch, CURLOPT_URL,$url);
    //curl_setopt($ch, CURLOPT_POSTFIELDS,$query);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec ($ch);
    curl_close ($ch);
    
    //error handling for cURL
    if ($reply === false) {
        // throw new Exception('Curl error: ' . curl_error($crl));
        print_r('Curl error: ' . curl_error($crl));
    };
    curl_close($crl);
    
    return $result;
    //cURL ends
    // Curl GET method ends
}

function getDetailViewData($userid, $deviceid) {
    $db2 = new db2();
    $sql_select = "SELECT hk.deviceid, hk.cpuutilization, hk.freememory, hk.buffers, hk.iosversion, hk.bootstatement, hk.configregister, hk.environmental, hk.platform, hk.bfdsession, hk.interfacestates, hk.interfacecounters, hk.mplsinterfaces, hk.mplsneighbors, hk.bgpvfourneighbors, hk.bgpvsixneighbors, hk.bgpvfourroutes, hk.bgpvsixroutes, hk.twothsndbyteping, hk.fivethsndbyteping, hk.logentries, hk.xconnect, hk.lightlevel, hk.userid ";
    $sql_condition = "
	FROM
	healthcheck hk
	JOIN nodes n on n.id = hk.deviceid
	JOIN userdevices ud on ud.nodeid = hk.deviceid AND ud.userid = hk.userid
	WHERE hk.userid = $userid and hk.deviceid = ". $deviceid;
    
    $sql = $sql_select . $sql_condition;
    
    logToFile(my.log, $sql);
    $db2->query($sql);
    
    $resultset['result'] = $db2->resultset();
    logToFile(my.log, $resultset);
    return $resultset;
}

/*
 * Function to get the Switches list of user
 */
function getSwitchDevicesList($userid){
    
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
function getSwitchDevicesListByCity($userid, $city){
    
    global $db2, $pages;
    
    $sql_count = " SELECT count(*) ";
    $sql_select = " SELECT n.id, n.devicename, n.custom_Location, n.submarket ";
    
    $sql_condition = " FROM userdevices ud
                    JOIN nodes n ON n.id = ud.nodeid
                    WHERE ud.userid = $userid AND n.submarket = '$city' ";
    $sql_order = " ORDER BY ud.nodeid ";
    
    $count_sql = $sql_count . $sql_condition ;
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
function get_switchlist_for_market_subregion($userid, $market, $subregion){
    
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
    
    $count_sql = $sql_count .  $sql_join . $sql_where_condition  ;
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
function getSWroutersDetails($deviceid, $userid) {
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
function getSEuserCityList($userid)  {
    
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



function usrfavritelist_display($userid){
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

function usrcellsitefavritelist_display($userid){
    $db2 = new db2();
    $sql_select = " SELECT listname, listid ";
    $sql_condition = "
  FROM
  userdevices
  WHERE userid = $userid 
  group by listname, listid
  order by listid desc ";
    
    $sql = $sql_select . $sql_condition;
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}






function insert_my_device_record($data){
    $db2 = new db2();
    $listid = $data['listid'];
    $userid =$data['userid'];
    $nodeid = $data['deviceid'];
    
    
    $sql = "SELECT  listname FROM userdevices WHERE listid = $listid group by listname ";
    
    $db2->query($sql);
    $recordset = $db2->resultset();
    $listname = addslashes($recordset[0]['listname']);
    
    $sql = "INSERT INTO userdevices (nodeid, userid, listid, listname)
           VALUES($nodeid,$userid,$listid,'$listname')";
    // echo $sql;
    $db2->query($sql);
    $result =$db2->execute();
    
    return $result;
    
}

function insert_ipaddrmgmt_record($data){
    $db2 = new db2();
    
    $sql = "INSERT INTO ipaddrmgmt (market, fromipvfour, toipvfour, fromipvsix, toipvsix)
           VALUES('".$data['market']."','".$data['fromipvfour']."','".$data['toipvfour']."','".$data['fromipvsix']."','".$data['toipvsix']."')";
    
    $db2->query($sql);
    $result =$db2->execute();
    
    return $result;
    
}

function insert_usrfavritedev($data){
    $db2 = new db2();
    $lname = addslashes($data['listname']);
    $userid =$data['userid'];
    $nodes = array($data['deviceid']);
    $sql = "SELECT  max(listid) + 1  as listidmaxval FROM userdevices WHERE listid <> 0 ";
    $db2->query($sql);
    $recordset = $db2->resultset();
    $listid = $recordset[0]['listidmaxval']+1;
    
    $sql = "INSERT INTO userdevices (nodeid, userid, listid, listname)
           VALUES(0,$userid,$listid,'$lname')";
    // echo $sql ;
    $_SESSION['mylistname'] = $lname;
    $_SESSION['switchlistid'] = $listid;
    $db2->query($sql);
    $result =$db2->execute();
    if (in_array($_SESSION['userlevel'], array(1,3,4))) {
       header("Location: cellsitetech-dashboard.php");
    }elseif (in_array($_SESSION['userlevel'], array(2,5,6,7))) { 
       header("Location: switchtech-dashboard.php");
    }elseif (in_array($_SESSION['userlevel'], array(8))) {
        header("Location: login-impersonate.php");
    }
    //return $result; 
}

function usrfavritecondev_display($userid,$listid){
    $db2 = new db2();
    $sql_select = " SELECT distinct(ud.id), ud.listid, ud.listname, ud.nodeid, n.devicename ";
    $sql_condition = "
  FROM
  userdevices ud
  LEFT JOIN nodes n on ud.nodeid = n.id
  WHERE ud.listid = $listid and ud.userid = $userid and ud.listid != 0  order by ud.id desc ";
    $sql = $sql_select . $sql_condition;
    
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    
    $resultset['mylistname'] = $resultset['result'][0]['listname'];
    
    array_pop($resultset['result']);
    
    return $resultset;
}

function usrfavritecondev_celt_display($userid,$listid){
    $db2 = new db2();
    $sql_select = " SELECT ud.id, ud.listid, ud.listname, ud.nodeid, n.devicename ";
    $sql_condition = "
  FROM
  userdevices ud
  LEFT JOIN nodes n on ud.nodeid = n.id
  WHERE ud.listid = $listid and ud.userid = $userid and ud.listid >= 0  order by ud.id desc ";
    $sql = $sql_select . $sql_condition;
    
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    
    $resultset['mylistname'] = $resultset['result'][0]['listname'];
    
    array_pop($resultset['result']);
    
    return $resultset;
}

function user_mylist_devieslist($userid,$listid){
    
    
    global $db2, $pages;
    $pages->paginate();
    if ($userid > 0) {
        $sql_count = "SELECT COUNT(*) ";
        $sql_select = "SELECT n.id, n.custom_Location, n.devicename, n.deviceIpAddr, n.model, v.vendorName, n.investigationstate, n.status, n.upsince, n.nodeVersion, ud.listname, n.severity, n.deviceseries ";
        
        $sql_condition = " FROM userdevices ud
         JOIN nodes n on ud.nodeid = n.id
            
         LEFT JOIN vendors v on v.id = n.vendorId
         WHERE ud.userid = " . $userid ." and ud.listid = " . $listid ;
        
        
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

function get_user_mylist_name($userid,$listid) {
    global $db2;
    
    $sql = "SELECT ud.listname  FROM userdevices ud
         JOIN nodes n on ud.nodeid = n.id
        
         WHERE ud.userid = " . $userid ." and ud.listid = " . $listid . "
         limit 0,1 " ;
    
    $db2->query($sql);
    
    $resultset = $db2->resultset();
    if(isset($resultset[0]['listname']))  {
        return($resultset[0]['listname']);
    }
    else {
        return;
    }
}

function get_user_mylist_name_by_id($listid) {
    global $db2;
    
    $sql = "SELECT ud.listname  FROM userdevices ud
          WHERE ud.listid = " . $listid . "
         limit 0,1 " ;
    $db2->query($sql);
    
    $resultset = $db2->resultset();
    if(isset($resultset[0]['listname']))  {
        return($resultset[0]['listname']);
    }
    else {
        return;
    }
}

function user_mylist_devieslist_datatable($userid,$listid){
    
    
    global $db2, $pages;
    
    if (!$userid) {
        return false;
    }
    //print_r($_GET);
    $draw = $_GET['draw'];
    $start = isset($_GET['start']) ? $_GET['start'] : 0;
    $length = isset($_GET['length']) ? $_GET['length'] : 10;
    $search = trim($_GET['search']['value']) ? addslashes(trim($_GET['search']['value'])) : null;
    $order_col = $_GET['order'][0]['column'];
    $order_dir = $_GET['order'][0]['dir'];
    
    $columns = array(
        'n.model',
        'n.id',
        'n.csr_site_id',
        'n.csr_site_name',
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
       WHERE ud.userid = " . $userid ." and ud.listid = " . $listid ;
    if ($search) {
        $sql_condition .=  " AND ( ";
        $sql_condition .=  " n.devicename LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.csr_site_id LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.csr_site_name  LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.market  LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.deviceseries  LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.nodeVersion  LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.lastpolled  LIKE '%". $search ."%'";
        $sql_condition .=  " ) ";
    }
    $count_sql = $sql_count . $sql_condition;
    // echo $count_sql;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $total_rec = $row[0];
    
    
    $sql_order = "";
    if ($order_col != ''){
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != ''){
        $sql_order .= $order_dir != '' ? " $order_dir ": " asc ";
    }
    
    $sql_limit = " LIMIT $start, $length ";
    
    $sql = $sql_select . $sql_condition  . $sql_order . $sql_limit ;
    
    $db2->query($sql);
    
    
    $resultset['draw'] = $draw;
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'] ;
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    }
    else {
        $resultset['data'] = '';
        $resultset['recordsTotal'] =10;
        $resultset['recordsFiltered'] = 0;
    }
    return $resultset;
    
}


function usrfavritelistdel ($userid,$switchlistid){
    $db2 = new db2();
    $sql = "delete from userdevices where userid = $userid and listid = $switchlistid and listname !='My Routers'";
    $db2->query($sql);
    $db2->execute();
    return;
}


function usrfavritelistswdel($userid,$switchlistid,$switchid){
    $db2 = new db2();
    $sql = "delete from userdevices where listid = $switchlistid and nodeid = $switchid and userid = $userid and listname !='My Routers'";
    $db2->query($sql);
    $db2->execute();
    return;
}

function get_market_subregion_list($market_name) {
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



function  userexist($emailid) {
    $db2 = new db2();
    $sql = "SELECT COUNT(*) FROM users WHERE email ='" .$emailid."'";
    $db2->query($sql);
    $row = $db2->resultsetCols();
    $resultset['result'] = $db2->resultset();
    
    return $row;
}

function sendmail($mailbody,$pwrurl) {
    $mail = new PHPMailer();
    $mail->IsSMTP(); // send via SMTP
    $mail->SMTPAuth = true; // turn on SMTP authentication
    $mail->Username = "oneemsadministrator@gmail.com"; // SMTP username
    $mail->Password = "oneemsadministratorpassword"; // SMTP password
    $webmaster_email = "oneemsadministrator@gmail.com"; //Reply to this email ID
    $email="enduser@gmail.com"; // Recipients email ID
    $name="enduser"; // Recipient's name
    $mail->From = $webmaster_email;
    $mail->FromName = "OneEMS Administrator";
    $mail->AddAddress($email,$name);
    $mail->AddReplyTo($webmaster_email,"oneemsadministrator@gmail.com");
    $mail->WordWrap = 50; // set word wrap
    //$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment
    //$mail->AddAttachment("/tmp/image.jpg", "new.jpg"); // attachment
    $mail->IsHTML(true); // send as HTML
    $mail->Subject = "OneEMS Password Reset";
    //$mail->Body = "Hi,
    //This is the HTML BODY "; //HTML Body
    $mail->Body = file_get_contents('emailcontent.php').$mailbody.$pwrurl;
    $mail->AltBody = "This is the body when user views in plain text format"; //Text Body
    if(!$mail->Send())
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
        //echo "Message has been sent";
    }
    //echo "<br>"."sendmail completed";
}

function updateuserpassword($emailid,$password) {
    // Update the user's password
    $db2   = new db2();
    $sql = "SELECT * FROM users WHERE email = '".$emailid."'";
    $db2->query($sql);
    $recordset = $db2->resultset();
    if (!$recordset) {
        echo "Username not found in our records.";
    }  else {
        $sql = "UPDATE `users` SET password = '".$password."' WHERE email = '".$emailid."'";
        $db2->query($sql);
        $db2->execute();
        return true;
    };
}
function get_market_list() {
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
function get_switchlist_all_market($userid){
    
    global $db2;
    
    $sql_count = " SELECT count(*) ";
    $sql_select = " SELECT n.switch_name ";
    
    $sql_join = " FROM  nodes n
                      JOIN users u on u.username = n.swt_tech_id ";
    
    $sql_where_condition = " WHERE u.id = $userid and n.switch_name !='' limit 0,1 ";
    
    /*if ($market != '') {
     $sql_where_condition .= " AND n.market  = '$market' ";
     }
     if ($subregion != '') {
     $sql_where_condition .= " AND n.submarket = '$subregion' ";
     }*/
    
    $sql_order = " ";
    
    $count_sql = $sql_count .  $sql_join . $sql_where_condition  ;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $resultset['total_rec'] = $row[0];
    
    
    $sql = $sql_select . $sql_join . $sql_where_condition . $sql_order;
    //  $sql .= $pages->limit;
    
    $db2->query($sql);
    
    $resultset['result'] = $db2->resultset();
    return $resultset;
}


/*
 *
 */
function getSWroutersDetails_all($swich_devince_name, $search_term='', $userid, $page_limit) {
    global $db2;
    
    $high_limit = HIGH_LIMIT;
    $low_limit = LOW_LIMIT;
    $pages = new Paginator();
    $pages->default_ipp = $page_limit;
    $temp_page_var = (isset($_GET['page'])) ? $_GET['page'] : 1;
    
    if (isset($_GET['page'])) {
        
        if ($_GET['ipp'] ==  $high_limit) {
            $_SESSION['high_page'] = $_GET['page'];
        }
        
        if ($_GET['ipp'] ==  $low_limit) {
            $_SESSION['low_page'] = $_GET['page'];
        }
        
        
        if ($page_limit  ==  $high_limit) {
            $_GET['page'] = ($_SESSION['high_page']) ? $_SESSION['high_page'] : '1';
        }
        
        if ($page_limit  ==  $low_limit) {
            $_GET['page'] = ($_SESSION['low_page']) ? $_SESSION['low_page'] : '1';
        }
    }
    else {
        unset($_SESSION['low_page']);
        unset($_SESSION['high_page']);
        
        $_SESSION['low_page'] = 1;
        $_GET['ipp'] = LOW_LIMIT;
        $_GET['page'] = 1;
    }
    $pages->paginate();
    $_GET['page']=   $temp_page_var;
    
    
    
    $sql_count = " SELECT count(*) ";
    $sql_select = " SELECT n2.id,n2.devicename,n2.deviceIpAddr, n2.custom_Location, n2.connPort, n2.model, n2.systemname ";
    $sql_condition = " FROM nodes n2
                      join userdevices ud on ud.nodeid = n2.id
                      join users u on u.id = ud.userid
                    WHERE n2.switch_name ='$swich_devince_name' AND u.id = $userid  ";
    
    if ($search_term != '') {
        $sql_condition .= " AND ( ";
        $sql_condition .= "  n2.devicename LIKE '%". addslashes($search_term) ."%' " ;
        $sql_condition .= "  OR n2.deviceIpAddr LIKE '%". addslashes($search_term) ."%' " ;
        $sql_condition .= "  OR n2.market LIKE '%". addslashes($search_term) ."%' " ;
        $sql_condition .= "  OR n2.submarket LIKE '%". addslashes($search_term) ."%' " ;
        $sql_condition .= " ) ";
    }
    $count_sql = $sql_count .  $sql_condition  ;
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
function get_swt_user_routers_list_datatable($list_for, $list_type, $selswitch) {
    global $db2;
    
    
    //print_r($_GET);
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
        'n.deviceIpAddr',
    );
    
    
    $sql_count = " SELECT COUNT(DISTINCT(n.id)) as count ";
    $sql_select = " SELECT distinct " . implode(", ", $columns);
    
    if ($list_type == 'user') {
        $userid = $_SESSION['userid'];
        $switch_device_name = addslashes($list_for);
        $sql_condition = " FROM nodes n
                      join userdevices ud on ud.nodeid = n.id
                      join users u on u.id = ud.userid
                      WHERE n.switch_name ='$switch_device_name' AND u.id = $userid ";
    }
    else {
        $market = addslashes($list_for);
        $sql_condition = " FROM nodes n
                        WHERE trim(lower(REPLACE(n.market,' ',''))) ='$market' ";
        
        if($selswitch != ''){
            $sql_condition .= " AND switch_name ='$selswitch'";
        }
        
    }
    
    if ($search_term != '') {
        $sql_condition .= " AND ( ";
        $sql_condition .= "  n.csr_site_tech_name LIKE '%". addslashes($search_term) ."%' " ;
        $sql_condition .= "  OR csr_site_id LIKE '%". addslashes($search_term) ."%' " ;
        $sql_condition .= "  OR n.csr_site_name LIKE '%". addslashes($search_term) ."%' " ;
        $sql_condition .= "  OR n.devicename LIKE '%". addslashes($search_term) ."%' " ;
        $sql_condition .= "  OR n.deviceIpAddr LIKE '%". addslashes($search_term) ."%' " ;
        $sql_condition .= "  OR n.market LIKE '%". addslashes($search_term) ."%' " ;
        $sql_condition .= " ) ";
    }
    
    $count_sql = $sql_count .  $sql_condition  ;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $total_rec = $row[0];
    
    
    
    $sql_order = "";
    if ($order_col != ''){
        if($order_col == 3){
            $sql_order = " ORDER BY csr_site_id";
        }else{
            $sql_order = " ORDER BY " . $columns[$order_col];
        }    
    }
    
    if ($order_dir != ''){
        $sql_order .= $order_dir != '' ? " $order_dir ": " asc ";
    }
    
    $sql_limit = " LIMIT $start, $length ";
    
    $sql = $sql_select . $sql_condition  . $sql_order . $sql_limit ; 
    $db2->query($sql);
    
    $resultset['draw'] = $draw;
    
    if (count($db2->resultset())) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'] ;
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
        
    }
    else {
        $resultset['data'] = '';
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] =0;
    }
    
    return $resultset;
}



function get_cellsitetech_user_routers_list_datatable($list_for, $list_type, $selswitch) {
    global $db2;
    
    
    //print_r($_GET);
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
        'n.deviceIpAddr',
    );
    
    
    $sql_count = " SELECT COUNT(DISTINCT(n.id)) as count ";
    $sql_select = " SELECT distinct " . implode(", ", $columns);
    
    if ($list_type == 'user') {
        $userid = $_SESSION['userid'];
        $switch_device_name = addslashes($list_for);
        $sql_condition = " FROM nodes n
                      join userdevices ud on ud.nodeid = n.id
                      join users u on u.id = ud.userid
                      WHERE n.switch_name ='$switch_device_name' AND n.status = 3 ";
    }
    else {
        $market = addslashes($list_for);
        $sql_condition = " FROM nodes n
                        WHERE trim(lower(REPLACE(n.market,' ',''))) ='$market'";
					//WHERE trim(lower(REPLACE(n.market,' ',''))) ='$market' AND n.status = 3";
        if($selswitch != ''){
            $sql_condition .= " AND switch_name ='$selswitch'";
        }
        
    }
    
    if ($search_term != '') {
        $sql_condition .= " AND ( ";
        $sql_condition .= "  n.csr_site_tech_name LIKE '%". addslashes($search_term) ."%' " ;
        $sql_condition .= "  OR csr_site_id LIKE '%". addslashes($search_term) ."%' " ;
        $sql_condition .= "  OR n.csr_site_name LIKE '%". addslashes($search_term) ."%' " ;
        $sql_condition .= "  OR n.devicename LIKE '%". addslashes($search_term) ."%' " ;
        $sql_condition .= "  OR n.deviceIpAddr LIKE '%". addslashes($search_term) ."%' " ;
        $sql_condition .= "  OR n.market LIKE '%". addslashes($search_term) ."%' " ;
        $sql_condition .= " ) ";
    }
    
    $count_sql = $sql_count .  $sql_condition  ;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $total_rec = $row[0];
    
    
    
    $sql_order = "";
    if ($order_col != ''){
        if($order_col == 3){
            $sql_order = " ORDER BY csr_site_id";
        }else{
            $sql_order = " ORDER BY " . $columns[$order_col];
        }
    }
    
    if ($order_dir != ''){
        $sql_order .= $order_dir != '' ? " $order_dir ": " asc ";
    }
    
    $sql_limit = " LIMIT $start, $length ";
    
    $sql = $sql_select . $sql_condition  . $sql_order . $sql_limit ;
    $db2->query($sql);
    
    $resultset['draw'] = $draw;
    
    if (count($db2->resultset())) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'] ;
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
        
    }
    else {
        $resultset['data'] = '';
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] =0;
    }
    
    return $resultset;
} 

function get_market_list_new() {
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



function getmarketroutersDetails_all($market, $search_term, $page_limit) {
    global $db2;
    $pages = new Paginator();
    
    
    $high_limit = HIGH_LIMIT;
    $low_limit = LOW_LIMIT;
    $pages->default_ipp = $page_limit;
    $temp_page_var = (isset($_GET['page'])) ? $_GET['page'] : 1;
    
    if (isset($_GET['page'])) {
        
        if ($_GET['ipp'] ==  $high_limit) {
            $_SESSION['high_page'] = $_GET['page'];
        }
        
        if ($_GET['ipp'] ==  $low_limit) {
            $_SESSION['low_page'] = $_GET['page'];
        }
        
        
        if ($page_limit  ==  $high_limit) {
            $_GET['page'] = ($_SESSION['high_page']) ? $_SESSION['high_page'] : '1';
        }
        
        if ($page_limit  ==  $low_limit) {
            $_GET['page'] = ($_SESSION['low_page']) ? $_SESSION['low_page'] : '1';
        }
    }
    else {
        unset($_SESSION['low_page']);
        unset($_SESSION['high_page']);
        
        $_SESSION['low_page'] = 1;
        $_GET['ipp'] = LOW_LIMIT;
        $_GET['page'] = 1;
    }
    $pages->paginate();
    $_GET['page']=   $temp_page_var;
    
    
    $sql_count = " SELECT count(*) ";
    $sql_select = " SELECT n2.id,n2.devicename,n2.deviceIpAddr, n2.custom_Location, n2.connPort, n2.model, n2.systemname ";
    $sql_condition = " FROM nodes n2
                        WHERE trim(lower(REPLACE(n2.market,' ',''))) ='$market'";
    
    if ($search_term != '') {
        $sql_condition .= " AND ( ";
        $sql_condition .= "  n2.devicename LIKE '%". addslashes($search_term) ."%' " ;
        $sql_condition .= "  OR n2.deviceIpAddr LIKE '%". addslashes($search_term) ."%' " ;
        $sql_condition .= "  OR n2.market LIKE '%". addslashes($search_term) ."%' " ;
        $sql_condition .= "  OR n2.submarket LIKE '%". addslashes($search_term) ."%' " ;
        $sql_condition .= " ) ";
    }
    $count_sql = $sql_count .  $sql_condition  ;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $resultset['total_rec'] = $row[0];
    
    $sql = $sql_select . $sql_condition;
    $sql .= $pages->limit;
    // echo $sql;;
    //echo $sql; exit(0);
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
    
}


function export_table($table_name, $table_fields = array()) {
    
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
function getIpAddrMgmtList($userid){
    global $db2;
    $sql = "SELECT market,fromipvfour,toipvfour,fromipvsix,toipvsix FROM ipaddrmgmt as ipmgt ORDER BY ipmgt.id";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
function get_discovery_list_datatable($userid) {
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
        $sql_condition .=  " where ( ";
        $sql_condition .=  " n.scantime  LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.deviceipaddr  LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.ping  LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.deviceid  LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.deviceos  LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.nodeVersion  LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.deviceseries  LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.processed  LIKE '%". $search ."%'";
        $sql_condition .=  " ) ";
    }
    $count_sql = $sql_count . $sql_condition;
    //echo $count_sql;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    
    $total_rec = $row[0];
    
    
    $sql_order = "";
    if ($order_col != ''){
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != ''){
        $sql_order .= $order_dir != '' ? " $order_dir ": " asc ";
    }
    
    $sql_limit = " LIMIT $start, $length ";
    
    $sql = $sql_select . $sql_condition  . $sql_order . $sql_limit ;
    
    $db2->query($sql);
    $resultset['draw'] = $draw;
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'] ;
            $records[$key] = $value;
        }
        
        
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    }
    else {
        $resultset['data'] = array();
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] =0;
    }
    
    return $resultset;
}

function load_ipv_dataset($type){
    global $db2;
    $condition = ($type == 'ipv4') ? '.' : ':';
    $sql = "SELECT * FROM ipallocation  as ipa  where subnetmask like '%".$condition."%' and market !=''  ORDER BY ipa.id"; 
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
/*
function getipvfour_details($snm)
{
     $parts=explode("/",$snm);
     $exponent = 32 - $parts[1].'-';
     $count = pow(2,$exponent);
     $start = ip2long($parts[0]);
     $end = $start+$count;
     $ip['fromipvfour'] = long2ip($start) ;
     $ip['toipvfour'] = long2ip($end) ;
     $ip['count'] = $count;
     return $ip;
}
*/
function getipvfour_details($range){
    $range=rtrim($range);
    if (preg_match("/\//",$range)){  //if cidr type mask
        $dq_host = strtok("$range", "/");
        $cdr_nmask = strtok("/");
        if (!($cdr_nmask >= 0 && $cdr_nmask <= 32)){
            tr("Invalid CIDR value. Try an integer 0 - 32.");
            print "$end";
            exit ;
        }
        $bin_nmask=cdrtobin($cdr_nmask);
        $bin_wmask=binnmtowm($bin_nmask);
    } else { //Dotted quad mask?
        $dqs=explode(" ", $range);
        $dq_host=$dqs[0];
        $bin_nmask=dqtobin($dqs[1]);
        $bin_wmask=binnmtowm($bin_nmask);
        if (preg_match("/0/",rtrim($bin_nmask, "0"))) {  //Wildcard mask then? hmm?
            $bin_wmask=dqtobin($dqs[1]);
            $bin_nmask=binwmtonm($bin_wmask);
            if (preg_match("/0/",rtrim($bin_nmask, "0"))){ //If it's not wcard, whussup?
                print("Invalid Netmask.");
                print "$end";
                exit ;
            }
        }
        $cdr_nmask=bintocdr($bin_nmask);
    }
    
    //Check for valid $dq_host
    if(! preg_match('/^0./',$dq_host)){
        foreach( explode(".",$dq_host) as $octet ){
            if($octet > 255){
                print("Invalid IP Address");
                print $end ;
                exit;
            }
            
        }
    }
    
    $bin_host=dqtobin($dq_host);
    $bin_bcast=(str_pad(substr($bin_host,0,$cdr_nmask),32,1));
    $bin_net=(str_pad(substr($bin_host,0,$cdr_nmask),32,0));
    $bin_first=(str_pad(substr($bin_net,0,31),32,1));
    $bin_last=(str_pad(substr($bin_bcast,0,31),32,0));
    $host_total=(bindec(str_pad("",(32-$cdr_nmask),1)) - 1);
    
    if ($host_total <= 0){  //Takes care of 31 and 32 bit masks.
        $bin_first="N/A" ; $bin_last="N/A" ; $host_total="N/A";
        if ($bin_net === $bin_bcast) $bin_bcast="N/A";
    }
    
    //Determine Class
    if (preg_match('/^0/',$bin_net)){
        $class="A";
        $dotbin_net= "<font color=\"Green\">0</font>" . substr(dotbin($bin_net,$cdr_nmask),1) ;
    }elseif (preg_match('/^10/',$bin_net)){
        $class="B";
        $dotbin_net= "<font color=\"Green\">10</font>" . substr(dotbin($bin_net,$cdr_nmask),2) ;
    }elseif (preg_match('/^110/',$bin_net)){
        $class="C";
        $dotbin_net= "<font color=\"Green\">110</font>" . substr(dotbin($bin_net,$cdr_nmask),3) ;
    }elseif (preg_match('/^1110/',$bin_net)){
        $class="D";
        $dotbin_net= "<font color=\"Green\">1110</font>" . substr(dotbin($bin_net,$cdr_nmask),4) ;
        $special="<font color=\"Green\">Class D = Multicast Address Space.</font>";
    }else{
        $class="E";
        $dotbin_net= "<font color=\"Green\">1111</font>" . substr(dotbin($bin_net,$cdr_nmask),4) ;
        $special="<font color=\"Green\">Class E = Experimental Address Space.</font>";
    }
    
    if (preg_match('/^(00001010)|(101011000001)|(1100000010101000)/',$bin_net)){
        $special='<a href="http://www.ietf.org/rfc/rfc1918.txt">( RFC-1918 Private Internet Address. )</a>';
    }
    
    return array_map('long2ip', range(ip2long(bintodq($bin_first)), ip2long(bintodq($bin_last))));
}


function binnmtowm($binin){
    $binin=rtrim($binin, "0");
    if (!preg_match("/0/",$binin) ){
        return str_pad(str_replace("1","0",$binin), 32, "1");
    } else return "1010101010101010101010101010101010101010";
}

function bintocdr ($binin){
    return strlen(rtrim($binin,"0"));
}

function bintodq ($binin) {
    if ($binin=="N/A") return $binin;
    $binin=explode(".", chunk_split($binin,8,"."));
    for ($i=0; $i<4 ; $i++) {
        $dq[$i]=bindec($binin[$i]);
    }
    return implode(".",$dq) ;
}

function bintoint ($binin){
    return bindec($binin);
}

function binwmtonm($binin){
    $binin=rtrim($binin, "1");
    if (!preg_match("/1/",$binin)){
        return str_pad(str_replace("0","1",$binin), 32, "0");
    } else return "1010101010101010101010101010101010101010";
}

function cdrtobin ($cdrin){
    return str_pad(str_pad("", $cdrin, "1"), 32, "0");
}

function dotbin($binin,$cdr_nmask){
    // splits 32 bit bin into dotted bin octets
    if ($binin=="N/A") return $binin;
    $oct=rtrim(chunk_split($binin,8,"."),".");
    if ($cdr_nmask > 0){
        $offset=sprintf("%u",$cdr_nmask/8) + $cdr_nmask ;
        return substr($oct,0,$offset ) . "&nbsp;&nbsp;&nbsp;" . substr($oct,$offset) ;
    } else {
        return $oct;
    }
}

function dqtobin($dqin) {
    $dq = explode(".",$dqin);
    for ($i=0; $i<4 ; $i++) {
        $bin[$i]=str_pad(decbin($dq[$i]), 8, "0", STR_PAD_LEFT);
    }
    return implode("",$bin);
}

function inttobin ($intin) {
    return str_pad(decbin($intin), 32, "0", STR_PAD_LEFT);
}



function getipvsix_details($range){
    // Split in address and prefix length
    list($firstaddrstr, $prefixlen) = explode('/', $range);
    
    // Parse the address into a binary string
    $firstaddrbin = inet_pton($firstaddrstr);
    
    // Convert the binary string to a string with hexadecimal characters
    # unpack() can be replaced with bin2hex()
    # unpack() is used for symmetry with pack() below
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
    # Using pack() here
    # Newer PHP version can use hex2bin()
    $lastaddrbin = pack('H*', $lastaddrhex);
    
    // And create an IPv6 address from the binary string
    $lastaddrstr = inet_ntop($lastaddrbin);
    
    // Report to user
    $ip['fromipvsix'] = $firstaddrstr ;
    $ip['toipvsix'] = $lastaddrstr ;
    $ip['count'] = (ipv6_numeric($lastaddrstr) - ipv6_numeric($firstaddrstr));
    return $ip;
}

function ipv6_numeric($ip) {
    $binNum = '';
    foreach (unpack('C*', inet_pton($ip)) as $byte) {
        $binNum .= str_pad(decbin($byte), 8, "0", STR_PAD_LEFT);
    }
    return base_convert(ltrim($binNum, '0'), 2, 10);
}

function cidrToRange($cidr) {
    $range = array();
    $cidr = explode('/', $cidr);
    $range[0] = long2ip((ip2long($cidr[0])) & ((-1 << (32 - (int)$cidr[1]))));
    $range[1] = long2ip((ip2long($range[0])) + pow(2, (32 - (int)$cidr[1])) - 1);
    return $range;
}
function ip_in_range( $ip, $range ) {
    if ( strpos( $range, '/' ) == false ) {
        $range .= '/32';
    }
    // $range is in IP/CIDR format eg 127.0.0.1/24
    list( $range, $netmask ) = explode( '/', $range, 2 );
    $range_decimal = ip2long( $range );
    $ip_decimal = ip2long( $ip );
    $wildcard_decimal = pow( 2, ( 32 - $netmask ) ) - 1;
    $netmask_decimal = ~ $wildcard_decimal;
    return ( ( $ip_decimal & $netmask_decimal ) == ( $range_decimal & $netmask_decimal ) );
}
        
function get_nodes_list_ipmgmt($region,$market,$subnetmask) {
	  global $db2;
	 // echo 'value of region'.$region.'market'.$market.'subnetmask'.$subnetmask.'<br>';	   
	  $ipvfour_details = getipvfour_details($subnetmask);	
	$sql_select = "SELECT n.id, deviceIpAddr, n.devicename, n.csr_site_id, n.csr_site_name, n.deviceseries, n.deviceos, n.nodeVersion,n.lastpolled "; 
	$sql_condition = " FROM  nodes n
                     WHERE n.market = '$market' and n.region = '$region'
                    ";
    $sql = $sql_select . $sql_condition;
	//echo '<br>'.$sql.'<br>';
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset['result'];
}
function get_nodes_list_ipmgmtv6($region,$market,$subnetmask) {
    global $db2;
    $sql_select = "SELECT n.id, deviceIpAddr, n.devicename, n.csr_site_id, n.csr_site_name, n.deviceseries, n.deviceos, n.nodeVersion,n.lastpolled ";
    $sql_condition = " FROM  nodes n
                     WHERE n.market = '$market' and n.region = '$region'
                    ";
    $sql = $sql_select . $sql_condition;
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    $ip = getipvsix_details($subnetmask);
    foreach ($resultset['result'] as $key => $val){
        if(filter_var($val['deviceIpAddr'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) && ($val['deviceIpAddr'] <= $ip['toipvsix'] && $ip['fromipvsix'] <= $val['deviceIpAddr']) ){
            $outputres[] = $val;
        }
    }
    return $outputres;
}
function get_ipallocation_region_list(){
    global $db2;
    $sql = "select distinct(region) from ipallocation order by region";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

function get_ipallocation_market_list($region){
    global $db2;
    $sql = "select distinct(market) from ipallocation where region = '".$region."' order by market";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
function insert_ip_allocation($values){
    global $db2;
    $sql = "INSERT INTO ipallocation (cust_gvn_region, region, market, subnetmask)
				VALUES ('".$values[cust_gvn_region]."','".$values[region]."','".$values[market]."','".$values[subnetmask]."')";
    
    $db2->query($sql);
    $db2->execute();
}
function load_discovery_dataset($class = 'C'){
    global $db2;
    $sqlm = "select GROUP_CONCAT(DISTINCT(CONCAT('''', (market), '''' ))) as market from nodes where csr_site_tech_id like '".$_SESSION['username']."'";
    $db2->query($sqlm);
    $mrecordset = $db2->resultset();
    if(isset($mrecordset[0]['market'])){
        $market = $mrecordset[0]['market'];
        $sql = "SELECT * FROM discoveryres where class ='".strtolower($class)."' AND market in (".$market.") ORDER BY id";
        $db2->query($sql);
        $resultset['result'] = $db2->resultset();
        return $resultset;
    }else{
        return '';
    }
}
function discovery_status_update($status, $id){
    global $db2;
    if($id != 0){
        $sql = "UPDATE `discoveryres` SET class = 'd' WHERE id = '".$id."' AND class = '".$status."'";
    }else{
        $sql = "UPDATE `discoveryres` SET class = 'd' WHERE class = '".$status."'";
    }
    $db2->query($sql);
    $db2->execute();
    return success;
}
function test_ipv6_address($ipaddress = ''){
    return filter_var($ipaddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
}
function discovery_add_new_device($values){
    global $db2;
    $sqlc = "SELECT  max(id) + 1  as id FROM nodes WHERE id <> 0 ";
    $db2->query($sqlc);
    $recordset = $db2->resultset();
    $values['id'] = $recordset[0]['id'];
    $sql = "INSERT INTO nodes (id, region, market, devicename, deviceIpAddr, nodeAddedBy, nodeCatId, vendorId, deviceseries, status, 
            csr_site_tech_name, csr_site_tech_mgr_name, csr_site_id, systemname, deviceos, csr_site_tech_id, csr_site_tech_mgr_id,
            csr_site_name, nodeVersion, lastpolled, deviceDateAdded, deviceLastUpdated, upsince, switch_name, submarket)
				VALUES (
                ".$values['id'].",'".$values['region']."','".$values['market']."','".$values['devicename']."','".$values['deviceIpAddr']."',
                '".$values['nodeAddedBy']."','".$values['nodeCatId']."','".$values['vendorId']."','".$values['deviceseries']."','".$values['status']."',
                '".$values['csr_site_tech_name']."','".$values['csr_site_tech_mgr_name']."','".$values['csr_site_id']."','".$values['systemname']."',
                '".$values['deviceos']."','".$values['csr_site_tech_id']."', '".$values['csr_site_tech_mgr_id']."','".$values['csr_site_name']."',
                '".$values['nodeVersion']."', '".$values['lastpolled']."', '".$values['deviceDateAdded']."', '".$values['deviceLastUpdated']."',    
                '".$values['upsince']."','".$values['switch_name']."','')";
    $db2->query($sql);
    $db2->execute();
}
function get_managers(){
    global $db2;
    $sql = "SELECT distinct(csr_site_tech_mgr_id),csr_site_tech_mgr_name FROM nodes ORDER BY csr_site_tech_mgr_name";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
function get_csr_technames(){
    global $db2;
    $sql = "SELECT distinct(csr_site_tech_id),csr_site_tech_name FROM nodes ORDER BY csr_site_tech_name";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

function get_csr_site_tech_mgr_id($username){
    global $db2;
    $sql = "SELECT distinct(csr_site_tech_mgr_id),csr_site_tech_mgr_name FROM nodes where csr_site_tech_id = '".$username."' ORDER BY csr_site_tech_mgr_name";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

function generic_get_categories(){
    global $db2;
    $sql = "SELECT id,categoryName FROM categories where status = 1 ORDER BY categoryName";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
function generic_get_vendors(){
    global $db2;
    $sql = "SELECT id,vendorName FROM vendors  where status = 1 ORDER BY vendorName";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
function generic_get_site_ids(){
    global $db2;
    $sql = "SELECT distinct(csr_site_id) FROM nodes ORDER BY csr_site_id";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
function generic_get_csr_site_names(){
    global $db2;
    $sql = "SELECT distinct(csr_site_name) FROM nodes ORDER BY csr_site_name";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
function generic_get_csr_switch_names(){
    global $db2;
    $sql = "SELECT distinct(switch_name) FROM nodes ORDER BY switch_name";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
function generic_get_region(){
    global $db2;
    $sql = "SELECT distinct(region) FROM nodes ORDER BY region";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
function generic_get_market(){
    global $db2;
    $sql = "SELECT distinct(market) FROM nodes ORDER BY market";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
function generic_get_market_by_region($region){
    global $db2;
    $sql = "SELECT distinct(market) FROM nodes where region like '".$region."' ORDER BY market";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
function generic_get_deviceseries(){
    global $db2;
    $sql = "SELECT distinct(deviceseries) FROM nodes ORDER BY deviceseries";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
function generic_get_switch_name(){
    global $db2;
    $sql = "SELECT distinct(switch_name) FROM nodes ORDER BY switch_name";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
function generic_get_switch_name_by_region_market($region = '', $market = ''){
    global $db2;
    
    $sql_condition = 'where 1';
    
    if(!empty($region))
        $sql_condition .= " AND region like '".$region."' ";
    
    if(!empty($market))
        $sql_condition .= " AND market like '".$market."' ";
        
    $sql = "SELECT distinct(switch_name) FROM nodes ".$sql_condition." ORDER BY switch_name";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
function generic_get_switch_name_by_market($market){
    global $db2;
    $sql = "SELECT distinct(switch_name) FROM nodes where REPLACE(market,' ','') = '".str_replace(' ','',$market)."' ORDER BY switch_name";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
/*nodeVersion or OSVersion*/
function generic_get_nodeVersion(){
    global $db2;
    $sql = "SELECT distinct(nodeVersion) FROM nodes ORDER BY nodeVersion";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}
function generic_get_market_by_username($username){
    global $db2;
    $sql = "SELECT distinct(market) FROM nodes where csr_site_tech_id = '".$username."' ORDER BY market";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset;
}

function generic_get_csr_site_tech_name($query){
    global $db2;
    $sql = "SELECT distinct(csr_site_tech_name) FROM nodes WHERE csr_site_tech_name LIKE '".$query."%'";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    foreach ($resultset['result'] as $key => $val){
        $Result[] = $val["csr_site_tech_name"];
    }
    return json_encode($Result);
}

function generic_get_usernames_ac($query){
    global $db2;
    $sql = "SELECT distinct(username) FROM users WHERE username LIKE '".$query."%'";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    foreach ($resultset['result'] as $key => $val){
        $Result[] = $val["username"];
    }
    return json_encode($Result);
}

function generic_get_usernames_ac_fn_ln_ro($query){
    global $db2;
    $sql = "SELECT u.fname, u.lname, ul.userlevel FROM users u, userlevels ul WHERE (u.fname LIKE '%".$query."%' OR u.lname LIKE '%".$query."%' OR ul.userlevel LIKE '%".$query."%') AND u.userlevel = ul.id";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    foreach ($resultset['result'] as $key => $val){
        $Result[] = $val["fname"].' '.$val["lname"].' <'.$val["userlevel"].'>';
    }
    return json_encode($Result);
}

function get_csr_site_names($region, $market){
    global $db2;
    $sql = "SELECT distinct(csr_site_name) FROM nodes where region like '".$region."' AND market like '".$market."' ORDER BY csr_site_name"; 
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    foreach ($resultset['result'] as $key => $val){
        $Result[] = $val["csr_site_name"];
    }
    return json_encode($Result);
}

function get_csr_tech_mgr_name_from_tech_name($csr_tech_name){
    global $db2;
    $db2->query( "SELECT csr_site_tech_mgr_name, csr_site_tech_mgr_id, csr_site_tech_id  FROM nodes WHERE csr_site_tech_name='" .$csr_tech_name ."'");
    $resultset['result'] = $db2->resultset();
    foreach ($resultset['result'] as $key => $val){
        $Result['csr_site_tech_mgr_id'] = $val['csr_site_tech_mgr_id'];
        $Result['csr_site_tech_mgr_name'] = $val["csr_site_tech_mgr_name"];
        $Result['csr_site_tech_id'] = $val["csr_site_tech_id"];
    }
    return json_encode($Result);
}
function get_csr_tech_mgr_id_from_tech_id($csr_tech_id){
    global $db2;
    $db2->query( "SELECT csr_site_tech_mgr_id FROM nodes WHERE csr_site_tech_id='" .$csr_tech_id ."'");
    $row = $db2->resultsetCols();
    return $row[0];
}
function get_csr_site_id_from_csr_site_name($csr_site_name){
    global $db2;
    $db2->query( "SELECT csr_site_id FROM nodes WHERE csr_site_name='" .$csr_site_name ."'");
    $row = $db2->resultsetCols();
    return $row[0];
}
function process_missed_ip($ip_address, $process){
    global $db2;
    if($process == 'OK' && !empty($ip_address)){
        $sql = "UPDATE `discoveryres` SET class = 'k' WHERE deviceIpAddr = '".$ip_address."'";
        $db2->query($sql);
        $db2->execute();
    }elseif ($process == 'Remove' && !empty($ip_address)){
        $sql = "UPDATE `discoveryres` SET class = 'd' WHERE deviceIpAddr = '".$ip_address."'";
        $db2->query($sql);
        $db2->execute();
        $sql = "DELETE FROM nodes WHERE deviceIpAddr = '".$ip_address."'";
        $db2->query($sql);
        $db2->execute();
    }
    return success;
}
function upload_file_to_disk($trigger, $path, $allowed_ext = array('jpg','jpeg','png','gif'), $append = ''){
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST[$trigger]) && $_POST[$trigger] == 'Upload') {
        $name     = $_FILES['file']['name'];
        $tmpName  = $_FILES['file']['tmp_name'];
        $error    = $_FILES['file']['error'];
        $size     = $_FILES['file']['size'];
        $ext	  = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        
        switch ($error) {
            case UPLOAD_ERR_OK:
                $valid = true;
                //validate file extensions
                if ( !in_array($ext, $allowed_ext) ) {
                    $valid = false;
                    $response = 'Invalid file extension.';
                }
                //validate file size
                if ( $size/1024/1024 > 2 ) {
                    $valid = false;
                    $response = 'File size is exceeding maximum allowed size.';
                }
                //upload file
                if ($valid) {
                    $targetPath =  dirname( __FILE__ ) . DIRECTORY_SEPARATOR. 'uploads' . DIRECTORY_SEPARATOR. $path . DIRECTORY_SEPARATOR. $append.'_config.txt';    
                    move_uploaded_file($tmpName,$targetPath);
                    return true;
                    exit;
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
    }else{
        $response = 'Required parameter is missing.';
        return $response;
    }
}
function generateRandomString($length = 10) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function get_device_list_from_backuprestore_datatable($userid, $listname = '') {
    
    global $db2, $pages;
    
    //print_r($_GET);
    $draw = $_GET['draw'];
    $start = isset($_GET['start']) ? $_GET['start'] : 0;
    $length = isset($_GET['length']) ? $_GET['length'] : 10;
    $search = trim($_GET['search']['value']) ? addslashes(trim($_GET['search']['value'])) : null;
    $order_col = $_GET['order'][0]['column'];
    $order_dir = $_GET['order'][0]['dir'];
    
    $columns = array(
        'distinct(n.id)',
        'n.csr_site_id',
        'n.csr_site_name',
        'n.devicename',
		'n.region',
        'n.market',
        'n.deviceseries',
        'n.nodeVersion'        
    ); 
    $sql_count = "SELECT COUNT(distinct(n.id)) ";
    $sql_select = "SELECT " . implode(", ", $columns);
    
    $sql_condition = " FROM userdevices ud
       JOIN nodes n on ud.nodeid = n.id
       WHERE ud.userid = " . $userid ;
    
    if($listname != ''){
       $sql_condition .= " AND(ud.listname = '".$listname."')";
    }
    //die;
    
    if ($search) {
        $sql_condition .=  " AND ( ";
        $sql_condition .=  " n.devicename LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.csr_site_id  LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.csr_site_name  LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.market  LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.deviceseries  LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.nodeVersion  LIKE '%". $search ."%'";
        $sql_condition .=  " OR n.lastpolled  LIKE '%". $search ."%'";
        $sql_condition .=  " ) ";
    }
    $count_sql = $sql_count . $sql_condition;
    // echo $count_sql;
    $db2->query($count_sql);
    $row = $db2->resultsetCols();
    
    $total_rec = $row[0];
    
    
    $sql_order = "";
    if ($order_col != ''){
        $sql_order = " ORDER BY " . $columns[$order_col];
    }
    
    if ($order_dir != ''){
        $sql_order .= $order_dir != '' ? " $order_dir ": " asc ";
    }
    
    $sql_limit = " LIMIT $start, $length ";
    
    $sql = $sql_select . $sql_condition  . $sql_order . $sql_limit ;
    // echo '<br>';
    // echo $sql;
    
    $db2->query($sql);
    
    
    $resultset['draw'] = $draw;
    
    if ($db2->resultset()) {
        foreach ($db2->resultset() as $key => $value) {
            $value['DT_RowId'] = "row_" . $value['id'] ;
            $records[$key] = $value;
        }
        $resultset['data'] = $records;
        $resultset['recordsTotal'] = $total_rec;
        $resultset['recordsFiltered'] = $total_rec;
    }
    else {
        $resultset['data'] = array();
        $resultset['recordsTotal'] = 10;
        $resultset['recordsFiltered'] =0;
    } 
    return $resultset;
} 
function get_celltechusers_list($userid){
    global $db2;
    $sql = "select distinct(listid), listname from userdevices where userid=".$userid;
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return  $resultset['result'];
}

function get_switchtechusers_list($userid){
    global $db2;
    $sql = "select distinct(listid), listname from userdevices where userid=".$userid;
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return  $resultset['result'];
}

function update_login_api_rules($sso_flag,$username){
    global $db2;
     //$_SESSION['userlevel'] = 2; 
     echo "inside the update_login_api".$username.$ssoflag.$_SESSION['userlevel'];
     if (in_array($_SESSION['userlevel'], array(1,3,4))) {
        //$output = @file_get_contents('http://txsliopsa1v.nss.vzwnet.com:8080/site/devices/user/'.$username.'/csrinfo');
		$output = @file_get_contents('http://localhost/oneemstest/login_response_celltech_user.php');
     } elseif (in_array($_SESSION['userlevel'], array(2,5,6,7))) {
	//$output = 'https://nssapigateway.vh.vzwnet.com/iop/switchbytech/v1.0.0/switch/tech/'.$username.''';	
        //$output = @file_get_contents('https://ohtwoemsda3z.nss.vzwnet.com/oneemstest/login_response_switchtech_user.php');
         $output = @file_get_contents('http://localhost/oneemstest/login_response_switchtech_user.php?username='.$username);
		 // $output = 'https://nssapigateway.vh.vzwnet.com/iop/switchbytech/v1.0.0/switch/tech/'.$username.''';	
       // $output ='https://nssapigateway.vh.vzwnet.com/iop/switchbytech/v1.0.0/switch/tech/'.$username;         
		//print_r($output); 
        //echo 'reach here 123';
       // exit();
	     //echo "reach here";
	    //header("Location: index.php");        
		//exit();
     };
     
     if (in_array($_SESSION['userlevel'], array(1,3,4))) {
        $resp_result_arr = json_decode($output, 1);
        $_SESSION['sel_switch_name']  = '';
        $swt_mswitch_arr = array();
        for($i=0; $i <= count($resp_result_arr['site_devices']); $i++){
            if(count($resp_result_arr['site_devices'][$i]['csr_hostnames']) > 0){
                foreach ($resp_result_arr['site_devices'][$i]['csr_hostnames'] as $key => $val){
                    $_SESSION['sel_switch_name'] = ($_SESSION['sel_switch_name'] == '') ? $resp_result_arr['site_devices'][$i]['switch'] : $_SESSION['sel_switch_name'];
                    $records_to_update[] =  array('devicename' => $val, 'csr_site_tech_name' => $resp_result_arr['site_devices'][$i]['techname'], 'switch_name' => $resp_result_arr['site_devices'][$i]['switch'], 'csr_site_id' => $resp_result_arr['site_devices'][$i]['siteid']);
                    //Node table status 3 added for live API active
                    $sql = "UPDATE `nodes` SET csr_site_tech_name = '".$resp_result_arr['site_devices'][$i]['techname']."', switch_name ='".$resp_result_arr['site_devices'][$i]['switch']."', csr_site_id ='".$resp_result_arr['site_devices'][$i]['siteid']."', status=3 WHERE devicename = '".$val."'";
                    $db2->query($sql);
                    $db2->execute();
                    if(!in_array($resp_result_arr['site_devices'][$i]['switch'], $swt_mswitch_arr)){
                        $swt_mswitch_arr[] = $resp_result_arr['site_devices'][$i]['switch'];
                    }                    
                }
            }
        }
        $_SESSION['swt_mswitch_arr'] = $swt_mswitch_arr;
     } elseif (in_array($_SESSION['userlevel'], array(2,5,6,7))) {
        $resp_result_arr = json_decode($output, 1);
        $_SESSION['sel_switch_name']  = '';
        for($i=0; $i <= count($resp_result_arr['switches']); $i++){
            $_SESSION['sel_switch_name'] = ($_SESSION['sel_switch_name'] == '') ? $resp_result_arr['switches'][$i]['switch_name'] : $_SESSION['sel_switch_name'];
            //Node table status 3 added for live API active
            $sql = "UPDATE `nodes` SET status=3 WHERE switch_name = '".$resp_result_arr['switches'][$i]['switch_name']."'";
            $db2->query($sql);
            $db2->execute();
            $swt_mswitch_arr[] = $resp_result_arr['switches'][$i]['switch_name'];
        }
        $_SESSION['swt_mswitch_arr'] = $swt_mswitch_arr;
        
        
        $sql = "SELECT id, username from users";
        //$sql = $sql_select . $sql_condition;
        $db2->query($sql);
        $resultset['result'] = $db2->resultset();
        foreach ($resultset['result'] as $resultsetku => $resultsetvu){
            $users[$resultsetvu['username']] = $resultsetvu['id'];
        }
        
        
        /* Updating user devices table based on switch from API */
        foreach ($swt_mswitch_arr as $key => $val){
            $sql = "DELETE FROM userdevices WHERE listname='".$val."'";
            $db2->query($sql);
            $db2->execute();
            
            $sql = " SELECT * from nodes where status=3 and switch_name = '".$val."'";
            $db2->query($sql);
            $resultset['result'] = $db2->resultset();
            $sql = "SELECT  max(listid) + 1  as listidmaxval FROM userdevices WHERE listid <> 0 ";
            $db2->query($sql);
            $recordset = $db2->resultset();
            $listid = $recordset[0]['listidmaxval'];
            $oc = 1;
            $dsql = 'INSERT INTO `userdevices` (`nodeid`, `userid`, `listid`, `listname`) VALUES';
            foreach ($resultset['result'] as $resultsetk => $resultsetv){
                if(count($resultset['result']) == $oc){
                    //$dsql .= "('".$resultsetv['id']."',".$users[$resultsetv['swt_tech_id']].",'".$listid."','".$resultsetv['switch_name']."')";
					$dsql .= "('".$resultsetv['id']."',".$users[$_SESSION['username']].",'".$listid."','".$resultsetv['switch_name']."')";
                }else{
                    //$dsql .= "('".$resultsetv['id']."',".$users[$resultsetv['swt_tech_id']].",'".$listid."','".$resultsetv['switch_name']."'),";
					$dsql .= "('".$resultsetv['id']."',".$users[$_SESSION['username']].",'".$listid."','".$resultsetv['switch_name']."'),";
                }
                $oc++;
            }
            if($oc > 1){
                $db2->query($dsql);
                $db2->execute();
            }
            
            
        }
    }
}

function get_landing_page_sso($username,$eid,$email,$fname,$lname,$vzid) {
    echo 'inside the get_landing_page_sso function'.$username,$eid,$email,$fname,$lname,$vzid.'<br>';
/*

    $userinfo = array('id'=>159,'username' => $username,'userlevel'=>1,'fname'=>$fname,'lname'=>$lname');
    $userinfo['id']  = 159;
    $userinfo['username']  = $username;
    $userinfo['userlevel'] = 1;
    $userinfo['fname']  = $fname;
    $userinfo['lname']  = $lname;

    echo '<br>'."Username : $username, EID: $eid, EMAIL: $email, FIRSTNAME: $fname, LAST NAME :$lname,VZID: $vzid".'<br>';
    
    die;
    if (strtolower($username) == 'mohilpa' || strtolower($username) == 'edward') { // fieldsite technician
       $_SESSION['userlevel'] = "2" ;
    } else {
       $_SESSION['userlevel'] = "1" ;
    };   
    if ($_SESSION['userlevel'] === "1") { // fieldsite technician
        $userinfo = array('id' => 159,'username' => 'debarle','userlevel' =>'1','fname' => $fname, 'lname' => $lname);
    } elseif ($_SESSION['userlevel'] === "2") {
       $userinfo = array('id' => 503,'username' => 'swt_womaha','userlevel' =>'2','fname' => $fname, 'lname' => $lname);
    };
    
    */
    
    
    
    $_SESSION['userid'] = $userinfo['id'];
    $_SESSION['username'] = $userinfo['username'];
    $_SESSION['userlevel'] = $userinfo['userlevel'];
    $_SESSION['welcome_username'] = $userinfo['fname'] . ' ' . $userinfo['lname'];
    echo 'value of userlevel in session'.$_SESSION['userlevel'].'<br>';
    if (!$_SESSION['userlevel']) {
        return 'index.php';
    }
    else {
        if (in_array($_SESSION['userlevel'], array(1,3,4))) { // fieldsite technician
       //  echo 'inside the cellsite tech url';
            $location_href = "cellsitetech-dashboard.php";
        }
        if (in_array($_SESSION['userlevel'], array(2,5,6,7))) {
            $location_href = "switchtech-dashboard.php";
        }
        if (in_array($_SESSION['userlevel'], array(8))) {
            $location_href = "login-impersonate.php";
        }
     // echo '<br>'.'value of location href inside the function'.$location_href.'<br>';
        return $location_href;
    }
}
function load_backup_information($deviceid){
    global $db2;
    $sql = "select * from backup_information where deviceid=".$deviceid;
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return  $resultset['result'];
}
function load_available_templates($filename){
    global $db2;
    $filename_arr = explode('_',$filename);
    if(count($filename_arr) > 0){
        $condition = '';
        foreach ($filename_arr as $key => $val):
            if($condition == '' && isset($val)){
                $condition .= "templname like '%".$val."%'";
            }elseif($condition != ''  && isset($val)){
                $condition .= "AND templname like '%".$val."%'";
            }
        endforeach;
    }
    
    $sql = "SELECT distinct(templname) FROM configtemplate where $condition";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return  $resultset['result'];
}
	function getUser($name) {
			global $db2;	
			//$sql = "SELECT id, p.name, p.description, p.price, p.created FROM items p WHERE p.name LIKE '%".$name."%' ORDER BY p.created DESC";
				$sql = "select id, username, password, userlevel,fname,lname,phone from users p WHERE p.username = '".$name."'"; 
				$db2->query($sql);
			   $resultset['result'] = $db2->resultset();
				return  $resultset['result'];    
	}
			  //[username] => ssf [password] => k [usertype] => k [firstname] => k [lastname] => k [phoneno] => k [emailid] => k ) 
	function addUser($data) {
			global $db2;	
			$sql = "insert into users (username, password, userid, userlevel, email, fname, lname, phone ) values ('".$data['username']."','".md5($data['password'])."','".$data['username']."','".$data['usertype']."','".$data['emailid']."','".$data['firstname']."','".$data['lastname']."','".$data['phoneno']."')"; 
			 //$data = array("username" => $_POST['uname'],"password" => $_POST['passwd'],"usertype" => $_POST['usertype'],"firstname"=>$_POST['firstname'],"lastname" => $_POST['lname'],"phoneno" => $_POST['phoneno'],"emailid" => $_POST['emailid']);
			    //$sql = "insert into users ( username, password, userid, userlevel, email, fname, lname, phone ) values ('".$data['username']."''".$data['password']."''"..$data['userid']."''".$data['userlevel']."''".$data['email']."''".$data['fname']."''".$data['lname']."''".$data['phoneno']."')";
			   $db2->query($sql);
			   $result=$db2->execute();
			   
			    //$resultset['result'] = $db2->resultset();
				//return  $resultset['result'];    
				 return $result;
				  //$data = json_decode($data);
				 // echo $result;  
				 //print_r($data);
				 //echo json_encode($sql);
	} 
			 
	function deleteUser($data) {
		global $db2;	
		$sql = "delete from users where username = '".$data['username']."'";  
		$db2->query($sql);
		$result=$db2->execute(); 
		return $result; 
			
	}  
	
	/*function getconfigtempldpdwntbl() {
		global $db2;
		$sql = "SELECT * FROM configtempldpdwntbl";
		$db2->query($sql);
		$resultset['result'] = $db2->resultset();
		return $resultset;
			
	}
	*/
	function getconfigtempldpdwntbl($table, $order = 'desc') {
	    global $db2;
	    $sql = "SELECT * FROM ".$table." order by `".$order."` asc";
	    $db2->query($sql);
	    $resultset['result'] = $db2->resultset();
	    return $resultset;
	}
	
	
	
	
	
	function getconfigtemplscriptddwntbl() {
		global $db2;
		$sql = "SELECT * FROM configtmpscriptddwntbl";
		$db2->query($sql);
		$resultset['result'] = $db2->resultset();
		return $resultset;
			
	}
	function select_healthchk_info($deviceid){
	    global $db2;
	    $sql = "SELECT * FROM healthcheck where deviceid = $deviceid";
	    $db2->query($sql);
	    $resultset = $db2->resultset();
	    return $resultset[0];
	}
	function config_get_templates(){
	    global $db2;
	    $sql = "SELECT distinct templname FROM configtemplate order by templname asc";
	    $db2->query($sql);
	    $resultset = $db2->resultset();
	    return $resultset;
	}
	function check_templname_already_exist($templname){
	    global $db2;
	    $sql = "SELECT count(*) as cnt FROM configtemplate where templname = '".$templname."'";
	    $db2->query($sql);
	    $resultset = $db2->resultset();
	    return $resultset;
	}
	function check_subnet_already_exist($ipaddress){
	    global $db2;
	    $sql = "SELECT count(*) as cnt FROM ipallocation where subnetmask = '".$ipaddress."'";
	    $db2->query($sql);
	    $resultset = $db2->resultset();
	    return $resultset;
	}
	function delete_templname_already_exist($templname){
	    global $db2;
	    $sql = "DELETE FROM configtemplate where templname = '".$templname."'";
	    $db2->query($sql);
	    $db2->execute();
	}
	function config_get_templates_from_templname($templname){
	    global $db2;
	    $sql = "SELECT distinct(elemid),elemvalue, editable FROM configtemplate where templname='$templname' order by elemid asc";
	    $db2->query($sql);
	    $resultset = $db2->resultset();
	    return $resultset;
	}
	function update_healthchk_info($deviceid, $output, $lastupdated){
	    global $db2;
	    if(count($output) > 0 && isset($output)):
    	    $cols = array();
    	    foreach($output as $key=>$val) {
    	        $val = json_encode($val);
    	        $cols[] = "$key = '$val'";
    	    }
    	    $sql = "UPDATE  `healthcheck` SET " . implode(', ', $cols) . ",lastupdated='".$lastupdated."' WHERE deviceid = '".$deviceid."'";
    	    $db2->query($sql);
    	    $db2->execute();
	    endif;
	}
	function insertorupdate_healthchk_info($deviceid, $output, $lastupdated){
	    global $db2;
	    if(count($output) > 0 && isset($output)):
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
	    $fivethsndbyteping = json_encode($output['fivethsndbyteping']);
	    $logentries = json_encode($output['logentries']);
	    $xconnect = json_encode($output['xconnect']);
	    $lightlevel = json_encode($output['lightlevel']);
	    $userid = 1;
	    if($recordset[0]['id'] == ""){
	        $sql = "INSERT INTO `healthcheck` (`deviceid`, `cpuutilization`, `freememory`, `buffers`, `iosversion`, `bootstatement`, `configregister`, `environmental`, `platform`, `bfdsession`, `interfacestates`, `interfacecounters`, `mplsinterfaces`, `mplsneighbors`, `bgpvfourneighbors`, `bgpvsixneighbours`, `ran`, `bgpvsixroutes`, `twothsndbyteping`, `fivethsndbyteping`, `logentries`, `xconnect`, `lightlevel`, `userid`, `lastupdated` ) 
            VALUES($deviceid, '".$cpuutilization."','".$freememory."','".$buffers."','".$iosversion."','".$bootstatement."','".$configregister."',
            '".$environmental."','".$platform."','".$bfdsession."','".$interfacestates."','".$interfacecounters."','".$mplsinterfaces."',
            '".$mplsneighbors."','".$bgpvfourneighbors."','".$bgpvsixneighbours."','".$ran."','".$bgpvsixroutes."','".$twothsndbyteping."',
            '".$fivethsndbyteping."','".$logentries."','".$xconnect."','".$lightlevel."',$userid,'".$lastupdated."')";
	        $db2->query($sql);
	        $db2->execute();
	    }else{
	        $sql = "UPDATE `healthcheck` SET cpuutilization='".$cpuutilization."', freememory='".$freememory."', buffers='".$buffers."', iosversion='".$iosversion."', bootstatement='".$bootstatement."', configregister='".$configregister."', environmental='".$environmental."',
            platform='".$platform."', bfdsession='".$bfdsession."', interfacestates='".$interfacestates."', interfacecounters='".$interfacecounters."', mplsinterfaces='".$mplsinterfaces."', mplsneighbors='".$mplsneighbors."', bgpvfourneighbors='".$bgpvfourneighbors."', 
            bgpvsixneighbours='".$bgpvsixneighbours."', ran='".$ran."', bgpvsixroutes='".$bgpvsixroutes."', twothsndbyteping='".$twothsndbyteping."', fivethsndbyteping='".$fivethsndbyteping."', logentries='".$logentries."', xconnect='".$xconnect."',
            lightlevel='".$lightlevel."', lastupdated='".$lastupdated."' WHERE deviceid = '".$deviceid."'";
	        $db2->query($sql);
	        $db2->execute();
	    }
	    endif;
	}
	function delete_ipallocation_by_subnet($region, $subnetmask){
        global $db2;
        $sql = "DELETE FROM ipallocation WHERE region='$region' and subnetmask='$subnetmask'";
        $db2->query($sql);
        $db2->execute();
    }
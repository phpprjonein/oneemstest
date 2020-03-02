<?php
header("Content-Type: application/json; charset=UTF-8");
include 'classes/db2.class.php';

function sendResponse ($result)
{
    echo json_encode($result);
    exit();
}

function get_user_info ($username, $password)
{
    global $db2;
    if (trim($username) != '' && trim($password) != '') {
        $password = md5($password);
        $sql = "SELECT u.*,ul.userlevel as role FROM users u, userlevels ul WHERE u.username='" .
                $username .
                "' AND
        u.password='" .
                $password . "' AND ul.id = u.userlevel AND u.status = 1";
        $db2->query($sql);
        $rows = $db2->resultset();
        $result = $rows[0];
        return $result;
    }
    return false;
}

function get_celltechusers_list ($userid)
{
    global $db2;
    $sql = "select distinct(listid), listname from userdevices where userid=" .
            $userid;
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return $resultset['result'];
}
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

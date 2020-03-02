<?php
ini_set('display_errors', 1);
include 'config/global.php';
include 'model/db.php';
if($_POST['action'] == 'backup' && $_POST['function'] == 'get_celltechusers_list'){
    $result = get_celltechusers_list($_POST['userid']);
    sendResponse($result);
}
if($_POST['action'] == 'backup' && $_POST['function'] == 'get_device_list_from_backuprestore_datatable'){
    $result = get_device_list_from_backuprestore_datatable($_POST['userid'],$_POST['listname']);
    sendResponse($result);
}
if($_POST['action'] == 'backup' && $_POST['function'] == 'get_device_list_from_nodes_datatable'){
    $result = get_device_list_from_nodes_datatable($_POST['userid']);
    sendResponse($result);
}
?>
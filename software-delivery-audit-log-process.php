<?php
include "classes/db2.class.php";
include 'functions.php';
onerr();
if(!isset($_GET['type'])){
    $userid = $_SESSION['userid'];
    $swdelvry_dev_list = swt_get_auditlog_batch_process_datatable($userid, $_GET['listname'], $_GET['deviceseries']);
    exit(json_encode($swdelvry_dev_list, 1));
}
if($_GET['type'] == 'audithistory'){
    $swdelvry_dev_list = get_audithistory_datatable();
    exit(json_encode($swdelvry_dev_list, 1));
}

<?php
include "classes/db2.class.php";
include 'functions.php';
ini_set('display_errors',1);
$backup_list = get_devicebatch_list_from_devicebatch_datatable();
exit(json_encode($backup_list, 1));
?>

<?php
include "classes/db2.class.php";
include 'functions.php';
ini_set('display_errors',1);
$userid = $_SESSION['userid'];
$class = $_GET['class'];
// $device_list = get_device_list_from_nodes($_SESSION['userid']);
$resultset = load_discovery_dataset_new($class);

exit(json_encode($resultset, 1));
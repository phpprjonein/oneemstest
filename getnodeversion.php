<?php
include "classes/db2.class.php";
$html = "";
$deviceseries = $_POST['dropdownValue'];
// $deviceseries = $_GET['dropdownValue'];
// echo 'hello';
$nodeversions = swrepo_get_nodeversions($deviceseries);
// print_r($nodeversions);
// echo 'hello';
foreach ($nodeversions as $val)
    $html .= '<option>' . $val['nodeVersion'] . '</option>';
echo $html;

// exit(json_encode($output));
function swrepo_get_nodeversions($deviceseries)
{
    global $db2;
    $sql = "SELECT distinct(nodeVersion) FROM swrepository where deviceseries  = '" . $deviceseries . "'";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}
?>							
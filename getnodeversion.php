<?php
include "classes/db2.class.php";
$html = '<option value="">- SELECT OS Version -</option>';
$deviceseries = $_POST['dropdownValue'];
// $deviceseries = $_GET['dropdownValue'];
// echo 'hello';
$nodeversions = swrepo_get_nodeversions($deviceseries);
//print_r($nodeversions); die;
// echo 'hello';
foreach ($nodeversions as $val)
    $html .= '<option>' . $val['newosversion'] . '</option>';
echo $html;

// exit(json_encode($output));
function swrepo_get_nodeversions($deviceseries)
{
    global $db2;
    $sql = "SELECT distinct(newosversion) FROM osrepository where deviceseries  = '" . $deviceseries . "' and newosversion != ''";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}
?>							
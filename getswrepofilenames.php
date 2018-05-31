<?php
include "classes/db2.class.php";
$html = "";
$deviceseries = $_POST['deviceseries'];
$nodeversion = $_POST['nodeversion'];
$swrepofilenames = swrepo_get_nodeversions($deviceseries, $nodeversion);
// print_r($nodeversions);
// echo 'hello';
foreach ($swrepofilenames as $val)
    $html .= '<option>' . $val['filename'] . '</option>';
echo $html;

// exit(json_encode($output));
function swrepo_get_nodeversions($deviceseries, $nodeversion)
{
    global $db2;
    $sql = "SELECT distinct(filename) FROM swrepository where deviceseries  = '" . $deviceseries . "'and nodeVersion = '" . $nodeversion . "'";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
}
?>							
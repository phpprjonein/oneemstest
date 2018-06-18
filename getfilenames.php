<?php
include "classes/db2.class.php";
$html = '<option value="">- SELECT File Name -</option>';
$deviceseries = $_POST['deviceseries'];
$nodeVersion = $_POST['nodeVersion'];

//echo $deviceseries.$nodeVersion;die;

// echo 'hello';
$filenames = swrepo_get_filenames($deviceseries, $nodeVersion);
//print_r($nodeversions); die;
// echo 'hello';
foreach ($filenames as $val)
    $html .= '<option>' . $val . '</option>';
echo $html;

// exit(json_encode($output));
function swrepo_get_filenames($deviceseries, $nodeVersion = '')
{
    global $db2;
    $sql = "SELECT distinct(filename) FROM osrepository where deviceseries  like '%" . $deviceseries . "%' and status != 'd'";

    if($nodeVersion != '')
       $sql .= " or newosversion like '%".$nodeVersion."%'";
    

    
    $db2->query($sql);
    $resultset = $db2->resultset();
    
    foreach ($resultset as $key => $val):
        $filenames_exp = explode('|',$val['filename']);
        foreach ($filenames_exp as $ikey => $ival):
            $filenames_arr[] = $ival;
        endforeach;    
    endforeach;
    return $filenames_arr;
}
?>							
<?php
include_once "classes/db2.class.php";
include_once 'functions.php';

ini_set('display_errors',1);

$output = @file_get_contents('http://localhost/oneemstest/'.$_SESSION['username'].'_callout_zone_list.php');
$resp_result_arr = json_decode($output, 1);
print '<pre>';
print_r($resp_result_arr['user']['prefs']['calloutzones']);

foreach ($resp_result_arr['user']['prefs']['calloutzones'] as $key=>$val):
//print $_SESSION['username'].'_callout_zone_'.$val.'_list.json'.'<br/>';
//echo ('calloutzonesAPI/'.$_SESSION['username'].'_callout_zone_'.$val.'_list.json');

echo ('http://localhost/oneemstest/calloutzonesAPI/'.$_SESSION['username'].'_callout_zone_'.$val.'_list.php');

$output_zones = @file_get_contents(urlencode('http://localhost/oneemstest/calloutzonesAPI/'.$_SESSION['username'].'_callout_zone_'.$val.'_list.php'));

print_r($output_zones);

$output_zones_resp_result_arr = json_decode($output_zones, 1);
print '<pre>';
print_r($output_zones_resp_result_arr);
print '<br><br><br><br><br>';
endforeach;

die;


?>
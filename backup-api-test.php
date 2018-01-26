<?php

$ftp_server = 'localhost';
$ftp_user_name = 'saravanan';
$ftp_user_pass = '123';
$row_region = 'greatlakes';
$row_market = 'opw';
$row_device_name = 'AKROOH20T1A-P-CI-0382-01';


// set up basic connection
$conn_id = ftp_connect($ftp_server);

// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// get contents of the current directory
$contents = ftp_nlist($conn_id, '/usr/apps/config/bkup/'.$row_region.'/'.$row_market.'/');

for($i=0; $i<count($contents);$i++){
    if(substr(basename($contents[$i]), 0, strlen($row_device_name)) === $row_device_name){
        echo basename($contents[$i]).'  '.date ("Y-m-d H:i:s", filemtime($contents[$i]));
        echo "<br>";
    }
}
?>


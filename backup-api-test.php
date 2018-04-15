<<<<<<< HEAD
<?php

$ftp_server = 'localhost';
$ftp_user_name = 'linuxnix';
$ftp_user_pass = 'linuxnix';
$row_region = 'GreatLakes';
$row_market = 'opw';
//$row_device_name = 'AKROOH20T1A-P-CI-0382-01';
$row_device_name = 'CTTPMIBGT1A-P-CI-0025-01';

echo "inside the backup -api-test.php file ";

// set up basic connection
$conn_id = ftp_connect($ftp_server);

// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
echo 'Value of login_result'.$login_result;
// get contents of the current directory
//$contents = ftp_nlist($conn_id, '/export/home/linuxnix/usr/apps/config/bkup/'.$row_region.'/');
//$contents = ftp_nlist($conn_id, '/export/home/linuxnix/');
$contents = ftp_nlist($conn_id, '/export/home/linuxnix/usr/apps/config/bakup/GreatLakes/');
print_r($contents);
for($i=0; $i<count($contents);$i++){
    if(substr(basename($contents[$i]), 0, strlen($row_device_name)) === $row_device_name){
        echo basename($contents[$i]).'  '.date ("Y-m-d H:i:s", filemtime($contents[$i]));
        echo "<br>";
    }
}
?>


=======
<?php

$ftp_server = 'localhost';
$ftp_user_name = 'linuxnix';
$ftp_user_pass = 'linuxnix';
$row_region = 'GreatLakes';
$row_market = 'opw';
//$row_device_name = 'AKROOH20T1A-P-CI-0382-01';
$row_device_name = 'CTTPMIBGT1A-P-CI-0025-01';

echo "inside the backup -api-test.php file ";

// set up basic connection
$conn_id = ftp_connect($ftp_server);

// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
echo 'Value of login_result'.$login_result;
// get contents of the current directory
//$contents = ftp_nlist($conn_id, '/export/home/linuxnix/usr/apps/config/bkup/'.$row_region.'/');
//$contents = ftp_nlist($conn_id, '/export/home/linuxnix/');
$contents = ftp_nlist($conn_id, '/export/home/linuxnix/usr/apps/config/bakup/GreatLakes/');
print_r($contents);
for($i=0; $i<count($contents);$i++){
    if(substr(basename($contents[$i]), 0, strlen($row_device_name)) === $row_device_name){
        echo basename($contents[$i]).'  '.date ("Y-m-d H:i:s", filemtime($contents[$i]));
        echo "<br>";
    }
}
?>


>>>>>>> f925d24473e59e9234a9eee7f64f09b390f58d46

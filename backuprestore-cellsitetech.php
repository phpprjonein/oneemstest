<?php

$ftp_server = 'localhost';
$ftp_user_name = 'linuxnix';
$ftp_user_pass = 'linuxnix';
$row_region = strtolower(str_replace(' ','', $_GET['region']));
$row_market = strtolower(str_replace(' ','', $_GET['market']));
$row_device_name = $_GET['devicename']; //'AKROOH20T1A-P-CI-0382-01';


// set up basic connection
$conn_id = ftp_connect($ftp_server);

// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// get contents of the current directory
$contents = ftp_nlist($conn_id, '/export/home/linuxnix/usr/apps/config/bakup/'.$row_region.'/');
?>
<div class="ownfont box-body launch-modal">
<table class="table table-bordered" id="back_res" cellspacing="0" cellpadding="0" >
<tbody>
<?php 
$found = false;
for($i=0; $i<count($contents);$i++){
    if(substr(basename($contents[$i]), 0, strlen($row_device_name)) === $row_device_name){  $found = true; ?>
         <tr>                  
			<td><b><?php echo basename($contents[$i]);?><b></td>                                              
            <td><b><?php echo date ("Y-m-d H:i:s", filemtime($contents[$i]));?><b></td>
            <td><b><?php echo 'Manual';?><b><b></td> 
			<td><button type="button" id = "restorebtn" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-remote="remote-page.html">Restore </button></td>
         </tr>
<?php   
    }
}
if(!$found){    ?>
        <tr>
			<td colspan="4"> Backup doesn't exist</td>
         </tr>
<?php }

exit;
?>



<?php
include "classes/db2.class.php";
include "classes/paginator.class.php";  
include 'functions.php'; 

$results = load_backup_information($_GET['deviceid']);

?>
    
<div class="ownfont box-body launch-modal">
  <table class="table table-bordered" id="back_res" cellspacing="0" cellpadding="0" >				  
    <tbody>
    	<?php foreach ($results as $key => $val){ ?>
        <tr>                  
			<td><b><?php echo $val['name'];?><b></td>                                              
            <td><b><?php echo $val['date'];?><b></td>
            <td><b><?php echo $val['type'];?><b><b></td> 
			<td><button type="button" id = "restorebtn" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-remote="remote-page.html">Restore </button></td>
         </tr>
         <?php } ?>
    </tbody>
  </table>
</div> 
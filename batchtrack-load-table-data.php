<?php
include "classes/db2.class.php";
include "classes/paginator.class.php";  
include 'functions.php';
$deviceid = $_POST['deviceid'];
$deviceinfo = batch_accordion_details($deviceid);
?>                
                
                <div class="ownfont box-body launch-modal">
                 <table class="table table-bordered"  cellspacing="0" cellpadding="0" >
                    <tbody>
                                            <tr>
                                              <td><b>IP Address</b></td>
                                              <td><b>Sys Name</b></td>
                                              <td><b>Execution Status</b></td>
                                            </tr>
                                            <tr>
                                              <td><?php echo $deviceinfo['result'][0]['deviceIpAddr'].$deviceinfo['result'][0]['deviceIpAddrsix'];?></td>
                                              <td><?php echo $deviceinfo['result'][0]['systemname']; ?></td>
                                              <td><?php echo $deviceinfo['result'][0]['status']; ?></td>
                                            </tr>
					</tbody>
				</table>
				</div>

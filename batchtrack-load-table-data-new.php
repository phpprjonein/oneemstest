<?php
include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';
$batchid = $_POST['batchid'];
$deviceinfo = batch_accordion_details_new($batchid);
?>
<div class="ownfont box-body launch-modal">
	<table class="table table-bordered" cellspacing="0" cellpadding="0">
		<tbody>
			<tr>
				<td><b>IP Address</b></td>
				<td><b>Sys Name</b></td>
				<td><b>Execution Status</b></td>
			</tr>
			<?php foreach ($deviceinfo['result'] as $key => $val):?>
            <tr>
				<td><?php echo $val['deviceIpAddr'];?></td>
				<td><?php echo $val['systemname'];?></td>
				<td><?php echo $val['status'];?></td>
			</tr>
            <?php endforeach;?>
			</tbody>
	</table>
</div>

<?php
include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';
$batchid = $_POST['batchid'];
$deviceinfo = batch_accordion_details($batchid);
?>
<div class="ownfont box-body launch-modal">
	<table class="table table-bordered" cellspacing="0" cellpadding="0">
		<tbody>
			<tr>
				<td><b>IP Address</b></td>
				<td><b>Device Name</b></td>
				<td><b>Comment</b></td>
				<td><b>Execution Status</b></td>
			</tr>
            <?php foreach ($deviceinfo['result'] as $key => $val): ?>
            <?php
                if (strtolower($val['status']) == 's') {
                    $val['status'] = 'Scheduled';
                } elseif (strtolower($val['status']) == 'd') {
                    $val['status'] = 'Cancelled';
                }
                ?>
			<tr>
				<td><?php echo $val['deviceIpAddr'].$val['deviceIpAddrsix'];?></td>
				<td><?php echo $val['devicename']; ?></td>
				<td><?php echo $val['comment']; ?></td>
				<td><?php echo $val['status']; ?></td>
			</tr>
            <?php endforeach;?>
		</tbody>
	</table>
</div>

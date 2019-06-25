
<div class="ownfont box-body launch-modal" id="health-chk-div-wrap">
	<div id="status" style="display: none;" class="alert"></div>
	<table class="table table-bordered" cellspacing="0" cellpadding="0">
		<tbody>
			<tr>
				<td><b>Cpu utilization</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_process_cpu&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Cpu utilization']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Cpu utilization']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Free Memory </b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_memory_statistics&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Free Memory']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Free Memory']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>OS Version</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_version_os&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['OS Version']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['OS Version']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>

				<tr>
				<td><b>Boot Statement</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_boot_statement&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Boot Statement']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Boot Statement']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Environmental</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_environmental&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Environmental']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Environmental']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>`

				<td><b>Platform</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_platform&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Platform']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Platform']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td><b>BFD Sessions(S)</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_bfd_neighbor&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['BFD Sessions(S)']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['BFD Sessions(S)']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Interface States</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_interface_states&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Interface States']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Interface States']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Interface Counters</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_count_interfaces&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Interface Counters']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Interface Counters']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td><b>MPLS Interfaces</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_mpls_interfaces&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['MPLS Interfaces']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['MPLS Interfaces']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Log Entries</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_show_logging&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['IP Log Entries']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['IP Log Entries']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Xconnect</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_xconnect&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Xconnect']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Xconnect']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td><b>Router Status</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_router_status&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Router Status']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Router Status']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
                <td><b>Static Routes</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_static_routes&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Static Routes']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Static Routes']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
                <td><b>Service service-Using</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_service_using&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Service service-Using']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Service service-Using']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
                <td><b>ARP</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_arp&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['ARP']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['ARP']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
			<tr>
<?php
    if ($healthchktype != 'Load Table') {
        $device_status = '<tr><td align="right" class="border-0"><b>Status: </b></td><td align="left" class="border-0"><b>';
        // if($output['status']['error']){
        if (($output['error']) || ($healthchktype == 'Custom' && count($_GET['category']) == 0)) {
            $device_status .= 'Failed';
        } else {
            $device_status .= 'Reached';
        }
        $device_status .= '</b></td></tr>';
    }
    ?>
    <!-- <td colspan="3" class="instant_run_all_checks text-center"  data-deviceid="<?php echo $deviceid ?>"  data-userid="<?php echo $_SESSION['userid'] ?>"><button class="btn btn-primary">Run All Health Checks</button></td>  -->
				<td colspan="6" class="text-center"><table align="center"
						class="border-0">
						<tr>
							<td align="right" class="float-right border-0"><b>Last Run On:</b></td>
							<td align="left" class="border-0"><b><?php echo $lastupdated;?></b></td><?php echo $device_status; ?></tr>
					</table></td>
				<!-- <td colspan="2" class="run_preventive_checks" data-deviceid="<?php echo $deviceid ?>"  data-userid="<?php echo $_SESSION['userid'] ?>" style="cursor: pointer;">&nbsp;<!--<b>Run Preventive Health Checks</b></td> -->
			</tr>
		</tbody>
	</table>
</div>

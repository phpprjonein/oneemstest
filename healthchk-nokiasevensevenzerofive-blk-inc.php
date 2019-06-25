
<div class="ownfont box-body launch-modal" id="health-chk-div-wrap">
	<div id="status" style="display: none;" class="alert"></div>
	<table class="table table-bordered" cellspacing="0" cellpadding="0">
		<tbody>
			<tr>
<!-- CPU Utilization / extract_process_cpu -->
				<td style="width: 10px;"><input type="checkbox" name="extract_process_cpu"
					id="extract_process_cpu" value="extract_process_cpu"
					<?php if(in_array('extract_process_cpu', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>CPU Utilization</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_process_cpu&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['cpuutilization']['R'] == 0) ? 'green' : 'red';
                    //$display = "<span style='color:" . $color . "'>" . $output['Cpu utilization']['message'] . '</span>';
                    $display = "<span style='color:" . $color . "'>" . $output['cpuutilization']['message'] . '</span>';
                    echo $display;
                     //echo  $output['cpuutilization']['message'];
                    ?>
				</td>
<!-- /CPU Utilization / extract_process_cpu -->

<!-- Free Memory / extract_memory_statistics -->
				<td style="width: 10px;"><input id="extract_memory_statistics" type="checkbox"
					name="extract_memory_statistics" value="extract_memory_statistics"
					<?php if(in_array('extract_memory_statistics', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Free Memory </b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_memory_statistics&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['freememory']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['freememory']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /Free Memory / extract_memory_statistics -->

<!-- OS Version / extract_version_os -->
				<td style="width: 10px;"><input id=" extract_version_os" type="checkbox"
					name=" extract_version_os" value=" extract_version_os"
					<?php if(in_array(' extract_version_os', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>OS Version</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname= extract_version_os&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['osversion']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['osversion']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /OS Version / extract_version_os -->
				</tr>

				<tr>
<!-- Boot Statement / extract_boot_statement -->
				<td style="width: 10px;"><input id="extract_boot_statement" type="checkbox"
					name="extract_boot_statement" value="extract_boot_statement"
					<?php if(in_array('extract_boot_statement', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Boot Statement</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_boot_statement&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['bootstatement']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['bootstatement']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /Boot Statement / extract_boot_statement -->

<!-- Environmental / extract_environmental -->
				<td style="width: 10px;"><input id="extract_environmental" type="checkbox"
					name="extract_environmental" value="extract_environmental"
					<?php if(in_array('extract_environmental', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Environmental</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_environmental&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['environmental']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['environmental']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /Environmental / extract_environmental -->

<!-- Platform / extract_platform -->
				<td style="width: 10px;"><input id="extract_platform" type="checkbox"
					name="extract_platform" value="extract_platform"
					<?php if(in_array('extract_platform', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Platform</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_platform&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Platform']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Platform']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /Platform / extract_platform -->
				</tr>

				<tr>
<!-- BFD Sessions(S) / extract_bfd_neighbor -->
				<td style="width: 10px;"><input id="extract_bfd_neighbor" type="checkbox"
					name="extract_bfd_neighbor" value="extract_bfd_neighbor"
					<?php if(in_array('extract_bfd_neighbor', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>BFD Sessions(S)</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_bfd_neighbor&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['BFD Sessions(S)']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['BFD Sessions(S)']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /BFD Sessions(S) / extract_bfd_neighbor -->

<!-- Interface States / extract_interfact_states -->
				<td style="width: 10px;"><input id="extract_interface_states" type="checkbox"
					name="extract_interfact_states" value="extract_interface_states"
					<?php if(in_array('extract_interface_states', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Interface States</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_interface_states&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Interface States']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Interface States']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /Interface States / extract_interfact_states -->

<!-- Interface Counters / extract_count_interfaces -->
				<td style="width: 10px;"><input id="extract_count_interfaces" type="checkbox"
					name="extract_count_interfaces" value="extract_count_interfaces"
					<?php if(in_array('extract_count_interfaces', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Interface Counters</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_count_interfaces&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Interface Counters']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Interface Counters']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /Interface Counters / extract_count_interfaces -->
				</tr>

				<tr>
<!-- MPLS Interfaces / extract_mpls_interfaces -->
                <td style="width: 10px;"><input id="extract_mpls_interfaces" type="checkbox"
					name="extract_mpls_interfaces" value="extract_mpls_interfaces"
					<?php if(in_array('extract_mpls_interfaces', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>MPLS Interfaces</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_mpls_interfaces&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['MPLS Interfaces']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['MPLS Interfaces']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /MPLS Interfaces /	extract_mpls_interfaces -->

<!-- Log Entries / extract_show_logging -->
				<td style="width: 10px;"><input id="extract_show_logging" type="checkbox"
					name="extract_show_logging" value="extract_show_logging"
					<?php if(in_array('extract_show_logging', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Log Entries</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_show_logging&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Log Entries']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Log Entries']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /Log Entries / extract_show_logging -->

<!-- Xconnect / extract_xconnect -->
				<td style="width: 10px;"><input id="extract_xconnect" type="checkbox"
					name="extract_xconnect" value="extract_xconnect"
					<?php if(in_array('extract_xconnect', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Xconnect</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_xconnect&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Xconnect']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Xconnect']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /Xconnect / extract_xconnect -->
				</tr>

				<tr>
<!-- Router Status / extract_router_status -->
				<td style="width: 10px;"><input id="extract_router_status" type="checkbox"
					name="extract_router_status" value="extract_router_status"
					<?php if(in_array('extract_router_status', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Router Status</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_router_status&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Router Status']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Router Status']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /Router Status / extract_router_status -->

<!-- Static Routes / extract_static_routes -->
				<td style="width: 10px;"><input id="extract_static_routes" type="checkbox"
					name="extract_static_routes" value="extract_static_routes"
					<?php if(in_array('extract_static_routes', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Static Routes</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_static_routes&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Static Routes']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Static Routes']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- Static Routes / extract_static_routes -->

<!-- Service service-Using / extract_service_using -->
				<td style="width: 10px;"><input id="extract_service_using" type="checkbox"
					name="extract_service_using" value="extract_service_using"
					<?php if(in_array('extract_service_using', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Service service-Using</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_service_using&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Service service-Using']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Service service-Using']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /Service service-Using / extract_service_using -->
				</tr>

				<tr>
<!-- ARP / extract_arp -->
                    <td style="width: 10px;"><input id="extract_arp" type="checkbox"
					name="extract_arp" value="extract_arp"
					<?php if(in_array('extract_arp', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>ARP</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_arp&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['ARP']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['ARP']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /ARP / extract_arp -->
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
    <td colspan="3" class="run_custom_checks text-center"
					data-deviceid="<?php echo $deviceid ?>"
					data-userid="<?php echo $_SESSION['userid'] ?>"
					data-version="<?php echo $_GET['version'] ?>"
					data-deviceseries="<?php echo $_GET['deviceseries'] ?>"
					><button
						class="btn btn-primary">Run selected health Checks</button></td>
				<td colspan="3" class="run_all_checks text-center"
					data-deviceid="<?php echo $deviceid ?>"
					data-userid="<?php echo $_SESSION['userid'] ?>"
					data-version="<?php echo $_GET['version'] ?>"
					data-deviceseries="<?php echo $_GET['deviceseries'] ?>"
					><button
						class="btn btn-primary">Run All Health Checks</button></td>
				<td colspan="3" class="text-center"><table class="border-0">
						<tr>
							<td align="right" class="float-right border-0"><b>Last Run On:</b></td>
							<td align="left" class="border-0"><b><?php echo $lastupdated;?></b></td><?php echo $device_status; ?></tr>
						<tr>
							<td align="center" class="border-0" colspan="2">
								<!-- <button type="button" id="but<?php echo $deviceid ?>" class="btn btn-sm auditLog" data-toggle="modal">Audit Log</button> -->
							</td>
						</tr>
					</table></td>
				<!-- <td colspan="2" class="run_preventive_checks" data-deviceid="<?php echo $deviceid ?>"  data-userid="<?php echo $_SESSION['userid'] ?>" style="cursor: pointer;">&nbsp;<!--<b>Run Preventive Health Checks</b></td> -->
			</tr>
	</tbody>
	</table>
</div>

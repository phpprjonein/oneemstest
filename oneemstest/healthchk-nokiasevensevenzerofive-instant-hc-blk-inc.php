
<div class="ownfont box-body launch-modal" id="health-chk-div-wrap">
	<div id="status" style="display: none;" class="alert"></div>
	<table class="table table-bordered" cellspacing="0" cellpadding="0">
		<tbody>
			<tr>
<!-- CPU Utilization / extract_process_cpu -->
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
				<td><b>Environmental</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_environmental&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['environmental']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . "Major led state:". $output['environmental']['message'][major_led_state]. "Critical led state: ". $output['environmental']['message'][critical_led_state] .'</span>';
                    //$display = "<span style='color:" . $color . "'>" . print_r($output). '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /Environmental / extract_environmental -->

<!-- Platform / extract_platform -->
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
				<td><b>BFD Sessions(S)</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_bfd_neighbor&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                   
 $color = ($output['bfdsession']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['bfdsession']['message'] . '</span>';

                    echo $display;
                    ?>
				</td>
<!-- /BFD Sessions(S) / extract_bfd_neighbor -->

<!-- Interface States / extract_interfact_states -->
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
				<td><b>Interface Counters</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_count_interfaces&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['interfacecounters']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['interfacecounters']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /Interface Counters / extract_count_interfaces -->
				</tr>

				<tr>
<!-- MPLS Interfaces / extract_mpls_interfaces -->
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
				<td><b>Xconnect</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_xconnect&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['xconnect']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['xconnect']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /Xconnect / extract_xconnect -->
				</tr>

				<tr>
<!-- Router Status / extract_router_status -->
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
				<td><b>Service service-Using</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_service_using&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Service Service-using']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Service Service-using']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /Service service-Using / extract_service_using -->
				</tr>

				<tr>
<!-- ARP / extract_arp -->
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

<!-- MPLS Neighbors / extract_mpls_neighbors -->
                                <td><b>MPLS Neighbors</b></td>
                                <td><a id="anchorcmd" class="anchorcmd"
                                        href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_mpls_neighbors&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
                                                class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['MPLS Neighbors']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['MPLS Neighbors']['message'] . '</span>';
                    echo $display;
                    ?>
                                </td>
<!-- /MPLS Neighbors / extract_mpls_neighbors  -->


<!-- Buffers / extract_buffers --
                    <td style="width: 10px;"><input id="extract_buffers" type="checkbox"
                                        name="extract_buffers" value="extract_buffers"
                                        <?php if(in_array('extract_buffers', $_GET['category'])):?> checked="checked"
                                        <?php endif;?>></td>
                                <td><b>Buffers</b></td>
                                <td><a id="anchorcmd" class="anchorcmd"
                                        href="healthchk-nokiasevensevenzerofive-devdetmdl-cellsite.php?commandname=extract_buffers&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
                                                class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['buffers']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['buffers']['message'] . '</span>';
                    echo $display;
                    ?>
                                </td>
-- /Buffers / extract_buffers  -->

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


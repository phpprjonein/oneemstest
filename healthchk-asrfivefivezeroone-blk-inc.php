
<div class="ownfont box-body launch-modal" id="health-chk-div-wrap">
	<div id="status" style="display: none;" class="alert"></div>
	<table class="table table-bordered" cellspacing="0" cellpadding="0">
		<tbody>
			<tr>
				<td style="width: 10px;"><input type="checkbox" name="extract_version"
					id="extract_version" value="extract_version"
					<?php if(in_array('extract_version', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Show version</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-asrfivefivezeroone-devdetmdl-cellsite.php?commandname=extract_version&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['redundancy']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['redundancy']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				
				
				<td style="width: 10px;"><input id="extract_processes_cpu" type="checkbox"
					name="extract_processes_cpu" value="extract_processes_cpu"
					<?php if(in_array('extract_processes_cpu', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Show processes cpu</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-asrfivefivezeroone-devdetmdl-cellsite.php?commandname=extract_processes_cpu&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['cpuutilization']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['cpuutilization']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				
				<td style="width: 10px;"><input id="extract_memory_summary" type="checkbox"
					name="extract_memory_summary" value="extract_memory_summary"
					<?php if(in_array('extract_memory_summary', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Show memory summary</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-asrfivefivezeroone-devdetmdl-cellsite.php?commandname=extract_memory_summary&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['freememory']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['freememory']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				
				<tr>
				<td style="width: 10px;"><input id="extract_platform" type="checkbox"
					name="extract_platform" value="extract_platform"
					<?php if(in_array('extract_platform', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>show platform</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-asrfivefivezeroone-devdetmdl-cellsite.php?commandname=extract_platform&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['show_version']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['show_version']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td style="width: 10px;"><input id="extract_ping_brief" type="checkbox"
					name="extract_ping_brief" value="extract_ping_brief"
					<?php if(in_array('extract_ping_brief', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Show alarms brief</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-asrfivefivezeroone-devdetmdl-cellsite.php?commandname=extract_ping_brief&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['show_version_installed_active']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['show_version_installed_active']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>`
				
				<td style="width: 10px;"><input id="extract_interfaces" type="checkbox"
					name="extract_interfaces" value="extract_interfaces"
					<?php if(in_array('extract_interfaces', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Show interfaces</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-asrfivefivezeroone-devdetmdl-cellsite.php?commandname=extract_interfaces&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['show_version_installed_committed']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['show_version_installed_committed']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td style="width: 10px;"><input id="extract_ping" type="checkbox"
					name="extract_ping" value="extract_ping"
					<?php if(in_array('extract_ping', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Ping 10.114.88.0 size 2000</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-asrfivefivezeroone-devdetmdl-cellsite.php?commandname=extract_ping&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['environmental']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['environmental']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td style="width: 10px;"><input id="extract_bfd_session" type="checkbox"
					name="extract_bfd_session" value="extract_bfd_session"
					<?php if(in_array('extract_bfd_session', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Show bfd session</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-asrfivefivezeroone-devdetmdl-cellsite.php?commandname=extract_bfd_session&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['power_supply']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['power_supply']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td style="width: 10px;"><input id="extract_logging" type="checkbox"
					name="extract_logging" value="extract_logging"
					<?php if(in_array('extract_logging', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>show logging</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-asrfivefivezeroone-devdetmdl-cellsite.php?commandname=extract_logging&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['platform']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['platform']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td style="width: 10px;"><input id="extract_vrf_all" type="checkbox"
					name="extract_vrf_all" value="extract_vrf_all"
					<?php if(in_array('extract_vrf_all', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Show vrf all</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-asrfivefivezeroone-devdetmdl-cellsite.php?commandname=extract_vrf_all&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['fabric status']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['fabric status']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td style="width: 10px;"><input id="extract_ip_interface_brief" type="checkbox"
					name="extract_ip_interface_brief" value="extract_ip_interface_brief"
					<?php if(in_array('extract_ip_interface_brief', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Show ip interface brief</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-asrfivefivezeroone-devdetmdl-cellsite.php?commandname=extract_ip_interface_brief&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['fabric interface asic drops']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['fabric interface asic drops']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				
				
				
				<td style="width: 10px;"><input id="extract_mpls_interfaces" type="checkbox"
					name="extract_mpls_interfaces" value="extract_mpls_interfaces"
					<?php if(in_array('extract_mpls_interfaces', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Show mpls interfaces</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-asrfivefivezeroone-devdetmdl-cellsite.php?commandname=extract_mpls_interfaces&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['fabric interface asic errors']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['fabric interface asic errors']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td style="width: 10px;"><input id="extract_bgp_vpnv4_unicast_summary" type="checkbox"
					name="extract_bgp_vpnv4_unicast_summary" value="extract_bgp_vpnv4_unicast_summary"
					<?php if(in_array('extract_bgp_vpnv4_unicast_summary', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Show bgp vpnv4 unicast summary</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-asrfivefivezeroone-devdetmdl-cellsite.php?commandname=extract_bgp_vpnv4_unicast_summary&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['fabric interface asic link-status']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['fabric interface asic link-status']['message'] . '</span>';
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

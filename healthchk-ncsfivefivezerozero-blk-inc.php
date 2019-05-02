
<div class="ownfont box-body launch-modal" id="health-chk-div-wrap">
	<div id="status" style="display: none;" class="alert"></div>
	<table class="table table-bordered" cellspacing="0" cellpadding="0">
		<tbody>
			<tr>
<!-- IOS Version / extract_version -->
				<td style="width: 10px;"><input type="checkbox" name="extract_version"
					id="extract_version" value="extract_version"
					<?php if(in_array('extract_version', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>IOS Version</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-ncsfivefivezerozero-devdetmdl-cellsite.php?commandname=extract_version&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['IOS Version']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['IOS Version']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /IOS Version / extract_version -->

<!-- CPU Utilization / extract_processes_cpu -->
				<td style="width: 10px;"><input id="extract_processes_cpu" type="checkbox"
					name="extract_processes_cpu" value="extract_processes_cpu"
					<?php if(in_array('extract_processes_cpu', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>CPU Utilization </b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-ncsfivefivezerozero-devdetmdl-cellsite.php?commandname=extract_processes_cpu&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['CPU Utilization']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['CPU Utilization']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /CPU Utilization / extract_processes_cpu -->

<!-- Free Memory	extract_memory_summary -->
				<td style="width: 10px;"><input id="extract_memory_summary" type="checkbox"
					name="extract_memory_summary" value="extract_memory_summary"
					<?php if(in_array('extract_memory_summary', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Free Memory</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-ncsfivefivezerozero-devdetmdl-cellsite.php?commandname=extract_memory_summary&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Free Memory']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Free Memory']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /Free Memory	extract_memory_summary -->
				</tr>

				<tr>
<!-- Platform extract_platform -->
				<td style="width: 10px;"><input id="extract_platform" type="checkbox"
					name="extract_platform" value="extract_platform"
					<?php if(in_array('extract_platform', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Platform</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-ncsfivefivezerozero-devdetmdl-cellsite.php?commandname=extract_platform&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Platform']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Platform']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /Platform extract_platform -->

<!-- Environmental	extract_alarms_brief -->
				<td style="width: 10px;"><input id="extract_alarms_brief" type="checkbox"
					name="extract_alarms_brief" value="extract_alarms_brief"
					<?php if(in_array('extract_alarms_brief', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Environmental</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-ncsfivefivezerozero-devdetmdl-cellsite.php?commandname=extract_alarms_brief&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Environmental']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Environmental']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /Environmental	extract_alarms_brief -->

<!-- Interface Counters 	extract_interfaces -->
				<td style="width: 10px;"><input id="extract_interfaces" type="checkbox"
					name="extract_interfaces" value="extract_interfaces"
					<?php if(in_array('extract_interfaces', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Interface Counters</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-ncsfivefivezerozero-devdetmdl-cellsite.php?commandname=extract_interfaces&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Interface Counters']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Interface Counters']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /Interface Counters 	extract_interfaces -->
				</tr>
				<tr>
<!-- Log Entries	extract_logging -->
				<td style="width: 10px;"><input id="extract_logging" type="checkbox"
					name="extract_logging" value="extract_logging"
					<?php if(in_array('extract_logging', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Log Entries</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-ncsfivefivezerozero-devdetmdl-cellsite.php?commandname=extract_logging&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Ping']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Ping']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /Log Entries	extract_logging -->

<!-- Interface Status	extract_ip_interface_brief -->
				<td style="width: 10px;"><input id="extract_ip_interface_brief" type="checkbox"
					name="extract_ip_interface_brief" value="extract_ip_interface_brief"
					<?php if(in_array('extract_ip_interface_brief', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Interface Status</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-ncsfivefivezerozero-devdetmdl-cellsite.php?commandname=extract_ip_interface_brief&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['Interface Status']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['Interface Status']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /Interface Status	extract_ip_interface_brief -->

<!-- MPLS Interfaces	extract_mpls_interfaces -->
				<td style="width: 10px;"><input id="extract_mpls_interfaces" type="checkbox"
					name="extract_mpls_interfaces" value="extract_mpls_interfaces"
					<?php if(in_array('extract_mpls_interfaces', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>MPLS Interfaces</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-ncsfivefivezerozero-devdetmdl-cellsite.php?commandname=extract_mpls_interfaces&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['MPLS Interfaces']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['MPLS Interfaces']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /MPLS Interfaces	extract_mpls_interfaces -->
				</tr>

				<tr>
<!-- IPV4 BGP Neighbors 	extract_bgp_vpnv4_unicast_summary -->
				<td style="width: 10px;"><input id="extract_bgp_vpnv4_unicast_summary" type="checkbox"
					name="extract_bgp_vpnv4_unicast_summary" value="extract_bgp_vpnv4_unicast_summary"
					<?php if(in_array('extract_bgp_vpnv4_unicast_summary', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>IPV4 BGP Neighbors</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-ncsfivefivezerozero-devdetmdl-cellsite.php?commandname=extract_bgp_vpnv4_unicast_summary&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['IPV4 BGP Neighbors']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['IPV4 BGP Neighbors']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /IPV4 BGP Neighbors 	extract_bgp_vpnv4_unicast_summary -->

<!-- MPLS LDP Neighbor	extract_mpls_ldp_neighbor -->
				<td style="width: 10px;"><input id="extract_mpls_ldp_neighbor" type="checkbox"
					name="extract_mpls_ldp_neighbor" value="extract_mpls_ldp_neighbor"
					<?php if(in_array('extract_mpls_ldp_neighbor', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>MPLS LDP Neighbor</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-ncsfivefivezerozero-devdetmdl-cellsite.php?commandname=extract_mpls_ldp_neighbor&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['MPLS LDP Neighbor']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['MPLS LDP Neighbor']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /MPLS LDP Neighbor	extract_mpls_ldp_neighbor -->

<!-- BGPv4 Routes	extract_bgp_vpnv4_unicast_vrf -->
				<td style="width: 10px;"><input id="extract_bgp_vpnv4_unicast_vrf" type="checkbox"
					name="extract_bgp_vpnv4_unicast_vrf" value="extract_bgp_vpnv4_unicast_vrf"
					<?php if(in_array('extract_bgp_vpnv4_unicast_vrf', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>BGPv6 Routes</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-ncsfivefivezerozero-devdetmdl-cellsite.php?commandname=extract_bgp_vpnv4_unicast_vrf&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['BGPv6 Routes']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['BGPv6 Routes']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /BGPv4 Routes	extract_bgp_vpnv4_unicast_vrf -->

				</tr>

				<tr>

<!-- BGPv6 Neighbors	extract_bgp_vpnv6_unicast_summary -->
				<td style="width: 10px;"><input id="extract_bgp_vpnv4_unicast_summary" type="checkbox"
					name="extract_bgp_vpnv4_unicast_summary" value="extract_bgp_vpnv4_unicast_summary"
					<?php if(in_array('extract_bgp_vpnv4_unicast_summary', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>BGPv6 Neighbors</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-ncsfivefivezerozero-devdetmdl-cellsite.php?commandname=extract_bgp_vpnv4_unicast_summary&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['BGPv6 Neighbors']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['BGPv6 Neighbors']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /BGPv6 Neighbors	extract_bgp_vpnv6_unicast_summary -->

<!-- BGPv6 Routes	extract_bgp_vpnv6_unicast_vrf -->
				<td style="width: 10px;"><input id="extract_bgp_vpnv6_unicast_vrf" type="checkbox"
					name="extract_bgp_vpnv6_unicast_vrf" value="extract_bgp_vpnv6_unicast_vrf"
					<?php if(in_array('extract_bgp_vpnv6_unicast_vrf', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>BGPv6 Routes</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-ncsfivefivezerozero-devdetmdl-cellsite.php?commandname=extract_bgp_vpnv6_unicast_vrf&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['BGPv6 Routes']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['BGPv6 Routes']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- BGPv6 Routes	extract_bgp_vpnv6_unicast_vrf -->

<!-- BFD Sessions - Not OK	extract_bfd_session -->
				<td style="width: 10px;"><input id="extract_bfd_session" type="checkbox"
					name="extract_bfd_session" value="extract_bfd_session"
					<?php if(in_array('extract_bfd_session', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>BFD Sessions - Not OK</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-ncsfivefivezerozero-devdetmdl-cellsite.php?commandname=extract_bfd_session&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['BFD Sessions - Not OK']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['BFD Sessions - Not OK']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /BFD Sessions - Not OK	extract_bfd_session -->

				</tr>

				<tr>
<!-- VRF - Not OK	extract_vrf_all -->
				<td style="width: 10px;"><input id="extract_vrf_all" type="checkbox"
					name="extract_vrf_all" value="extract_vrf_all"
					<?php if(in_array('extract_vrf_all', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>VRF - Not OK</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-ncsfivefivezerozero-devdetmdl-cellsite.php?commandname=extract_vrf_all&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['VRF - Not OK']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['VRF - Not OK']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- VRF - Not OK	extract_vrf_all -->

<!-- Bandwidth – Not OK -->
<td style="width: 10px;"><input id="extract_vrf_all" type="checkbox"
					name="extract_vrf_all" value="extract_vrf_all"
					<?php if(in_array('extract_vrf_all', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>VRF - Not OK</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="healthchk-ncsfivefivezerozero-devdetmdl-cellsite.php?commandname=extract_vrf_all&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['VRF - Not OK']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['VRF - Not OK']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
<!-- /Bandwidth – Not OK -->
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

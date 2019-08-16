
<div class="ownfont box-body launch-modal" id="health-chk-div-wrap">
	<div id="status" style="display: none;" class="alert"></div>
	<table class="table table-bordered" cellspacing="0" cellpadding="0">
		<tbody>
			<tr>
				<td style="width: 10px;"><input type="checkbox" name="iosversion"
					id="iosversion" value="extract_version_ios"
					<?php if(in_array('extract_version_ios', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>IOS Version </b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=iosversion&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    //$color = ($output['iosversion']['R'] == 0) ? 'green' : 'red';
    $color = ($output['iosversion']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['iosversion']['message'] . '</span>';
    echo $display;
    ?>
</td>
				<td style="width: 10px;"><input id="cpuutilization" type="checkbox"
					name="cpuutilization" value="extract_process_cpu"
					<?php if(in_array('extract_process_cpu', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>CPU Utilization</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=cpuutilization&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['cpuutilization']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['cpuutilization']['message'] . '</span>';
    echo $display;
    ?>
</td>
				<td style="width: 10px;"><input type="checkbox" id="freememory"
					name="freememory" value="extract_memory_statistics"
					<?php if(in_array('extract_memory_statistics', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Free Memory</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=freememory&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['freememory']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['freememory']['message'] . '</span>';
    echo $display;
    ?>
</td>
			</tr>
			<tr>
				<td><input type="checkbox" id="buffers" name="buffers" value="extract_buffers"
					<?php if(in_array('extract_buffers', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Buffers</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=buffers&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['buffers']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['buffers']['message'] . '</span>';
    echo $display;
    ?>
</td>
				<td><input type="checkbox" id="bootstatement" name="bootstatement"
					value="extract_show_running_config" <?php if(in_array('extract_show_running_config', $_GET['category'])):?>
					checked="checked" <?php endif;?>></td>
				<td><b>Boot Statement</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=bootstatement&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['bootstatement']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['bootstatement']['message'] . '</span>';
    echo $display;
    ?>
</td>
				<td><input type="checkbox" id="platform" name="platform" value="extract_show_platform"
					<?php if(in_array('extract_show_platform', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Platform </b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=platform&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['platform']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['platform']['message'] . '</span>';
    echo $display;
    ?>
</td>
			</tr>

			<tr>
				<td><input type="checkbox" id="environmental" name="environmental"
					value="extract_alarms" <?php if(in_array('extract_alarms', $_GET['category'])):?>
					checked="checked" <?php endif;?>></td>
				<td><b>Environmental</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=environment&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['environmental']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['environmental']['message'] . '</span>';
    echo $display;
    ?>
</td>
				<td><input type="checkbox" id="configregister" name="configregister"
					value="extract_version_config" <?php if(in_array('extract_version_config', $_GET['category'])):?>
					checked="checked" <?php endif;?>></td>
				<td><b>Config Register</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=configregister&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['configregister']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['configregister']['message'] . '</span>';
    echo $display;
    ?>
</td>
				<td><input type="checkbox" id="interfacecounters"
					name="interfacecounters" value="extract_count_interfaces"
					<?php if(in_array('extract_count_interfaces', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Interface Counters</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=interfacecounters&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['interfacecounters']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['interfacecounters']['count'] . '</span>';
    echo $display;
    ?>
</td>
			</tr>
			<tr>
				<td><input type="checkbox" id="twothsndbyteping"
					name="twothsndbyteping" value="extract_ping"
					<?php if(in_array('extract_ping', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>2000 Byte Ping</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=twothsndbyteping&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php

    $color = ($output['twothsndbyteping']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['twothsndbyteping']['message'] . '</span>';
    echo $display;
    ?>
</td>
				<td><input type="checkbox" id="bfdsession" name="bfdsession"
					value="extract_bfd_neighbour" <?php if(in_array('extract_bfd_neighbour', $_GET['category'])):?>
					checked="checked" <?php endif;?>></td>
				<td><b>BFD Sessions</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=bfdsession&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['bfdsession']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['bfdsession']['message'] . '</span>';
    echo $display;
    ?>
</td>
				<td><input type="checkbox" id="logentries" name="logentries"
					value="extract_show_logging" <?php if(in_array('extract_show_logging', $_GET['category'])):?>
					checked="checked" <?php endif;?>></td>
				<td><b>Log Entries</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=logentries&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    if (isset($output['logentries']['buffer_logging']['R'])) {
        $color = ($output['logentries']['buffer_logging']['R'] == 0) ? 'green' : 'red';
        $display = "<span style='color:" . $color . "'>" . " Buffer Logging : " . $output['logentries']['buffer_logging']['value'] . '</span>';
        echo $display;
    }
    ?>
											  <?php
            
            if (isset($output['logentries']['trap_logging']['R'])) {
                $color = ($output['logentries']['trap_logging']['R'] == 0) ? 'green' : 'red';
                $display = "<span style='color:" . $color . "'>" . "<br> Trap Logging : " . $output['logentries']['trap_logging']['value'] . '</span>';
                echo $display;
            }
            ;
            ?>
											  </td>
			</tr>
			<tr>
				<td><input type="checkbox" id="vrfstates" name="vrfstates"
					value="extract_show_vrf" <?php if(in_array('extract_show_vrf', $_GET['category'])):?>
					checked="checked" <?php endif;?>></td>
				<td><b>VRF</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=vrfstates&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['vrfstates']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['vrfstates']['message'] . '</span>';
    echo $display;
    ?>
</td>
				<td><input type="checkbox" id="interfacestates"
					name="interfacestates" value="extract_show_brief"
					<?php if(in_array('extract_show_brief', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Interface State</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=interfacestates&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['interfacestates']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['interfacestates']['message'] . '</span>';
    echo $display;
    ?>
</td>
				<td><input type="checkbox" id="xconnect" name="xconnect" value="extract_xconnect_all"
					<?php if(in_array('extract_xconnect_all', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Xconnect</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=xconnect&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['xconnect']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['xconnect']['count'] . '</span>';
    echo $display;
    ?>
</td>
			</tr>
			<tr>
				<td><input type="checkbox" id="mplsinterfaces" name="mplsinterfaces"
					value="extract_mlps_interfaces" <?php if(in_array('extract_mlps_interfaces', $_GET['category'])):?>
					checked="checked" <?php endif;?>></td>
				<td><b>MPLS Interfaces</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=mplsinterfaces&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    //$color = ($output['mplsinterfaces']['extract_mpls_interfaces']['mplsinterfaces']['R'] == 0) ? 'green' : 'red';
	$color = ($output['mplsinterfaces']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['mplsinterfaces']['message'] . '</span>';
    echo $display;
    ?>
</td>
				<td><input type="checkbox" id="bgpvfourneighbors"
					name="bgpvfourneighbors" value="extract_bgpv4_neighbour"
					<?php if(in_array('extract_bgpv4_neighbour', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>IPV4 BGP Neighbors</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=bgpvfourneighbors&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['bgpvfourneighbors']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['bgpvfourneighbors']['neighbours'] . '</span>';
    echo $display;
    ?>
</td>
				<td><input type="checkbox" id="ran" name="ran" value="extract_show_ip_bgp_vpnv4_vrf_ran"
					<?php if(in_array('extract_show_ip_bgp_vpnv4_vrf_ran', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>IPV4 BGP Routes</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=ran&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a> <?php
    $color = ($output['ran']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['ran']['count'] . '</span>';
    echo $display;
    ?>
</td>
			</tr>
			<tr>
				<td><input type="checkbox" id="mplsneighbors" name="mplsneighbors"
					value="extract_mlps_ldp_neighbour" <?php if(in_array('extract_mlps_ldp_neighbour', $_GET['category'])):?>
					checked="checked" <?php endif;?>></td>
				<td><b>MPLS Neighbors</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=mplsneighbors&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['mplsneighbors']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['mplsneighbors']['message'] . '</span>';
    echo $display;
    ?>
</td>
				<td><input type="checkbox" id="bgpvsixneighbours"
					name="bgpvsixneighbours" value="extract_bgp_v6_neighbour"
					<?php if(in_array('extract_bgp_v6_neighbour', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>IPV6 BGP Neighbors</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=bgpvsixneighbours&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    $color = ($output['bgpvsixneighbors']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['bgpvsixneighbours']['neighbours'] . '</span>';
    echo $display;
    ?>
</td>
				<td><input type="checkbox" id="bgpvsixroutes" name="bgpvsixroutes"
					value="extract_bgpv6_routes" <?php if(in_array('extract_bgpv6_routes', $_GET['category'])):?>
					checked="checked" <?php endif;?>></td>
				<td><b>IPV6 BGP Routes</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=bgpvsixroutes&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a> <?php
    $color = ($output['bgpvsixroutes']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['bgpvsixroutes']['count'] . '</span>';
    echo $display;
    ?>
</td>
			</tr>
			<tr>
				<td style="width: 10px;"><input type="checkbox" name="bandwidth"
					id="bandwidth" value="extract_bandwidth"
					<?php if(in_array('extract_bandwidth', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Bandwidth</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=bandwidth&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    $color = ($output['bandwidth']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['bandwidth']['message'] . '</span>';
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

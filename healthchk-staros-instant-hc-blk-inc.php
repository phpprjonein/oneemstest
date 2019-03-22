<div class="ownfont box-body launch-modal" id="health-chk-div-wrap">
	<table class="table table-bordered" cellspacing="0" cellpadding="0">
		<tbody>
			<tr>
				<td><b>Redundancy state</b></td>
				<td><?php
                    $color = ($output['redundancy']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['redundancy']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				
				
				<td><b>CPU Utilization</b></td>
				<td><?php
                    $color = ($output['cpuutilization']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['cpuutilization']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				
				<td><b>Memory utilization</b></td>
				<td><?php
                    $color = ($output['freememory']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['freememory']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>

				<td><b>Software running on the RSP</b></td>
				<td><?php
                    $color = ($output['show_version']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['show_version']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Software installed and active</b></td>
				<td><?php
                    $color = ($output['show_version_installed_active']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['show_version_installed_active']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Software installed and committed</b></td>
				<td><?php
                    $color = ($output['show_version_installed_committed']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['show_version_installed_committed']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td><b>Alarms</b></td>
				<td><?php
                    $color = ($output['environmental']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['environmental']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Power supply</b></td>
				<td><?php
                    $color = ($output['power_supply']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['power_supply']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Line card status</b></td>
				<td><?php
                    $color = ($output['platform']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['platform']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td><b>Fabric Status</b></td>
				<td><?php
                    $color = ($output['fabric status']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['fabric status']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Fabric interface ASIC drops</b></td>
				<td><?php
                    $color = ($output['fabric interface asic drops']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['fabric interface asic drops']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Fabric interface ASIC errors</b></td>
				<td><?php
                    $color = ($output['fabric interface asic errors']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['fabric interface asic errors']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td><b>Fabric Interface ASIC link-status</b></td>
				<td><?php
                    $color = ($output['fabric interface asic link-status']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['fabric interface asic link-status']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Up/Down Status</b></td>
				<td><?php
                    $color1 = ($output['UP/DOWN Status']['ipv6_interface_brief']['R'] == 0) ? 'green' : 'red';
                    $display1 = "<span style='color:" . $color1 . "'>" . $output['UP/DOWN Status']['ipv6_interface_brief']['message'] . '</span>';
$color2 = ($output['UP/DOWN Status']['ipv4_interface_brief']['R'] == 0) ? 'green' : 'red';
                    $display2 = "<span style='color:" . $color2 . "'>" . $output['UP/DOWN Status']['ipv4_interface_brief']['message'] . '</span>';
                   $display = $display1.$display2; 
echo $display;
                    ?>
				</td>
				<td><b>Interface counters</b></td>
				<td><?php
                    $color = ($output['interfacecounters']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['interfacecounters']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td><b>BFD session</b></td>
				<td><?php
                    $color = ($output['bfdsession']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['bfdsession']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>VRRP</b></td>
				<td><?php
                    $color = ($output['VRRP']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['VRRP']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>NTP</b></td>
				<td><?php
                    $color = ($output['NTP']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['NTP']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td><b>Global OSPF neighbors</b></td>
				<td><?php
                    $color = ($output['global ospf neighbor']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['global ospf neighbor']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>1XRTT OSPF Neighbor</b></td>
				<td><?php
                    $color = ($output['1XRTT ospf']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['1XRTT ospf']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>CELL_MGMT OSPF Neighbor</b></td>
				<td><?php
                    $color = ($output['CELL_MGMT OSPF neighbor']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['CELL_MGMT OSPF neighbor']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td><b>OSPF NSR and GR</b></td>
				<td><?php
                    $color = ($output['ospf nsr and gr']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['ospf nsr and gr']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>LDP neighbors</b></td>
				<td><?php
                    $color = ($output['ldp neighbors']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['ldp neighbors']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>WDN peering</b></td>
				<td><?php
                    $color = ($output['WDN peering']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['WDN peering']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td><b>CSR peering</b></td>
				<td><?php
                    $color1 = ($output['CSR peering']['vpnv6_csr_peering']['R'] == 0) ? 'green' : 'red';
                    $display1 = "<span style='color:" . $color1 . "'>" . $output['CSR peering']['vpnv6_csr_peering']['message'] . '</span>';
		    $color2 = ($output['csr peering']['vpnv4_csr_peering']['R'] == 0) ? 'green' : 'red';
                    $display2 = "<span style='color:" . $color2 . "'>" . $output['csr peering']['vpnv4_csr_peering']['message'] . '</span>';
$diplay = $display1.$display2;
                    echo $display;
                    ?>
				</td>
				<td><b>CRS WDN peering</b></td>
				<td><?php
                    $color = ($output['CRS WDN peering']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['CRS WDN peering']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>CRS LTE peering</b></td>
				<td><?php
                    $color1 = ($output['CRS LTE peering']['ipv6_crs_lte_peering']['R'] == 0) ? 'green' : 'red';
                    $display1 = "<span style='color:" . $color1 . "'>" . $output['CRS LTE peering']['ipv6_crs_lte_peering']['message'] . '</span>';
		    $color2 = ($output['CRS LTE peering']['ipv4_crs_lte_peering']['R'] == 0) ? 'green' : 'red';
                    $display2 = "<span style='color:" . $color2 . "'>" . $output['CRS LTE peering']['ipv4_crs_lte_peering']['message'] . '</span>';
$display = $display1.$display2;
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td><b>BGP NSR and Graceful Restart</b></td>
				<td><?php
                    $color = ($output['BGP NSR and Graceful Restart']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['BGP NSR and Graceful Restart']['message'] . '</span>';
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

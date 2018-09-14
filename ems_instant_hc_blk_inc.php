<div class="ownfont box-body launch-modal" id="health-chk-div-wrap">
	<table class="table table-bordered" cellspacing="0" cellpadding="0">
		<tbody>
			<tr>
				<td><b>Redundancy state</b></td>
				<td><?php
                    $color = ($output['extract_redundancy']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_redundancy']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				
				
				<td><b>CPU Utilization</b></td>
				<td><?php
                    $color = ($output['extract_process_cpu']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_process_cpu']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				
				<td><b>Memory utilization</b></td>
				<td><?php
                    $color = ($output['extract_memory_statistics']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_memory_statistics']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>

				<td><b>Software running on the RSP</b></td>
				<td><?php
                    $color = ($output['extract_version_rsp']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_version_rsp']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Software installed and active</b></td>
				<td><?php
                    $color = ($output['extract_version_installed_active']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_version_installed_active']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Software installed and committed</b></td>
				<td><?php
                    $color = ($output['extract_version_installed_committed']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_version_installed_committed']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td><b>Alarms</b></td>
				<td><?php
                    $color = ($output['extract_alarms']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_alarms']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Power supply</b></td>
				<td><?php
                    $color = ($output['extract_power_supply']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_power_supply']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Line card status</b></td>
				<td><?php
                    $color = ($output['extract_platform']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_platform']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td><b>Fabric Status</b></td>
				<td><?php
                    $color = ($output['extract_fbric_status']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_fbric_status']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Fabric interface ASIC drops</b></td>
				<td><?php
                    $color = ($output['extract_fabric_inter_asic_drops']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_fabric_inter_asic_drops']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Fabric interface ASIC errors</b></td>
				<td><?php
                    $color = ($output['extract_fabric_inter_asic_errors']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_fabric_inter_asic_errors']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td><b>Fabric Interface ASIC link-status</b></td>
				<td><?php
                    $color = ($output['extract_fabric_inter_asic_link_status']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_fabric_inter_asic_link_status']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Up/down status</b></td>
				<td><?php
                    $color = ($output['extract_up_down_status']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_up_down_status']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Interface counters</b></td>
				<td><?php
                    $color = ($output['extract_count_interfaces']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_count_interfaces']['count'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td><b>BFD session</b></td>
				<td><?php
                    $color = ($output['extract_bfd_session']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_bfd_session']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>VRRP</b></td>
				<td><?php
                    $color = ($output['extract_vrrp']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_vrrp']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>NTP</b></td>
				<td><?php
                    $color = ($output['extract_ntp']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_ntp']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td><b>Global OSPF neighbors</b></td>
				<td><?php
                    $color = ($output['extract_global_ospf_neighbor']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_global_ospf_neighbor']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>1XRTT OSPF Neighbor</b></td>
				<td><?php
                    $color = ($output['extract_1xrtt_ospf_neighbor']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_1xrtt_ospf_neighbor']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>CELL_MGMT OSPF Neighbor</b></td>
				<td><?php
                    $color = ($output['extract_cell_mgmt_ospf_neighbor']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_cell_mgmt_ospf_neighbor']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td><b>OSPF NSR and GR</b></td>
				<td><?php
                    $color = ($output['extract_ospf_nsr_gr']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_ospf_nsr_gr']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>LDP neighbors</b></td>
				<td><?php
                    $color = ($output['extract_ldp_neighbor']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_ldp_neighbor']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>WDN peering</b></td>
				<td><?php
                    $color = ($output['extract_wdn_peering']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_wdn_peering']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td><b>CSR peering</b></td>
				<td><?php
                    $color = ($output['extract_csr_peering']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_csr_peering']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>CRS WDN peering</b></td>
				<td><?php
                    $color = ($output['extract_crs_wdn_peering']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_crs_wdn_peering']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>CRS LTE peering</b></td>
				<td><?php
                    $color = ($output['extract_crs_lte_peering']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_crs_lte_peering']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td><b>BGP NSR and Graceful Restart</b></td>
				<td><?php
                    $color = ($output['extract_bgp_nsr_graceful_restart']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_bgp_nsr_graceful_restart']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td><b>Air Filter Check</b></td>
				<td><?php
                    $color = ($output['extract_air_filter_check']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_air_filter_check']['message'] . '</span>';
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

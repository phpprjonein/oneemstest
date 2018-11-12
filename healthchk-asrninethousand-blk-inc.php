
<div class="ownfont box-body launch-modal" id="health-chk-div-wrap">
	<table class="table table-bordered" cellspacing="0" cellpadding="0">
		<tbody>
			<tr>
				<td style="width: 10px;"><input type="checkbox" name="extract_redundancy"
					id="extract_redundancy" value="extract_redundancy"
					<?php if(in_array('extract_redundancy', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Redundancy state</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_redundancy&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['redundancy']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['redundancy']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				
				
				<td style="width: 10px;"><input id="extract_process_cpu" type="checkbox"
					name="extract_process_cpu" value="extract_process_cpu"
					<?php if(in_array('extract_process_cpu', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>CPU Utilization</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_process_cpu&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['cpuutilization']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['cpuutilization']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				
				<td style="width: 10px;"><input id="extract_memory_statistics" type="checkbox"
					name="extract_memory_statistics" value="extract_memory_statistics"
					<?php if(in_array('extract_memory_statistics', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Memory utilization</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_memory_statistics&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['freememory']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['freememory']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td style="width: 10px;"><input id="extract_version_rsp" type="checkbox"
					name="extract_version_rsp" value="extract_version_rsp"
					<?php if(in_array('extract_version_rsp', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Software running on the RSP</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_version_rsp&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['show_version']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['show_version']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td style="width: 10px;"><input id="extract_version_installed_active" type="checkbox"
					name="extract_version_installed_active" value="extract_version_installed_active"
					<?php if(in_array('extract_version_installed_active', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Software installed and active</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_version_installed_active&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['show_version_installed_active']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['show_version_installed_active']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td style="width: 10px;"><input id="extract_version_installed_committed" type="checkbox"
					name="extract_version_installed_committed" value="extract_version_installed_committed"
					<?php if(in_array('extract_version_installed_committed', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Software installed and committed</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_version_installed_committed&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['show_version_installed_committed']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['show_version_installed_committed']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td style="width: 10px;"><input id="extract_alarms" type="checkbox"
					name="extract_alarms" value="extract_alarms"
					<?php if(in_array('extract_alarms', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Alarms</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_alarms&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['environmental']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['environmental']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td style="width: 10px;"><input id="extract_power_supply" type="checkbox"
					name="extract_power_supply" value="extract_power_supply"
					<?php if(in_array('extract_power_supply', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Power supply</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_power_supply&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['power_supply']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['power_supply']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td style="width: 10px;"><input id="extract_platform" type="checkbox"
					name="extract_platform" value="extract_platform"
					<?php if(in_array('extract_platform', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Line card status</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_platform&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['platform']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['platform']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td style="width: 10px;"><input id="extract_fabric_status" type="checkbox"
					name="extract_fabric_status" value="extract_fabric_status"
					<?php if(in_array('extract_fabric_status', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Fabric Status</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_fabric_status&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['fabric status']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['fabric status']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td style="width: 10px;"><input id="extract_fabric_inter_asic_drops" type="checkbox"
					name="extract_fabric_inter_asic_drops" value="extract_fabric_inter_asic_drops"
					<?php if(in_array('extract_fabric_inter_asic_drops', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Fabric interface ASIC drops</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_fabric_inter_asic_drops&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['fabric interface asic drops']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['fabric interface asic drops']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td style="width: 10px;"><input id="extract_fabric_inter_asic_errors" type="checkbox"
					name="extract_fabric_inter_asic_errors" value="extract_fabric_inter_asic_errors"
					<?php if(in_array('extract_fabric_inter_asic_errors', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Fabric interface ASIC errors</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_fabric_inter_asic_errors&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['fabric interface asic errors']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['fabric interface asic errors']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td style="width: 10px;"><input id="extract_fabric_inter_asic_link_status" type="checkbox"
					name="extract_fabric_inter_asic_link_status" value="extract_fabric_inter_asic_link_status"
					<?php if(in_array('extract_fabric_inter_asic_link_status', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Fabric Interface ASIC link-status</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_fabric_inter_asic_link_status&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['fabric interface asic link-status']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['fabric interface asic link-status']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td style="width: 10px;"><input id="extract_up_down_status" type="checkbox"
					name="extract_up_down_status" value="extract_up_down_status"
					<?php if(in_array('extract_up_down_status', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Up/down status</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_up_down_status&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color1 = ($output['UP/DOWN Status']['ipv6_interface_brief']['R'] == 0) ? 'green' : 'red';
                    $display1 = "<span style='color:" . $color1 . "'>" . $output['UP/DOWN Status']['ipv6_interface_brief']['message'] . '</span>';
$color2 = ($output['UP/DOWN Status']['ipv4_interface_brief']['R'] == 0) ? 'green' : 'red';
                    $display2 = "<span style='color:" . $color2 . "'>" . $output['UP/DOWN Status']['ipv4_interface_brief']['message'] . '</span>';
$display = $display1.$display2;
                    echo $display;
                    ?>
				</td>
				<td style="width: 10px;"><input id="extract_count_interfaces" type="checkbox"
					name="extract_count_interfaces" value="extract_count_interfaces"
					<?php if(in_array('extract_count_interfaces', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Interface counters</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_count_interfaces&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['interfacecounters']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['interfacecounters']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td style="width: 10px;"><input id="extract_bfd_session" type="checkbox"
					name="extract_bfd_session" value="extract_bfd_session"
					<?php if(in_array('extract_bfd_session', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>BFD session</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_bfd_session&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['bfdsession']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['bfdsession']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td style="width: 10px;"><input id="extract_vrrp" type="checkbox"
					name="extract_vrrp" value="extract_vrrp"
					<?php if(in_array('extract_vrrp', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>VRRP</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_vrrp&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['VRRP']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['VRRP']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td style="width: 10px;"><input id="extract_ntp" type="checkbox"
					name="extract_ntp" value="extract_ntp"
					<?php if(in_array('extract_ntp', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>NTP</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_ntp&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['NTP']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['NTP']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td style="width: 10px;"><input id="extract_global_ospf_neighbor" type="checkbox"
					name="extract_global_ospf_neighbor" value="extract_global_ospf_neighbor"
					<?php if(in_array('extract_global_ospf_neighbor', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Global OSPF neighbors</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_global_ospf_neighbor&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['global ospf neighbor']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['global ospf neighbor']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td style="width: 10px;"><input id="extract_1xrtt_ospf_neighbor" type="checkbox"
					name="extract_1xrtt_ospf_neighbor" value="extract_1xrtt_ospf_neighbor"
					<?php if(in_array('extract_1xrtt_ospf_neighbor', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>1XRTT OSPF Neighbor</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_1xrtt_ospf_neighbor&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['1XRTT ospf']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['1XRTT ospf']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td style="width: 10px;"><input id="extract_cell_mgmt_ospf_neighbor" type="checkbox"
					name="extract_cell_mgmt_ospf_neighbor" value="extract_cell_mgmt_ospf_neighbor"
					<?php if(in_array('extract_cell_mgmt_ospf_neighbor', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>CELL_MGMT OSPF Neighbor</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_cell_mgmt_ospf_neighbor&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['CELL_MGMT OSPF neighbor']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['CELL_MGMT OSPF neighbor']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td style="width: 10px;"><input id="extract_ospf_nsr_gr" type="checkbox"
					name="extract_ospf_nsr_gr" value="extract_ospf_nsr_gr"
					<?php if(in_array('extract_ospf_nsr_gr', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>OSPF NSR and GR</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_ospf_nsr_gr&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['ospf nsr and gr']['R'] == 0) ? 'green' : 'red';
                      $display = "<span style='color:" . $color . "'>" . $output['ospf nsr and gr']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td style="width: 10px;"><input id="extract_ldp_neighbor" type="checkbox"
					name="extract_ldp_neighbor" value="extract_ldp_neighbor"
					<?php if(in_array('extract_ldp_neighbor', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>LDP neighbors</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_ldp_neighbor&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['ldp neighbors']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['ldp neighbors']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td style="width: 10px;"><input id="extract_wdn_peering" type="checkbox"
					name="extract_wdn_peering" value="extract_wdn_peering"
					<?php if(in_array('extract_wdn_peering', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>WDN peering</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_wdn_peering&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['WDN peering']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['WDN peering']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td style="width: 10px;"><input id="extract_csr_peering" type="checkbox"
					name="extract_csr_peering" value="extract_csr_peering"
					<?php if(in_array('extract_csr_peering', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>CSR peering</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_csr_peering&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a>
					<?php 
						$color1 = ($output['CSR peering']['vpnv6_csr_peering']['R'] == 0) ? 'green' : 'red';                    
						$display1 = "<span style='color:" . $color1 . "'>" . $output['CSR peering']['vpnv6_csr_peering']['message'] . '</span>';
						$color2 = ($output['CSR peering']['vpnv4_csr_peering']['R'] == 0) ? 'green' : 'red';
                                                $display2 = "<span style='color:" . $color2 . "'>" . $output['CSR peering']['vpnv4_csr_peering']['message'] . '</span>';
						$display = $display1.$display2;
                    echo $display;
                    ?>
				</td>
				<td style="width: 10px;"><input id="extract_crs_wdn_peering" type="checkbox"
					name="extract_crs_wdn_peering" value="extract_crs_wdn_peering"
					<?php if(in_array('extract_crs_wdn_peering', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>CRS WDN peering</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_crs_wdn_peering&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['CRS WDN peering']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['CRS WDN peering']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<td style="width: 10px;"><input id="extract_crs_lte_peering" type="checkbox"
					name="extract_crs_lte_peering" value="extract_crs_lte_peering"
					<?php if(in_array('extract_crs_lte_peering', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>CRS LTE peering</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_crs_lte_peering&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['CRS LTE peering']['ipv6_crs_lte_peering']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color1 . "'>" . $output['CRS LTE peering']['ipv6_crs_lte_peering']['message'] . '</span>';
		    $color2 = ($output['CRS LTE peering']['ipv4_crs_lte_peering']['R'] == 0) ? 'green' : 'red';
                    $display2 = "<span style='color:" . $color2 . "'>" . $output['CRS LTE peering']['ipv4_crs_lte_peering']['message'] . '</span>';
		    $display = $display1.$display2;
                    echo $display;
                    ?>
				</td>
				</tr>
				<tr>
				<td style="width: 10px;"><input id="extract_bgp_nsr_graceful_restart" type="checkbox"
					name="extract_bgp_nsr_graceful_restart" value="extract_bgp_nsr_graceful_restart"
					<?php if(in_array('extract_bgp_nsr_graceful_restart', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>BGP NSR and Graceful Restart</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_bgp_nsr_graceful_restart&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['BGP NSR and Graceful Restart']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['BGP NSR and Graceful Restart']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>
				<!--<td style="width: 10px;"><input id="extract_air_filter_check " type="checkbox"
					name="extract_air_filter_check " value="extract_air_filter_check "
					<?php if(in_array('extract_air_filter_check ', $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Air Filter Check</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="ems-devdetmdl-cellsite.php?commandname=extract_air_filter_check&deviceid=<?php echo $_SESSION['deviceidswusr'];?>&deviceseries=<?php echo $_GET['deviceseries']?>&version=<?php echo $_GET['version']?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
                    $color = ($output['extract_air_filter_check']['R'] == 0) ? 'green' : 'red';
                    $display = "<span style='color:" . $color . "'>" . $output['extract_air_filter_check']['message'] . '</span>';
                    echo $display;
                    ?>
				</td>-->
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

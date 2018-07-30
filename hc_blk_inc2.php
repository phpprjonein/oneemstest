
<div class="ownfont box-body launch-modal" id="health-chk-div-wrap">
	<table class="table table-bordered" cellspacing="0" cellpadding="0">
		<tbody>
			<tr>
				<td style="width: 10px;"><input type="checkbox" name="iosversion"
					id="iosversion" value="2"
					<?php if(in_array(2, $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Software Version </b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=iosversion&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['iosversion']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['iosversion']['message'] . '</span>';
    echo $display;
    ?>
</td>
				<td style="width: 10px;"><input id="cpuutilization" type="checkbox"
					name="cpuutilization" value="1"
					<?php if(in_array(1, $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>CPU Utilization</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=cpuutilization&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['cpuutilization']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['cpuutilization']['message'] . '</span>';
    echo $display;
    ?>
</td>
				<td style="width: 10px;"><input type="checkbox" id="freememory"
					name="freememory" value="8"
					<?php if(in_array(8, $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Free Memory</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=freememory&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['freememory']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['freememory']['message'] . '</span>';
    echo $display;
    ?>
</td>
			</tr>


			<tr>
				<td><input type="checkbox" id="bootstatement" name="bootstatement"
					value="16" <?php if(in_array(16, $_GET['category'])):?>
					checked="checked" <?php endif;?>></td>
				<td><b>Boot Statement</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=bootstatement&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['bootstatement']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['bootstatement']['message'] . '</span>';
    echo $display;
    ?>
</td>
				<td><input type="checkbox" id="platform" name="platform" value="6"
					<?php if(in_array(6, $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Platform </b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=platform&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['platform']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['platform']['message'] . '</span>';
    echo $display;
    ?>
</td>
				<td><input type="checkbox" id="environmental" name="environmental"
					value="4" <?php if(in_array(4, $_GET['category'])):?>
					checked="checked" <?php endif;?>></td>
				<td><b>Environmental</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=environment&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['environmental']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['environmental']['message'] . '</span>';
    echo $display;
    ?>
</td>


			</tr>

			<tr>
				<td><input type="checkbox" id="interfacecounters"
					name="interfacecounters" value="7"
					<?php if(in_array(7, $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Interface Counters</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=interfacecounters&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['interfacecounters']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['interfacecounters']['count'] . '</span>';
    echo $display;
    ?>
</td>
				<td><input type="checkbox" id="bfdsession" name="bfdsession"
					value="10" <?php if(in_array(10, $_GET['category'])):?>
					checked="checked" <?php endif;?>></td>
				<td><b>BFD Sessions</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=bfdsession&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['bfdsession']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['bfdsession']['message'] . '</span>';
    echo $display;
    ?>
</td>
				<td><input type="checkbox" id="logentries" name="logentries"
					value="15" <?php if(in_array(15, $_GET['category'])):?>
					checked="checked" <?php endif;?>></td>
				<td><b>Log Entries</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=logentries&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><i
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
				<td><input type="checkbox" id="interfacestates"
					name="interfacestates" value="9"
					<?php if(in_array(9, $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Interface State</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=interfacestates&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['interfacestates']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['interfacestates']['message'] . '</span>';
    echo $display;
    ?>
</td>
				<td><input type="checkbox" id="xconnect" name="xconnect" value="20"
					<?php if(in_array(20, $_GET['category'])):?> checked="checked"
					<?php endif;?>></td>
				<td><b>Xconnect</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=xconnect&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['xconnect']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['xconnect']['count'] . '</span>';
    echo $display;
    ?>
</td>
				<td><input type="checkbox" id="mplsinterfaces" name="mplsinterfaces"
					value="12" <?php if(in_array(12, $_GET['category'])):?>
					checked="checked" <?php endif;?>></td>
				<td><b>MPLS Interfaces</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=mplsinterfaces&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['mplsinterfaces']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['mplsinterfaces']['message'] . '</span>';
    echo $display;
    ?>
</td>
			</tr>
			<tr>
				<td><input type="checkbox" id="mplsneighbors" name="mplsneighbors"
					value="11" <?php if(in_array(11, $_GET['category'])):?>
					checked="checked" <?php endif;?>></td>
				<td><b>MPLS Neighbors</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=mplsneighbors&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['mplsneighbors']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['mplsneighbors']['message'] . '</span>';
    echo $display;
    ?>
</td>
				<td><input type="checkbox" id="mplsneighbors" name="mplsneighbors"
					value="11" <?php if(in_array(11, $_GET['category'])):?>
					checked="checked" <?php endif;?>></td>
				<td><b>Routes Status</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=mplsneighbors&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['mplsneighbors']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['mplsneighbors']['message'] . '</span>';
    echo $display;
    ?>
</td>
				<td><input type="checkbox" id="mplsneighbors" name="mplsneighbors"
					value="11" <?php if(in_array(11, $_GET['category'])):?>
					checked="checked" <?php endif;?>></td>
				<td><b>Static Routes</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=mplsneighbors&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['mplsneighbors']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['mplsneighbors']['message'] . '</span>';
    echo $display;
    ?>
</td>
			</tr>
			<tr>
				<td><input type="checkbox" id="mplsneighbors" name="mplsneighbors"
					value="11" <?php if(in_array(11, $_GET['category'])):?>
					checked="checked" <?php endif;?>></td>
				<td><b>Service Service Using</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=mplsneighbors&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['mplsneighbors']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['mplsneighbors']['message'] . '</span>';
    echo $display;
    ?>
</td>
				<td><input type="checkbox" id="mplsneighbors" name="mplsneighbors"
					value="11" <?php if(in_array(11, $_GET['category'])):?>
					checked="checked" <?php endif;?>></td>
				<td><b>ARP</b></td>
				<td><a id="anchorcmd" class="anchorcmd"
					href="devdetmdl-cellsite.php?commandname=mplsneighbors&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><i
						class="fa fa-file-text-o fa-lg text-primary"></i></a><?php
    
    $color = ($output['mplsneighbors']['R'] == 0) ? 'green' : 'red';
    $display = "<span style='color:" . $color . "'>" . $output['mplsneighbors']['message'] . '</span>';
    echo $display;
    ?>
</td>

			</tr>




			<tr>
				<td colspan="3" class="run_custom_checks text-center"
					data-deviceid="<?php echo $deviceid ?>"
					data-userid="<?php echo $_SESSION['userid'] ?>"><button
						class="btn btn-primary">Run selected health Checks</button></td>
				<td colspan="3" class="run_all_checks text-center"
					data-deviceid="<?php echo $deviceid ?>"
					data-userid="<?php echo $_SESSION['userid'] ?>"><button
						class="btn btn-primary">Run All Health Checks</button></td>
				<td colspan="3" class="text-center"><b>Last Run On - <?php echo $lastupdated;?></b></td>
				<!-- <td colspan="2" class="run_preventive_checks" data-deviceid="<?php echo $deviceid ?>"  data-userid="<?php echo $_SESSION['userid'] ?>" style="cursor: pointer;">&nbsp;<!--<b>Run Preventive Health Checks</b></td> -->
			</tr>
		</tbody>
	</table>
</div>

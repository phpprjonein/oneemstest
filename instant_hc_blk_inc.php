                <div class="ownfont box-body launch-modal" id="health-chk-div-wrap">
                 <table class="table table-bordered"  cellspacing="0" cellpadding="0" >
                    <tbody>
                                            <tr>
                                              <td><b>IOS Version </b></td>
                                              <td>
<?php $color = ($output['iosversion']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>".$output['iosversion']['message'].'</span>';echo $display; ?>
</td>
                                              <td><b>CPU Utilization</b></td>
                                              <td>
<?php $color = ($output['cpuutilization']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>".$output['cpuutilization']['message'].'</span>';
echo $display; ?>
</td>
                                              <td><b>Free Memory</b> </td>
                                              <td>
<?php $color = ($output['freememory']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>".$output['freememory']['message'].'</span>';
echo $display; ?>
</td>
                                            </tr>
                                            <tr>
                                              <td><b>Buffers</b></td>
                                              <td>
<?php $color = ($output['buffers']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>".$output['buffers']['message'].'</span>';
echo $display; ?>
</td>
                                              <td><b>Boot Statement</b></td>
                                              <td>
<?php $color = ($output['bootstatement']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>".$output['bootstatement']['message'].'</span>';
echo $display; ?>
</td>
                                              <td><b>Platform </b></td>
                                              <td>
<?php $color = ($output['platform']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>".$output['platform']['message'].'</span>';
echo $display; ?>
</td>
                                            </tr>

                                            <tr>
                                              <td><b>Environmental</b></td>
                                              <td>
<?php $color = ($output['environmental']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>".$output['environmental']['message'].'</span>';
echo $display; ?>
</td>
                                              <td><b>Config Register</b></td>
                                              <td>
<?php $color = ($output['configregister']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>".$output['configregister']['message'].'</span>';
echo $display; ?>
</td>
                                              <td><b>Interface Counters</b> </td>
                                              <td>
<?php $color = ($output['interfacecounters']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>".$output['interfacecounters']['count'].'</span>';
echo $display; ?>
</td>
                                            </tr>
                                            <tr>
                                              <td><b>2000 Byte Ping</b></td>
                                              <td>
<?php $color = ($output['twothsndbyteping']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>".$output['twothsndbyteping']['message'].'</span>';
echo $display; ?>
</td>
                                              <td><b>BFD Sessions</b></td>
                                              <td>
<?php $color = ($output['bfdsession']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>".$output['bfdsession']['message'].'</span>';
echo $display; ?>
											  <td><b>Log Entries</b></td>
                                              <td>
<?php if (isset($output['logentries']['buffer_logging']['R'])){
													$color = ($output['logentries']['buffer_logging']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>"." Buffer Logging : ".$output['logentries']['buffer_logging']['value'].'</span>';
											  echo $display;}?>
											  <?php if (isset($output['logentries']['trap_logging']['R'])) {
												  $color = ($output['logentries']['trap_logging']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>"."<br> Trap Logging : ".$output['logentries']['trap_logging']['value'].'</span>';
											  echo $display;}; ?>
											  </td>
                                            </tr>
                                            <tr>
                                              <td><b>VRF</b></td>
                                              <td>
<?php $color = ($output['vrfstates']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>".$output['vrfstates']['message'].'</span>';
echo $display; ?>
</td>
                                              <td><b>Interface State</b></td>
                                              <td>
<?php $color = ($output['interfacestates']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>".$output['interfacestates']['message'].'</span>';
echo $display; ?>
</td>
                                              <td><b>Xconnect</b></td>
                                              <td>
<?php $color = ($output['xconnect']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>".$output['xconnect']['count'].'</span>';
echo $display; ?>
</td>
                                            </tr>
                                            <tr>
                                              <td><b>MPLS Interfaces</b></td>
                                              <td>
<?php $color = ($output['mplsinterfaces']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>".$output['mplsinterfaces']['message'].'</span>';
echo $display; ?>
</td>
                                              <td><b>IPV4 BGP Neighbors</b></td>
                                              <td>
<?php $color = ($output['bgpvfourneighbors']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>".$output['bgpvfourneighbors']['neighbours'].'</span>';
echo $display; ?>
</td>										  
                                              <td><b>IPV4 BGP Routes</b></td>
                                              <td>
<?php
$color = ($output['ran']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>".$output['ran']['count'].'</span>';
echo $display; ?>
</td>
                                            </tr>
                                            <tr>
                                              <td><b>MPLS Neighbors</b></td>
                                              <td>
<?php $color = ($output['mplsneighbors']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>".$output['mplsneighbors']['message'].'</span>';
echo $display; ?>
</td>
                                              <td><b>IPV6 BGP Neighbors</b></td>
                                              <td>
<?php
$color = ($output['bgpvsixneighbors']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>".$output['bgpvsixneighbours']['neighbours'].'</span>';
echo $display; ?>
</td>
                                              <td><b>IPV6 BGP Routes</b></td>
                                              <td>
<?php
$color = ($output['bgpvsixroutes']['R'] == 0) ? 'green':'red';
$display ="<span style='color:".$color."'>".$output['bgpvsixroutes']['count'].'</span>';
echo $display; ?>
</td>
  </tr>
    <tr>
    <?php
    if($healthchktype != 'Load Table'){
        $device_status = '<tr><td align="right" class="border-0"><b>Status: </b></td><td align="left" class="border-0"><b>';
        //if($output['status']['error']){
            if(($output['error']) || ($healthchktype == 'Custom' && count($_GET['category']) == 0)){
            $device_status .= 'Failed';
        }else{
            $device_status .= 'Reached';
        }
        $device_status .= '</b></td></tr>';
    }
    ?>
    <td colspan="3" class="instant_run_all_checks text-center"  data-deviceid="<?php echo $deviceid ?>"  data-userid="<?php echo $_SESSION['userid'] ?>"><button class="btn btn-primary">Run All Health Checks</button></td>
    <td colspan="3" class="text-center"><table class="border-0"><tr><td align="right" class="float-right border-0"><b>Last Run On:</b></td><td align="left" class="border-0"><b><?php echo $lastupdated;?></b></td><?php echo $device_status; ?></tr>
    <tr><td align="center" class="border-0" colspan="2"><!-- <button type="button" id="but<?php echo $deviceid ?>" class="btn btn-sm auditLog" data-toggle="modal">Audit Log</button> --></td></tr>
    </table></td>
    <!-- <td colspan="2" class="run_preventive_checks" data-deviceid="<?php echo $deviceid ?>"  data-userid="<?php echo $_SESSION['userid'] ?>" style="cursor: pointer;">&nbsp;<!--<b>Run Preventive Health Checks</b></td> -->
  </tr>
</tbody>
</table>
</div>

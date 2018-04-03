                <div class="ownfont box-body launch-modal" id="health-chk-div-wrap">
                 <table class="table table-bordered"  cellspacing="0" cellpadding="0" >
                    <tbody>
                                            <tr>
                                              <td style="width: 10px;"><input type="checkbox" name="iosversion" id="iosversion" value="2" <?php if(in_array(2, $_GET['category'])):?> checked="checked" <?php endif;?>></td>	                  
                                              <td><b>IOS Version </b></td>
                                              <td>
<a id="anchorcmd" class="anchorcmd" href="devdetmdl-cellsite.php?commandname=iosversion&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><img src="resources/img/RDimage.png"  alt="Smiley face" height="22" width="22"> </img></a><?php $color = ($output['iosversion']['R'] == 0) ? 'green':'red';  
$display ="<span style='color:".$color."'>".$output['iosversion']['message'].'</span>';echo $display; ?>
</td>					
                                              <td style="width: 10px;"><input id="cpuutilization" type="checkbox" name="cpuutilization" value="1" <?php if(in_array(1, $_GET['category'])):?> checked="checked" <?php endif;?>></td>
                                              <td><b>CPU Utilization</b></td>
                                              <td>
<a id="anchorcmd" class="anchorcmd" href="devdetmdl-cellsite.php?commandname=cpuutilization&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><img src="resources/img/RDimage.png" alt="Smiley face" height="22" width="22"></img></a><?php $color = ($output['cpuutilization']['R'] == 0) ? 'green':'red';  
$display ="<span style='color:".$color."'>".$output['cpuutilization']['message'].'</span>';
echo $display; ?>
</td>
                                              <td style="width: 10px;"><input type="checkbox" id="freememory" name="freememory" value="8" <?php if(in_array(8, $_GET['category'])):?> checked="checked" <?php endif;?>></td>
                                              <td><b>Free Memory</b> </td>
                                              <td>
<a id="anchorcmd" class="anchorcmd" href="devdetmdl-cellsite.php?commandname=freememory&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><img src="resources/img/RDimage.png" alt="Smiley face" height="22" width="22"> </img></a><?php $color = ($output['freememory']['R'] == 0) ? 'green':'red';  
$display ="<span style='color:".$color."'>".$output['freememory']['message'].'</span>';
echo $display; ?>
</td>
                                            </tr>
                                            <tr>
                                              <td><input type="checkbox" id="buffers" name="buffers" value="5" <?php if(in_array(5, $_GET['category'])):?> checked="checked" <?php endif;?>></td>                  
                                              <td><b>Buffers</b></td>
                                              <td>
<a id="anchorcmd" class="anchorcmd" href="devdetmdl-cellsite.php?commandname=buffers&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><img src="resources/img/RDimage.png" alt="Smiley face" height="22" width="22"> </img></a><?php $color = ($output['buffers']['R'] == 0) ? 'green':'red';  
$display ="<span style='color:".$color."'>".$output['buffers']['message'].'</span>';
echo $display; ?>
</td>
											  <td><input type="checkbox" id="bootstatement" name="bootstatement" value="16" <?php if(in_array(16, $_GET['category'])):?> checked="checked" <?php endif;?>></td>
                                              <td><b>Boot statement</b></td>
                                              <td>
<a id="anchorcmd" class="anchorcmd" href="devdetmdl-cellsite.php?commandname=bootstatement&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><img src="resources/img/RDimage.png" alt="Smiley face" height="22" width="22"> </img></a><?php $color = ($output['bootstatement']['R'] == 0) ? 'green':'red';  
$display ="<span style='color:".$color."'>".$output['bootstatement']['message'].'</span>';
echo $display; ?> 
</td>
											  <td><input type="checkbox" id="platform" name="platform" value="6" <?php if(in_array(6, $_GET['category'])):?> checked="checked" <?php endif;?>></td>
                                              <td><b>Platform </b></td>
                                              <td>
<a id="anchorcmd" class="anchorcmd" href="devdetmdl-cellsite.php?commandname=platform&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><img src="resources/img/RDimage.png" alt="Smiley face" height="22" width="22"> </img></a><?php $color = ($output['platform']['R'] == 0) ? 'green':'red';  
$display ="<span style='color:".$color."'>".$output['platform']['message'].'</span>';
echo $display; ?>
</td>
                                            </tr>
                                            
                                            <tr>
                                              <td><input type="checkbox" id="environmental" name="environmental" value="4" <?php if(in_array(4, $_GET['category'])):?> checked="checked" <?php endif;?>></td>                  
                                              <td><b>Environmental</b></td>
                                              <td>
<a id="anchorcmd" class="anchorcmd" href="devdetmdl-cellsite.php?commandname=environmental&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><img src="resources/img/RDimage.png" alt="Smiley face" height="22" width="22"> </img></a><?php $color = ($output['environmental']['R'] == 0) ? 'green':'red';  
$display ="<span style='color:".$color."'>".$output['environmental']['message'].'</span>';
echo $display; ?>
</td>
                                              <td><input type="checkbox" id="configregister" name="configregister" value="3" <?php if(in_array(3, $_GET['category'])):?> checked="checked" <?php endif;?>></td>
                                              <td><b>Config Register</b></td>
                                              <td>
<a id="anchorcmd" class="anchorcmd" href="devdetmdl-cellsite.php?commandname=configregister&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><img src="resources/img/RDimage.png" alt="Smiley face" height="22" width="22"> </img></a><?php $color = ($output['configregister']['R'] == 0) ? 'green':'red';  
$display ="<span style='color:".$color."'>".$output['configregister']['message'].'</span>';
echo $display; ?>
</td>
											  <td><input type="checkbox" id="interfacecounters" name="interfacecounters" value="7" <?php if(in_array(7, $_GET['category'])):?> checked="checked" <?php endif;?>></td>
                                              <td><b>Interface Counters</b> </td>
                                              <td>
<a id="anchorcmd" class="anchorcmd" href="devdetmdl-cellsite.php?commandname=interfacecounters&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><img src="resources/img/RDimage.png" alt="Smiley face" height="22" width="22"> </img></a><?php $color = ($output['interfacecounters']['R'] == 0) ? 'green':'red';  
$display ="<span style='color:".$color."'>".$output['interfacecounters']['count'].'</span>';
echo $display; ?>
</td>
                                            </tr>
                                            <tr>
                                              <td><input type="checkbox" id="twothsndbyteping" name="twothsndbyteping" value="22" <?php if(in_array(22, $_GET['category'])):?> checked="checked" <?php endif;?>></td>                  
                                              <td><b>2000 Byte Ping</b></td>                                              
                                              <td>
<a id="anchorcmd" class="anchorcmd" href="devdetmdl-cellsite.php?commandname=twothsndbyteping&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><img src="resources/img/RDimage.png" alt="Smiley face" height="22" width="22"> </img></a><?php $color = ($output['twothsndbyteping']['R'] == 0) ? 'green':'red';  
$display ="<span style='color:".$color."'>".$output['twothsndbyteping']['message'].'</span>';
echo $display; ?>
</td>
											  <td><input type="checkbox" id="bfdsession" name="bfdsession" value="10" <?php if(in_array(10, $_GET['category'])):?> checked="checked" <?php endif;?>></td>
                                              <td><b>BFD Sessions</b></td>
                                              <td>
<a id="anchorcmd" class="anchorcmd" href="devdetmdl-cellsite.php?commandname=bfdsession&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><img src="resources/img/RDimage.png" alt="Smiley face" height="22" width="22"> </img></a><?php $color = ($output['bfdsession']['R'] == 0) ? 'green':'red';  
$display ="<span style='color:".$color."'>".$output['bfdsession']['message'].'</span>';
echo $display; ?>
</td>										  <td><input type="checkbox" id="logentries" name="logentries" value="15" <?php if(in_array(15, $_GET['category'])):?> checked="checked" <?php endif;?>></td>
											  <td><b>Log Entries</b></td>
                                              <td>
<a id="anchorcmd" class="anchorcmd" href="devdetmdl-cellsite.php?commandname=logentries&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><img src="resources/img/RDimage.png" alt="Smiley face" height="22" width="22"> </img></a><?php if (isset($output['logentries']['buffer_logging']['R'])){
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
                                              <td><input type="checkbox" id="fivethsndbyteping" name="fivethsndbyteping" value="23" <?php if(in_array(23, $_GET['category'])):?> checked="checked" <?php endif;?>></td>
                                              <td><b>VRF</b></td>                                              
                                              <td>
<a id="anchorcmd" class="anchorcmd" href="devdetmdl-cellsite.php?commandname=fivethsndbyteping&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><img src="resources/img/RDimage.png" alt="Smiley face" height="22" width="22"> </img></a><?php $color = ($output['fivethsndbyteping']['R'] == 0) ? 'green':'red';  
$display ="<span style='color:".$color."'>".$output['fivethsndbyteping']['message'].'</span>';
echo $display; ?> 
</td>
											  <td><input type="checkbox" id="interfacestates" name="interfacestates" value="9" <?php if(in_array(9, $_GET['category'])):?> checked="checked" <?php endif;?>></td>
                                              <td><b>Interface State</b></td>
                                              <td>
<a id="anchorcmd" class="anchorcmd" href="devdetmdl-cellsite.php?commandname=interfacestates&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><img src="resources/img/RDimage.png" alt="Smiley face" height="22" width="22"> </img></a><?php $color = ($output['interfacestates']['R'] == 0) ? 'green':'red';  
$display ="<span style='color:".$color."'>".$output['interfacestates']['message'].'</span>';
echo $display; ?> 
</td>
											  <td><input type="checkbox" id="xconnect" name="xconnect" value="20" <?php if(in_array(20, $_GET['category'])):?> checked="checked" <?php endif;?>></td>
                                              <td><b>Xconnect</b></td>
                                              <td>
<a id="anchorcmd" class="anchorcmd" href="devdetmdl-cellsite.php?commandname=xconnect&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><img src="resources/img/RDimage.png" alt="Smiley face" height="22" width="22"> </img></a><?php $color = ($output['xconnect']['R'] == 0) ? 'green':'red';  
$display ="<span style='color:".$color."'>".$output['xconnect']['count'].'</span>';
echo $display; ?>
</td>
                                            </tr>
                                            <tr>                  
                                              <td><input type="checkbox" id="mplsinterfaces" name="mplsinterfaces" value="12" <?php if(in_array(12, $_GET['category'])):?> checked="checked" <?php endif;?>></td>
                                              <td><b>MPLS Interfaces</b></td>                                              
                                              <td>
<a id="anchorcmd" class="anchorcmd" href="devdetmdl-cellsite.php?commandname=mplsinterfaces&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><img src="resources/img/RDimage.png" alt="Smiley face" height="22" width="22"> </img></a><?php $color = ($output['mplsinterfaces']['R'] == 0) ? 'green':'red';  
$display ="<span style='color:".$color."'>".$output['mplsinterfaces']['message'].'</span>';
echo $display; ?>
</td>
											  <td><input type="checkbox" id="bgpvfourneighbors" name="bgpvfourneighbors" value="13" <?php if(in_array(13, $_GET['category'])):?> checked="checked" <?php endif;?>></td>
                                              <td><b>IPV4 BGP Neighbors</b></td>
                                              <td>
<a id="anchorcmd" class="anchorcmd" href="devdetmdl-cellsite.php?commandname=bgpvfourneighbors&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><img src="resources/img/RDimage.png" alt="Smiley face" height="22" width="22"> </img></a><?php $color = ($output['bgpvfourneighbors']['R'] == 0) ? 'green':'red';  
$display ="<span style='color:".$color."'>".$output['bgpvfourneighbors']['neighbours'].'</span>';
echo $display; ?>
</td>										  <td><input type="checkbox" id="ran" name="ran" value="19" <?php if(in_array(19, $_GET['category'])):?> checked="checked" <?php endif;?>></td>
                                              <td><b>IPV4 BGP Routes</b></td>
                                              <td>
<a id="anchorcmd" class="anchorcmd" href="devdetmdl-cellsite.php?commandname=ran&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><img src="resources/img/RDimage.png" alt="Smiley face" height="22" width="22"> </img></a> <?php
$color = ($output['ran']['R'] == 0) ? 'green':'red';  
$display ="<span style='color:".$color."'>".$output['ran']['count'].'</span>';
echo $display; ?>
</td> 
                                            </tr>                  
                                            <tr>   
                                              <td><input type="checkbox" id="mplsneighbors" name="mplsneighbors" value="11" <?php if(in_array(11, $_GET['category'])):?> checked="checked" <?php endif;?>></td>
                                              <td><b>MPLS Neighbors</b></td>                                              
                                              <td>
<a id="anchorcmd" class="anchorcmd" href="devdetmdl-cellsite.php?commandname=mplsneighbors&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><img src="resources/img/RDimage.png" alt="Smiley face" height="22" width="22"> </img></a><?php $color = ($output['mplsneighbors']['R'] == 0) ? 'green':'red';  
$display ="<span style='color:".$color."'>".$output['mplsneighbors']['message'].'</span>';
echo $display; ?>
</td>
											  <td><input type="checkbox" id="bgpvsixneighbours" name="bgpvsixneighbours" value="14" <?php if(in_array(14, $_GET['category'])):?> checked="checked" <?php endif;?>></td>
                                              <td><b>IPV6 BGP Neighbors</b></td>
                                              <td>
<a id="anchorcmd" class="anchorcmd" href="devdetmdl-cellsite.php?commandname=bgpvsixneighbours&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><img src="resources/img/RDimage.png" alt="Smiley face" height="22" width="22"> </img></a><?php
$color = ($output['bgpvsixneighbors']['R'] == 0) ? 'green':'red';  
$display ="<span style='color:".$color."'>".$output['bgpvsixneighbours']['neighbours'].'</span>';
echo $display; ?>
</td>
											  <td><input type="checkbox" id="bgpvsixroutes" name="bgpvsixroutes" value="17" <?php if(in_array(17, $_GET['category'])):?> checked="checked" <?php endif;?>></td>
                                              <td><b>IPV6 BGP Routes</b></td>
                                              <td>
<a id="anchorcmd" class="anchorcmd" href="devdetmdl-cellsite.php?commandname=bgpvsixroutes&deviceid=<?php echo $_SESSION['deviceidswusr'];?>"><img src="resources/img/RDimage.png" alt="Smiley face" height="22" width="22"> </img></a> <?php
$color = ($output['bgpvsixroutes']['R'] == 0) ? 'green':'red';  
$display ="<span style='color:".$color."'>".$output['bgpvsixroutes']['count'].'</span>';
echo $display; ?>
</td>
                                            </tr>                  
                                              <tr>  
                                              <td colspan="2" class="run_custom_checks" data-deviceid="<?php echo $deviceid ?>"  data-userid="<?php echo $_SESSION['userid'] ?>" style="cursor: pointer;"><b>Run Custom Health Checks</b></td>
                                              <td colspan="2" class="run_preventive_checks" data-deviceid="<?php echo $deviceid ?>"  data-userid="<?php echo $_SESSION['userid'] ?>" style="cursor: pointer;"><b>Run Preventive Health Checks</b></td>                 
                                              <td colspan="2" class="run_all_checks"  data-deviceid="<?php echo $deviceid ?>"  data-userid="<?php echo $_SESSION['userid'] ?>" style="cursor: pointer;"><b>Run All Health Checks</b></td>
                                              <td colspan="3"><b>Last Run On - <?php echo $result['lastupdated'];?></b></td>
                                            </tr>
                                          </tbody>
                                       </table>
                                    </div>

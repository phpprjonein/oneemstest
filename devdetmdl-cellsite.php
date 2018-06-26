<?php
$command = $_GET['commandname'];
$deviceid = $_GET['deviceid'];
// $deviceid = 2;

switch ($command) {
    
    case 'freememory':
        // $url='http://10.134.179.82:8080/healthcheck/ios/2///
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/8';
        break;
    case 'buffers':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/5';
        break;
    // case 'showversion':
    case 'iosversion':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/2';
        break;
    case 'configregister':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/3';
        break;
    case 'environment':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/4';
        break;
    case 'platform':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/6';
        break;
    case 'bfdsession':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/10';
        break;
    case 'interfacestates':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/9';
        break;
    case 'showinterfaces':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/7';
        break;
    case 'mplsinterfaces':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/12';
        break;
    case 'mplsneighbors':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/11';
        break;
    case 'bgpvsixroutes':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/17';
        break;
    case 'show-running-config-|-i-boot':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/16';
        break;
    case 'cpuutilization':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/1';
        break;
    case 'vrfstates':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/23';
        break;
    case 'twothsndbyteping':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/22';
        break;
    case 'bgpvsixneighbors':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/14';
        break;
    case 'bgpvfourneighbors':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/13';
        break;
    case 'xconnect':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/20';
        break;
    // case 'bgpvfourroutes':
    case 'ran':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/19';
        break;
    case 'bootstatement':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/16';
        break;
    case 'interfacecounters':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/7';
        break;
    case 'logentries':
        $url = 'http://10.134.179.82:8080/healthcheck/ios/' . $deviceid . '/15';
        break;
    
    default:
        break;
}
/* Ends */
?>
<div class="modal-header">
	<h5 class="modal-title" id="exampleModalLabel">Device Console Output  - Command Issued - <?php echo $_GET['commandname'];?></h5>
	<button type="button" class="close" data-dismiss="modal"
		aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">    
<?php
if (isset($url)) {
    $data = @file_get_contents($url);
} else
    $data = "CLI command needs is in progress123." . $command . $device . $url;

echo "<span style='font-family:courier;font-size:12px;font-weight:500;'> $data</span>";
?>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

</div>

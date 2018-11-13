<script type="text/javascript">
$(document).ready(function(){
			$(document).on('click', '.anchorcmd', function(event) {
            		var myModal = $('#mycmdModal');
            		myModal.find('.modal-content').css('border', 'none'); 
                    //myModal.find('.modal-content').html('<div id="ajax_loader" style="position: absolute; left: 50%; top: 50%; display: start;"><img src="resources/img/ajax-loader.gif"></img></div>');
                    myModal.find('.modal-content').html('<div id="ajax_loader" style="position: absolute; left: 30%; top: 50%; display: start;">Loading... <div class="fa fa-refresh fa-spin" style="font-size:24px; text-align:center;"></div></div>');
                    myModal.modal('show'); 
                	$.ajax({url: $(this).attr('href'), success: function(result){
                		var myModal = $('#mycmdModal');
                		myModal.find('.modal-content').css('border', '1px solid rgba(0, 0, 0, 0.2)');
                        myModal.find('.modal-content').html(result);
                        myModal.modal('show');
                        
                    }});
                     $('#mycmdModal').removeData()   
                     return false;                  
              });
            });        
</script>
<?php
ini_set('display_errors', 1);
include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';
$userid = $_GET['userid'];
$deviceid = $_GET['deviceid'];
$lastupdated = date('Y-m-d H:i:s');
if (count($_GET['category']) > 0) {
    $category_imp = implode(',', $_GET['category']);
    /* Custom HealthCheck API API Call */
    $devicetype = 'ios';
    $url_final = $APPCONFIG['healthcheck']['endpoint'].'/healthcheck/custom/Cisco/'.$_GET['deviceseries'].'/'.$devicetype.'/'.$_GET['version'].'/'.$deviceid.'/'.$category_imp;
    //$url_final = 'http:///njbboemsda3v.nss.vzwnet.com:8085/healthcheck/custom/Cisco/'.$_GET['deviceseries'].'/'.$devicetype.'/'.$_GET['version'].'/'.$deviceid.'/'.$category_imp;
    // $url_final = 'http://njbboemsda3v.nss.vzwnet.com:8080/healthcheck/' . $devicetype . '/custom/' . $deviceid . '/' . $category_imp;
    // $url_final = 'http://njbboemsda3v.nss.vzwnet.com:8080/healthcheck/'.$devicetype.'/custom/'.$deviceid.'/1,2,3';
   $filename = 'customhealthcheck';
     $msg = $url_final;
   logToFile($filename, $msg);
    $output = json_decode(sendPostData($url_final), true);
    /*
     * $output = '{
     * "configregister": {
     * "R": 0,
     * "message": "configuration register = 0x2102"
     * },
     * "cpuutilization": {
     * "R": 0,
     * "message": "5s = 4%/1%; 1m = 3%; 5m= 3%"
     * },
     * "iosversion": {
     * "R": 0,
     * "message": "15.6(1)S1"
     * }
     * }';
     */
    // $output = json_decode($output, 1);
}
//print_r($output);
$healthchktype = 'Custom';
// $result = select_healthchk_info($deviceid);
if (! in_array('extract_version_ios', $_GET['category']) || ! isset($output['iosversion'])) {
    $output['iosversion'] = array(
        'R' => '',
        'message' => ''
    );
}
if (! in_array('extract_process_cpu', $_GET['category']) || ! isset($output['cpuutilization'])) {
    $output['cpuutilization'] = array(
        'R' => '',
        'message' => ''
    );
}
if (! in_array('extract_memory_statistics', $_GET['category']) || ! isset($output['freememory'])) {
    $output['freememory'] = array(
        'R' => '',
        'message' => ''
    );
}
if (! in_array('extract_buffers', $_GET['category']) || ! isset($output['buffers'])) {
    $output['buffers'] = array(
        'R' => '',
        'message' => ''
    );
}
if (! in_array('extract_show_running_config', $_GET['category']) || ! isset($output['bootstatement'])) {
    $output['bootstatement'] = array(
        'R' => '',
        'message' => ''
    );
}
if (! in_array('extract_show_platform', $_GET['category']) || ! isset($output['platform'])) {
    $output['platform'] = array(
        'R' => '',
        'message' => ''
    );
}
if (! in_array('extract_alarms', $_GET['category']) || ! isset($output['environmental'])) {
    $output['environmental'] = array(
        'R' => '',
        'message' => ''
    );
}
if (! in_array('extract_version_config', $_GET['category']) || ! isset($output['configregister'])) {
    $output['configregister'] = array(
        'R' => '',
        'message' => ''
    );
}
if (! in_array('extract_count_interfaces', $_GET['category']) || ! isset($output['interfacecounters'])) {
    $output['interfacecounters'] = array(
        'R' => '',
        'message' => ''
    );
}
if (! in_array('extract_ping', $_GET['category']) || ! isset($output['twothsndbyteping'])) {
    $output['twothsndbyteping'] = array(
        'R' => '',
        'message' => ''
    );
}
if (! in_array('extract_bfd_neighbour', $_GET['category']) || ! isset($output['bfdsession'])) {
    $output['bfdsession'] = array(
        'R' => '',
        'message' => ''
    );
}
if (! in_array('extract_show_logging', $_GET['category']) || ! isset($output['logentries'])) {
    $output['logentries'] = array(
        'R' => '',
        'message' => ''
    );
}
if (! in_array('extract_show_vrf', $_GET['category']) || ! isset($output['vrfstates'])) {
    $output['vrfstates'] = array(
        'R' => '',
        'message' => ''
    );
}
if (! in_array('extract_show_brief', $_GET['category']) || ! isset($output['interfacestates'])) {
    $output['interfacestates'] = array(
        'R' => '',
        'message' => ''
    );
}
if (! in_array('extract_xconnect_all', $_GET['category']) || ! isset($output['xconnect'])) {
    $output['xconnect'] = array(
        'R' => '',
        'message' => ''
    );
}
if (! in_array('extract_mlps_interfaces', $_GET['category']) || ! isset($output['mplsinterfaces'])) {
    $output['mplsinterfaces'] = array(
        'R' => '',
        'message' => ''
    );
}
//if (! in_array('extract_bgpv4_neighbour', $_GET['category']) || ! isset($output['bgpvfourneighbors'])) {
if (! in_array('extract_bgpv4_neighbour', $_GET['category']) || ! isset($output['bgpvfourneighbors'])) {
    $output['bgpvfourneighbors'] = array(
        'R' => '',
        'message' => ''
    );
}
if (! in_array('extract_mlps_ldp_neighbour', $_GET['category']) || ! isset($output['mplsneighbors'])) {
    $output['mplsneighbors'] = array(
        'R' => '',
        'message' => ''
    );
}
/*
if (! in_array(11, $_GET['category']) || ! isset($output['configregister'])) {
    $output['mplsneighbors'] = array(
        'R' => '',
        'message' => ''
    );
}
*/
if (! in_array('extract_bgp_v6_neighbour', $_GET['category']) || ! isset($output['bgpvsixneighbours'])) {
    $output['bgpvsixneighbours'] = array(
        'R' => '',
        'message' => ''
    );
}

if (! in_array('extract_show_ip_bgp_vpnv4_vrf_ran', $_GET['category']) || ! isset($output['ran'])) {
    $output['ran'] = array(
        'R' => '',
        'message' => ''
    );
}
if (! in_array('extract_bgpv6_routes', $_GET['category']) || ! isset($output['bgpvsixroutes'])) {
    $output['bgpvsixroutes'] = array(
        'R' => '',
        'message' => ''
    );
}
if (! in_array('extract_bandwidth', $_GET['category']) || ! isset($output['bandwidth'])) {
    $output['bandwidth'] = array(
            'R' => '',
            'message' => ''
    );
}
// $output = '{"bfdsession":'.$result['bfdsession'].',"bgpvfourneighbors":'.$result['bgpvfourneighbors'].',"bgpvsixneighbours":'.$result['bgpvsixneighbours'].',"bgpvsixroutes":'.$result['bgpvsixroutes'].',"bootstatement":'.$result['bootstatement'].',"buffers":'.$result['buffers'].',"configregister":'.$result['configregister'].',"cpuutilization":'.$result['cpuutilization'].',"environmental":'.$result['environmental'].',"vrfstates":'.$result['vrfstates'].',"freememory":'.$result['freememory'].',"interfacecounters":'.$result['interfacecounters'].',"interfacestates":'.$result['interfacestates'].',"iosversion":'.$result['iosversion'].',"logentries":'.$result['logentries'].',"mplsinterfaces":'.$result['mplsinterfaces'].',"mplsneighbors":'.$result['mplsneighbors'].',"platform":'.$result['platform'].',"ran":'.$result['ran'].',"twothsndbyteping":'.$result['twothsndbyteping'].',"xconnect":'.$result['xconnect'].'}';
// $output = json_decode($output,true);
// print '<pre>';
// print_r($output); die;
update_healthchk_info($deviceid, $output, $lastupdated);
$_SESSION['deviceidswusr'] = $deviceid;
?>
<?php include_once 'hc_blk_inc.php';?>

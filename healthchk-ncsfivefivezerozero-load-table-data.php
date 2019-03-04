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
include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';
$userid = $_GET['userid'];
$healthchktype = 'Load Table';
// $deviceid = $_GET['deviceid'];
// $arr_res = getDetailViewData($userid, $deviceid );
// $output = $arr_res['result'][0];
// print_r($output);
?>
    <?php
    $deviceid = $_GET['deviceid'];
    $result = select_emshealthchk_info($deviceid);
    $lastupdated = $result['lastupdated'];
//      print '<pre>';
//      print_r($result['content']);
//      die;
    $output = json_decode($result['content'], 1);
    //$output = '{"extract_redundancy":' . $output['extract_redundancy'] . ',"bgpvfourneighbors":' . $result['bgpvfourneighbors'] . ',"bgpvsixneighbours":' . $result['bgpvsixneighbours'] . ',"bgpvsixroutes":' . $result['bgpvsixroutes'] . ',"bootstatement":' . $result['bootstatement'] . ',"buffers":' . $result['buffers'] . ',"configregister":' . $result['configregister'] . ',"cpuutilization":' . $result['cpuutilization'] . ',"environmental":' . $result['environmental'] . ',"vrfstates":' . $result['vrfstates'] . ',"freememory":' . $result['freememory'] . ',"interfacecounters":' . $result['interfacecounters'] . ',"interfacestates":' . $result['interfacestates'] . ',"iosversion":' . $result['iosversion'] . ',"logentries":' . $result['logentries'] . ',"mplsinterfaces":' . $result['mplsinterfaces'] . ',"mplsneighbors":' . $result['mplsneighbors'] . ',"platform":' . $result['platform'] . ',"ran":' . $result['ran'] . ',"twothsndbyteping":' . $result['twothsndbyteping'] . ',"xconnect":' . $result['xconnect'] . '}';
    // die;
    //$output = json_decode($output, true);
    // print_r($output);
    // die;
    
    // Python API Request using curl Begins
    
    /*
     * $userid = $_GET['userid'];
     * $deviceid = $_GET['deviceid'];
     * $devicetype='ios';
     * $url_send =" http://txaroemsda2z.nss.vzwnet.com:8080/healthcheck/";
     * $url_final = 'http://njbboemsda1v.nss.vzwnet.com:8080/healthcheck/'.$devicetype.'/'.$deviceid;
     * $output = json_decode(sendPostData($url_final),true);
     */
    $_SESSION['deviceidswusr'] = $deviceid;
    
    ?>
<?php
$vendorId = load_node_vendor_id_from_deviceid($deviceid);
if ($vendorId == 1) {
    include_once 'healthchk-ncsfivefivezerozero-blk-inc.php';
} elseif ($vendorId == 2) {
    include_once 'hc_blk_inc_nokia.php';
} elseif ($vendorId == 3) {
    include_once 'hc_blk_inc_juniper.php';
}
?>

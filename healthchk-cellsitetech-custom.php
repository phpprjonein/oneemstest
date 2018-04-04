<script type ="text/javascript">
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
$deviceid = $_GET['deviceid'];
if(count($_GET['category']) > 0){
    $category_imp = implode(',',$_GET['category']);
    /*Custom HealthCheck API API Call*/
    $devicetype='ios';
    //$url_final = 'http://10.134.179.82:8080/healthcheck/'.$devicetype.'/custom/'.$deviceid.'/'.$category_imp; 
    //$output = json_decode(sendPostData($url_final),true);
    $output = '{
        "configregister": {
        "R": 0,
        "message": "configuration register = 0x2102"
        },
        "cpuutilization": {
        "R": 0,
        "message": "5s = 4%/1%; 1m = 3%; 5m= 3%"
        },
        "iosversion": {
        "R": 0,
        "message": "15.6(1)S1"
        }
    }';
    $output = json_decode($output, 1);
    update_healthchk_info($deviceid, $output);
}            
            $result = select_healthchk_info($deviceid);
            if(!in_array(2, $_GET['category']) || !isset($output['iosversion'])){
                $result['iosversion'] = '{"R":"","message":""}';
            }if(!in_array(1, $_GET['category']) || !isset($output['cpuutilization'])){
                $result['cpuutilization'] = '{"R":"","message":""}';
            }if(!in_array(8, $_GET['category']) || !isset($output['freememory'])){
                $result['freememory'] = '{"R":"","message":""}';
            }if(!in_array(5, $_GET['category']) || !isset($output['buffers'])){
                $result['buffers'] = '{"R":"","message":""}';
            }if(!in_array(16, $_GET['category']) || !isset($output['bootstatement'])){
                $result['bootstatement'] = '{"R":"","message":""}';
            }if(!in_array(6, $_GET['category']) || !isset($output['platform'])){
                $result['platform'] = '{"R":"","message":""}';
            }if(!in_array(4, $_GET['category']) || !isset($output['environmental'])){
                $result['environmental'] = '{"R":"","message":""}';
            }if(!in_array(3, $_GET['category']) || !isset($output['configregister'])){
                $result['configregister'] = '{"R":"","message":""}';
            }if(!in_array(7, $_GET['category']) || !isset($output['interfacecounters'])){
                $result['interfacecounters'] = '{"R":"","message":""}';
            }if(!in_array(22, $_GET['category']) || !isset($output['twothsndbyteping'])){
                $result['twothsndbyteping'] = '{"R":"","message":""}';
            }if(!in_array(10, $_GET['category']) || !isset($output['bfdsession'])){
                $result['bfdsession'] = '{"R":"","message":""}';
            }if(!in_array(15, $_GET['category']) || !isset($output['logentries'])){
                $result['logentries'] = '{"R":"","message":""}';
            }if(!in_array(23, $_GET['category']) || !isset($output['fivethsndbyteping'])){
                $result['fivethsndbyteping'] = '{"R":"","message":""}';
            }if(!in_array(9, $_GET['category']) || !isset($output['interfacestates'])){
                $result['interfacestates'] = '{"R":"","message":""}';
            }if(!in_array(20, $_GET['category']) || !isset($output['xconnect'])){
                $result['xconnect'] = '{"R":"","message":""}';
            }if(!in_array(12, $_GET['category']) || !isset($output['mplsinterfaces'])){
                $result['mplsinterfaces'] = '{"R":"","message":""}';
            }if(!in_array(13, $_GET['category']) || !isset($output['bgpvfourneighbors'])){
                $result['bgpvfourneighbors'] = '{"R":"","message":""}';
            }if(!in_array(19, $_GET['category']) || !isset($output['mplsneighbors'])){
                $result['ran'] = '{"R":"","message":""}';
            }if(!in_array(11, $_GET['category']) || !isset($output['configregister'])){
                $result['mplsneighbors'] = '{"R":"","message":""}';
            }if(!in_array(14, $_GET['category']) || !isset($output['bgpvsixneighbours'])){
                $result['bgpvsixneighbours'] = '{"R":"","message":""}';
            }if(!in_array(17, $_GET['category']) || !isset($output['bgpvsixroutes'])){
                $result['bgpvsixroutes'] = '{"R":"","message":""}';
            }
            $output = '{"bfdsession":'.$result['bfdsession'].',"bgpvfourneighbors":'.$result['bgpvfourneighbors'].',"bgpvsixneighbours":'.$result['bgpvsixneighbours'].',"bgpvsixroutes":'.$result['bgpvsixroutes'].',"bootstatement":'.$result['bootstatement'].',"buffers":'.$result['buffers'].',"configregister":'.$result['configregister'].',"cpuutilization":'.$result['cpuutilization'].',"environmental":'.$result['environmental'].',"fivethsndbyteping":'.$result['fivethsndbyteping'].',"freememory":'.$result['freememory'].',"interfacecounters":'.$result['interfacecounters'].',"interfacestates":'.$result['interfacestates'].',"iosversion":'.$result['iosversion'].',"logentries":'.$result['logentries'].',"mplsinterfaces":'.$result['mplsinterfaces'].',"mplsneighbors":'.$result['mplsneighbors'].',"platform":'.$result['platform'].',"ran":'.$result['ran'].',"twothsndbyteping":'.$result['twothsndbyteping'].',"xconnect":'.$result['xconnect'].'}';
            $output = json_decode($output,true); 
	        $_SESSION['deviceidswusr'] = $deviceid;
?>
<?php include_once 'hc_blk_inc.php';?>

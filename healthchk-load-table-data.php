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
//$deviceid = $_GET['deviceid'];
//$arr_res = getDetailViewData($userid, $deviceid );  
//$output = $arr_res['result'][0];
// print_r($output); 
?>
    <?php  
            $deviceid = $_GET['deviceid'];
            $result = select_healthchk_info($deviceid);
            $lastupdated = $result['lastupdated'];
            //print '<pre>';
            //print_r($result);
            //die;
            $output = '{"bfdsession":'.$result['bfdsession'].',"bgpvfourneighbors":'.$result['bgpvfourneighbors'].',"bgpvsixneighbours":'.$result['bgpvsixneighbours'].',"bgpvsixroutes":'.$result['bgpvsixroutes'].',"bootstatement":'.$result['bootstatement'].',"buffers":'.$result['buffers'].',"configregister":'.$result['configregister'].',"cpuutilization":'.$result['cpuutilization'].',"environmental":'.$result['environmental'].',"fivethsndbyteping":'.$result['fivethsndbyteping'].',"freememory":'.$result['freememory'].',"interfacecounters":'.$result['interfacecounters'].',"interfacestates":'.$result['interfacestates'].',"iosversion":'.$result['iosversion'].',"logentries":'.$result['logentries'].',"mplsinterfaces":'.$result['mplsinterfaces'].',"mplsneighbors":'.$result['mplsneighbors'].',"platform":'.$result['platform'].',"ran":'.$result['ran'].',"twothsndbyteping":'.$result['twothsndbyteping'].',"xconnect":'.$result['xconnect'].'}';
            //die;
            $output = json_decode($output,true); 
            //print_r($output);
            //die;
        
                                               //  Python API Request using curl Begins                    

            /*
 	          $userid = $_GET['userid'];
            $deviceid = $_GET['deviceid'];               
            $devicetype='ios';
            $url_send =" http://txaroemsda2z.nss.vzwnet.com:8080/healthcheck/";  
 	          $url_final = 'http://txaroemsda2z.nss.vzwnet.com:8080/healthcheck/'.$devicetype.'/'.$deviceid;			
            $output = json_decode(sendPostData($url_final),true);     */                     
	         $_SESSION['deviceidswusr'] = $deviceid;
                      
                        ?>
<?php include_once 'hc_blk_inc.php';?>

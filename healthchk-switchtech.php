<script type ="text/javascript">
$(document).ready(function(){
			$(document).on('click', '.anchorcmd', function(event) {
            		var myModal = $('#mycmdModal');
            		myModal.find('.modal-content').css('border', 'none'); 
                    myModal.find('.modal-content').html('<div id="ajax_loader" style="position: absolute; left: 50%; top: 50%; display: start;"><img src="resources/img/ajax-loader.gif"></img></div>');
                    //myModal.find('.modal-content').html('<div id="ajax_loader" style="position: absolute; left: 30%; top: 50%; display: start;"><b>Running health checks. Takes several minutes</b></div>');
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
?>
    <?php  
                                               //  Python API Request using curl Begins                    
            $userid = $_GET['userid'];
            $deviceid = $_GET['deviceid'];               
            $devicetype='ios';
            $url_send =" http://txaroemsda2z.nss.vzwnet.com:8080/healthcheck/";
            $deviceid = $_GET['deviceid'];              
 	        $url_final = 'http://njbboemsda3v.nss.vzwnet.com:8080/healthcheck/'.$devicetype.'/'.$deviceid;			
            $output = json_decode(sendPostData($url_final),true); 
            $lastupdated = date('Y-m-d H:i:s');
            insertorupdate_healthchk_info($deviceid, $output, $lastupdated);
            $_SESSION['deviceidcs'] = $deviceid;                 
     ?>
<?php include_once 'hc_blk_inc.php';?>                

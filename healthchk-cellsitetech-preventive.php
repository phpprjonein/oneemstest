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
            $deviceid = $_GET['deviceid'];              
 	        //$url_final = ' http://10.134.179.82:8080/healthcheck/'.$devicetype.'/preventive/'.$deviceid;
            //$output = sendPostData($url_final);
            $output = '{
  "1xrtt": {
    "R": 0,
    "count": 2
  },
  "bfdsession": {
    "R": 0,
    "message": "down neighbors = 0"
  },
  "bgpvfourneighbors": {
    "R": 0,
    "neighbour_": [
      [
        "10.114.82.0",
        "4",
        "64656",
        "379370",
        "427743",
        "123",
        "0",
        "0",
        "3"
      ],
      [
        "10.114.82.1",
        "4",
        "64656",
        "381929",
        "422790",
        "123",
        "0",
        "0",
        "3"
      ]
    ],
    "neighbours": "BGPv4 Neighbors = 2"
  },
  "bootstatement": {
    "R": 0,
    "message": "Boot statement matches Version"
  },
  "buffers": {
    "R": 0,
    "message": "Max Buffer misses = 98"
  },
  "cell_mgmt": {
    "R": 0,
    "count": 3
  },
  "configregister": {
    "R": 0,
    "message": "configuration register = 0x2102"
  },
  "cpuutilization": {
    "R": 0,
    "message": "5s = 2%/0%; 1m = 4%; 5m= 3%"
  },
  "environmental": {
    "R": 0,
    "message": "Total alarms = 0"
  },
  "freememory": {
    "R": 0,
    "message": "Free memory = 1318482524"
  },
  "interfacecounters": {
    "R": 0,
    "count": "Interface Counters = 4"
  },
  "interfacestates": {
    "R": 0,
    "message": "Interfaces down = 0"
  },
  "iosversion": {
    "R": 0,
    "message": "15.6(1)S1"
  },
  "mplsinterfaces": {
    "R": 0,
    "message": "Number of failed interfaces = 0"
  },
  "platform": {
    "R": 0,
    "message": "All Slots OK"
  },
  "ran": {
    "R": 0,
    "count": "BGPv4 Routes= 3"
  }
}';
            $output = json_decode($output,true);
            $lastupdated = date('Y-m-d H:i:s');
            insertorupdate_healthchk_info($deviceid, $output, $lastupdated);
            $_SESSION['deviceidcs'] = $deviceid;                 
     ?>
<?php include_once 'hc_blk_inc.php';?>                

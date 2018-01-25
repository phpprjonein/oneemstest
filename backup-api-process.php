<?php
include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';
?>
<?php  
        $deviceid = $_POST['deviceid'];               
        //$url_send = 'http://63.49.0.192:8080/configbackup/'.$deviceid;
        //$json_response = sendPostData($url_send);
        $json_response = '{
  "data": [
    {
      "data": "AKROOH20T1A_P_CI_0021_01-10_198_238_19-running_config-2018_24_0123_31",
      "success": true
    }
  ],
  "status": "success",
  "success": false
}';
        
        $output = json_decode($json_response,true);   
        
        echo "<b>Backup Status : ".$output['status']."</b>";
        echo "<br/>";
        echo "<b>Backup data : ".$output['data'][0]['data']."</b>";
       
 ?>
 
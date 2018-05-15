 <?php 
 if($_GET['act'] == 'restore'){
     //print '<pre>';print_r($_POST);
//  Get the curl response from the file and display it from modal restore-api-response.php. Either include that 
//file over here and display the json response Or use the curl and display the json values here. 

$region = strtolower(str_replace(' ','',$_POST['region'])); 
$device_series = strtolower(str_replace(' ','',$_POST['device_series'])); 
$filename = $_POST['filename'];
     
$url = 'http://10.134.179.82:8080/2/'.$region.'/'.$device_series.'/'.$filename;
//  Initiate curl
$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$result=curl_exec($ch);
// Closing
curl_close($ch);
// Will dump a beauty json :3
$output = json_decode($result, true);
$arr = json_decode($response,1);
/*
 $response = '[
     {
         "data": {
         "output": {
         "scp": true,
         "ssh": true,
         "status": "SUCCESS"
         }
     }
     }
     ]';
     $arr = json_decode($response,1);
*/
     if($arr[0]['data']['output']['status'] == 'SUCCESS'):
        $status = 'Restore done successfully'; 
     else:
        $status = 'Restore has failed';
     endif;
     echo '<table class="table table-striped">
     <thead>
     <tr>
     <th>scp</th>
     <th>ssh</th>
     <th>Status</th>
     </tr>
     </tuhead>
     <tbody>
     <tr><td align="center" colspan="3"><b>'.$status.'</b></td>
     <tr>
     <td>'.$arr[0]['data']['output']['scp'].'</td>
     <td>'.$arr[0]['data']['output']['ssh'].'</td>
     <td>'.$arr[0]['data']['output']['status'].'</td>
     </tr>
     </tbody>
     </table>';
     exit;
 }elseif($_GET['act'] == 'view'){
     $row_region = strtolower(str_replace(' ','', $_POST['region']));
     //$path = '/pysvrdevbakupfiles/'.$row_region.'/'.$_POST['filename'];
     $path = '/usr/apps/oneems/config/bkup/'.$row_region.'/'.$_POST['filename'];
     if(file_exists($path)){
         echo file_get_contents($path);
     }
 }

 /* API response  given as below   
 [
  {
    "data": {
      "output": {
        "scp": true,
        "ssh": true,
        "status": "SUCCESS"
      }
    }
  }
] 
 */ 
 ?>
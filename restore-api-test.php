 <?php 
 if($_GET['act'] == 'restore'){
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




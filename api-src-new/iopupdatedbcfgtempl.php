<?php
include '/var/www/html/oneemstest/config/config.inc.php';
include '/var/www/html/oneemstest/classes/db2.class.php';
include '/var/www/html/oneemstest/classes/paginator.class.php';
include '/var/www/html/oneemstest/functions.php';
//$_GET['name'] = 'Golden_purpose1_ASR-920_1533S3_ranvendor2_scripttype2_GreatLakes_Lab_Detroit9';

$name = $_GET['name'];
$category = $_GET['category'];
header("Content-Type:application/json");
$headers = apache_request_headers();
//print_r($headers);
//exit;
logToFile('postmanapi.log', $headers['Authorization']);

    $results = config_get_templates_from_templname($name);
    
    foreach ($results as $key=>$val):
    $newarr[intval($val['elemid']/10)][] = array('elemid' => $val['elemid'], 'elemvalue' => $val['elemvalue'], 'editable' => $val['editable']);
    if($newarr[intval($val['elemid']/10)]['editablem'] == 0){
        $newarr[intval($val['elemid']/10)]['editablem'] = ($val['editable'] == 1) ? 1 : 0;
    }
    endforeach;
    
    foreach ($newarr as $key=>$val):
        $line = '';
        if($val[editablem] == 1):
            foreach ($val as $keyin=>$valin):
            $line .= $valin['elemvalue'];
            endforeach;
            $line_arr[] = $line;
        endif;
    endforeach;

//     print '<pre>';
//     print_r($line_arr);
//     die;
    
    
    $data_string = json_encode($line_arr);
    $ch = curl_init('http://localhost/oneemstest/config-temp.api.php');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, array(
        "data" => $data_string
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch)
    /*
    $result = json_decode(curl_exec($ch));
    
    
    $replace_pos = 0;
    foreach ($result as $key=>$val):
        if(!empty($val)):
            $line_arr[$replace_pos] = $val;
        endif;
        $replace_pos++;
    endforeach;
    
        
    print json_encode($line_arr);
    */
    
    

/*
 * $status = $_GET['name'];
 * $status_message = "User Not Fsound";
 * $data = "userdata".$_GET['name'];
 * $response['status']=$status;
 * $response['status_message']=$status_message;
 * $response['data']=$data;
 * $json_response = json_encode($response);
 * echo $json_response;
 */
function jsonResponse($status, $status_message, $data)
{
    $username = $_SERVER['PHP_AUTH_USER'];
    $password = $_SERVER['PHP_AUTH_PW'];
    header("HTTP/1.1 " . $status_message);
    $response['status'] = $status;
    $response['status_message'] = $status_message;
    $response['data'] = $data;
   //Bearer oneemscarmsapi
   /* if ($username != 'admin') {
        $response['status'] = 700;
        $response['status_message'] = ' Invalid credentials';
        $response['data'] = $data . 'Username' . $username . 'Password' . $password;
    }
    ; */
    $json_response = json_encode($response);
    echo $json_response;
}
;
?>

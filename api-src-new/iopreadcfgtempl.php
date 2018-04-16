<?php
include '/var/www/html/oneemstest/classes/db2.class.php';
include '/var/www/html/oneemstest/classes/paginator.class.php';
include '/var/www/html/oneemstest/functions.php';
$name = $_GET['name'];
header("Content-Type:application/json");
$headers = apache_request_headers();
//print_r($headers);
//exit;
logToFile('postmanapi.log', $headers['Authorization']);
/*
if ( strcmp($headers['Authorization'],"Bearer oneemscarmsapi") != 0 ) {
       $response['status'] = 800;
       $response['status_message'] = ' Invalid credentials';
       $response['data'] = 'Username' . $name;
       $json_response = json_encode($response);
       echo $json_response;
 exit;
 }; 
*/
if (! empty($_GET['name'])) {
    $name = '/var/www/html/api-src-new/upload/'.$name;
    if (!file_exists($name)) {
        jsonResponse(200, " Template Not Found", NULL);
    } else {
//	 jsonResponse(200, "Template Found", file_get_contents($name);
         $tmplname = $_GET['name'];
        $tmplname = '/var/www/html/api-src-new/upload/'.$name;
        $lines  = @file($name);
        foreach($lines  as $line ){
            $line_arr[] = preg_replace('~[\r\n]+~', '', $line);
        }
        jsonResponse(200, "Template Found", $line_arr);

    }
} else {
    jsonResponse(400, "Invalid Request", NULL);
}
;

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

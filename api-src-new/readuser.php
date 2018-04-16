<?php
include '/var/www/html/oneemstest/classes/db2.class.php';
include '/var/www/html/oneemstest/classes/paginator.class.php';
include '/var/www/html/oneemstest/functions.php';
<<<<<<< HEAD
header("Content-Type:application/json");
$name = $_GET['name'];
=======
$name = $_GET['name'];
header("Content-Type:application/json");
$headers = apache_request_headers();
//print_r($headers);
//exit;
logToFile('postmanapi.log', $headers['Authorization']);
if ( strcmp($headers['Authorization'],"Bearer oneemscarmsapi") != 0 ) {
       $response['status'] = 800;
       $response['status_message'] = ' Invalid credentials';
       $response['data'] = 'Username' . $name;
       $json_response = json_encode($response);
       echo $json_response;
        //jsonResponse(400, "Invalid credentials", NULL);
       // echo json_encode('hello');
 exit;
 }; 

>>>>>>> f925d24473e59e9234a9eee7f64f09b390f58d46
$user = getUser($name);
if (! empty($_GET['name'])) {
    $name = $_GET['name'];
    $user = getUser($name);
    if (empty($user)) {
        jsonResponse(200, "User Not Found", NULL);
    } else {
<<<<<<< HEAD
        jsonResponse(200, "User Found", $user);
=======
        //jsonResponse(200, "User Found", $user);
        //jsonResponse(200, "User Found", $headers);
        jsonResponse(200, "User Found", $headers['Authorization']);
>>>>>>> f925d24473e59e9234a9eee7f64f09b390f58d46
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
<<<<<<< HEAD
    
    if ($username != 'admin') {
=======
   //Bearer oneemscarmsapi
   /* if ($username != 'admin') {
>>>>>>> f925d24473e59e9234a9eee7f64f09b390f58d46
        $response['status'] = 700;
        $response['status_message'] = ' Invalid credentials';
        $response['data'] = $data . 'Username' . $username . 'Password' . $password;
    }
<<<<<<< HEAD
    ;
=======
    ; */
>>>>>>> f925d24473e59e9234a9eee7f64f09b390f58d46
    $json_response = json_encode($response);
    echo $json_response;
}
;
?>

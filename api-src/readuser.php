<?php
include '../classes/db2.class.php';
include '../classes/paginator.class.php';
include '../functions.php';
header("Content-Type:application/json");
$name = $_GET['name'];
$user = getUser($name);
if (! empty($_GET['name'])) {
    $name = $_GET['name'];
    $user = getUser($name);
    if (empty($user)) {
        jsonResponse(200, "User Not Found", NULL);
    } else {
        jsonResponse(200, "User Found", $user);
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
    
    if ($username != 'admin') {
        $response['status'] = 700;
        $response['status_message'] = ' Invalid credentials';
        $response['data'] = $data . 'Username' . $username . 'Password' . $password;
    }
    ;
    $json_response = json_encode($response);
    echo $json_response;
}
;
?>
<?php
include '../classes/db2.class.php';
include '../classes/paginator.class.php';
include '../functions.php';
header("Content-Type:application/json");
$datastring = $_POST['customer'];
$data = json_decode(urldecode($datastring));
$data = json_decode(json_encode($data), true);
// $user = addUser($data);
// echo json_encode($data);
// echo "reach here";
// print_r($data);
$data['username'] = $_GET['username'];
if (! empty($data['username'])) {
    $user = deleteUser($data);
    if (empty($user)) {
        jsonResponse(200, "User Not found", NULL);
    } else {
        jsonResponse(200, "User deleted", $user);
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
    header("HTTP/1.1 " . $status_message);
    $response['status'] = $status;
    $response['status_message'] = $status_message;
    $response['data'] = $data;
    $json_response = json_encode($response);
    echo $json_response;
}
;
?>
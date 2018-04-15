<<<<<<< HEAD
<?php
include '/var/www/html/oneemstest/classes/db2.class.php';
include '/var/www/html/oneemstest/classes/paginator.class.php';
include '/var/www/html/oneemstest/functions.php';
header("Content-Type:application/json");
if (! empty($_GET['tmplname'])) {
    $tmplname = $_GET['tmplname'];
    $tmplname = '/var/www/html/oneemstest/upload/'.$tmplname;
    if (!file_exists($tmplname)) {
        jsonResponse(200, "Template Not Found", NULL);
    } else {
        jsonResponse(200, "Template Found", file_get_contents($tmplname));
    }
} else {
    jsonResponse(400, "Invalid Request", NULL);
}

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
=======
<?php
include '/var/www/html/oneemstest/classes/db2.class.php';
include '/var/www/html/oneemstest/classes/paginator.class.php';
include '/var/www/html/oneemstest/functions.php';
header("Content-Type:application/json");
if (! empty($_GET['tmplname'])) {
    $tmplname = $_GET['tmplname'];
    $tmplname = '/var/www/html/oneemstest/upload/'.$tmplname;
    if (!file_exists($tmplname)) {
        jsonResponse(200, "Template Not Found", NULL);
    } else {
        jsonResponse(200, "Template Found", file_get_contents($tmplname));
    }
} else {
    jsonResponse(400, "Invalid Request", NULL);
}

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
>>>>>>> f925d24473e59e9234a9eee7f64f09b390f58d46

<?php
ini_set('display_errors', 1);
include 'config/global.php';
include 'model/db.php';
if($_POST['action'] == 'login' && $_POST['function'] == 'get_user_info'){
    $result = get_user_info($_POST['username'],$_POST['password']);
    sendResponse($result);
}
?>
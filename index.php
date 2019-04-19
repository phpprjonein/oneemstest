<?php
$sso_flag = 0;
include 'classes/db2.class.php';
include 'functions.php';
$page_title = 'OneEMS';
// Destroy All sessions
$_SESSION = array();
ini_set('display_errors', 1);
$headers = apache_request_headers();
foreach ($headers as $header => $value) {
    if ($header == 'SM_USER') {
        $username = $value;
    }
    ;
    if ($header == 'EID') {
        $eid = $value;
    }
    ;
    if ($header == 'Email') {
        $email = $value;
    }
    ;
    if ($header == 'FirstName') {
        $firstname = $value;
    }
    ;
    if ($header == 'LastName') {
        $lastname = $value;
    }
    ;
    if ($header == 'VZID') {
        $sso_flag = 1;
        $vzid = $value;
    }
    ;
}
;

$_SESSION['sso_flag'] = $sso_flag;
/*Added for local testing sso session expire testing
if($sso_flag == 0){
    
    $headers['SM_TIMETOEXPIRE'] = 60;
    $_SESSION['sso_session_life'] = $_SERVER['REQUEST_TIME'] + $headers['SM_TIMETOEXPIRE'];
    $_SESSION['sso_session_started'] = $_SERVER['REQUEST_TIME'];
}
*/
if ($_POST['userimp'] == 'imp' && isset($_POST['username'])) {
    $_SESSION['impusername'] = $_POST['impusername'];
    $name_exp_1 = explode(' <', $_POST['username']);
    $name_exp = explode(' ', $name_exp_1[0]);
    $name_exp_role = str_replace('>', '', $name_exp_1[1]);
    $userinfo = get_user_info_sso_imp($name_exp[0], $name_exp[1], trim($name_exp_role));
    $_SESSION['userid'] = $userinfo['id'];
    $_SESSION['username'] = $userinfo['username'];
    $_SESSION['email'] = $userinfo['email'];
    $_SESSION['userlevel'] = $userinfo['userlevel'];
    $_SESSION['welcome_username'] = $userinfo['fname'] . ' ' . $userinfo['lname'];
    $_SESSION['zones'] = $userinfo['zones'];
    update_login_api_rules($sso_flag, $_SESSION['username']);
    // Remove if config file exist
    if (file_exists(getcwd() . "/upload/sampleconfigfile_" . $_SESSION['userid'] . ".txt")) {
        unlink(getcwd() . "/upload/sampleconfigfile_" . $_SESSION['userid'] . ".txt");
    }
    if (isset($_SESSION['userlevel']) && $_SESSION['userlevel']) {
        $location_href = get_landing_page();
        header('Location:' . $location_href);
        exit();
    }
}
if ($sso_flag == 1) {
    //$headers['SM_TIMETOEXPIRE'] = 33000;
    $_SESSION['sso_flag'] = $sso_flag;
    if(isset($headers['SM_TIMETOEXPIRE']) && $headers['SM_TIMETOEXPIRE'] > 0){
        $_SESSION['sso_session_life'] = $_SERVER['REQUEST_TIME'] + $headers['SM_TIMETOEXPIRE'];
        $_SESSION['sso_session_started'] = $_SERVER['REQUEST_TIME'];
    }
    $userinfo = get_user_info_sso($username);
    $_SESSION['userid'] = $userinfo['id'];
    $_SESSION['username'] = $userinfo['username'];
    $_SESSION['email'] = $userinfo['email'];
    $_SESSION['userlevel'] = $userinfo['userlevel'];
    $_SESSION['welcome_username'] = $userinfo['fname'] . ' ' . $userinfo['lname'];
    $_SESSION['zones'] = $userinfo['zones'];
    $_SESSION['role'] = $userinfo['role'];
    update_login_api_rules($sso_flag, $_SESSION['username']);
    // Remove if config file exist
    if (file_exists(getcwd() . "/upload/sampleconfigfile_" . $_SESSION['userid'] . ".txt")) {
        unlink(getcwd() . "/upload/sampleconfigfile_" . $_SESSION['userid'] . ".txt");
    }
    if (isset($_SESSION['userlevel']) && $_SESSION['userlevel']) {
        $location_href = get_landing_page();
        header('Location:' . $location_href);
        exit();
    }
} else {
    if (isset($_POST['username']) && $_POST['password']) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $userinfo = get_user_info($username, $password);
        // exit(print_r( $userinfo));
        if (! $userinfo) {
            $message['error'] = '<div class="alert alert-danger"><i class="fa fa-exclamation-circle fa-lg"></i> The Username and/or Password you have entered is incorrect.</div>';
        } else {
            $_SESSION['userid'] = $userinfo['id'];
            $_SESSION['username'] = $userinfo['username'];
            $_SESSION['email'] = $userinfo['email'];
            $_SESSION['userlevel'] = $userinfo['userlevel'];
            $_SESSION['role'] = $userinfo['role'];
            $_SESSION['welcome_username'] = $userinfo['fname'] . ' ' . $userinfo['lname'];
            $_SESSION['zones'] = $userinfo['zones'];
            update_login_api_rules($sso_flag, $_SESSION['username']);
        }
        // Remove if config file exist
        if (file_exists(getcwd() . "/upload/sampleconfigfile_" . $_SESSION['userid'] . ".txt")) {
            unlink(getcwd() . "/upload/sampleconfigfile_" . $_SESSION['userid'] . ".txt");
        }
        
        if (isset($_SESSION['userlevel']) && $_SESSION['userlevel']) {
            $location_href = get_landing_page();
            header('Location:' . $location_href);
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php include "includes.php" ?>
  </head>
<body>
	<div class="container-fluid">
		<header class="main-header">
			<div class="nav">
				<div class="pull-left box">
					<a class="navbar-brand" href="#"> <img
						src="resources/img/ncmlogo.png" height="24px" alt="NCM Logo" />
					</a>
				</div>
			</div>
			<hr class="border border-danger">
		</header>

		<div id="div1"></div>
		<!-- Modal HTML -->
		<div id="myModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<!-- Content will be loaded here from "remote.php" file -->
				</div>
			</div>
		</div>

		<!-- 12 Oct 17: Added class login-page and oneems logo -->
		<div class="login-page">
			<p class="logo">
				<a class="one"></a><a class="ems"><h4>OneEMS</h4></a>
			</p>

    <?php
    
    if (isset($message['error'])) {
        ?>

    <p class="warning"><?php echo $message['error']; ?></p>
    <?php
    }
    ?>

    <div class="form">
				<form class="login-form" action="index.php" method="post">

					<p class="box-title">Username</p>
					<input class="form-control" name="username" type="text" />
					<p class="input-error" id="username"></p>

					<p class="box-title">Password</p>
					<input class="form-control" name="password" type="password" />
					<p class="input-error" id="password"></p>

					<button type="submit" class="btn btn-primary btn-block btn-flat">Sign
						In</button>
					<!--

        <a href ="#" class=" launch-modal" ><p class="message">Forgot your password?</p> </a>
       <a href="#"><p class="message">Forgot your password?</p></a>
-->

				</form>
			</div>
		</div>
	</div>
</body>
</html>

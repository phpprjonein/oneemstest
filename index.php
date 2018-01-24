<?php
$headers = apache_request_headers();
//print_r($headers);
foreach($headers as $header => $value) {
       if ($header == 'SM_USER') {
          $username = $value;
        };
       if ($header == 'EID') {
          $eid = $value;
        };
       if ($header == 'Email') {
          $email = $value;
        };
       if ($header == 'FirstName') {
          $firstname = $value;
        };
       if ($header == 'LastName') {
          $lastname  = $value;
        };
       if ($header == 'VZID') {
          $sso_flag = 1;
          $vzid  = $value;
        };
//       echo '<br>'."Header: $header value: $value".'<br>'; 
};
include 'classes/db2.class.php';
include 'functions.php';
$page_title = '';
    //Destroy All sessions
    $_SESSION = array();
if ( $sso_flag != 1) {
if (isset($_POST['username']) && $_POST['password']) {
   $username = $_POST['username'];
   $password = $_POST['password'];

   $userinfo = get_user_info($username, $password);
//exit(print_r( $userinfo));
   if ( ! $userinfo ) {
      $message['error'] = 'Username or Password is incorrect ';
   }
   else {
      $_SESSION['userid'] = $userinfo['id'];
      $_SESSION['username'] = $userinfo['username'];
      $_SESSION['userlevel'] = $userinfo['userlevel'];
      $_SESSION['welcome_username'] = $userinfo['fname'] . ' ' . $userinfo['lname'];
      update_login_api_rules($_SESSION['username']);
   }
   
    if (isset($_SESSION['userlevel']) && $_SESSION['userlevel']) {
      $location_href = get_landing_page(); 
// exit($location_href);
      header('Location:' . $location_href );
      exit;
    }

}
} else  {
//  echo '<br>'."Username:$username EID:$eid Email:$email First Name:$firstname Last Name:$lastname VZID:$vzid".'<br>';
  $userinfo = get_user_info_sso($username,$eid,$email,$firstname,$lastname,$vzid);
};
function get_user_info_sso($username,$eid,$email,$fname,$lname,$vzid) {
      $location_href = get_landing_page_sso($username,$eid,$email,$fname,$lname,$vzid);
      header('Location:' . $location_href );
      exit;
}
$page_title = 'NCM Login';
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
		<div class="pull-left box"><a class="navbar-brand" href="#" >
			<img src="resources/img/ncmlogo.png"  height = "24px"  alt=" OneEMS Logo"/>
		  </a>
		</div>
	  </div> 
	<hr style="border-top:5px solid red;">
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
    
    <!-- 12 Oct 17: Added class login-page and OneEMS logo -->
    <div class="login-page">
      <p class="logo"><a class="one"></a><a class="ems"></a></p>
      
    <?php


    if (isset($message['error'])) {
      ?>
    
    <p class="warning"><?php echo $message['error']; ?></p>
    <?php }
    ?>
    
    <div class="form">
      <form class="login-form" action="index.php" method="post">
    
        <p class="box-title"> Username </p>
        <input name="username" type="text" />
        <p class="input-error" id="username"></p>
      
        <p class="box-title"> Password </p>
        <input name="password" type="password" />
        <p class="input-error" id="password"></p>
                             
        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        <!--
        
        <a href ="#" class=" launch-modal" ><p class="message">Forgot your password?</p> </a>
-->       <a href="#"><p class="message">Forgot your password?</p></a>

      
      </form>
    </div>
    </div> 
    </div>
  </body>
</html>

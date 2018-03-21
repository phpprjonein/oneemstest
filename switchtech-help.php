<?php
include_once ("classes/db2.class.php");
include_once "classes/paginator.class.php";
include_once ("functions.php");
user_session_check();
//Check for switch tech type user
include_once ('config/session_check_switch_tech.php');
$page_title =  'OneEMS';
// Default map dispaly flag true
$show_map_flag = true;
// Map flag set to false once map is clicked
// print_r($_GET);

if (isset($_GET['markets']) &&  $_GET['markets'] !='') {
    $marketname =  $_SESSION['marketname'] = $_GET['markets'];
    $show_map_flag = false;
    unset($_SESSION['switch_device_id']);
}
else {
    $marketname = null;
    unset($_SESSION['marketname']);
}


$userid = $_SESSION['userid'];
$succss_msg  = '';

if (isset($_POST['addlist']) && $_POST['addlist'] ) {
    $_SESSION['succss_msg'] = '';
    
    if ($_SESSION['mylistname'] != $_POST['addlist']){
        $data=array('listname'=>$_POST['addlist'],'userid'=>$userid);
        $result = insert_usrfavritedev($data);
        $_SESSION['mylistname'] = $_POST['addlist'];
        $_SESSION['succss_msg'] = 'Created succesfully';
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'editmylist') {
    $switchlistid = $_SESSION['switchlistid'] = $_GET['switchlistid'];
}


?>
<!DOCTYPE html>
<html lang="en">
<head>  
<?php include_once("includes.php");  ?>
<script src="resources/js/switchtech_user_list.js?t=<?php echo date('his'); ?>"></script>
</head>  
<body class="hold-transition skin-blue sidebar-mini ownfont">
<div class="container-fluid">

    <?php 
    // include_once menu bar htmls [ Logo, welcome text, menu ]
    include_once ('menu.php'); 
    ?>   
  
    
    							<div id="mylist" class="panel-heading" style = "height:580px;"><b>Coming soon.</b></div> 


  <!-- Hidden field for user id value -->
  <input type="hidden" id="hidd_userid" value="<?php echo $_SESSION['userid'] ?>">     
  
  <!-- include_once custom js file for switchtech_devicelist page -->  
  <div style="clear:both;"></div>

</div>
  

 <?php 
    // Footder section include_once file
    include_once ('footer.php');
  ?> 
</body>
</html>
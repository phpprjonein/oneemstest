<?php 
/*
 * Application dynamic configuration loads
 */
global $APPCONFIG;
$APPCONFIG = parse_ini_file("config/appconfig.ini",true);
if($_SERVER['SERVER_NAME'] == 'localhost'){
    $APPCONFIG = $APPCONFIG['localhost'];
}else{
    $APPCONFIG = $APPCONFIG['live'];
}
?>

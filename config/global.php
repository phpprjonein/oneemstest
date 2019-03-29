<?php 
/*
 * Application dynamic configuration loads
 */
global $APPCONFIG;
if(file_exists('config/'.$_SERVER['SERVER_NAME'].'.ini')){
    $APPCONFIG = parse_ini_file('config/'.$_SERVER['SERVER_NAME'].'.ini',true);
}else{
    $APPCONFIG = parse_ini_file("config/appconfig.ini",true);
}
if($_SERVER['SERVER_NAME'] == 'localhost'){
    $APPCONFIG = $APPCONFIG['localhost'];
}else{
    $APPCONFIG = $APPCONFIG['live'];
}
?>

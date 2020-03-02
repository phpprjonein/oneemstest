<?php
/*
 * Application dynamic configuration loads
 */
global $APPCONFIG;
$APPCONFIG = parse_ini_file("config/appconfig.ini",true);
$APPCONFIG = $APPCONFIG['apis'];
if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || !($_SERVER['PHP_AUTH_USER'] == $APPCONFIG['api']['username'] && $_SERVER['PHP_AUTH_PW'] == $APPCONFIG['api']['password'])){
    echo "API Access Denied";
    exit;
}
?>

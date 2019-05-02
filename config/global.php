<?php
/*
 * Application dynamic configuration loads
 */
global $APPCONFIG;
if($_SERVER['SERVER_ADDR'] == '10.215.137.21'){
 $APPCONFIG = parse_ini_file('config/'.carooemssa1v.'.ini',true);
}
elseif($_SERVER['SERVER_ADDR'] == '10.215.137.34'){
 $APPCONFIG = parse_ini_file('config/'.carooemssa2v.'.ini',true);
}
elseif($_SERVER['SERVER_ADDR'] == '10.215.137.10'){
 $APPCONFIG = parse_ini_file('config/'.carooemspa1v.'.ini',true);
}
elseif($_SERVER['SERVER_ADDR'] == '10.215.137.11'){
 $APPCONFIG = parse_ini_file('config/'.carooemspa2v.'.ini',true);
}
elseif($_SERVER['SERVER_ADDR'] == '10.134.179.69 '){
 $APPCONFIG = parse_ini_file('config/'.njbboemssa1v.'.ini',true);
}
elseif($_SERVER['SERVER_ADDR'] == '10.134.179.70'){
 $APPCONFIG = parse_ini_file('config/'.njbboemssa2v.'.ini',true);
}
elseif($_SERVER['SERVER_ADDR'] == '10.134.179.40'){
 $APPCONFIG = parse_ini_file('config/'.njbboemspa1v.'.ini',true);
}
elseif($_SERVER['SERVER_ADDR'] == '10.134.179.41'){
 $APPCONFIG = parse_ini_file('config/'.njbboemspa2v.'.ini',true);
}
elseif(file_exists('config/'.$_SERVER['SERVER_NAME'].'.ini')){
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

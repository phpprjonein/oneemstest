<?php
if(rand(0,1)){
    $ret = true;
}else{
    $ret = false;
}
$myObject = array( 'result' => $ret ); // example
echo json_encode($myObject); // outputs JSON text
?>
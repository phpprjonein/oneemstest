<?php 
if(rand(1,99) % 2 == 0){
    $ret = true;
}else{
    $ret = false;
}
$myObject = array( 'result' => $ret ); // example
echo json_encode($myObject); // outputs JSON text
?>
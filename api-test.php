<<<<<<< HEAD
<?php 
if(rand(1,99) % 2 == 0){
    $ret = true;
}else{
    $ret = false;
}
$myObject = array( 'result' => $ret ); // example
echo json_encode($myObject); // outputs JSON text
=======
<?php 
if(rand(1,99) % 2 == 0){
    $ret = true;
}else{
    $ret = false;
}
$myObject = array( 'result' => $ret ); // example
echo json_encode($myObject); // outputs JSON text
>>>>>>> f925d24473e59e9234a9eee7f64f09b390f58d46
?>
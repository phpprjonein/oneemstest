<?php
include "classes/db2.class.php";
include 'functions.php';

if($_GET['batchtype'] == 'se'){
    $_SESSION['batchtype-dt-filter'] = 'Script Execution';
}elseif($_GET['batchtype'] == 'sd'){
    $_SESSION['batchtype-dt-filter'] = 'Software Delivery';
}elseif($_GET['batchtype'] == 'bo'){
    $_SESSION['batchtype-dt-filter'] = 'Change Boot Order';
}elseif($_GET['batchtype'] == 'rb'){
    $_SESSION['batchtype-dt-filter'] = 'Reboot';
}



$backup_list = get_devicebatch_list_from_devicebatch_datatable();
exit(json_encode($backup_list, 1));
?>

<?php
include "classes/db2.class.php";
include 'functions.php';
$userid = $_SESSION['userid'];
ini_set('display_errors', 1);

if ($_POST['screen'] == 'Vendor') {
    if($_POST['act'] == 'add'){
        $values_arr = array(
                'vendorName' => $_POST['vendorName'],
        );
        insert_vendor($values_arr);
        print 'success';
    }
    if($_POST['act'] == 'edit'){
        $values_arr = array(
                'id' => $_POST['id'],
                'vendorName' => $_POST['vendorName'],
        );
        update_vendor($values_arr);
        print 'success';
    }
    if($_POST['act'] == 'delete'){
        $values_arr = array(
                'id' => $_POST['id'],
        );
        delete_vendor($values_arr);
        $_SESSION['msg'] = 'ds';
        print 'success';
    }
    
}
?>
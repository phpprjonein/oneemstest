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

if ($_POST['screen'] == 'User') {
    
    if($_POST['act'] == 'add'){
        $values_arr = array(
                'username' => $_POST['username'],
                'password' => md5($_POST['password']),
                'userid' => $_POST['username'],
                'userlevel' => $_POST['role'],
                'email' => $_POST['email'],
                'timestamp' => date('m-d-Y'),
                'status' => $_POST['status'],
                'fname' => $_POST['fname'],
                'lname' => $_POST['lname'],
                'phone' => $_POST['phone'],
                'role' => $_POST['role'],
                'zones' => $_POST['zones'],
        );
        insert_user($values_arr);
        print 'success';
    }
    
    if($_POST['act'] == 'edit'){
        $values_arr = array(
                'id' => $_POST['id'],
                'username' => $_POST['username'],
                'userlevel' => $_POST['role'],
                'email' => $_POST['email'],
                'status' => $_POST['status'],
                'fname' => $_POST['fname'],
                'lname' => $_POST['lname'],
                'phone' => $_POST['phone'],
                'role' => $_POST['role'],
                'zones' => $_POST['zones'],
        );
        if($_POST['password'] != ''){
            $values_arr['password'] = md5($_POST['password']);
        }
        
        update_user($values_arr);
        print 'success';
    }
    
    
    if($_POST['act'] == 'delete'){
        $values_arr = array(
                'id' => $_POST['id'],
        );
        delete_user($values_arr);
        $_SESSION['msg'] = 'ds';
        print 'success';
    }
    
}






?>
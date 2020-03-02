<?php
include "classes/db2.class.php";
include 'functions.php';
$userid = $_SESSION['userid'];
ini_set('display_errors', 'ON');
if ($_POST['action'] == 'Save Configuration') {
    $db2 = new db2();
    $templname = $_POST['templname'];
    $sql = 'INSERT INTO `configtemplate` (`templname`, `elemid`, `elemvalue`, `editable`, `alias`, `userid`, `refmop`, `comments`, `auditable`, `category`) VALUES';
    $oc = 0;
    foreach ($_POST['loop'] as $key => $val) {
        $oc ++;
        $inc = 0;
        foreach ($val as $linekey => $lineval) {
            $inc ++;
            if (count($_POST['loop']) == $oc && count($val) == $inc) {
                $sql .= "('" . $templname . "','" . str_replace('looper_', '', $key) . $linekey . "','" . $lineval . "','" . $_POST['hidden'][$key][$linekey] . "','','" . $_SESSION['userid'] . "','','','','')";
            } else {
                $sql .= "('" . $templname . "','" . str_replace('looper_', '', $key) . $linekey . "','" . $lineval . "','" . $_POST['hidden'][$key][$linekey] . "','','" . $_SESSION['userid'] . "','','','',''),";
            }
        }
    }
    if ($inc > 0) {
        $db2->query($sql);
        $db2->execute();
        $_SESSION['msg'] = 'dbs';
    }
    if (isset($_POST['usertype']) && $_POST['usertype'] == 2) {
        header("location:scripting.php");
    } else {
        header("location:scripting.php");
    }
} elseif ($_POST['action'] == 'Download Script') {
    $templname = $_POST['templname'];
    $file = fopen(getcwd() . "/upload/" . $templname . ".script", "w");
    foreach ($_POST['loop'] as $key => $val) {
        $line = '';
        foreach ($val as $linekey => $lineval) {
            $line .= $lineval;
        }
        fwrite($file, $line . "\n");
    }
    fclose($file);
    $file_url = getcwd() . "/upload/" . $templname . ".script";
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
    readfile($file_url); // do the double-download-dance (dirty but worky)
}
?>
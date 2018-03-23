<?php
include "classes/db2.class.php";
include 'functions.php';
$userid = $_SESSION['userid'];
ini_set('display_errors', 'ON');    
if($_POST['action'] == 'Save Configuration'){
    $db2 = new db2();
    $templname = $_POST['templname'];
    $sql = 'INSERT INTO `configtemplate` (`templname`, `elemid`, `elemvalue`, `editable`, `alias`, `userid`, `refmop`, `comments`, `auditable`, `category`) VALUES';
    $oc = 0;
    foreach ($_POST['loop'] as $key => $val){
        $oc++;$inc = 0;
        foreach($val as $linekey => $lineval){
            $inc++;
            if(count($_POST['loop']) == $oc && count($val) == $inc){
                $sql .= "('".$templname."','".str_replace('looper_','',$key).$linekey."','".$lineval."','".$_POST['hidden'][$key][$linekey]."','','".$_SESSION['userid']."','','','','')";
            }else{
                $sql .= "('".$templname."','".str_replace('looper_','',$key).$linekey."','".$lineval."','".$_POST['hidden'][$key][$linekey]."','','".$_SESSION['userid']."','','','',''),";
            }
        }
    }
    if($inc > 0){
        $db2->query($sql);
        $db2->execute();
        $_SESSION['msg'] = 'dbs';
    }
    if(isset($_POST['usertype']) && $_POST['usertype'] == 2){
        header("location:switchtech-configuration.php");
    }else{
        header("location:cellsitetech-configuration.php");
    }
}elseif ($_POST['action'] == 'Save Script'){
    $file = fopen(getcwd()."/upload/sampleconfigfile.script","w");
    foreach ($_POST['loop'] as $key => $val){
        $line = '';
        foreach($val as $linekey => $lineval){
            $line .= $lineval;
        }
        fwrite($file,$line."\n");
    }
    fclose($file);
    $_SESSION['msg'] = 'ss';
    header("location:cellsitetech-configuration.php");
}elseif ($_POST['action'] == 'Download Script'){
    $file = fopen(getcwd()."/upload/sampleconfigfile.script","w");
    foreach ($_POST['loop'] as $key => $val){
        $line = '';
        foreach($val as $linekey => $lineval){
            $line .= $lineval;
        }
        fwrite($file,$line."\n");
    }
    fclose($file);
    $file_url = getcwd()."/upload/sampleconfigfile.cfg";
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
    readfile($file_url); // do the double-download-dance (dirty but worky)
}elseif ($_POST['action'] == 'Upload'){
    if ($_FILES["file"]["type"] == "text/plain") {
        //Remove if config file exist
        if(file_exists(getcwd()."/upload/sampleconfigfile_".$_SESSION['userid'].".txt")){
            unlink(getcwd()."/upload/sampleconfigfile_".$_SESSION['userid'].".txt");
        }
        if ($_FILES["file"]["error"] > 0) {
            $_SESSION['msg'] = 'fe';
            $_SESSION['msg-param']['fileerror'] = $_FILES["file"]["error"];
        } else {
            if(file_exists($_POST['filename'])){
                unlink($_POST['filename']);
            }
            if (file_exists($_POST['filename'])) {
                $_SESSION['msg'] = 'fae';
                $_SESSION['msg-param']['filename'] = $_FILES["file"]["name"];
            } else {
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $_POST['filename'])) {
                    $_SESSION['msg'] = 'fus';
                }
            }
        }
    } else {
        if ($_FILES["file"]["type"] != "text/plain"){
            $_SESSION['msg'] = 'fte';
        }
        else if ($_FILES["file"]["size"] < 65536){
            $_SESSION['msg'] = 'feps';
        }
    }
    if(isset($_POST['usertype']) && $_POST['usertype'] == 2){
        header("location:switchtech-configuration.php");
    }else{
        header("location:cellsitetech-configuration.php");
    }
}

?>
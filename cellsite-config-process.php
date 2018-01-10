<?php
include "classes/db2.class.php";
include 'functions.php';
$userid = $_SESSION['userid'];
    
if($_POST['action'] == 'SaveDB'){
    $db2 = new db2();
    $templname = 'templ_'.generateRandomString();
    $sql = 'INSERT INTO `configtemplate` (`templname`, `elemid`, `elemvalue`, `editable`) VALUES';
    $oc = 0;
    foreach ($_POST['loop'] as $key => $val){
        $oc++;$inc = 0;
        foreach($val as $linekey => $lineval){
            $inc++;
            if(count($_POST['loop']) == $oc && count($lineval) == $inc){
                $sql .= "('".$templname."','".str_replace('looper_','',$key).$linekey."','".$lineval."','".$_POST['hidden'][$key][$linekey]."')";
            }else{
                $sql .= "('".$templname."','".str_replace('looper_','',$key).$linekey."','".$lineval."','".$_POST['hidden'][$key][$linekey]."'),";
            }
        }
    }
    if($inc > 0){
        $db2->query($sql);
        $db2->execute();
        $_SESSION['msg'] = 'dbs';
    }
    header("location:cellsitetech-configuration.php");
}elseif ($_POST['action'] == 'Saveasscriptfile'){
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
}elseif ($_POST['action'] == 'Downloadsscriptfile'){
    $file_url = getcwd()."/upload/sampleconfigfile.script";
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
    readfile($file_url); // do the double-download-dance (dirty but worky)
}
?>
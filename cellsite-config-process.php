<?php
include "classes/db2.class.php";
include 'functions.php';
$userid = $_SESSION['userid'];
    
if($_POST['action'] == 'SaveDB'){
    $db2 = new db2();
    $templname = 'templ_'.generateRandomString();
    foreach ($_POST['loop'] as $key => $val){
        foreach($val as $linekey => $lineval){
            $sql = "INSERT INTO `configtemplate` (`templname`, `elemid`, `elemvalue`, `editable`) VALUES('".$templname."','".str_replace('looper_','',$key).$linekey."','".$lineval."','".$_POST['hidden'][$key][$linekey]."')";
            $db2->query($sql);
            $db2->execute();
        }
    }
    $_SESSION['msg'] = 'dbs';
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
}
?>
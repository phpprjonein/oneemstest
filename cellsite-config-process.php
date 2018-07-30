<?php
ini_set('display_errors', 'ON');
include_once 'classes/db2.class.php';
include_once 'functions.php';
$userid = $_SESSION['userid'];

if ($_POST['action'] == 'SAVE CONFIGURATION') {
    /*
     * unset($_POST['switch_name']);
     * if(isset($_POST['switch_name']) && !empty($_POST['switch_name'])){
     * $_SESSION['ct_switch_name']=$_POST['switch_name'];
     * }
     */
    $templname = $_POST['templname'];
    delete_templname_already_exist($templname);
    $db2 = new db2();
    $sql = 'INSERT INTO `configtemplate` (`templname`, `elemid`, `elemvalue`, `editable`, `alias`, `userid`, `refmop`, `comments`, `auditable`, `category`, `tabname`) VALUES';
    $oc = 0;
    foreach ($_POST['loop'] as $key => $val) {
        $oc ++;
        $inc = 0;
        foreach ($val as $linekey => $lineval) {
            $inc ++;
            $_POST['looptabler'][$key][$linekey] = ($_POST['looptabler'][$key][$linekey] == '--Select--') ? '' : $_POST['looptabler'][$key][$linekey];
            $lineval = ($lineval == '--Select--') ? '' : $lineval;
            if (count($_POST['loop']) == $oc && count($val) == $inc) {
                $sql .= "('" . $templname . "','" . str_replace('looper_', '', $key) . $linekey . "','" . $lineval . "','" . $_POST['hidden'][$key][$linekey] . "','" . $_POST['alias'] . "','" . $_SESSION['userid'] . "','" . $_POST['refmop'] . "','','','','" . $_POST['looptabler'][$key][$linekey] . "')";
            } else {
                $sql .= "('" . $templname . "','" . str_replace('looper_', '', $key) . $linekey . "','" . $lineval . "','" . $_POST['hidden'][$key][$linekey] . "','" . $_POST['alias'] . "','" . $_SESSION['userid'] . "','" . $_POST['refmop'] . "','','','','" . $_POST['looptabler'][$key][$linekey] . "'),";
            }
        }
    }
    if ($inc > 0) {
        $db2->query($sql);
        $db2->execute();
        $_SESSION['msg'] = 'dbs';
    }
    if (isset($_POST['usertype']) && $_POST['usertype'] == 2) {
        header("location:switchtech-configuration.php");
    } else {
        header("location:cellsitetech-configuration.php");
    }
} elseif ($_POST['action'] == 'Execute Script') {
    $usertype = (isset($_SESSION['userlevel']) == 1) ? "Cell sitetechnician" : "";
    $username = $_SESSION['username'];
    $mesg = " User name: $username User type : $usertype Page:  Generate Script page Description: User has executed the script.";
    write_log($mesg);
    
    // exit();
    $templname = $_POST['templname'];
    $db2 = new db2();
    $batchid = time();
    $sql = "INSERT INTO `tmpbatchconfigtemplate` (`batchid`,`templname`, `elemid`, `elemvalue`, `editable`, `alias`, `userid`, `refmop`, `comments`, `auditable`, `category`, `tabname`) SELECT " . $batchid . " AS batchid, `templname`, `elemid`, `elemvalue`, `editable`, `alias`, `userid`, `refmop`, `comments`, `auditable`, `category`,`tabname` FROM configtemplate where templname = '" . $templname . "'";
    $db2->query($sql);
    $db2->execute();
    $sql = "SELECT distinct(elemid),elemvalue, templname, refmop FROM tmpbatchconfigtemplate where batchid = '" . $batchid . "' order by elemid asc";
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    $compare_arr = array();
    foreach ($resultset['result'] as $key => $val) :
        $compare_arr[$batchid][$val['templname']][$val['elemid']] = $val['elemvalue'];
    endforeach
    ;
    foreach ($_POST['edit'] as $key => $val) :
        if ($val[0] == 1) :
            $location = str_replace("looper_", "", $key);
            foreach ($_POST['loop'][$key] as $ink => $inv) :
                $update_pos = intval($location . $ink);
                if ($compare_arr[$batchid][$templname][$update_pos] != $inv) :
                    $sql = "UPDATE `tmpbatchconfigtemplate` SET elemvalue = '" . $inv . "' WHERE elemid = " . $update_pos . " AND templname = '" . $_POST['templname'] . "' AND batchid = " . $batchid;
                    $db2->query($sql);
                    $db2->execute();
                endif;
                
            endforeach
            ;
        endif;
        
    endforeach
    ;
    $newlinearr = array();
    $sql = "SELECT distinct(elemid),elemvalue, templname, refmop FROM tmpbatchconfigtemplate where batchid = '" . $batchid . "' order by elemid asc";
    $db2->query($sql);
    $results = $db2->resultset();
    foreach ($results as $key => $val) :
        $newlinearr[intval($val['elemid'] / 10)] .= $val['elemvalue'];
    endforeach
    ;
    $values = implode('|', $newlinearr);
    $sql = "INSERT INTO `scriptmaster` (`batchid`,`scriptlist`)  VALUES ('" . $batchid . "', '" . $values . "')";
    $db2->query($sql);
    $db2->execute();
    empty($_SESSION['batch_vars']);
    $_SESSION['batch_vars'] = array(
        'batchid' => $batchid,
        'refmop' => $val['refmop'],
        'templname' => $templname,
        'deviceseries' => $_POST['deviceseries'],
        'deviceos' => $_POST['deviceos']
    );
    if (isset($_POST['usertype']) && $_POST['usertype'] == 2) {
        header("location:batch-page.php");
    } else {
        header("location:batch-page.php");
    }
} elseif ($_POST['action'] == 'Save Script') {
    $file = fopen(getcwd() . "/upload/sampleconfigfile.script", "w");
    foreach ($_POST['loop'] as $key => $val) {
        $line = '';
        foreach ($val as $linekey => $lineval) {
            $line .= $lineval;
        }
        fwrite($file, $line . "\n");
    }
    fclose($file);
    $_SESSION['msg'] = 'ss';
    header("location:cellsitetech-configuration.php");
} elseif ($_POST['action'] == 'Download Script') {
    $file = fopen(getcwd() . "/upload/sampleconfigfile.script", "w");
    foreach ($_POST['loop'] as $key => $val) {
        $line = '';
        foreach ($val as $linekey => $lineval) {
            $line .= $lineval;
        }
        fwrite($file, $line . "\n");
    }
    fclose($file);
    $file_url = getcwd() . "/upload/sampleconfigfile.script";
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
    readfile($file_url); // do the double-download-dance (dirty but worky)
} elseif ($_POST['action'] == 'UPLOAD') {
    if ($_FILES["file"]["type"] == "text/plain") {
        // Remove if config file exist
        if (file_exists(getcwd() . "/upload/sampleconfigfile_" . $_SESSION['userid'] . ".txt")) {
            unlink(getcwd() . "/upload/sampleconfigfile_" . $_SESSION['userid'] . ".txt");
        }
        if ($_FILES["file"]["error"] > 0) {
            $_SESSION['msg'] = 'fe';
            $_SESSION['msg-param']['fileerror'] = $_FILES["file"]["error"];
        } else {
            if (file_exists($_POST['filename'])) {
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
        if ($_FILES["file"]["type"] != "text/plain") {
            $_SESSION['msg'] = 'fte';
        } else if ($_FILES["file"]["size"] < 65536) {
            $_SESSION['msg'] = 'feps';
        }
    }
    if (isset($_POST['usertype']) && $_POST['usertype'] == 2) {
        header("location:switchtech-configuration.php");
    } else {
        header("location:cellsitetech-configuration.php");
    }
} elseif ($_POST['action'] == 'LoadTableData') {
    $tablename_arr = array(
        'globalvars' => 'globalvars',
        'marketvars' => 'marketvars',
        'usrvars' => 'usrvars',
        'switchvars' => 'switchvars'
    );
    $posttabname = $_POST['loadTab'];
    if (isset($posttabname) && in_array($posttabname, $tablename_arr)) {
        if ($posttabname == 'globalvars') {
            $field = 'gvarname';
        } elseif ($posttabname == 'marketvars') {
            $field = 'mvarname';
        } elseif ($posttabname == 'usrvars') {
            $field = 'usrvarname';
        } elseif ($posttabname == 'switchvars') {
            $field = 'swvarname';
        }
        $replace_selbox = '<option val="">--Select--</option>';
        $vars = configtemplate_elemvalue($posttabname, $field, $_POST['switch_name']);
        foreach ($vars as $key => $val) {
            $replace_selbox .= '<option value="' . $val[$field] . '">' . $val[$field] . '</option>';
        }
    }
    echo $replace_selbox;
}

?>
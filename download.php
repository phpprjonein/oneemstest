<?php
if (isset($_GET['file']) && file_exists($_GET['file'])) {
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . basename($_GET['file']) . "\"");
    readfile($_GET['file']); // do the double-download-dance (dirty but worky)
}
if (isset($_GET['tarfile'])) {
    $path = '/usr/apps/oneems/fs1/showtech/';
    $filenames = array_values(array_diff(scan_dir($path), array(
            '.',
            '..'
    )));
    $timestamp = date("Y-m-d_H-i-s");
    $zipname = 'showtech/'.$_GET['tarfile'].'_'.$timestamp.'.zip';
    unlink($zipname);
    $zip = new ZipArchive;
    $zip->open($zipname, ZipArchive::CREATE);
    foreach ($filenames as $file) {
        if(strpos($file, $_GET['tarfile']) !== false){
            $zip->addFile("/usr/apps/oneems/fs1/showtech/".$file);
        }
    }
    $zip->close();
    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename='.$zipname);
    header('Content-Length: ' . filesize($zipname));
    readfile($zipname);
    
}
function scan_dir($dir)
{
    $ignored = array(
            '.',
            '..'
    );
    
    $files = array();
    foreach (scandir($dir) as $file) {
        if (in_array($file, $ignored))
            continue;
            $files[$file] = filemtime($dir . '/' . $file);
    }
    
    arsort($files);
    $files = array_keys($files);
    
    return ($files) ? $files : false;
}

?>
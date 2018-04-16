<<<<<<< HEAD
<?php 
if(isset($_GET['file']) && file_exists($_GET['file'])){
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . basename($_GET['file']) . "\"");
    readfile($_GET['file']); // do the double-download-dance (dirty but worky)
}
=======
<?php 
if(isset($_GET['file']) && file_exists($_GET['file'])){
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . basename($_GET['file']) . "\"");
    readfile($_GET['file']); // do the double-download-dance (dirty but worky)
}
>>>>>>> f925d24473e59e9234a9eee7f64f09b390f58d46
?>
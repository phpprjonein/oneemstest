 <?php 
 if($_GET['act'] == 'restore'){
    $homepage = file_get_contents('C:\Users\Srinivasan\Downloads\thota\AKROOH2091A-P-CI-9010-01.txt');
    echo '<PRE>' . $homepage . '</PRE>';
 }elseif($_GET['act'] == 'view'){
     $row_region = strtolower(str_replace(' ','', $_POST['region']));
     //$path = '/pysvrdevbakupfiles/'.$row_region.'/'.$_POST['filename'];
     $path = '/usr/apps/oneems/config/bkup/'.$row_region.'/'.$_POST['filename'];
     if(file_exists($path)){
         echo file_get_contents($path);
     }
 }
?>

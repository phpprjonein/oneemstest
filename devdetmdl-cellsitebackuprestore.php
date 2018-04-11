<?php 
        
        $deviceid = $_GET['deviceid'];
        $url='http://10.134.179.82:8089/backuprestore/ios/'.$deviceid;
?>
         
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel"> Back up and Restore  - <?php echo $_GET['deviceid'];?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">    
<?php
        if (isset($url)) {
           if (!$data = @file_get_contents($url)) {
             $error = error_get_last(); 
             $data = "HTTP request failed. Error was: " . $error['message'];
           } 
        } else 
            $data = "CLI command needs is in progress.";
          
     echo "<span style='font-family:courier;font-size:12px;font-weight:500;'> $data</span>";
?>  
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    
</div>
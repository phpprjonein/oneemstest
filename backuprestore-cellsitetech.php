<?php
include "classes/db2.class.php";
include "classes/paginator.class.php";  
include 'functions.php'; 

$results = load_backup_information($_GET['deviceid']);

?>
    
<div class="ownfont box-body launch-modal">
  <table class="table table-bordered" id="back_res" cellspacing="0" cellpadding="0" >				  
    <tbody>
    	<?php foreach ($results as $key => $val){ ?>
        <tr>                  
			<td><b><?php echo $val['name'];?><b></td>                                              
            <td><b><?php echo $val['date'];?><b></td>
            <td><b><?php echo $val['type'];?><b><b></td> 
			<td><button type="button" id = "restorebtn" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-remote="remote-page.html">Restore </button></td>
         </tr>
         <?php } ?>
    </tbody>
  </table>
</div> 
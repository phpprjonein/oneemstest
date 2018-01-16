
<?php
include "classes/db2.class.php";
include "classes/paginator.class.php";  
include 'functions.php'; 
?>
    <?php  
                                               //  Python API Request using curl Begins                    
            $userid = $_GET['userid'];
            $deviceid = $_GET['deviceid'];               
            $devicetype='ios';
            $url_send =" http://txaroemsda2z.nss.vzwnet.com:8080/healthcheck/";
            $deviceid = $_GET['deviceid'];              
 	          $url_final = 'http://txaroemsda2z.nss.vzwnet.com:8080/healthcheck/'.$devicetype.'/'.$deviceid;			
            $output = json_decode(sendPostData($url_final),true);   
            $_SESSION['deviceidcs'] = $deviceid;                 
     ?>

                <div class="ownfont box-body launch-modal">
                  <table class="table table-bordered" id="back_res" cellspacing="0" cellpadding="0" >				  
                    <tbody>
                        <tr>                  
							<td><b><?php echo 'Backup file name one';?><b></td>                                              
                            <td><b><?php echo date('Y-m-d H:i:s');?><b></td>
                            <td><b><?php echo 'Manual'?><b><b></td>
                             <td><b><!-- Button trigger modal -->
							 <!--
								<button type="button" class="btn btn-primary anchorcmd" data-toggle="modal" data-target="#mycmdModal">Restore
								</button>
								-->
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-remote="remote-page.html">
								Restore </button>
								</td>
                         </tr>
						<tr>                  
							<td><b><?php echo 'Backup file name two';?><b></td>                                              
                            <td><b><?php echo date('Y-m-d H:i:s');?><b></td>
                            <td><b><?php echo 'Automatic'?><b><b></td>
                             <td><b><!-- Button trigger modal -->
								<!--
								<button type="button" class="btn btn-primary anchorcmd" data-toggle="modal" data-target="#mycmdModal">Restore
								</button>-->
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
								Restore </button>
								</td>
                         </tr>						 
                    </tbody>
                                       </table>
                                    </div> 
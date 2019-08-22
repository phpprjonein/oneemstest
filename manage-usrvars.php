<?php
include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';
include "libraries/spreadsheet-reader-master/php-excel-reader/excel_reader2.php";
include "libraries/spreadsheet-reader-master/SpreadsheetReader.php";
ini_set('max_execution_time', 500);
ini_set('display_errors',1);

// Static variable values set
if (isset($_GET['clear'])) {
    if (strtolower($_GET['clear']) == 'search') {
        unset($_SESSION['search_term']);
    }
}

user_session_check();
check_user_authentication(array(
    8
)); // cellsite tech type user

$page_title = 'OneEMS';
if ( isset($_POST["submit"]) ) {
	/* if(!file_exists($_FILES["file"]["tmp_name"])){
		echo '
			<div id="main-status" class="alert alert-success">No file to upload</div>';																
	}
	else{ */
		$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
		  
		if(in_array($_FILES["file"]["type"],$allowedFileType))
		{
			$targetPath = 'upload/'.$_FILES['file']['name'];
			move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
			$Reader = new SpreadsheetReader($targetPath);			
			$sheetCount = count($Reader->sheets());
			
			for($i=0;$i<$sheetCount;$i++)
			{
				$Reader->ChangeSheet($i);				
				foreach ($Reader as $Row)
				{
					$values_arr = array(
						'usrvarname' => $Row[1],
						'value' => $Row[2],
						'deviceseries' => $Row[3],
						'template' => $Row[4],
					);
					insert_user_variable($values_arr);
				}			
			}
			echo '<div id="main-status" class="alert alert-success">Variables inserted successfully</div>';
		}
		else
		{ 
			$type = "error";
			$message = "Invalid File Type. Upload Excel File.";
			echo $message;exit;
		}
	//}	 
}

?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes.php");  ?>
	<script src="resources/js/manageusrvars.js?t="
	<?php echo date('his'); ?>></script>
</head>
<body class="hold-transition skin-blue sidebar-mini ownfont">
	<!-- Modal HTML -->
	<div class="container-fluid">
        <?php include ('menu.php'); ?>
        <div class="content container-fluid" id="login-impersonate">
			<!-- Main content -->
			<section class="content" id="sw-delivery-devices">
				<div class="col-md-12">
					<?php if($_SESSION['msg'] == 'ds'){?>
					<div id="status" class="alert alert-success"> User Variable Deleted Successfully</div>
					<?php unset($_SESSION['msg']);}?>
						<!-- Button trigger modal -->
						<!--button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addUsrvarForm">
							Add User Variable
						</button-->
						<h5> Add User Variable</h5>
						<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="file">Select a file to upload</label> <input
									type="file" id="file" name="file">
								
							</div>
							<input type="submit" name="submit" />
						</form>

        <!-- Modal -->
                <!-- The Modal -->
        		<!--div class="modal fade" id="addUsrvarForm">
        			<div class="modal-dialog modal-lg">
        				<div class="modal-content" id="manual-device-discovery">
        					<!-- Modal Header -->
        					<!--div class="modal-header" id="restoremodalhdr">
        						<h5 class="modal-title text-center" id="modalLabelLarge">Add User Variable</h5>
        						<button type="button" class="close" data-dismiss="modal"
        							aria-label="Close">
        							<span aria-hidden="true">&times;</span>
        						</button>
        					</div>
        					<!-- Modal body -->
        					<!--div class="modal-body">
        					<div id="status" style="display: none;" class="alert-popup"></div><br/>
        					<form role="form">
        					<input type="hidden" id="usrvarId" value="">
        					
        					
                          <div class="row">
    						  <div class="form-group col-md-12">
                              <div class="form-group">
                                <label for="Template">Template Name</label>
                                  <input type="file" class="form-control"
                                  id="Template" placeholder="Template"/>
                              </div>
                              </div>
                          </div>
                          
                            <?php
                            //$role_names = generic_get_userlevels();
                            ?>
                        </form>
        					
        					</div>
        
        					<!-- Modal footer -->
        					<!--div class="modal-footer">
        						<button type="button" class="btn btn-secondary" id="addusrvar">Upload User Variable</button>
        							
        						<button type="button" class="btn btn-secondary"
        							data-dismiss="modal">Close</button>
        					</div-->
        				<!--/div>
        			</div>
        		</div-->


				<!--div class="modal fade" id="deleteUsrvarForm">
        			<div class="modal-dialog modal-lg">
        				<div class="modal-content" id="manual-device-discovery">
        					<!-- Modal Header -->
        					<!--div class="modal-header" id="restoremodalhdr">
        						<h5 class="modal-title text-center" id="modalLabelLarge">Delete User Variable</h5>
        						<button type="button" class="close" data-dismiss="modal"
        							aria-label="Close">
        							<span aria-hidden="true">&times;</span>
        						</button>
        					</div-->
        					<!-- Modal body -->
        					<!--div class="modal-body">
        					<div id="status" style="display: none;" class="alert-popup"></div><br/>
        					<form role="form">
        					<input type="hidden" id="usrvarId" value="">
                          <div class="form-group">
                            Are you sure want to delete User Variable - <b><span id="usrvarNameDel"></span></b>
                          </div>
                          
                        </form>
        					
        					</div-->
        
        					<!-- Modal footer -->
        					<!--div class="modal-footer">
        						<button type="button" class="btn btn-secondary" id="deleteuser">Delete User Variable</button>
        						<button type="button" class="btn btn-secondary"
        							data-dismiss="modal">Close</button>
        					</div>
        				</div>
        			</div>
        		</div-->

				<div class="row">
					<!-- /router selection content row -->
					<div class="col-sm-12 col-md-12" id="listname-dd">
						<div class="row">
							<div class="col">
								<input type="hidden" value="<?php echo $_SESSION['userid'];?>" name="userid" id="userid" />
								<?php $usrvars = generic_get_usrvars();?>
								<?php //print '<pre>'; print_r($usrvars);?>
								<table id="manageusrvars" class="display"
									style="width: 100%">
									<thead>
										<tr>
											<th width="75px">S.No</th>
											<th>User Variable ID</th>
											<th>User Variable Name</th>
											<th>Value</th>
											<th>Device Series</th>
											<!--th>Action</th-->
										</tr>
									</thead>
									<tbody>
									<?php $i=1; foreach ($usrvars['result'] as $key=>$val){?>
										<tr data-user="<?php echo $val['id'];?>" data-zones="<?php echo $val['zones'];?>" data-userlevel="<?php echo $val['userlevel'];?>" data-status="<?php echo $val['status'];?>">
										<td><?php echo $i++;?></td>
										<td><?php echo $val['usrvarid'];?></td>
										<td><?php echo $val['usrvarname'];?></td>
										<td><?php echo $val['usrvarval'];?></td>
										<td><?php echo $val['deviceseries'];?></td>
										<!--td><button type="button" class="btn btn-secondary edituser">Edit</button>&nbsp;<button type="button" class="btn btn-secondary deleteuser">Delete</button></td-->
										</tr>
									<?php }?>

									</tbody>
								</table>
							</div>
						</div>
						<!-- /template name content -->
					</div>
							<!-- /script output -->

							<!-- /backup management content row -->
				</div>			
			</section>
		</div>
	</div>
	<?php include ('footer.php'); ?>
    </body>
</html>

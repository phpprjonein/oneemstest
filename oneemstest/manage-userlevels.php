<?php
include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';

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

?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes.php");  ?>
	<script src="resources/js/manageuserlevels.js?t="
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
					<div id="status" class="alert alert-success"> User Level Deleted Successfully</div>
					<?php unset($_SESSION['msg']);}?>
				<!-- Button trigger modal -->
				<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addUserLevelForm">
					Add User Level
				</button>

        <!-- Modal -->
                <!-- The Modal -->
        		<div class="modal fade" id="addUserLevelForm">
        			<div class="modal-dialog modal-lg">
        				<div class="modal-content" id="manual-device-discovery">
        					<!-- Modal Header -->
        					<div class="modal-header" id="restoremodalhdr">
        						<h5 class="modal-title text-center" id="modalLabelLarge">Add User Level</h5>
        						<button type="button" class="close" data-dismiss="modal"
        							aria-label="Close">
        							<span aria-hidden="true">&times;</span>
        						</button>
        					</div>
        					<!-- Modal body -->
        					<div class="modal-body">
								<div id="status" style="display: none;" class="alert-popup"></div><br/>
								<form role="form">
									<input type="hidden" id="userlevelId" value="">
									<div class="row">
										<div class="form-group col-md-6">
											<div class="form-group">
												<label for="userlevelName">User Level Name</label>
												<input type="text" class="form-control" id="userlevelName" placeholder="User Level Name"/>
											</div>
										</div>									  
									</div>							  
								</form>        					
							</div>
		
							<!-- Modal footer -->
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" id="adduserlevel">Add User Level</button>
								<button type="button" class="btn btn-secondary" id="edituserlevel">Update User Level</button>	
								<button type="button" class="btn btn-secondary"
									data-dismiss="modal">Close</button>
							</div>
						</div>
        			</div>
        		</div>


				<div class="modal fade" id="deleteUserLevelForm">
        			<div class="modal-dialog modal-lg">
        				<div class="modal-content" id="manual-device-discovery">
        					<!-- Modal Header -->
        					<div class="modal-header" id="restoremodalhdr">
        						<h5 class="modal-title text-center" id="modalLabelLarge">Delete User Level</h5>
        						<button type="button" class="close" data-dismiss="modal"
        							aria-label="Close">
        							<span aria-hidden="true">&times;</span>
        						</button>
        					</div>
        					<!-- Modal body -->
        					<div class="modal-body">
								<div id="status" style="display: none;" class="alert-popup"></div><br/>
								<form role="form">
									<input type="hidden" id="userlevelId" value="">
									<div class="form-group">
										Are you sure want to delete User Level - <b><span id="userlevelDel"></span></b>
									</div>							  
								</form>        					
        					</div>
        
        					<!-- Modal footer -->
        					<div class="modal-footer">
        						<button type="button" class="btn btn-secondary" id="deleteuserlevel">Delete User Level</button>
        						<button type="button" class="btn btn-secondary"
        							data-dismiss="modal">Close</button>
        					</div>
        				</div>
        			</div>
        		</div>




						<div class="row">
							<!-- /router selection content row -->
							<div class="col-sm-12 col-md-12" id="listname-dd">
								<div class="row">
									<div class="col">
										<input type="hidden" value="<?php echo $_SESSION['userid'];?>" name="userid" id="userid" />
										<?php $userlevels = generic_get_user_levels();?>
										<?php //print '<pre>'; print_r($users);?>
										<table id="manageuserlevels" class="display"
											style="width: 100%">
											<thead>
												<tr>
													<th width="75px">S.No</th>
													<th>Userlevel ID</th>
													<th>Userlevel Name</th>
													<th>Action</th>													
												</tr>
											</thead>
											<tbody>
											<?php $i=1; foreach ($userlevels['result'] as $key=>$val){?>
												<tr data-user="<?php echo $val['id'];?>" data-zones="<?php echo $val['zones'];?>"  data-userlevel="<?php echo $val['userlevel'];?>" data-status="<?php echo $val['status'];?>">
												<td><?php echo $i++;?></td>
												<td><?php echo $val['id'];?></td>
												<td><?php echo $val['userlevel'];?></td>
												<td><button type="button" class="btn btn-secondary edituserlevel">Edit</button>&nbsp;<button type="button" class="btn btn-secondary deleteuserlevel">Delete</button></td>
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

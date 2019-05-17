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
	<script src="resources/js/manageusers.js?t="
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
					<div id="status" class="alert alert-success"> User Deleted Successfully</div>
					<?php unset($_SESSION['msg']);}?>
<!-- Button trigger modal -->
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addUserForm">
    Add User
</button>

        <!-- Modal -->
                <!-- The Modal -->
        		<div class="modal fade" id="addUserForm">
        			<div class="modal-dialog modal-lg">
        				<div class="modal-content" id="manual-device-discovery">
        					<!-- Modal Header -->
        					<div class="modal-header" id="restoremodalhdr">
        						<h5 class="modal-title text-center" id="modalLabelLarge">Add User</h5>
        						<button type="button" class="close" data-dismiss="modal"
        							aria-label="Close">
        							<span aria-hidden="true">&times;</span>
        						</button>
        					</div>
        					<!-- Modal body -->
        					<div class="modal-body">
        					<div id="status" style="display: none;" class="alert-popup"></div><br/>
        					<form role="form">
        					<input type="hidden" id="userId" value="">
                          <div class="form-group">
                            <label for="userName">User Name</label>
                              <input type="email" class="form-control"
                              id="userName" placeholder="User Name"/>
                          </div>
                          
                        </form>
        					
        					</div>
        
        					<!-- Modal footer -->
        					<div class="modal-footer">
        						<button type="button" class="btn btn-secondary" id="adduser">Add User</button>
        						<button type="button" class="btn btn-secondary" id="edituser">Update User</button>	
        						<button type="button" class="btn btn-secondary"
        							data-dismiss="modal">Close</button>
        					</div>
        				</div>
        			</div>
        		</div>


<div class="modal fade" id="deleteUserForm">
        			<div class="modal-dialog modal-lg">
        				<div class="modal-content" id="manual-device-discovery">
        					<!-- Modal Header -->
        					<div class="modal-header" id="restoremodalhdr">
        						<h5 class="modal-title text-center" id="modalLabelLarge">Delete User</h5>
        						<button type="button" class="close" data-dismiss="modal"
        							aria-label="Close">
        							<span aria-hidden="true">&times;</span>
        						</button>
        					</div>
        					<!-- Modal body -->
        					<div class="modal-body">
        					<div id="status" style="display: none;" class="alert-popup"></div><br/>
        					<form role="form">
        					<input type="hidden" id="userId" value="">
                          <div class="form-group">
                            Are you sure want to delete User - <b><span id="userNameDel"></span></b>
                          </div>
                          
                        </form>
        					
        					</div>
        
        					<!-- Modal footer -->
        					<div class="modal-footer">
        						<button type="button" class="btn btn-secondary" id="deleteuser">Delete User</button>
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
										<?php $users = generic_get_users();?>
										<?php //print '<pre>'; print_r($users);?>
										<table id="manageusers" class="display"
											style="width: 100%">
											<thead>
												<tr>
													<th width="75px">S.No</th>
													<th>User ID</th>
													<th>User Name</th>
													<th>First Name</th>
													<th>Last Name</th>
													<th>Email</th>
													<th>Phone</th>
													<th>Operation</th>
													
												</tr>
											</thead>
											<tbody>
											<?php $i=1; foreach ($users['result'] as $key=>$val){?>
												<tr data-user="<?php echo $val['id'];?>">
												<td><?php echo $i++;?></td>
												<td><?php echo $val['id'];?></td>
												<td><?php echo $val['username'];?></td>
												<td><?php echo $val['fname'];?></td>
												<td><?php echo $val['lname'];?></td>
												<td><?php echo $val['email'];?></td>
												<td><?php echo $val['phone'];?></td>
												<td><button type="button" class="btn btn-secondary edituser">Edit</button>&nbsp;<button type="button" class="btn btn-secondary deleteuser">Delete</button></td>
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

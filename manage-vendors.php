<?php
include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';

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
	<script src="resources/js/managescreen.js?t="
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
					<div id="status" class="alert alert-success"> Vendor Deleted Successfully</div>
					<?php unset($_SESSION['msg']);}?>
<!-- Button trigger modal -->
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addVendorForm">
    Add Vendor
</button>

        <!-- Modal -->
                <!-- The Modal -->
        		<div class="modal fade" id="addVendorForm">
        			<div class="modal-dialog modal-lg">
        				<div class="modal-content" id="manual-device-discovery">
        					<!-- Modal Header -->
        					<div class="modal-header" id="restoremodalhdr">
        						<h5 class="modal-title text-center" id="modalLabelLarge">Add Vendor</h5>
        						<button type="button" class="close" data-dismiss="modal"
        							aria-label="Close">
        							<span aria-hidden="true">&times;</span>
        						</button>
        					</div>
        					<!-- Modal body -->
        					<div class="modal-body">
        					<div id="status" style="display: none;" class="alert-popup"></div><br/>
        					<form role="form">
        					<input type="hidden" id="vendorId" value="">
                          <div class="form-group">
                            <label for="vendorName">Vendor Name</label>
                              <input type="email" class="form-control"
                              id="vendorName" placeholder="Vendor Name"/>
                          </div>
                          
                        </form>
        					
        					</div>
        
        					<!-- Modal footer -->
        					<div class="modal-footer">
        						<button type="button" class="btn btn-secondary" id="addvendor">Add Vendor</button>
        						<button type="button" class="btn btn-secondary" id="editvendor">Update Vendor</button>	
        						<button type="button" class="btn btn-secondary"
        							data-dismiss="modal">Close</button>
        					</div>
        				</div>
        			</div>
        		</div>


<div class="modal fade" id="deleteVendorForm">
        			<div class="modal-dialog modal-lg">
        				<div class="modal-content" id="manual-device-discovery">
        					<!-- Modal Header -->
        					<div class="modal-header" id="restoremodalhdr">
        						<h5 class="modal-title text-center" id="modalLabelLarge">Delete Vendor</h5>
        						<button type="button" class="close" data-dismiss="modal"
        							aria-label="Close">
        							<span aria-hidden="true">&times;</span>
        						</button>
        					</div>
        					<!-- Modal body -->
        					<div class="modal-body">
        					<div id="status" style="display: none;" class="alert-popup"></div><br/>
        					<form role="form">
        					<input type="hidden" id="vendorId" value="">
                          <div class="form-group">
                            Are you sure want to delete Vendor - <b><span id="vendorNameDel"></span></b>
                          </div>
                          
                        </form>
        					
        					</div>
        
        					<!-- Modal footer -->
        					<div class="modal-footer">
        						<button type="button" class="btn btn-secondary" id="deletevendor">Delete Vendor</button>
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
										<?php $vendors = generic_get_vendors();?>
										<?php //print '<pre>'; print_r($vendors);?>
										<table id="managevendors" class="display"
											style="width: 100%">
											<thead>
												<tr>
													<th width="75px">S.No</th>
													<th>Vendor ID</th>
													<th>Vendor Name</th>
													<th>Action</th>
													
												</tr>
											</thead>
											<tbody>
											<?php $i=1; foreach ($vendors['result'] as $key=>$val){?>
												<tr data-vendor="<?php echo $val['id'];?>">
												<td><?php echo $i++;?></td>
												<td><?php echo $val['id'];?></td>
												<td><?php echo $val['vendorName'];?></td>
												<td><button type="button" class="btn btn-secondary editvendor">Edit</button>&nbsp;<button type="button" class="btn btn-secondary deletevendor">Delete</button></td>
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

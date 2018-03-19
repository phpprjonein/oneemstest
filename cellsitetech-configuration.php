<?php
include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';
ini_set('DISPLAY_ERRORS','ON');
// Static variable values set
//echo 'inside the cellsiteconfig';
if (isset($_GET['clear'])) {
    if (strtolower($_GET['clear']) == 'search') {
        unset($_SESSION['search_term']);
    }
}

user_session_check();
check_user_authentication('1'); // cellsite tech type user

$page_title = 'OneEMS';

?>
<!DOCTYPE html>
<html>
<head>
 <?php include("includes.php");  ?>
   <script src="resources/js/cellsitetech_config.js?t=<?php echo date('his'); ?>"></script>

</head>
<body>
	<div class="container-fluid" id="cellsitech-config">
          <?php include ('menu.php'); ?>
        <!-- Content Wrapper. Contains page content -->
		<div class="content">
			<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">Configuration Management</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
                                                                        <?php if($_SESSION['msg'] == 'ss'){ ?>
                                                <div id="main-status"
                                                                                class="alert alert-success">Script File Generated Successfully
                                                                                in Upload Path</div>
                                        <?php }elseif($_SESSION['msg'] == 'dbs'){ ?>
                                                <div id="main-status"
                                                                                class="alert alert-success">Configurations Saved Successfully</div>
                                        <?php }elseif($_SESSION['msg'] == 'fus'){ ?>
                                                <div id="main-status"
                                                                                class="alert alert-success">File Saved Successfully</div>
                                        <?php }elseif($_SESSION['msg'] == 'fae'){ ?>
                                                <div id="main-status"
                                                                                class="alert alert-danger">
                                                                                <strong>Error!</strong> <?php echo $_SESSION['msg-param']['filename']." already exists. "; ?></div>
                                        <?php }elseif($_SESSION['msg'] == 'fe'){ ?>
                                                <div id="main-status"
                                                                                class="alert alert-danger">
                                                                                <strong>Error!</strong> <?php echo $_SESSION['msg-param']['fileerror'];?></div>
                                        <?php }elseif($_SESSION['msg'] == 'fte'){ ?>
                                                <div id="main-status"
                                                                                class="alert alert-danger">
                                                                                <strong>Error!</strong> File MUST be a <b>.txt</b> file!
                                                                        </div>
                                        <?php }elseif($_SESSION['msg'] == 'feps'){ ?>
                                                <div id="main-status"
                                                                                class="alert alert-danger">
                                                                                <strong>Error!</strong> File cannot be larger than 2MB!
                                                                        </div>
                                        <?php }unset($_SESSION['msg']);?>
                                                                        <?php
                                        if(empty($_SESSION['filename'])){
                                             $_SESSION['filename'] = isset($_POST['filename']) ? $_POST['filename']:'';
                                        }
                                        if(empty($_SESSION['filename'])){
                                            $filename = getcwd()."/upload/sampleconfigfile_".$_SESSION['userid'].".txt";
                                            $templname = 'templ_'.generateRandomString();
                                        }else{
                                            $filename = getcwd()."/upload/".$_SESSION['filename'].".txt";
                                            $templname = $_SESSION['filename'];
                                        }
                                        ?>
                                        <div id="upload_status"
                                                                                style="display: none;" class="alert"></div>
                                                                                <?php if(!empty($_SESSION['filename'])): ?>
                                      <div class="col" id="template_info">
                                        <label for="inputRegion">TEMPLATE:</label>
                                        <small><b><span id="filename"><?php echo $_SESSION['filename']; ?></span></b></small>
                                      </div>
                                    <?php endif; ?>


									<div class="row">
										<div class="col-lg-4 tags p-b-2">
                                                                                <form action="cellsite-config-process.php" method="post" id="config_file_uploader" enctype="multipart/form-data">
                                                                                <input type="hidden" name="filename" value="<?php echo $filename;?>" id="upload_filename">
                                                                                <div class="form-group">
                                                            <label for="file">Select a file to upload</label>
                                                            <input type="file"  id="file" name="file">
                                                            <p class="help-block">Please upload <b>.txt</b> files with a maximum size of 2 MB.</p>
                                                                </div>
                                                                <input type="submit" name="action" id="config-submit" class="btn" value="Upload">
                                                                </form>

								</div>
								</div>
									</div>
								</div>
							</div>

</div>
					</div>
				</div>
			</section>
			<!-- /.content -->
		</div>
	</div>
	<!-- container-fluid -->

    </body>
</html>

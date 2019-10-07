<!DOCTYPE html>
<html lang="en">
<head>
   <?php include "includes.php" ?>
  </head>
<body class="hold-transition skin-blue sidebar-mini ownfont">
	<div class="container-fluid">
		<header class="main-header">
			<div class="nav">
				<div class="pull-left box">
					<a class="navbar-brand" href="#"> <img
						src="resources/img/ncmlogo.png" height="24px" alt="NCM Logo" />
					</a>
				</div>
			</div>
			<hr class="border border-danger">
		</header>

		<!-- 12 Oct 17: Added class login-page and oneems logo -->
<div class="col-auto">
			<pre>
			
			
			
			</pre>
			<div class="row logout mt-5 text-center">
				<div
					class="col-sm-2 col-2 logout-left d-flex justify-content-center align-items-center">
					<i class="fa fa-sign-out fa-3x"></i>
				</div>
				<div class="col-sm-10 col-10">
                               <?php  if ($_SESSION['sso_flag'] == 0) { ?>
					<a href="index.php"><h5>User not exist! Please add in Carms API</h5></a>
				<?php }?>
					<p>
						<a href="index.php"><i
							class="fa fa-sign-in fa-lg text-primary"></i> Login</a>
					</p>
				</div>
			</div>
		</div>
		
		
		
		</div>
</body>
</html>

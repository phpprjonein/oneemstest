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
						src="resources/img/verizonlogo.png" height="24px" alt="Verizon Logo" />
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
					<!--<a href="index.php"><h5>User name not Found! Please get registered in CARMS </h5></a>-->
					<h5> User name not Found! Please register through CARMS. </h5>
					<h5> For any issues, Please raise a ticket on clicking the icon located at the bottom of page.</h5>
				<?php }?>
					<p>
 <!--
<a href="https://logindev.ebiz.verizon.com/onesso/login.jsp?TYPE=33554433&REALMOID=06-12035133-bb2a-1020-90b6-85114dc6fbc3&GUID=&SMAUTHREASON=0&METHOD=GET&SMAGENTNAME=$SM$Obk1gdJc3jGvdncG6BVVdHZ%2fQ0Ex627Y2pqBng6CDqNJdPLkjB768sxKLQTIhg%2b0&TARGET=$SM$HTTPS%3a%2f%2foneems-uat%2evh%2evzwnet%2ecom%2f"><h5>CLICK HERE TO LOG OUT</h5></a>
-->
<!--
<a href="https://login.verizon.com/onesso/login.jsp?TYPE=33554433&REALMOID=06-12035133-bb2a-1020-90b6-85114dc6fbc3&GUID=&SMAUTHREASON=0&METHOD=GET&SMAGENTNAME=$SM$uonu4YrCLDv6EqF6yb59tr2UPYs4S8GBgbQOF6U2p7vQHpMU10uLjWXD%2bg4bQRLc&TARGET=$SM$HTTPS%3a%2f%2foneems%2evh%2evzwnet%2ecom%2f"><h5>CLICK HERE TO LOG OUT</h5></a>
-->
<a href="https://login.verizon.com/onesso/login.jsp?TYPE=33554433&REALMOID=06-12035133-bb2a-1020-90b6-85114dc6fbc3&GUID=&SMAUTHREASON=0&METHOD=GET&SMAGENTNAME=$SM$uonu4YrCLDv6EqF6yb59tr2UPYs4S8GBgbQOF6U2p7vQHpMU10uLjWXD%2bg4bQRLc&TARGET=$SM$HTTPS%3a%2f%2foneems%2evh%2evzwnet%2ecom%2f">
<i
							class="fa fa-sign-in fa-lg text-primary"></i> Login</a>
					</p>
				</div>
			</div>
		</div>
		
		
		
		</div>
</body>
</html>

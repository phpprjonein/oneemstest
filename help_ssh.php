<?php
include_once "classes/db2.class.php";
include_once "classes/paginator.class.php";
include_once 'functions.php';

// Static variable values set
if (isset($_GET['clear'])) {
    if (strtolower($_GET['clear']) == 'search') {
        unset($_SESSION['search_term']);
    }
}

user_session_check();
// include_once ('config/session_check_cellsite_tech.php');

$page_title = 'OneEMS';

// page logging
$usertype = (isset($_SESSION['userlevel']) == 1) ? "Cell sitetechnician" : "";
$username = $_SESSION['username'];
$mesg = " User name: $username User type : $usertype Page:  Network Elements Help page Description: User has navigated to the Network Elements help page.";
write_log($mesg);
?>
<!DOCTYPE html>
<html>
<head>
   <?php include_once("includes.php");  ?>
   <script
	src="resources/js/cellsitetech_config.js?t=<?php echo date('his'); ?>"></script>
</head>
<body>
	<div class="container-fluid">
	<?php include_once ('menu.php'); ?>
  <?php
$values = array(
    'Network Elements Help' => '#'
);
echo generate_site_breadcrumb($values);
?>

<!-- Content Wrapper. Contains page content -->
		<div class="content">

<!-- Main content -->
			<section class="content">
				<div class="col-md-12">

<!-- table manipulation row -->
					<div class="form-row align-items-center justify-content-between border"></div>
<!-- /table maniupulation row -->

<!-- help guide content row -->
					<div class="row">

<!-- help guide navigation -->
						<div class="col-md-3 col-sm-12">
							<?php include_once("help-nav.php");  ?>
						</div>
<!-- /help guide navigation -->

<!-- PAM User Guide -->
						<div class="col-md-9 col-sm-12 scrollspy-example" data-spy="scroll" data-target="#navbar-help" data-offset="0">
							<hr class="d-md-none" />
							<h4 id="item-ssh1">PAM USER GUIDE</h4>
                            <p>The OneEMS application allows for user interactions with PAM’s Privileged Session Manager Proxy, otherwise known as ‘SSH Proxy”.</p>
                            <ul>
                                <li>The SSH proxy feature allows use of PAM controlled accounts without accessing the PAM website</li>
                                <li>The proxy can be accessed with any SSH, SCP or SFTP client</li>
                                <li>The proxy service is provided by Linux hosts running a custom SSH configuration
                                    <ul>
                                        <li>Listed under the ‘pamssh.nsiam.vzwnet.com’ DNS name</li>
                                        <li>Accessible from the EDN network</li>
                                    </ul>
                                </li>
                            </ul>
                            <p></p>
							<hr>
                            <h5 id="item-ssh2">Command Line Usage - SSH</h5>
                            <p>Any SSH client can be used to connect with the proxy.  The simplest usage is to call the default SSH client while in any UNIX/Linux session.</p>
                            <p>The necessary parameters are passed in the username specification of the SSH connection attempt, as follows: <b><pre class="text-danger">ssh &lt;YourUsername&gt;@&lt;PAMUserName&lt;@&lt;PAMAddress&gt;@&lt;PAMSSHProxy&gt;</pre></b></p>
                            <p>Where:</p>
                            <ul>
                                <li><b>Your Username</b>: your WIN-VZWNET username</li>
                                <li><b>PAMUserName</b>: The full and exact username from the desired PAM credential.
                                <p class="alert alert-danger"><b class="text-danger">NOTE:</b> You must have requested PAM access via CARM prior to this step so that PAM will recognize yourUserName and let you in. Depending on level of access granted you can use either <b>PAMronlygrp</b> or <b>PAMadmin</b> to log in to the device</p></li>
                                <li><b>PAMAddress</b> : The address from the desired PAM credential, in IPv6 form only.
                                <p class="alert alert-danger"><b class="text-damger">NOTE:</b>  When specifying IPv6 addresses, substitute a hyphen (‘-‘) for  each colon (‘:’).  ‘2001:4888:a26:2017:aa:a::1’ becomes ‘2001-4888-a26-2017-aa-a--1’</p></li>
                                <li><b>PAMSSHProxy</b> = 	The DNS address of the PAM SSH Proxy is <b>pamssh.nsiam.vzwnet.com</b></li>
                            </ul>
                            <p>When prompted for password, enter the password for your WIN-VZWNET credential. For example, for John Smith to connect to the <b class="text-danger">"PAMronlygrp"</b> credential on ‘2001:4888:a26:2017:aa:a::1’,   type:
                                <pre>ssh jsmith@PAMronlygrp@2001-4888-a26-2017-aa-a--1@pamssh.nsiam.vzwnet.com</pre>
                            Using the syntax above, the command can be executed:
                            <pre><b>jsmith@PAMronlygrp@2001-4888-a26-2017-aa-a--1@pamssh.nsiam.vzwnet.com’s;</b></pre> This session is being recorded by NSIAM PAM -STAGING-.  PSMP host is * Using username "PAMronlygrp".</p>
                            <p>password: <b>&lt;enter your WIN-VZWNET password&gt;</b></p>
                            <p class="alert alert-danger">
                                ***************************************************************************
                                <br>
                                <b class="text-danger">NOTICE TO USERS:</b>
                                <br>
                                This is a private computer system and is for authorized use only. Users (authorized or unauthorized) have no explicit or implicit expectation of privacy. Any or all uses of this system and all files on this system may be …. conditions stated in this warning.
                                <br>
                                *****************************************************************************
                                <br>
                                AKROOH20T2A-P-CI-xxxx-01#</b></p>
                            <p>&nbsp;</p>
                            <hr>
                            <!-- <a href="#top" class="border"><b>Back to top</b></a>
                            <hr> -->
                            <h5 id="item-ssh3">SSH Application Usage: PuTTY</h5>
				<ol>
					<li><b>Install PuTTY</b>
						<ol type="a">
							<li>Go to the <a href="https://atyourservice.verizon.com/ays" target="_blank">Verizon At Your Service website</a></li>
							<li>Click on <b>Request Something</b></li>
							<li>Click on <b>Desktop Software</b></li>
							<li>Scroll down to the "Search for software" search field and type "Putty terminal emulator"</li>
							<li>Select the Enterprise Standard version of "PuTTY - Terminal Emulator"</li>
							<li>Click "Submit". Once the software is approved, it will be auto installed on your device.</li>
						</ol>
					</li>
					<li><b>Install WinSCP</b>
						<ol type="a">
							<li>Go to the <a href="https://atyourservice.verizon.com/ays" target="_blank">Verizon At Your Service website</a></li>
							<li>Click on <b>Request Something</b></li>
							<li>Click on <b>Desktop Software</b></li>
							<li>Scroll down to the "Search for software" search field and type "winscp"</li>
							<li>Select the Enterprise Standard version of "WinSCP"</li>
							<li>Click "Submit". Once the software is approved, it will be auto installed on your device.</li>
						</ol>
					</li>
					<li>Click on the Network Elements tab in the main navigation and select a Device List. Then, on the Health Check page, click on a device name. You will get a popup which has a <b>"PuTTY"</b> text link on the right hand side. Click on this link and you will see a PuTTY window that will attempt to log you into the device. Enter your WIN-VZWNET password.
<p></p>
<img src="resources/img/screenshot-putty-ssh-two.png" class="img-fluid" alt="" data-toggle="modal"  data-target="#screenshot-ssh2"><p></p></li>
					<li>If you are denied access, be sure you have properly requested access to this device via CyberArk (aka PAM). Request access via CARMS.</li>
				</ol>


<!--                            <p>This section describes configuration of a PuTTY session using the example shown in Command Line Usage - SSH.</p>
                            <ul>
                                <li>Launch the PuTTY client</li>
                                <li>Set the Host Name to "jsmith@PAMronlygrp@2001-4888-a26-2017-aa-a--1@pamssh.nsiam.vzwnet.com"
                                    <p></p>
                                    <img src="resources/img/screenshot-putty-ssh1.png" class="img-fluid" alt="" data-toggle="modal"  data-target="#screenshot-ssh1">
                                    <p></p>
                                    <span class="font-italic"><b>One EMS Regional Map</b></span>
                                    <p></p></li>
                            </ul>
                            <p>Select Open. This will open a putty window and will prompt you for your WIN-VZWNET password.</p>
                            <img src="resources/img/screenshot-putty-ssh-two.png" class="img-fluid" alt="" data-toggle="modal"  data-target="#screenshot-ssh2">
                            <p></p>
                            <span class="font-italic"><b>One EMS Regional Map</b></span>
                            <p></p>
                            <p>Alternate Method:
                                <br>
                                Open a command prompt window and enter
                                <br>
                                putty jsmith@PAMronlygrp@2001-4888-a26-2017-aa-a--
                                <br>
                                1@pamssh.nsiam.vzwnet.com</p>
                                <p></p>
                                <img src="resources/img/screenshot-putty-ssh-three.png" class="img-fluid" alt="" data-toggle="modal"  data-target="#screenshot-ssh3">
                                <p></p>
                                <span class="font-italic"><b>One EMS Regional Map</b></span>
                                <p></p>
                                <p>This will open up a putty window</p>
                                <img src="resources/img/screenshot-putty-ssh-four.png" class="img-fluid" alt="" data-toggle="modal"  data-target="#screenshot-ssh4">
                                <p></p>
                                <span class="font-italic"><b>One EMS Regional Map</b></span> -->
                                <p></p>
                                <hr>
                                <a href="#top" class="border"><b>Back to top</b></a>
                                <hr>
                                <h5 id="item-ssh4">SSH Application Usage: SecureCRT</h5>
                              <!--  <p>This section describes configuration of a SecureCRT session using the example shown in Command Line Usage - SSH.</p>
                                    <ol type="n">
                                        <li>Launch the SecureCRT client</li>
                                        <li>From the Session Manager window, add a new session
                                            <p></p>
                                            <img src="resources/img/screenshot-putty-ssh-five.png" class="img-fluid" alt="" data-toggle="modal"  data-target="#screenshot-ssh5">
                                            <p></p>
                                            <span class="font-italic"><b>One EMS Regional Map</b></span>
                                            <p></p>
                                        </li>
                                        <li>Select <b>"SSH2"</b> as the Protocol and click <b>"Next"</b>
                                            <p></p>
                                            <img src="resources/img/screenshot-putty-ssh-six.png" class="img-fluid" alt="" data-toggle="modal"  data-target="#screenshot-ssh6">
                                            <p></p>
                                            <span class="font-italic"><b>One EMS Regional Map</b></span>
                                            <p></p>
                                        </li>
                                        <li>Set the ‘Hostname’ to ‘pamssh.nsiam.vzwnet.com
                                            <ol type="a">
                                                <li>This is the actual value to input for any Production PSMP session</li>
                                            </ol>
                                        </li>
                                        <li>Enter &lt;YourUsername&gt;@&lt;PAMUserName&gt;@&lt;PAMAddress&gt; in the ‘Username’ field.  For this example, we entered ‘jsmith@PAMronlygrp@2001-4888-a26-2017-aa-a--1’
                                            <ol type="a">
                                                <li>This is an example only.  Replace all three variables with the appropriate value
                                                    <p></p>
                                                    <img src="resources/img/screenshot-putty-ssh7.png" class="img-fluid" alt="" data-toggle="modal"  data-target="#screenshot-ssh7">
                                                    <p></p>
                                                    <span class="font-italic"><b>One EMS Regional Map</b></span>
                                                    <p></p>
                                                </li>
                                            </ol>
                                        </li>
                                        <li>Click <b>"Next"</b></li>
                                        <li>Set the Session name to ‘pamprvp1@cawciamusa1v.nss.vzwnet.com’
                                            <ol type="a">
                                                <li>This is an example only.  Replace this value with the credential being configured.</li>
                                                <li>The session name can be whatever you choose, of course, but we suggest using the PAM credential name for clarity</li>
                                            </ol>
                                        </li>
                                        <li>Click ‘Finish’ to save the newly defined session</li>
                                        <li>Right click the new session definition and select ‘Properties’</li>
                                        <li>In the ‘Authentication’ section of the properties window, highlight ‘Password’ and click the up arrow located to the right.  Make ‘Password’ the first entry in the list.
                                            <p></p>
                                            <img src="resources/img/screenshot-putty-ssh8.png" class="img-fluid" alt="" data-toggle="modal"  data-target="#screenshot-ssh8">
                                            <p></p>
                                            <span class="font-italic"><b>One EMS Regional Map</b></span>
                                            <p></p>
                                        </li>
                                        <li>Click ‘OK’ to save the changes to the session.</li>
                                        <li>Launch the session to connect</li>
                                    </ol>
                                <p>DO NOT enter or save a password anywhere in the session configuration.  Passwords must be entered at connection time.</p>
								<p>Alternative Method: For newer versions of SecureCRT, use Quick Connect and enter as follows replacing the username and IPv6 with a valid value:
								<br>
								Hostname: <span class="text-danger">pamssh.nsiam.vzwnet.com</span>
								<br>
								Username: jsmith@PAMronlygrp@2001-4888-a26-2017-aa-a--1</p>
								<p></p>
								<img src="resources/img/screenshot-putty-ssh9.png" class="img-fluid" alt="" data-toggle="modal"  data-target="#screenshot-ssh9">
								<p></p>
								<span class="font-italic"><b>One EMS Regional Map</b></span>
								<p></p>
								<p>Click Connect</p>
								<p></p>
								<img src="resources/img/screenshot-putty-ssh10.png" class="img-fluid" alt="" data-toggle="modal"  data-target="#screenshot-ssh10">
								<p></p>
								<span class="font-italic"><b>One EMS Regional Map</b></span> -->
								
<ol>
                                        <li><b>Install SecureCRT</b>
                                                <ol type="a">
                                                        <li>Go to the <a href="https://atyourservice.verizon.com/ays" target="_blank">Verizon At Your Service website</a></li>
                                                        <li>Click on <b>Request Something</b></li>
                                                        <li>Click on <b>Desktop Software</b></li>
                                                        <li>Scroll down to the "Search for software" search field and type "SecureCRT"</li>
                                                        <li>Select the Enterprise Standard version of "SecureCRT"</li>
                                                        <li>Click "Submit". Once the software is approved, it will be auto installed on your device.</li>
                                                </ol>
                                        </li>
                                        <li><b>Make SSH2 default setting for SecureCRT</b>
                                                <ol type="a">
                                                        <li>Open SecureCRT</a></li>
                                                        <li>Go to <b>Options -> Global Options -> Terminal -> Appearance -> Web Browser</b></li>
                                                        <li>Click on <b>Make SecureCRT the Default Application</b>
							<p></p>
							<img src="resources/img/screenshot-putty-ssh-three.png" class="img-fluid" alt="" data-toggle="modal"  data-target="#screenshot-ssh3"><p></p></li>
                                                        <li>Click OK on the popup</li>
                                                        <li>Click OK on the Global Options window</li>
                                                        <li>Close SecureCRT</li>
							<li>Next, go to the Windows menu on the bottom right of your device's screen</li>
							<li>Select <b>Settings -> Apps -> Default Apps</b></li>
							<li>Scroll down to the bottom and click on <b>"Choose default apps by protocol"</b>
							<p></p>
							<img src="resources/img/screenshot-putty-ssh-four.png" class="img-fluid" alt="" data-toggle="modal"  data-target="#screenshot-ssh4"><p></p></li>
							<li>Scroll down to SSH2
							<br />
							<br />
							<p class="alert alert-danger"><b class="text-danger">NOTE:</b> On the right side, if the <b>"SecureCRT Application"</b> is already assigned, then this process is complete.</p></li>
							<li>If it is not assigned, click on <b>"Choose a default"</b> and select <b>"SecureCRT Application"</b>
							<p></p>
							<img src="resources/img/screenshot-putty-ssh-five.png" class="img-fluid" alt="" data-toggle="modal"  data-target="#screenshot-ssh5"><p></p></li>
							<li>Click on the Network Elements tab in the main navigation and select a Device List. Then, on the Health Check page, click on a device name. You will get a popup which has a <b>"SecureCRT"</b> text link on the right hand side. Click on this link and you will see a SecureCRT window that will attempt to log you into the device. Enter your WIN-VZWNET password.
<p></p>
<img src="resources/img/screenshot-putty-ssh-six.png" class="img-fluid" alt="" data-toggle="modal"  data-target="#screenshot-ssh6"><p></p></li>
                                          
                                        </li>
                                        <li>If you are denied access, be sure you have properly requested access to this device via CyberArk (aka PAM). Request access via CARMS.</li>
                                </ol>
							



								<p></p>
								<hr>
								<a href="#top" class="border"><b>Back to top</b></a>
								<hr>
								<div class="row">
									<div class="col-6">
										<a href="help_admin.php" class="border"><b><< PREV: Admin</b></a>
									</div>
									<div class="col-6 text-right">
										<a href="help_faqs.php" class="border"><b>NEXT: FAQs >></b></a>
									</div>
								</div>
							<hr>
						</div>
<!-- /PAM User Guide -->

					</div>
<!-- /help guide content row -->

				</div>
			</section>
<!-- /.content -->

		</div>
	</div>
<!-- container-fluid -->

<!-- image modals -->
	<div class="big-modal">

<!-- modal start -->
		<div class="modal fade show" id="screenshot-ssh1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-putty-ssh1.png" alt="" width="100%">
				</div>
			</div>
        </div>
<!-- modal end -->

<!-- modal start -->
<div class="modal fade show" id="screenshot-ssh2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-putty-ssh-two.png" alt="" width="100%">
				</div>
			</div>
        </div>
<!-- modal end -->

<!-- modal start -->
<div class="modal fade show" id="screenshot-ssh3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-putty-ssh-three.png" alt="" width="100%">
				</div>
			</div>
        </div>
<!-- modal end -->

<!-- modal start -->
<div class="modal fade show" id="screenshot-ssh4" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-putty-ssh-four.png" alt="" width="100%">
				</div>
			</div>
        </div>
<!-- modal end -->

<!-- modal start -->
<div class="modal fade show" id="screenshot-ssh5" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-putty-ssh-five.png" alt="" width="100%">
				</div>
			</div>
        </div>
<!-- modal end -->

<!-- modal start -->
<div class="modal fade show" id="screenshot-ssh6" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-putty-ssh-six.png" alt="" width="100%">
				</div>
			</div>
        </div>
<!-- modal end -->

<!-- modal start -->
<div class="modal fade show" id="screenshot-ssh7" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-putty-ssh7.png" alt="" width="100%">
				</div>
			</div>
        </div>
<!-- modal end -->

<!-- modal start -->
<div class="modal fade show" id="screenshot-ssh8" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-putty-ssh8.png" alt="" width="100%">
				</div>
			</div>
        </div>
<!-- modal end -->

<!-- modal start -->
<div class="modal fade show" id="screenshot-ssh9" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-putty-ssh9.png" alt="" width="100%">
				</div>
			</div>
        </div>
<!-- modal end -->

<!-- modal start -->
<div class="modal fade show" id="screenshot-ssh10" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-putty-ssh10.png" alt="" width="100%">
				</div>
			</div>
        </div>
<!-- modal end -->

	</div>
<!-- /image modals -->

<!-- footer div -->
	<span class="text-muted"><?php include_once ('footer.php'); ?> </span>
<!-- /footer div -->

</body>
</html>

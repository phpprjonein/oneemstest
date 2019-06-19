<header class="main-header">
	<div class="nav top-menu">
		<div class="float-left box logo-box">
			<img src="resources/img/ncmlogo.png" height="24px" alt=" NCM Logo" />
			<h4>OneEMS</h4>
		</div>
    <?php
    if (isset($_SESSION['welcome_username']) && $_SESSION['welcome_username'] != '') {
        ?>

    <div class="float-right box profile-box">
			<ol class="nav navbar-nav text-center">
				<li class="dropdown messages-menu"><b>Welcome </b><span
					class="hidden-xs"><?php echo $_SESSION['welcome_username'];?></span> |
          <?php //if ($_SESSION['sso_flag'] == 0) { ?>
          <a href="logout.php"> <i class="fa fa-power-off"></i> LOGOUT
				</a>
          <?php //}; ?>
        </li>
			</ol>
		</div>
    <?php
    }
    ?>
  </div>
  <!--
  	<h4>SSO LOGIN TIME - [<?php  //echo date('d-M-Y h:i:s', $_SESSION['sso_session_started']); ?>]</h4>
	<h4>INFO SESSION EXPIRY(sso_session_life) SET AS - [<?php //echo date('d-M-Y h:i:s',$_SESSION['sso_session_life']); ?>]</h4>
  !-->	
	<hr class="border border-danger">

	<nav class="navbar navbar-expand-lg navbar-light d-print-none">
		<button class="navbar-toggler" type="button" data-toggle="collapse"
			data-target="#navbarHamburger" aria-controls="navbarHamburger"
			aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarHamburger">
			<div class="navbar-nav float-right text-right pr-3">
				<ul class="nav nav-tabs navbar-nav mr-auto" role="tablist">
          <?php
        if (isset($_SESSION['welcome_username'])) {
            ?>
          <?php if (check_user_authentication(array(8))){ ?>
            <li class="nav-item"><a
						class="nav-link <?php print activemenu("login-impersonate.php"); ?>"
						href="login-impersonate.php">Impersonate User</a></li>
					<li class="nav-item dropdown"><a
						class="nav-link dropdown-toggle  <?php print activemenu(array("golden-scripting.php", "cellsitetech-configuration.php","template-view-modify.php")); ?>"
						href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">Configuration</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="golden-scripting.php">Load Template - Golden</a>
						<a class="dropdown-item" href="template-view-modify.php">View / Modify Template</a>
						</div></li>	
					<li class="nav-item dropdown"><a
						class="nav-link dropdown-toggle  <?php print activemenu(array("os-repository.php","device-upload.php","device-file-upload.php","admin-user-revalidate.php","device-administration.php","manage-users.php","manage-vendors.php")); ?>"
						href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">Maintenance</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="os-repository.php">Device Binary</a>
							 <!-- <a class="dropdown-item" href="device-upload.php">Device Upload</a> -->
							<a class="dropdown-item" href="device-file-upload.php">Binary File Upload</a>
							<a class="dropdown-item" href="device-administration.php">Device Cleanup </a>
							<a class="dropdown-item" href="audit-history-cleanup.php">Audit History Cleanup </a>
                            <a class="dropdown-item" href="manage-users.php">Manage Users </a>
                            <a class="dropdown-item" href="manage-vendors.php">Manage Vendors </a>                          
						</div></li>
          <?php } ?>
          <?php if (check_user_authentication(array(1,3,4))){ ?>
            <li class="nav-item"><a
						class="nav-link <?php print activemenu("cellsitetech-dashboard.php", "cellsitetech-user-devicelist.php"); ?>"
						href="cellsitetech-dashboard.php">Network Elements</a></li>
					<li class="nav-item"><a
						class="nav-link <?php print activemenu("cellsitetech-restorebackup.php"); ?>"
						href="cellsitetech-restorebackup.php">Backup</a></li>
					<li class="nav-item dropdown"><a
						class="nav-link dropdown-toggle  <?php print activemenu(array("modification-scripting.php","generate-pre-script.php", "generate-post-script.php", "batch-page.php", "batch-tracking-devices.php")); ?>"
						href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">Configuration</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="modification-scripting.php">Load Template - Modification</a>
							<!--
						      <a class="dropdown-item" href="generate-pre-script.php">Generate Script </a>
						    -->
							<a class="dropdown-item" href="golden-generate-pre-script.php">Generate
								Script - Golden </a>
							<a class="dropdown-item" href="modification-generate-pre-script.php">Generate
								Script - Modification </a>		
							<!--<a class="dropdown-item" href="cellsitetech-configuration-update.php">Template - View / Modify </a>	-->
							<!-- <a class="dropdown-item" href="batch-page.php">Batch Page </a> -->
							<a class="dropdown-item" href="batch-rerun.php">Script Rerun </a>
							<a class="dropdown-item" href="batch-tracking-devices.php">Batch Tracking </a>
						</div></li>
					<li class="nav-item dropdown"><a
						class="nav-link dropdown-toggle  <?php print activemenu(array("cellsitetech-ip-management.php", "cellsitetech-discovery.php")); ?>"
						href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">Discovery</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="cellsitetech-ip-management.php">Discovery
								IPs</a> <a class="dropdown-item"
								href="cellsitetech-discovery.php">Discovery Results</a>
						</div></li>
					<li class="nav-item dropdown"><a
						class="nav-link dropdown-toggle  <?php print activemenu(array("software-upload-master.php", "software-master.php", "software-upload-devices.php", "reboot.php", "sw-delivery-devices.php", "schedule-backup-new.php", "sw-bootorder-sequence.php")); ?>"
						href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">Maintenance</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<!-- <a class="dropdown-item" href="software-upload-master.php">Software Upload - Master</a> -->
							<!-- <a class="dropdown-item" href=".php">Software Upload</a> -->
							<!--<a class="dropdown-item" href="software-delivery-devices.php">Software Delivery-version Initial</a>
                <a class="dropdown-item" href="software-delivery-devices-new.php">Software Delivery-version final</a>-->
							<a class="dropdown-item" href="sw-delivery-devices.php">Software
								Delivery</a> <a class="dropdown-item" href="reboot.php">Reboot</a>
							<!-- <a class="dropdown-item" href="schedule-backup.php">Schedule Backup</a> -->
							<!-- <a class="dropdown-item" href="sw-bootorder-sequence.php">Boot Order Sequence</a>   -->
							<a class="dropdown-item" href="sw-bootorder-sequence.php">Boot
								Order Sequence</a>
							<!--<a class="dropdown-item" href="config-template-uservar.php"> Configuration Template User Variables </a>-->
						</div></li>
					<li class="nav-item dropdown">
					<a class="nav-link  dropdown-toggle <?php print activemenu(array("ip-instant-health-check.php","cyberark.php","show-tech.php")); ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    	aria-haspopup="true" aria-expanded="false">Tools</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    		<a class="dropdown-item" href="cyberark.php">CyberArk</a> 
                    		<a class="dropdown-item" href="ip-instant-health-check.php">Health Check</a>
                    		<a class="dropdown-item" href="show-tech.php">Show Tech </a>
                    	</div>
					</li>
						
						
						
                    <li class="nav-item dropdown"><a
                    	class="nav-link dropdown-toggle  <?php print activemenu(array("auditing-log.php", "cus-auditing-log.php","audit-history.php")); ?>"
                    	href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    	aria-haspopup="true" aria-expanded="false">Audit</a>
                    	<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    		<a class="dropdown-item" href="auditing-log.php">Compliance</a> 
                    		<a class="dropdown-item" href="cus-auditing-log.php">Customize Audit</a>
                    		<a class="dropdown-item" href="audit-history.php">Customize Audit History</a>
                    	</div>
                    </li>
					<li class="nav-item"><a
						class="nav-link <?php print activemenu(array("software-inventory.php")); ?>"
						href="software-inventory.php">Inventory</a></li>
					<li class="nav-item"><a
						class="nav-link <?php print activemenu(array("help.php", "help_network_elements.php", "help_discovery_ips.php", "help_discovery_results.php", "help_backup.php", "help_config.php", "help_maintenance.php", "help_admin.php", "help_faqs.php")); ?>"
						href="help.php">Help</a></li>
              <?php }elseif(check_user_authentication(array(2,5,6,7,9))){  ?>
                <li class="nav-item"><a
						class="nav-link <?php print activemenu("switchtech-dashboard.php"); ?>"
						href="switchtech-dashboard.php">Network Elements</a></li>
					<li class="nav-item"><a
						class="nav-link <?php print activemenu("switchtech-restorebackup.php"); ?>"
						href="switchtech-restorebackup.php">Backup</a></li>
					<li class="nav-item dropdown"><a
						class="nav-link dropdown-toggle  <?php print activemenu(array("golden-scripting.php", "cellsitetech-configuration.php", "modification-scripting.php","generate-pre-script.php", "batch-tracking-devices.php")); ?>"
						href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">Configuration</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							
							<?php if(check_user_authentication(array(9))){ ?>
								<a class="dropdown-item" href="golden-scripting.php">Load Template - Golden</a>
							<?php } ?>
							
							<a class="dropdown-item" href="modification-scripting.php">Load Template - Modification</a>
							<!--
							<a class="dropdown-item" href="generate-pre-script.php">Generate Script </a>
							-->
							<a class="dropdown-item" href="golden-generate-pre-script.php">Generate
								Script - Golden </a>
							<a class="dropdown-item" href="modification-generate-pre-script.php">Generate
								Script - Modification </a>		
							<!-- <a class="dropdown-item" href="batch-page.php">Batch Page </a> -->
							<a class="dropdown-item" href="batch-rerun.php">Script Rerun </a>
							<a class="dropdown-item" href="batch-tracking-devices.php">Batch Tracking </a>
						</div></li>
					<li class="nav-item dropdown"><a
						class="nav-link dropdown-toggle  <?php print activemenu(array("switchtech-ip-management.php", "switchtech-discovery.php")); ?>"
						href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">Discovery</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="switchtech-ip-management.php">Discovery
								IPs</a> <a class="dropdown-item" href="switchtech-discovery.php">Discovery
								Results</a>
						</div></li>
					<li class="nav-item dropdown"><a
						class="nav-link dropdown-toggle  <?php print activemenu(array("os-repository.php","admin-user-revalidate.php", "software-upload-master.php", "software-master.php", "software-upload-devices.php", "sw-delivery-devices.php", "schedule-backup-new.php", "sw-bootorder-sequence.php")); ?>"
						href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">Maintenance</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							
							
					<?php if(check_user_authentication(array(9))){ ?>
						<a class="dropdown-item" href="os-repository.php">Device Binary</a>
 						<a class="dropdown-item" href="device-file-upload.php">Binary File Upload</a>
					<?php } ?>	
						
                    
						
							<!-- <a class="dropdown-item" href="software-upload-master.php">Software Upload - Master</a> -->
							<!-- <a class="dropdown-item" href=".php">Software Upload</a> -->
							<!--<a class="dropdown-item" href="software-delivery-devices.php">Software Delivery-version Initial</a>
                <a class="dropdown-item" href="software-delivery-devices-new.php">Software Delivery-version final</a>-->
							<a class="dropdown-item" href="sw-delivery-devices.php">Software
								Delivery</a> <a class="dropdown-item" href="reboot.php">Reboot</a>
							<!-- <a class="dropdown-item" href="schedule-backup.php">Schedule Backup</a> -->
							<!-- <a class="dropdown-item" href="sw-bootorder-sequence.php">Boot Order Sequence</a>   -->
							<a class="dropdown-item" href="sw-bootorder-sequence.php">Boot
								Order Sequence</a>
							<!--<a class="dropdown-item" href="config-template-uservar.php"> Configuration Template User Variables </a>-->
						</div></li>
					<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle <?php print activemenu(array("ip-instant-health-check.php","cyberark.php","show-tech.php")); ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    	aria-haspopup="true" aria-expanded="false">Tools</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    		<a class="dropdown-item" href="cyberark.php">CyberArk</a> 
                    		<a class="dropdown-item" href="ip-instant-health-check.php">Health Check</a>
                    		<a class="dropdown-item" href="show-tech.php">Show Tech </a>
                    	</div>
					</li>
					<li class="nav-item dropdown"><a
                    	class="nav-link dropdown-toggle  <?php print activemenu(array("auditing-log.php", "cus-auditing-log.php","audit-history.php")); ?>"
                    	href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    	aria-haspopup="true" aria-expanded="false">Audit</a>
                    	<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    		<a class="dropdown-item" href="auditing-log.php">Compliance</a> 
                    		<a class="dropdown-item" href="cus-auditing-log.php">Customize Audit</a>
                    		<a class="dropdown-item" href="audit-history.php">Customize Audit History</a>
                    	</div>
                    </li>	
					<li class="nav-item"><a
						class="nav-link <?php print activemenu(array("software-inventory.php")); ?>"
						href="software-inventory.php">Inventory</a></li>
					<li class="nav-item"><a
						class="nav-link <?php print activemenu(array("help.php", "help_network_elements.php", "help_discovery_ips.php", "help_discovery_results.php", "help_backup.php", "help_config.php", "help_maintenance.php", "help_admin.php", "help_faqs.php")); ?>"
						href="help.php">Help</a></li>
              <?php } ?>
              <?php  } ?>
        </ul>
			</div>
		</div>
	</nav>
</header>

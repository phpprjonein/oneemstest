s<header class="main-header"> 
  <div class="nav top-menu">
    <div class="float-left box logo-box"><a class="navbar-brand" href="#" >
        <img src="resources/img/ncmlogo.png"  height = "24px"  alt=" NCM Logo"/>
      </a>
    </div>
    <?php 
    if (isset($_SESSION['welcome_username']) && $_SESSION['welcome_username']!= '') { 
    ?>

    <div class="float-right box profile-box">
   
    <ul class="nav navbar-nav">
    
      <li class="dropdown messages-menu">
        <a >
         <b> Welcome </b><span class="hidden-xs"><?php echo $_SESSION['welcome_username'];?></span>
        </a>
      </li> 
      <li class="dropdown messages-menu" onclick="location.href='index.php';">
        <?php if ($_SESSION['sso_flag'] == 0) { ?>
        <a href="logout.php">                      
          <img src="resources/img/logout.jpg"  width="15" alt="Logo"/>
        </a>
       <?php }; ?> 
      </li>
    </ul>
  </div>
  <?php
  }
  ?>
  </div> 

  <hr>

    <div class="breadcrumb" style="border-top:5px solid red;">


    <ul class="nav nav-tabs"  role="tablist">
	<?php 
    if (isset($_SESSION['welcome_username'])) {
    ?>
    <?php if (check_user_authentication(array(1,3,4))){ ?>
		<li  class="nav-item"><a class="nav-link <?php print activemenu("cellsitetech-dashboard.php"); ?>" href="cellsitetech-dashboard.php">Network Elements</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("cellsitetech-discovery.php"); ?>" href="cellsitetech-discovery.php">Discovery Results</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("cellsitetech-ip-management.php"); ?>" href="cellsitetech-ip-management.php">Discovery IPs</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("cellsitetech-restorebackup.php"); ?>" href="cellsitetech-restorebackup.php">Backup</a></li>
    	<!--<li class="nav-item"><a class="nav-link <?php print activemenu("cellsitetech-configuration.php"); ?>" href="cellsitetech-configuration.php">Configuration</a></li> -->
    	<!--<li class="nav-item"><a class="nav-link <?php print activemenu("cellsitetech-scripting.php"); ?>" href="cellsitetech-scripting.php">Scripting</a></li> -->
        <li class="nav-item"><a class="nav-link <?php print activemenu(array("scripting.php","scripting-process.php")); ?>" href="scripting.php">Scripting</a></li>
        <li class="nav-item"><a class="nav-link <?php print activemenu("generate_script1.php"); ?>" href="generate_script1.php">Generate Script</a>
    	<!--<li class="nav-item"><a class="nav-link <?php print activemenu("cellsitetech-compliances.php"); ?>" href="cellsitetech-compliances.php">Compliances</a></li> -->
    	<li class="nav-item"><a class="nav-link <?php print activemenu("help.php"); ?>" href="help.php">Help</a></li>
    <?php }elseif(check_user_authentication(array(2,5,6,7))){  ?>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("switchtech-dashboard.php"); ?>" href="switchtech-dashboard.php">Network Elements</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("switchtech-discovery.php"); ?>" href="switchtech-discovery.php">Discovery Results</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("switchtech-ip-management.php"); ?>" href="switchtech-ip-management.php">Discovery IPs</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("switchtech-restorebackup.php"); ?>" href="switchtech-restorebackup.php">Backup</a></li>
    	<!--<li class="nav-item"><a class="nav-link <?php print activemenu("switchtech-configuration.php"); ?>" href="switchtech-configuration.php">Configuration</a></li>-->
    	<!-- <li class="nav-item"><a class="nav-link <?php print activemenu("switchtech-scripting.php"); ?>" href="switchtech-scripting.php">Scripting</a></li>  -->
        <li class="nav-item"><a class="nav-link <?php print activemenu("scripting.php"); ?>" href="scripting.php">Scripting</a></li>
        <li class="nav-item"><a class="nav-link <?php print activemenu("generate_script1.php"); ?>" href="generate_script1.php">Generate Script</a></li>
<!--<li class="nav-item"><a class="nav-link <?php //print activemenu("switchtech-compliances.php"); ?>" href="switchtech-compliances.php">Compliances</a></li> -->
		<li class="nav-item"><a class="nav-link <?php print activemenu("help.php"); ?>" href="help.php">Help</a></li> 
    <?php } ?>
  <?php  } ?>
    </ul>
    </div>
</header> 

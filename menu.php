<header class="main-header"> 
  <div class="nav top-menu">
    <div class="float-left box logo-box"><a class="navbar-brand" href="#" >
        <img src="resources/img/ncmlogo.png"  height = "24px"  alt=" OneEMS Logo"/>
      </a>
    </div>
    <?php 
    if (isset($_SESSION['welcome_username']) && $_SESSION['welcome_username']!= '') { 
    ?>

    <div class="float-right box profile-box">
   
    <ul class="nav navbar-nav">
    
      <li class="dropdown messages-menu">
        <a >
         <b> Welcome </b><span class="hidden-xs"><?php echo $_SESSION['welcome_username'];?></span;>
        </a>
      </li> 
      <li class="dropdown messages-menu">
        <a href="index.php">                      
          <img src="resources/img/logout.jpg"  width="15" alt="Logo"/>
        </a>
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
    <?php if ($_SESSION['userlevel'] === "1"){ ?>
		<li  class="nav-item"><a class="nav-link <?php print activemenu("cellsitetech-dashboard.php"); ?>" href="cellsitetech-dashboard.php">Network Elements</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("cellsitetech-discovery.php"); ?>" href="cellsitetech-discovery.php">Discovery Results</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("cellsitetech-ip-management.php"); ?>" href="cellsitetech-ip-management.php">Discovery IPs</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("cellsitetech-restorebackup.php"); ?>" href="cellsitetech-restorebackup.php">Backup</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("cellsitetech-configuration.php"); ?>" href="cellsitetech-configuration.php">Scripting</a></li>
    	<!--<li class="nav-item"><a class="nav-link <?php print activemenu("cellsitetech-scripting.php"); ?>" href="cellsitetech-scripting.php">Configuration</a></li>-->
    	<!--<li class="nav-item"><a class="nav-link <?php print activemenu("cellsitetech-compliances.php"); ?>" href="cellsitetech-compliances.php">Compliances</a></li> -->
    	<!-- <li class="nav-item"><a class="nav-link <?php //print activemenu("help.php"); ?>" href="help.php">Help</a></li> -->
    <?php }elseif($_SESSION['userlevel'] === "2"){  ?>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("switchtech-dashboard.php"); ?>" href="switchtech-dashboard.php">Network Elements</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("switchtech-discovery.php"); ?>" href="switchtech-discovery.php">Discovery Results</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("switchtech-ip-management.php"); ?>" href="switchtech-ip-management.php">Discovery IPs</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("switchtech-restorebackup.php"); ?>" href="switchtech-restorebackup.php">Backup</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("switchtech-configuration.php"); ?>" href="switchtech-configuration.php">Scripting</a></li>
<!--    	<li class="nav-item"><a class="nav-link <?php print activemenu("switchtech-scripting.php"); ?>" href="switchtech-scripting.php">Configuration</a></li>-->
<!--<li class="nav-item"><a class="nav-link <?php //print activemenu("switchtech-compliances.php"); ?>" href="switchtech-compliances.php">Compliances</a></li> -->
    	<!--<li class="nav-item"><a class="nav-link <?php //print activemenu("help.php"); ?>" href="help.php">Help</a></li>    -->
    <?php } ?>
  <?php  } ?>
    </ul>
    </div>
</header> 

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
        <a href="login.php">                      
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
		<li  class="nav-item"><a class="nav-link <?php print activemenu("sheet1_cellsitetech_user_devicelist.php"); ?>" href="sheet1_cellsitetech_user_devicelist.php">Dashboard</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("sheet2_cellsitetech_user_devicelist.php"); ?>" href="sheet2_cellsitetech_user_devicelist.php">Discovery</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("sheet3_cellsitetech_user_devicelist.php"); ?>" href="sheet3_cellsitetech_user_devicelist.php">Backup</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("sheet4_cellsitetech_user_devicelist.php"); ?>" href="sheet4_cellsitetech_user_devicelist.php">Configuration</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("sheet5_cellsitetech_user_devicelist.php"); ?>" href="sheet5_cellsitetech_user_devicelist.php">Scripting</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("sheet6_cellsitetech_user_devicelist.php"); ?>" href="sheet6_cellsitetech_user_devicelist.php">Compliances</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("sheet7_cellsitetech_user_devicelist.php"); ?>" href="sheet7_cellsitetech_user_devicelist.php">IP Management</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("sheet8_cellsitetech_user_devicelist.php"); ?>" href="sheet8_cellsitetech_user_devicelist.php">Help</a></li>
    <?php }elseif($_SESSION['userlevel'] === "2"){  ?>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("sheet1_switchtech_user_list.php"); ?>" href="sheet1_switchtech_user_list.php">Dashboard</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("sheet2_switchtech_user_list.php"); ?>" href="sheet2_switchtech_user_list.php">Discovery</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("sheet3_switchtech_user_list.php"); ?>" href="sheet3_switchtech_user_list.php">Backup</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("sheet4_switchtech_user_list.php"); ?>" href="sheet4_switchtech_user_list.php">Configuration</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("sheet5_switchtech_user_list.php"); ?>" href="sheet5_switchtech_user_list.php">Scripting</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("sheet6_switchtech_user_list.php"); ?>" href="sheet6_switchtech_user_list.php">Compliances</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("sheet7_switchtech_user_list.php"); ?>" href="sheet7_switchtech_user_list.php">IP Management</a></li>
    	<li class="nav-item"><a class="nav-link <?php print activemenu("sheet8_switchtech_user_list.php"); ?>" href="sheet8_switchtech_user_list.php">Help</a></li>    
    <?php } ?>
  <?php  } ?>
    </ul>
    </div>
</header> 
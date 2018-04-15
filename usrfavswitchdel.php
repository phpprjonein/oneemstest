<<<<<<< HEAD
<?php
  include "classes/db2.class.php";
  include 'functions.php';
  $userid  = $_POST['userid'];
  $listid  = $_POST['listid'];
  $switchid  = $_POST['switchid'];
  $result = usrfavritelistswdel($userid,$listid,$switchid);
=======
<?php
  include "classes/db2.class.php";
  include 'functions.php';
  $userid  = $_POST['userid'];
  $listid  = $_POST['listid'];
  $switchid  = $_POST['switchid'];
  $result = usrfavritelistswdel($userid,$listid,$switchid);
>>>>>>> f925d24473e59e9234a9eee7f64f09b390f58d46
?>
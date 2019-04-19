
<title><?php echo ($page_title) ? $page_title : 'title' ?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta
	content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
	name="viewport">
<!-- Bootstrap v4.0.0-beta.2 -->
<link rel="stylesheet" type="text/css"
	href="resources/css/bootstrap.css">
<!-- Font Awesome -->
<!-- Ionicons -->
<link rel="stylesheet" type="text/css"
	href="resources/css/ionicons.min.css">
<!-- Datetimepicker -->
<link rel="stylesheet" type="text/css"
	href="resources/css/bootstrap-datetimepicker.min.css">
<!-- datatabels -->
<link rel="stylesheet" type="text/css"
	href="resources/css/jquery.dataTables.css">

<!-- Theme style -->
<!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
<!--<link rel="stylesheet" type="text/css" href="resources/css/content.css"> -->
<link rel="stylesheet" type="text/css"
	href="resources/css/font-awesome.min.css">
<link href="resources/css/jquery-ui.css" rel="stylesheet">
<!-- jQuery 2.2.3-->
<script type="text/javascript" language="javascript"
	src="resources/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript" language="javascript"
	src="resources/js/popper.min.js"></script>

<script type="text/javascript" language="javascript"
	src="resources/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css"
	href="resources/css/datatables.min.css" />
<script type="text/javascript" src="resources/js/datatables.min.js"></script>
<!--  <link rel="stylesheet" href="resources/css/bootstrap-theme.min.css">  -->

<script type="text/javascript" language="javascript"
	src="resources/js/jquery-ui.min.js"></script>

<script type="text/javascript" language="javascript"
	src="resources/js/jquery.session.js"></script>


<!-- Bootstrap 3.3.6 -->
<script type="text/javascript" language="javascript"
	src="resources/js/bootstrap.min.js"></script>

<!-- FastClick -->
<script type="text/javascript" language="javascript"
	src="resources/js/fastclick.js"></script>
<!-- AdminLTE App -->
<script type="text/javascript" language="javascript"
	src="resources/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- DatePicker -->
<script type="text/javascript" language="javascript"
	src="resources/js/moment.js"></script>
<script type="text/javascript" language="javascript"
	src="resources/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" language="javascript"
	src="resources/js/jquery.rwdImageMaps.min.js"></script>
<script src="resources/js/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript"
	src="https://onejira.Verizon.com/s/7c327c63ac96e0e9fc91ad412d9005b8-T/-2ww38y/72014/c7aa29275592192ce069072bdefe4e22/2.0.23/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?locale=en-US&collectorId=10a5834a"></script>
<script type="text/javascript" language="javascript"
	src="resources/js/global.js"></script>
<link rel="stylesheet" type="text/css" href="resources/css/style.css">
<!-- multiselect dropdown script, styling -->
<script src="resources/js/chosen.jquery.js"></script>
<link rel="stylesheet" href="resources/css/chosen.css" class="ref">
<!-- multiselect dropdown script, styling -->

<!-- datepicker styling -->
<link rel="stylesheet" href="resources/css/jquery-ui.css" class="ref">
<!-- datepicker styling -->
<?php global $APPCONFIG;?>
<script type="text/javascript">
  var _paq = _paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//piwik.vh.vzwnet.com/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '<?php echo $APPCONFIG['piwik']['siteid'];?>']);
    _paq.push(['setUserId', '<?php echo $_SESSION['username'];?>']);
    _paq.push(['setMarket', 'marketval']);
    _paq.push(['setManager name', '<?php echo $_SESSION['welcome_username'];?>']);
    _paq.push(['setRole', '<?php echo $_SESSION['role'];?>']);
    _paq.push(['setFullname', '<?php echo $_SESSION['welcome_username'];?>']);
    _paq.push(['setEmail', '<?php echo $_SESSION['email'];?>']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
var IDLE_TIMEOUT = 240; //seconds
var _idleSecondsCounter = 0;

document.onclick = function () {
    _idleSecondsCounter = 0;
};

document.onmousemove = function () {
    _idleSecondsCounter = 0;
};

document.onkeypress = function () {
    _idleSecondsCounter = 0;
};

window.setInterval(CheckIdleTime, 1000);

function CheckIdleTime() {
    _idleSecondsCounter++;
    var oPanel = document.getElementById("SecondsUntilExpire");
    if (oPanel)
        oPanel.innerHTML = (IDLE_TIMEOUT - _idleSecondsCounter) + "";
    if (_idleSecondsCounter >= IDLE_TIMEOUT) {
        //alert("Time expired!");
        //document.location.href = "index.php";
        window.location.reload();
    }
}
</script>
<!-- End Piwik Code -->
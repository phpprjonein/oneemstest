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
$page_title = 'OneEMS';

// page logging
$usertype = (isset($_SESSION['userlevel']) == 1) ? "Cell sitetechnician" : "";
$username = $_SESSION['username'];
$mesg = " User name: $username User type : $usertype Page:  Schedule-backup Settings Description: Cell Site Tech has navigated to the OS Repository Software Upload page.";
write_log($mesg);
$market_list = get_market_list_backup();
?>
<!DOCTYPE html>
<html>
<head>
<title>One Ems</title>
<meta charset="utf-8">
<?php include_once("includes.php");  ?>
<script src="resources/js/schedule-backup.js"> </script>
</head>
<body>
	<div class="container-fluid" id="schedule-backup-devices">
  <?php include_once ('menu.php'); ?>
  <?php
$values = array(
    'Schedule Backup' => '#'
);
echo generate_site_breadcrumb($values);
?>


  <form action="#" method="POST">
			<div class="content">

				<!-- Modal -->
				<div class="modal fade" id="schedbackupModal">
					<div class="modal-dialog">
						<div class="modal-content" id="schedbackupModalContent">

							<!-- Modal Header -->
							<div class="modal-header" id="schedbackupModalhdr">
								<h5 class="modal-title">Message</h5>
								<button type="button" class="close" data-dismiss="modal"
									aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<!-- Modal Header -->

							<!-- Modal body -->
							<div class="modal-body">Scheduled backup Settings saved
								successfully.</div>
							<!-- Modal body -->

							<!-- Modal footer -->
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary"
									data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
				<!-- Modal -->

				<!-- Main content -->
				<section class="content">

					<div class="col-md-12">
						<div id="status" style="display: none;" class="alert"></div>

						<!-- begin dropdown rows -->
						<div class="row">
							<div class="col-sm-12 col-md-4">
								<div class="jf-form">
            	<?php $username = $_SESSION['username'];?>
              <!--<form action="software/html/tags/html_form_tag_action.cfm">-->
									<input type="hidden" id='username'
										value="<?php echo $username; ?>" name="username">

									<!-- select occurrence options -->
									<div class="form-group f1 required" data-fid="f4">
										<label class="control-label" for="f1">Occurrence</label> <select
											id="backup_occur" name="backup_occur"
											class="form-control custom-select" data-rule-required="true">
											<option value="">- Select Occurrence -</option>
											<option value="Week">Week</option>
											<option value="Month">Month</option>
										</select>
									</div>
									<!-- /select occurrence options -->

									<!-- select day options -->
									<div class="form-group f1 required" data-fid="f4">
										<label class="control-label" for="f1">Select Day</label> <select
											id="backup_day" name="backup_day"
											class="form-control custom-select" data-rule-required="true">
											<option value="">- Select Day -</option>
											<option value="Sunday">Sunday</option>
											<option value="Monday">Monday</option>
											<option value="Tuesday">Tuesday</option>
											<option value="Wednesday">Wednesday</option>
											<option value="Thursday">Thursday</option>
											<option value="Friday">Friday</option>
											<option value="Saturday">Saturday</option>
										</select>
									</div>
									<!-- /select day options -->

									<!-- select hour options -->
									<div class="form-group f1 required" data-fid="f4">
										<label class="control-label" for="f1">Select Hour</label> <select
											id="backup_hours" name="vendor"
											class="form-control custom-select" data-rule-required="true">
											<option value="">- Select Hour -</option>
											<option value="00:00">00:00</option>
											<option value="01:00">01:00</option>
											<option value="02:00">02:00</option>
											<option value="03:00">03:00</option>
											<option value="04:00">04:00</option>
											<option value="05:00">05:00</option>
											<option value="06:00">06:00</option>
											<option value="07:00">07:00</option>
											<option value="08:00">08:00</option>
											<option value="09:00">09:00</option>
											<option value="10:00">10:00</option>
											<option value="11:00">11:00</option>
											<option value="12:00">12:00</option>
											<option value="13:00">13:00</option>
											<option value="14:00">14:00</option>
											<option value="15:00">15:00</option>
											<option value="16:00">16:00</option>
											<option value="17:00">17:00</option>
											<option value="18:00">18:00</option>
											<option value="19:00">19:00</option>
											<option value="20:00">20:00</option>
											<option value="21:00">21:00</option>
											<option value="22:00">22:00</option>
											<option value="23:00">23:00</option>
										</select>
									</div>
									<!-- /select hour options -->

									<!-- select minute options -->
									<div class="form-group f1 required" data-fid="f4">
										<label class="control-label" for="f1">Select Minute</label> <select
											id="backup_minutes" name="backup_minutes"
											class="form-control custom-select" data-rule-required="true">
											<option value="">- Select Minute -</option>
											<option value="01">01</option>
											<option value="02">02</option>
											<option value="03">03</option>
											<option value="04">04</option>
											<option value="05">05</option>
											<option value="06">06</option>
											<option value="07">07</option>
											<option value="08">08</option>
											<option value="09">09</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
											<option value="13">13</option>
											<option value="14">14</option>
											<option value="15">15</option>
											<option value="16">16</option>
											<option value="17">17</option>
											<option value="18">18</option>
											<option value="19">19</option>
											<option value="20">20</option>
											<option value="21">21</option>
											<option value="22">22</option>
											<option value="23">23</option>
											<option value="24">24</option>
											<option value="25">25</option>
											<option value="26">26</option>
											<option value="27">27</option>
											<option value="28">28</option>
											<option value="29">29</option>
											<option value="30">30</option>
											<option value="31">31</option>
											<option value="32">32</option>
											<option value="33">33</option>
											<option value="34">34</option>
											<option value="35">35</option>
											<option value="36">36</option>
											<option value="37">37</option>
											<option value="38">38</option>
											<option value="39">39</option>
											<option value="40">40</option>
											<option value="41">41</option>
											<option value="42">42</option>
											<option value="43">43</option>
											<option value="44">44</option>
											<option value="45">45</option>
											<option value="46">46</option>
											<option value="47">47</option>
											<option value="48">48</option>
											<option value="49">49</option>
											<option value="50">50</option>
											<option value="51">51</option>
											<option value="52">52</option>
											<option value="53">53</option>
											<option value="54">54</option>
											<option value="55">55</option>
											<option value="56">56</option>
											<option value="57">57</option>
											<option value="58">58</option>
											<option value="59">59</option>
											<option value="60">60</option>
										</select>
									</div>
									<!-- /select minute options -->

									<!-- select backup type options -->

									<div class="form-group f1 required" data-fid="f4">
										<label class="control-label" for="f1">Select Backup Type</label>
										<select id="schedbackup_type" name="schedbackup_type"
											class="form-control custom-select" data-rule-required="true">
											<option value="">- Select Backup Type -</option>
											<option value="Healthcheck">Healthcheck</option>
											<option value="Configuration">Configuration</option>
										</select>
									</div>
									<!-- /select backup type options -->

									<!-- select time zone -->
									<div class="form-group f1 required" data-fid="f4">
										<label class="control-label" for="f1">Select Time Zone</label>
										<select id="backup_timezone" name="backup_timezone"
											class="form-control custom-select" data-rule-required="true">
											<option value="">- Select Time Zone -</option>
											<option value="UTC 08:00 EST USA & Canada">UTC 08:00 EST USA
												& Canada</option>
										</select>
									</div>
									<!-- /select time zone options -->

									<!-- select market options -->
									<div class="form-group f1 required" data-fid="f4">
										<label class="control-label" for="f1">Select Market</label> <select
											id="backup_market" name="backup_market"
											class="form-control custom-select" data-rule-required="true">
											<option value="">- SELECT Market -</option>
                      <?php foreach ($market_list as $key=>$value) { ?>
                      <option
												value="<?php echo $value['market_name'] ?>"> <?php echo $value['market_name'] ?></option>
                      <?php };?>
                  </select>
									</div>
									<!-- /select market options -->

									<br>
									<button type="button" value="SUBMIT" class="btn text-center"
										id="schedbackup_submit" name="schedbackup_submit">Apply
										Changes</button>
									<p>&nbsp;</p>

								</div>
								<!-- jf form -->

							</div>
							<!-- col-sm-12 col-md-4 -->

						</div>
					</div>
					<!-- dropdown rows -->
					<!-- left side -->

					<!-- right side -->
					<div class="col-sm-12 col-md-8">
						<!-- <h2> Devices List </h2> -->
					</div>
					<!-- right side -->
			
			</div>
		</form>
	</div>
<?php include_once ('footer.php'); ?>
</body>
</html>
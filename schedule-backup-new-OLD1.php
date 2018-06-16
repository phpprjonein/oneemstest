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
$usertype = (isset($_SESSION['userlevel']) == 1 ) ? "Cell sitetechnician" : "";
  $username = $_SESSION['username'];
  $mesg = " User name: $username User type : $usertype Page:  Schedule-backup Settings Description: Cell Site Tech has navigated to the OS Repository Software Upload page.";
  write_log($mesg);
$market_list = get_market_list_backup();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>One Ems</title>
  <meta charset="utf-8">
<?php include_once("includes.php");  ?>
<script src="resources/js/schedule-backup.js"> </script>
</head>
<body> 
<div class="container" style="margin-top:30px" id ="schedule-backup-devices">
<?php include_once ('menu.php'); ?>
<form action="#" method="POST">
  <div class="row">
  <div class="modal fade" id="schedbackupModal">
                <div class="modal-dialog">
                    <div class="modal-content" id="schedbackupModalContent">

<!-- Modal Header -->
                        <div class="modal-header" id="schedbackupModalhdr">
                            <h5 class="modal-title">Message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
<!-- Modal Header -->

<!-- Modal body -->
                        <div class="modal-body"> Scheduled backup Settings saved successfully.</div>
<!-- Modal body -->

<!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
    <div class="col-lg-4">
	<div id="status" style="display: none;" class="alert"></div>
	<?php $username = $_SESSION['username'];?>
 <!--<form action="software/html/tags/html_form_tag_action.cfm">-->
 <input type="hidden" id='username' value="<?php echo $username; ?>" name="username">
<fieldset class="form-group">
<label for="backup_occurs">Occurrence Every </label>
<select class="custom-select" id ="backup_occur" name ="backup_occur"> 
<option selected>Select </option>
<option selected>Week </option>
<option selected>Week </option>
<option selected>Month</option>
</select>
</fieldset>
<fieldset class="form-group">
<label for="backup_day">Day</label>
<select class="custom-select" id ="backup_day" name ="backup_day">
<option selected></option>
<option selected>Sunday </option>
<option selected>Monday </option>
<option selected>Tuesday </option>
<option selected>Wednesday </option>
<option selected>Thursday </option>
<option selected>Friday </option>
<option selected>Saturday</option>
</select>
</fieldset>
<fieldset class="form-group">
<label for="backup_hours">Hours</label>
<select class="custom-select" id ="backup_hours" name ="backup_hours">
<option selected></option>
<option selected>00:00</option>
<option selected>01:00</option>
<option selected>02:00</option>
<option selected>03:00</option>
<option selected>04:00</option>
<option selected>05:00</option>
<option selected>06:00</option>
<option selected>07:00</option>
<option selected>08:00</option>
<option selected>09:00</option>
<option selected>10:00</option>
<option selected>11:00</option>
<option selected>12:00</option>
<option selected>13:00</option>
<option selected>14:00</option>
<option selected>15:00</option>
<option selected>16:00</option>
<option selected>17:00</option>
<option selected>18:00</option>
<option selected>19:00</option>
<option selected>20:00</option>
<option selected>21:00</option>
<option selected>22:00</option>
<option selected>23:00</option>
</select>
</fieldset>
<fieldset class="form-group">
<label for="backup_minutes">Minutes</label>
<select class="custom-select" id ="backup_minutes" name ="backup_minutes">
<option selected></option>
<option selected>01</option>
<option selected>02</option>
<option selected>03</option>
<option selected>04</option>
<option selected>05</option>
<option selected>06</option>
<option selected>08</option>
<option selected>09</option>
<option selected>10</option>
<option selected>11</option>
<option selected>12</option>
<option selected>13</option>
<option selected>14</option>
<option selected>15</option>
<option selected>16</option>
<option selected>17</option>
<option selected>18</option>
<option selected>19</option>
<option selected>20</option>
<option selected>21</option>
<option selected>22</option>
<option selected>23</option>
<option selected>24</option>
<option selected>26</option>
<option selected>27</option>
<option selected>28</option>
<option selected>29</option>
<option selected>30</option>
<option selected>31</option>
<option selected>32</option>
<option selected>33</option>
<option selected>34</option>
<option selected>35</option>
<option selected>36</option>
<option selected>37</option>
<option selected>38</option>
<option selected>39</option>
<option selected>40</option>
<option selected>41</option>
<option selected>42</option>
<option selected>43</option>
<option selected>44</option>
<option selected>45</option>
<option selected>46</option>
<option selected>47</option>
<option selected>48</option>
<option selected>49</option>
<option selected>50</option>
<option selected>51</option>
<option selected>52</option>
<option selected>53</option>
<option selected>54</option>
<option selected>55</option>
<option selected>56</option>
<option selected>57</option>
<option selected>58</option>
<option selected>59</option>
<option selected>60</option>
</select>
</fieldset>
<fieldset class="form-group">
<label for="schedbackup_type">Backup Type</label>
<select class="custom-select" id ="schedbackup_type" name ="schedbackup_type">
<option selected></option>
<option selected>Healthcheck</option>
<option selected>Configuration</option>
</select>
</fieldset>
<fieldset class="form-group">
<label for="backup_timezone">Timezone</label>
<select class="custom-select" id ="backup_timezone" name ="backup_timezone">
<option selected></option>
<option selected>UTC 08:00 EST USA & Canada</option>
</select>
</fieldset>

<fieldset class="form-group">
<label for="backup_market">Market</label>
<select class="form-control custom-select" id="backup_market" name="backup_market">        						
<option selected></option>
<?php foreach ($market_list as $key=>$value) { ?>
<option selected > <?php echo $value['market_name'] ?></option>
<?php };?> 
</select>
</fieldset>							
<button type="button" value="SUBMIT" class="btn btn-default text-center"  id="schedbackup_submit" name="backup-submit">Apply Changes</button>
</div>
    <div class="col-lg-8">
        <!-- <h2> Devices List </h2> -->
  </div>
</div>
</form>
</div> 
<?php include_once ('footer.php'); ?> 
</body>
</html>
<?php
// Filename of log to use when none is given to write_log
define("DEFAULT_LOG","/var/www/html/oneemstest/logs/default.log");
define("UPLOAD_LOG", "/var/www/html/oneemstest/logs/oneems.log");
 
function write_log($message, $logfile='') {
  // Determine log file
  if($logfile == '') {
    // checking if the constant for the log file is defined
    if (defined(DEFAULT_LOG) == TRUE) {
        $logfile = DEFAULT_LOG;
    }
    // the constant is not defined and there is no log file given as input
    else {
        error_log('No log file defined!',0);
        return array(status => false, message => 'No log file defined!');
    }
  }
 
  // Get time of request
  if( ($time = $_SERVER['REQUEST_TIME']) == '') {
    $time = time();
  }
 
  // Get IP address
  if( ($remote_addr = $_SERVER['REMOTE_ADDR']) == '') {
    $remote_addr = "REMOTE_ADDR_UNKNOWN";
  }
 
  // Get requested script
  if( ($request_uri = $_SERVER['REQUEST_URI']) == '') {
    $request_uri = "REQUEST_URI_UNKNOWN";
  }
 
  // Format the date and time
  $date = date("Y-m-d H:i:s", $time);
 
  // Append to the log file
  if($fd = @fopen($logfile, "a")) {
    //$result = fputcsv($fd, array($date, $remote_addr, $request_uri, $message));
    $result = fputcsv($fd, array($date, $remote_addr, $request_uri, $message),'|');
    fclose($fd);
 
    if($result > 0)
      return array(status => true);  
    else
      return array(status => false, message => 'Unable to write to '.$logfile.'!');
  }
  else {
    return array(status => false, message => 'Unable to open log '.$logfile.'!');
  }
}

// Write to default log
$result = write_log("An error occurred that prevented a message from being saved");
 
// Write to another log
$result = write_log("User attempted to send file larger than 2 megabytes", UPLOAD_LOG);
?>

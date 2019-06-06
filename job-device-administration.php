<?php
// load library
require 'classes/php-excel.class.php';
include 'classes/db2.class.php';
include 'functions.php';
ini_set('display_errors',1);

define('ONE_EMS_ROOT', __DIR__);
echo date('d-m-Y');
$resultset = $data = array();
$resultset = load_tab_content('ipcase1');
if (isset($resultset)) {
    // open the file "demosaved.csv" for writing
    $file = fopen(ONE_EMS_ROOT . '/upload/admin/siteid_ipv4_ipv6_same.csv', 'w');
    // save the column headers
    fputcsv($file, array(
            'ID',
            'Device Name',
            'IPv4 Address',
            'IPv6 Address'
    ));
    
    // Sample data. This can be fetched from mysql too
    foreach ($resultset as $key1 => $value1) {
        foreach ($value1 as $key => $value) {
            $data[] = array(
                    $value['id'],
                    $value['devicename'],
                    $value['deviceIpAddr'],
                    $value['deviceIpAddrsix']
            );
            ?>
                           		<?php
        }
    }
    if (!$fp = fopen('php://temp', 'w+')) return FALSE;
    
    // save each row of the data
    foreach ($data as $row) {
        fputcsv($file, $row);
        fputcsv($fp, $row);
    }
    // Close the file
    fclose($file);
    rewind($fp);
    $csvData = stream_get_contents($fp);
    
    
    send_csv_mail($csvData, "Website Report \r\n \r\n siteid_ipv4_ipv6_same", "siteid_ipv4_ipv6_same");
}
$resultset = $data = array();
$resultset = load_tab_content('ipcase2');
if (isset($resultset)) {
    // open the file "demosaved.csv" for writing
    $file = fopen(ONE_EMS_ROOT . '/upload/admin/ipv4_ipv6_same.csv', 'w');
    // save the column headers
    fputcsv($file, array(
            'ID',
            'Device Name',
            'IPv4 Address',
            'IPv6 Address'
    ));
    // Sample data. This can be fetched from mysql too
    foreach ($resultset as $key1 => $value1) {
        foreach ($value1 as $key => $value) {
            $data[] = array(
                    $value['id'],
                    $value['devicename'],
                    $value['deviceIpAddr'],
                    $value['deviceIpAddrsix']
            );
            ?>
                           		<?php
        }
    }
    if (!$fp = fopen('php://temp', 'w+')) return FALSE;
    // save each row of the data
    foreach ($data as $row) {
        fputcsv($file, $row);
        fputcsv($fp, $row);
    }
    // Close the file
    fclose($file);
    rewind($fp);
    $csvData = stream_get_contents($fp);
    send_csv_mail($csvData, "Website Report \r\n \r\n ipv4_ipv6_same", "ipv4_ipv6_same");
    
}

$resultset = $data = array();
$resultset = load_tab_content('ipcase3');
if (isset($resultset)) {
    // open the file "demosaved.csv" for writing
    $file = fopen(ONE_EMS_ROOT . '/upload/admin/siteid_ipv4_or_ipv6_same.csv',
            'w');
    if (!$fp = fopen('php://temp', 'w+')) return FALSE;
    // save the column headers
    fputcsv($file, array(
            'ID',
            'Device Name',
            'IPv4 Address',
            'IPv6 Address'
    ));
    // Sample data. This can be fetched from mysql too
    foreach ($resultset as $key1 => $value1) {
        foreach ($value1 as $key => $value) {
            $data[] = array(
                    $value['id'],
                    $value['devicename'],
                    $value['deviceIpAddr'],
                    $value['deviceIpAddrsix']
            );
            ?>
                           		<?php
        }
    }
    if (!$fp = fopen('php://temp', 'w+')) return FALSE;
    // save each row of the data
    foreach ($data as $row) {
        fputcsv($file, $row);
        fputcsv($fp, $row);
    }
    // Close the file
    fclose($file);
    rewind($fp);
    $csvData = stream_get_contents($fp);
    send_csv_mail($csvData, "Website Report \r\n \r\n siteid_ipv4_or_ipv6_same", "siteid_ipv4_or_ipv6_same");
}
$resultset = $data = array();
$resultset = load_tab_content('ipcase4');
if (isset($resultset)) {
    // open the file "demosaved.csv" for writing
    $file = fopen(ONE_EMS_ROOT . '/upload/admin/ipv4_or_ipv6_same.csv', 'w');
    // save the column headers
    fputcsv($file, array(
            'ID',
            'Device Name',
            'IPv4 Address',
            'IPv6 Address'
    ));
    // Sample data. This can be fetched from mysql too
    foreach ($resultset as $key1 => $value1) {
        foreach ($value1 as $key => $value) {
            $data[] = array(
                    $value['id'],
                    $value['devicename'],
                    $value['deviceIpAddr'],
                    $value['deviceIpAddrsix']
            );
            ?>
                           		<?php
        }
    }
    if (!$fp = fopen('php://temp', 'w+')) return FALSE;
    // save each row of the data
    foreach ($data as $row) {
        fputcsv($file, $row);
        fputcsv($fp, $row);
    }
    // Close the file
    fclose($file);
    rewind($fp);
    $csvData = stream_get_contents($fp);
    send_csv_mail($csvData, "Website Report \r\n \r\n ipv4 or ipv6 same", "ipv4 or ipv6 same");
}

die('Data files generated successfully');


//Email code multiple files

function send_csv_mail($csvData, $body, $subject = 'Website Report', $from = 'noreply@oneems.com') {
    global $APPCONFIG;
    $to = $APPCONFIG['notify']['email'];
    // This will provide plenty adequate entropy
    $multipartSep = '-----'.md5(time()).'-----';
    // Arrays are much more readable
    $headers = array(
    "From: $from",
    "Reply-To: $from",
    "Content-Type: multipart/mixed; boundary=\"$multipartSep\""
    );
    // Make the attachment
    $attachment = chunk_split(base64_encode(($csvData)));
    // Make the body of the message
    $body = "--$multipartSep\r\n"
    . "Content-Type: text/plain; charset=ISO-8859-1; format=flowed\r\n"
    . "Content-Transfer-Encoding: 7bit\r\n"
    . "\r\n"
    . "$body\r\n"
    . "--$multipartSep\r\n"
    . "Content-Type: text/csv\r\n"
            . "Content-Transfer-Encoding: base64\r\n"
        . "Content-Disposition: attachment; filename=\"" .$subject.'_'. date("F-j-Y") . ".csv\"\r\n"
        . "\r\n"
        . "$attachment\r\n"
        . "--$multipartSep--";
        
        // Send the email, return the result
     return @mail($to, $subject, $body, implode("\r\n", $headers));
}

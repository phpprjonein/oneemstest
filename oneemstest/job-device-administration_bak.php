<?php
// load library
require 'classes/php-excel.class.php';
//include 'classes/db2.class.php';
include 'classes/db2.class-emailnfy.php';
include 'functions.php';
ini_set('display_errors',1);

define('ONE_EMS_ROOT', __DIR__);
echo date('d-m-Y');
$resultset = $data = array();
$resultset = load_tab_content('ipcase1');
$head = array(
        'ID',
        'Device Name',
        'IPv4 Address',
        'IPv6 Address',
        'Owner'
);
if (isset($resultset)) {
    // open the file "demosaved.csv" for writing
    $file = fopen(ONE_EMS_ROOT . '/upload/admin/siteid_ipv4_ipv6_same.csv', 'w');
    // save the column headers
    fputcsv($file, array(
            'ID',
            'Device Name',
            'IPv4 Address',
            'IPv6 Address',
            'Owner'
    ));
    $data[] = $head;
    // Sample data. This can be fetched from mysql too
    foreach ($resultset as $key1 => $value1) {
        foreach ($value1 as $key => $value) {
            $data[] = array(
                    $value['id'],
                    $value['devicename'],
                    $value['deviceIpAddr'],
                    $value['deviceIpAddrsix'],
                    $value['csr_site_tech_name']
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
    
    
    //send_csv_mail($csvData, "Device Cleanup \r\n \r\n siteid_ipv4_ipv6_same", "siteid_ipv4_ipv6_same");
    send_csv_mail($csvData, "Hi,\nPls. do refer the below attachment for details. Thanks & Regards....", "Device Cleanup List!! Criteria: Site Id & IPV4 & IPv6 - Same");
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
            'IPv6 Address',
            'Owner'
    ));
    $data[] = $head;
    // Sample data. This can be fetched from mysql too
    foreach ($resultset as $key1 => $value1) {
        foreach ($value1 as $key => $value) {
            $data[] = array(
                    $value['id'],
                    $value['devicename'],
                    $value['deviceIpAddr'],
                    $value['deviceIpAddrsix'],
                    $value['csr_site_tech_name']
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
    //send_csv_mail($csvData, "Device cleanup \r\n \r\n ipv4_ipv6_same", "ipv4_ipv6_same");
    //send_csv_mail($csvData, "Device cleanup \r\n \r\n ipv4_ipv6_same", "ipv4_ipv6_same");
    send_csv_mail($csvData, "Hi,\nPls. do refer the below attachment for details. Thanks & Regards...", " Device Cleanup List!! Criteria: IPv4 & IPv6 - Same");
    
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
            'IPv6 Address',
            'Owner'
    ));
    $data[] = $head;
    // Sample data. This can be fetched from mysql too
    foreach ($resultset as $key1 => $value1) {
        foreach ($value1 as $key => $value) {
            $data[] = array(
                    $value['id'],
                    $value['devicename'],
                    $value['deviceIpAddr'],
                    $value['deviceIpAddrsix'],
                    $value['csr_site_tech_name']
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
    //send_csv_mail($csvData, "Device cleanup \r\n \r\n siteid_ipv4_or_ipv6_same", "siteid_ipv4_or_ipv6_same");
    send_csv_mail($csvData, "Hi,\nPls. do refer the below attachment for details. Thanks & Regards.... \r\n \r\n ", "Device Cleanup List!! Criteria: Site Id & (IPv4 || IPv6 ) - Same");
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
            'IPv6 Address',
            'Owner'
    ));
    $data[] = $head;
    // Sample data. This can be fetched from mysql too
    foreach ($resultset as $key1 => $value1) {
        foreach ($value1 as $key => $value) {
            $data[] = array(
                    $value['id'],
                    $value['devicename'],
                    $value['deviceIpAddr'],
                    $value['deviceIpAddrsix'],
                    $value['csr_site_tech_name']
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
    //send_csv_mail($csvData, "Device cleanup \r\n \r\n ipv4 or ipv6 same", "ipv4 or ipv6 same");
    send_csv_mail($csvData, "Hi,\nPls. do refer the below attachment for details. Thanks & Regards.....\r\n \r\n", " Device Cleanup List!! Criteria: IPv4 || IPv6 - Same");
}

die('Data files generated successfully');


//Email code multiple files

function send_csv_mail($csvData, $body, $subject = 'Device cleanup', $from = 'kesavsr@vzwnet.com') {
    global $APPCONFIG;
    //$to = $APPCONFIG['notify']['email'];     
     $to = 'receiveremailid@gmail.com';
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

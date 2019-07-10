<?php
echo 'inside the testdbconnect file ';
# Fill our vars and run on cli
# $ php -f db-connect-test.php
$dbname = 'oneems';
$dbuser = 'oneems';
$dbpass = '1emsservice#';
//$dbhost = 'njbboemsdd1v';
$dbhost = 'carooemssd1v';
$link = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
mysqli_select_db($link, $dbname) or die("Could not open the db '$dbname'");
$test_query = "SHOW TABLES FROM $dbname";
$result = mysqli_query($link, $test_query);
$tblCnt = 0;
echo '<br>';
//print_r($result);
echo '<br>';
while($tbl = mysqli_fetch_array($result)) {
$tblCnt++;
#echo $tbl[0]."<br />\n";
}
if (!$tblCnt) {
echo "There are no tables<br />\n";
} else {
echo "There are $tblCnt tables<br />\n";
} 
?>

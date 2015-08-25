<?php

$webaddress = $_POST["website"]; // Getting the URL from the index.html
$wrapper = fopen('php://temp', 'r+'); // Opening a wrapper in php 
$ch = curl_init($webaddress);         // Initilizing Curl
curl_setopt($ch, CURLOPT_VERBOSE, true);  
curl_setopt($ch, CURLOPT_STDERR, $wrapper);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch); // Executing Curl & storing Data in result
curl_close($ch); // Closing Curl
$ips = get_curl_remote_ips($wrapper); // Getting remote IPS from the wrapper into the IPS Variable
fclose($wrapper); // Closing Wrapper
echo "<b>IP Address: </b>";
echo end($ips);  // Printing last IP address

function get_curl_remote_ips($fp) 
{
    rewind($fp); // Getting IP Adderss into fp variable
    $str = fread($fp, 8192); // Reading IP address
    $regex = '/\b\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\b/'; // Regular Expression for the Valid IP adress matching
    if (preg_match_all($regex, $str, $matches)) {
        return array_unique($matches[0]);
    } else {
        return false;
    }
}
?>

<?php

function http_header($url) {
    $handle = curl_init($url);
    curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

    // Get the HTML Code in the response
    $response = curl_exec($handle);

    // Checking http code through curl Inbuilt Function
    $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
    curl_close($handle);
    
    return $httpCode;
}
$webaddress = $_POST["website"];
$htmlcode = http_header($webaddress);
echo "<br/><br/>";
echo "<b>HTTP Code: </b> $htmlcode";

?>

<?php

function http_loadtime($url) {
    $handle = curl_init($url);
    curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

    // gtting the Page Contents into Response
    $response = curl_exec($handle);

    // Calculating Loadtime Using Curl Inbuilt Function
    $loadtime = curl_getinfo($handle, CURLINFO_TOTAL_TIME);
    curl_close($handle);
    return $loadtime;
}

$webaddress = $_POST["website"];
$loadtime = http_loadtime($webaddress);
echo "<br/><br/>";
echo "<b>URL Load Time:</b> $loadtime" . " " . "Seconds";
echo "<br/>";

?>

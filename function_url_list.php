<?php

echo "<br/>";
echo "<b>Internal and External Link lists : </b>";
echo "<br/><br/>";


function checkLink($url,$gathered_from) {
    if(filter_var($url, FILTER_VALIDATE_URL)){
                 $position = strpos($url, $gathered_from);

                  if($position !== FALSE)
                  {
                    echo "<b>Internal Link: </b> ";
                    echo "$url";
                    echo "<br/>";
                  }
                  else
                  {
                    echo "<b>External Link : </b> ";
                    echo "$url";
                    echo "<br/>";
                  }
        }
}


$webaddress = $_POST["website"];
$target_url = $webaddress;
$userAgent = 'Googlebot/2.1 (http://www.googlebot.com/bot.html)';

// make the cURL request to $target_url
$ch = curl_init();
curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
curl_setopt($ch, CURLOPT_URL,$target_url);
curl_setopt($ch, CURLOPT_FAILONERROR, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_AUTOREFERER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$html= curl_exec($ch);
if (!$html) {
    echo "<br />cURL error number:" .curl_errno($ch);
    echo "<br />cURL error:" . curl_error($ch);
    exit;
}

// parse the html into a DOMDocument
$dom = new DOMDocument();
@$dom->loadHTML($html);

//grab titles and all the things 

// grab all the on the page
$xpath = new DOMXPath($dom);
$hrefs = $xpath->evaluate("/html/body//a");

for ($i = 0; $i < $hrefs->length; $i++) {
    $href = $hrefs->item($i);
    $url = $href->getAttribute('href');
    checkLink($url,$target_url);
}
?>
<?php

function file_get_contents_curl($url)
{
    $ch = curl_init(); //Initializing Curl

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $data = curl_exec($ch); //Executing CURL Function for getting the data
    curl_close($ch); // Closing Curl

    return $data; // Returning the HTML Page through data
}
$webaddress = $_POST["website"]; //Getting the URL From index.html
$html = file_get_contents_curl($webaddress); // Calling the function 

// Starting of Parsing 
$doc = new DOMDocument(); //creating New Dom Document
@$doc->loadHTML($html); // Loading HTML Source in docs
$nodes = $doc->getElementsByTagName('title'); // getting the attributes of Title Tags 

//Putting Details into a variable
$title = $nodes->item(0)->nodeValue; // Getting title 

$metas = $doc->getElementsByTagName('meta'); //getting Elements with the tags meta
// Seperating meta description and meta keyword  with each other with running a loop.
for ($i = 0; $i < $metas->length; $i++)  
{
    $meta = $metas->item($i);
    if($meta->getAttribute('name') == 'description') //Getting attributes with the Attribute "description"
        $description = $meta->getAttribute('content'); // Loading Content of meta description into a variable
    if($meta->getAttribute('name') == 'keywords') //Getting attributes with the Attribute "keywords" 
        $keywords = $meta->getAttribute('content'); // Loading keyword content into a variable
}

echo "<b>Title:</b> $title". '<br/><br/>'; // Printing The Title
echo "<b>Description:</b> $description". '<br/><br/>'; // Printing The Description
// Checking if any keyword is returned or not if not Print NA
if ($keywords == "")  
{
    echo "<b>Keywords :</b> NA" . '<br/><br/>';
}
else
{
    echo "<b>Keywords: </b> $keywords" . '<br/><br/>';   
}
 
?>
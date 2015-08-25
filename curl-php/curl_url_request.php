<html>
<head>
<style type="text/css">
body {background-color:#d0e4fe;}
h3{color:red;text-align:center;}
p {color:blue;}
</style>
<title> SEO Details of the entered URL  </title>
</head>
<body>

<?php 
$webaddress = $_POST["website"];
echo "<h3> Page details of the URL : $webaddress</h3>";
echo "<br/><br/>";
?>
<?php include("function_title_desc_keyword.php"); ?>
<?php include("function_ipaddress.php"); ?>
<?php include("function_httpcode.php"); ?>
<?php include("function_url_load_time.php"); ?>
<?php include("function_url_list.php"); ?> 

</body>
</html>

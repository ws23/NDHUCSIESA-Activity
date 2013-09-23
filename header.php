<html>
<head>
<meta charset="UTF-8">
<link type="text/css" rel="stylesheet" href="index.css">
<title>東華資工系學會活動系統</title>
</head>
<body>
<p align="center"><input type="button" style="border: 0px; background-color: white; color: blue; font-size: 48pt; font-family: 微軟正黑體;" value="東華資工系學會活動系統" onclick="window.location.href='index.php';"></p>
<!--<a href="index.php"><h1 align="center" style="font-size: 48pt; font-family: 微軟正黑體;">東華資工系學會活動系統</h1></a>-->
<?php
require("connect.php");
if(isset($_POST['activity'])){
	$ID = $_POST['activity'];
	$result = mysql_query("SELECT * FROM `main` WHERE `AID` = {$ID};");
	$row = mysql_fetch_row($result);
	if($row[3]==false)
	        mysql_query("UPDATE `{$row[2]}` SET `money` = true WHERE 1;");

?>

	<form method="post" action="select.php">
		<input type="hidden" name="activity" value="<?php echo $_POST['activity']; ?>">
		<p align="center"><input style="border: 0px; background-color: white; font-size: 30pt; color: blue;" type="submit" value="<?php echo $row[1]; ?>"></p>
	</form>

	
<?php
}
?>
<hr></hr>
<table width="1024" align="center">
<tr><td>

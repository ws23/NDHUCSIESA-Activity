<html>
<head>
<meta charset="UTF-8">
<link type="text/css" rel="stylesheet" href="index.css">
<title>東華資工系學會活動系統</title>
</head>
<body>
<div id="background" style="width: 100%;height: 100%;position: absolute;left: 0px;top: 0px;z-index: -1;">
<img src="../img/bg.jpg" style="width:100%;height:150%" alt=""><br>  
</div>
<p align="center" style="position: absolute; top: 0px; left: 50%;margin-left: -230px;"><input type="button" style="border: 0px; background-color: transparent; color: transparent; font-size: 110pt; font-family: 微軟正黑體;" value="資工系" onclick="window.location.href='index.php?key=ndhucsiesa@gmail.com';"></p>
<p align="center"><img src="../img/logo.png"></p>
<!--<a href="index.php"><h1 align="center" style="font-size: 48pt; font-family: 微軟正黑體;">東華資工系學會活動系統</h1></a>-->
<?php
require_once("../connect.php");
require_once("../log.php");
if(isset($_POST['activity'])){
	$ID = $_POST['activity'];
	$result = mysql_query("SELECT * FROM `main` WHERE `AID` = '{$ID}';");
	$row = mysql_fetch_array($result);
	if($row['money']==false)
	        mysql_query("UPDATE `{$row['TName']}` SET `money` = true WHERE 1;");

?>

	<form method="post" action="select.php">
		<input type="hidden" name="activity" value="<?php echo $_POST['activity']; ?>">
		<p align="center"><input style="border: 0px; background-color: transparent; font-size: 30pt; color: blue;" type="submit" value="<?php echo $row['AName']; ?>"></p>
	</form>
<?php
}
?>
<table width="1024" align="center">
<tr><td>

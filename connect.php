<?php 
	
	$HOST = "127.0.0.1";
	$ID = "";
	$PW = "";
	$DB = "activity";
	
	mysql_connect($HOST, $ID, $PW)
		or die("Error connecting to MySQL: ". mysql_error());
	mysql_query("SET NAMES 'UTF8'");
	mysql_query("USE {$DB}")
		or die("Error connecting to DataBase: ". mysql_error());
	
?>

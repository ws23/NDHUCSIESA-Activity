<?php 
	
	$HOST = "localhost";
	$ID = "root";
	$PW = "yutsu1012";
	$DB = "csiesa";
	
	mysql_connect($HOST, $ID, $PW)
		or die("Error connecting to MySQL: ". mysql_error());
	mysql_query("SET NAMES 'UTF8'");
	mysql_query("USE {$DB}")
		or die("Error connecting to DataBase: ". mysql_error());
	
?>

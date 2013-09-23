

<!--
<html>
<head>
<meta charset="UTF-8">
<link type="text/css" rel="stylesheet" href="index.css">
<title>東華資工抽獎機</title>
</head>
<body>
<form name="index" method="post">
	<input style="width:110px; border:0px;" type="text" name="get" readonly value="抽獎？">
	<input type="submit" value="GO!">
</form>
<?php
	if(isset($_POST['get'])){
		require "pick.php";
	}
?>
</body>
</html>
-->


<form method="post" action="show">
<fieldset>
<?php
	require_once "connect.php";
	$result = mysql_query("SELECT COUNT(*) FROM `csv_db`.`tbl_name` WHERE 1");
	$row = mysql_fetch_row($result);
	$last = $row[0];
	$lucky = rand(1,$last);
	$result = mysql_query("SELECT * FROM `csv_db`.`tbl_name` WHERE ID = {$lucky}");
	$row = mysql_fetch_row($result);
	$Name = $row[2];
	$ID = (string)$row[1];

	$grade = $ID[0];
	$year = $ID[1] . $ID[2];
	if($year[0] == "1"){
		$year = $year . $ID[3];
		$dept = $ID[4] . $ID[5];
		$num = $ID[6] . $ID[7] . $ID[8];
	}
	else{
		$dept = $ID[3] . $ID[4];
		$num = $ID[5] . $ID[6] . $ID[7];
	}
?>
<p><?php echo $grade . $year . $dept . $num . "<br>\n" . $Name;?></p>	
</fieldset>
</form>

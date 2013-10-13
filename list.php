<?php 
require("header.php"); 

	echo '<table>';
	echo '<tr align="center" style="background-color: yellow;"><td width="200px">學號</td><td width="200px">姓名</td><td width="200px">應繳金額</td><td width="200px">繳費與否</td><td width="200px">報到與否</td><td width="200px">中獎與否</td>';
	$result = mysql_query("SELECT `TName` FROM `main` WHERE `AID` = {$_POST['activity']};");
	$TName = mysql_fetch_array($result);
	
	$result = mysql_query("SELECT * FROM `{$TName[0]}` ORDER BY `stuID`;");
	while($row = mysql_fetch_array($result)){
		echo "<tr align=\"center\"><td>{$row['stuID']}</td><td>{$row['stuName']}</td><td>{$row['charge']}</td><td>";
		echo $row['money']?"已繳費":"未繳費";
		echo "</td><td>";
		echo $row['checkIn']?"已報到":"未報到";
		echo "</td><td>";
		echo $row['pickUp']?"有中獎":"沒中獎";
		echo "</td></tr>";
	}
	echo "</table>";

require("footer.php"); 
?>

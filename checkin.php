<?php 
require("header.php"); 
?>

<?php 

if(isset($_POST['activity'])){

	echo '
	<form method="post" name="check">
		<label class="create_label">學號</label>
		<input type="text" class="create_input" name="stuID">
		<input type="hidden" name="activity" value="' . $_POST['activity'] . '">
		<input type="submit" value="報到">
	<form>
	';
}
if(isset($_POST['stuID'])){
	$result = mysql_query("SELECT `TName` FROM `main` WHERE `AID` = '{$_POST['activity']}';");
	$row = mysql_fetch_row($result);
	
	$result = mysql_query("SELECT * FROM `{$row[0]}` WHERE `stuID` = '{$_POST['stuID']}';");
	$row2 = mysql_fetch_row($result);
	
	if($row2[1] != $_POST['stuID'])
		echo "<br>未報名。</br>";
	else if($row2[5]==true)
		echo "<br>已報到。</br>";
	else{
		if($row2[4]==false)
	                echo "<br>未繳費。</br>";
		mysql_query("UPDATE `{$row[0]}` SET `checkIn` = true WHERE `stuID` = '{$_POST['stuID']}';");
		echo "<br>" . $row2[2] . "報到。</br>";
	}
}
require("footer.php"); ?>

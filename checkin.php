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

        echo '<table>';
        echo '<tr align="center" style="background-color: yellow;"><td width="200px">報到</td><td width="200px">學號</td><td width="200px">姓名</td><td width="200px">繳費與否</td><td width="200px">報到與否</td><td width="200px">中獎與否</td>';
        $result = mysql_query("SELECT `TName` FROM `main` WHERE `AID` = {$_POST['activity']};");
        $TName = mysql_fetch_row($result);

        $result = mysql_query("SELECT * FROM `{$TName[0]}` ORDER BY `stuID`;");
        while($row = mysql_fetch_row($result)){
                if($row[5])
                        continue;
                echo '<tr align="center"><td>';
                echo'
                <form method="post">
                        <input type="hidden" name="activity" value="' .  $_POST['activity'] . '">
                        <input type="hidden" name="stuID" value="' . $row[1] . '">
                        <input type="submit" value="報到" style="font-size: 12pt; border: 400;" >                       
                </form>
                ';
                echo "<td>{$row[1]}</td><td>{$row[2]}</td><td>";
                echo $row[4]?"已繳費":"未繳費";
                echo "</td><td>";
                echo $row[5]?"已報到":"未報到";
                echo "</td><td>";
                echo $row[6]?"有中獎":"沒中獎";
                echo "</td></tr>";
        }
        echo "</table>";

require("footer.php"); ?>

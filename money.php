<?php
require("header.php");
?>

<?php

/*if(isset($_POST['activity'])){

        echo '
        <form method="post" name="check">
                <label class="create_label">學號</label>
                <input type="text" class="create_input" name="stuID">
                <input type="hidden" name="activity" value="' . $_POST['activity'] . '">
                <input type="submit" value="繳費">
        <form>
        ';
}*/
if(isset($_POST['stuID'])){
        $result = mysql_query("SELECT `TName` FROM `main` WHERE `AID` = '{$_POST['activity']}';");
        $row = mysql_fetch_array($result);

        $result = mysql_query("SELECT * FROM `{$row['TName']}` WHERE `stuID` = '{$_POST['stuID']}';");
        $row2 = mysql_fetch_array($result);

        if($row2['stuID'] != $_POST['stuID'])
                echo "<br>未報名。</br>";
        else if($row2['money']==true)
                echo "<br>已繳費。</br>";
        else{
                mysql_query("UPDATE `{$row['TName']}` SET `money` = true WHERE `stuID` = '{$_POST['stuID']}';");
		LogBook("{$row['TName']}: {$_POST['stuID']} pay the money.");
		echo "<br>" . $row2['stuName'] . "繳費成功。</br>";
	}
}


        echo '<table>';
        echo '<tr align="center" style="background-color: yellow;"><td width="200px">繳費</td><td width="200px">學號</td><td width="200px">姓名</td><td width="200px">應繳金額</td><td width="200px">繳費與否</td><td width="200px">報到與否</td><td width="200px">中獎與否</td>';
        $result = mysql_query("SELECT `TName` FROM `main` WHERE `AID` = {$_POST['activity']};");
        $TName = mysql_fetch_array($result);

        $result = mysql_query("SELECT * FROM `{$TName['TName']}` ORDER BY `stuID`;");
        while($row = mysql_fetch_array($result)){
		if($row['money'])
			continue;
		echo '<tr align="center"><td>';
		echo'
		<form method="post">
	        <input type="hidden" name="activity" value="' .  $_POST['activity'] . '">
			<input type="hidden" name="stuID" value="' . $row['stuID'] . '">
	        <input type="submit" value="繳費" style="font-size: 12pt; border: 400;" >			
		</form>
		';
                echo "<td>{$row['stuID']}</td><td>{$row['stuName']}</td><td>{$row['charge']}</td><td>";
                echo $row['money']?"已繳費":"<font-color=\"red\">未繳費</font>";
                echo "</td><td>";
                echo $row['checkIn']?"已報到":"<font-color=\"red\">未報到</font>";
                echo "</td><td>";
                echo $row['pickUp']?"有中獎":"沒中獎";
                echo "</td></tr>";
        }
        echo "</table>";


require("footer.php"); ?>

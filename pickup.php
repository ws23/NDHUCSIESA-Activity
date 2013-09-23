<?php require("header.php"); ?>

<form method="post" name="show">
<input style="font-size: 20pt;" type="submit" value="抽吧！">

<?php
if(isset($_POST['picked'])){

	$result = mysql_query("SELECT `TName` FROM `main` WHERE `AID` = '{$_POST['activity']}';");
	$TName = mysql_fetch_row($result);

        $result = mysql_query("SELECT MAX(`ID`) FROM `{$TName[0]}` WHERE 1");
        $row = mysql_fetch_row($result);
        $last = $row[0];
	
	$result = mysql_query("SELECT COUNT(*) FROM `{$TName[0]}` WHERE `pickUp` = false && `checkIn` = true;");
	$unpick = mysql_fetch_row($result);

	if($unpick[0] == 0){
		echo '<p class="pick">所有人都中獎了！</br>恭喜！</p>';
	}
	else{
		do{
	        	$lucky = rand(1,$last);
	        	$result = mysql_query("SELECT * FROM `{$TName[0]}` WHERE ID = {$lucky}");
		        $row = mysql_fetch_row($result);
		}while($row[0] != $lucky || !$row[5] || $row[6]);	
			
	        $Name = $row[2];
        	$ID = (string)$row[1];
		
		mysql_query("UPDATE `{$TName[0]}` SET `pickUp` = true WHERE `ID` = {$lucky};");		

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
<p class="pick"><?php echo $grade . $year . $dept . $num . "<br>\n" . $Name;?></p>

<?php }
} ?>
<input type="hidden" name="activity" value="<?php echo $_POST['activity'] ?>">
<input type="hidden" name="picked" value="true">
</form>


<?php require("footer.php"); ?>

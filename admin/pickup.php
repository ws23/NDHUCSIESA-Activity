<?php require("header.php"); ?>

<form method="post" name="show">
<input style="font-size: 20pt;" type="submit" value="抽吧！">

<?php
if(isset($_POST['picked'])){

	$result = mysql_query("SELECT `TName` FROM `main` WHERE `AID` = '{$_POST['activity']}';");
	$TName = mysql_fetch_array($result);

        $result = mysql_query("SELECT MAX(`ID`) FROM `{$TName['TName']}` WHERE 1");
        $row = mysql_fetch_array($result);
        $last = $row[0];

	$result = mysql_query("SELECT COUNT(*) FROM `{$TName['TName']}` WHERE `pickUp` = false && `checkIn` = true;");
	$unpick = mysql_fetch_array($result);

	if($unpick[0] == 0){
		echo '<p class="pick">所有人都中獎了！</br>恭喜！</p>';
		LogBook("admin/pickup.php", "{$_POST['activity']}: 所有人都中獎了！");
	}
	else{
		do{
	        	$lucky = rand(1,$last);
	        	$result = mysql_query("SELECT * FROM `{$TName['TName']}` WHERE ID = {$lucky}");
		        $row = mysql_fetch_array($result);
		}while($row['ID'] != $lucky || !$row['checkIn'] || $row['pickUp']);	

	        $Name = $row['stuName'];
        	$ID = (string)$row['stuID'];

		mysql_query("UPDATE `{$TName['TName']}` SET `pickUp` = true WHERE `ID` = {$lucky};");		
		LogBook("admin/pickup.php", "{$_POST['activity']}: 抽到 {$ID}(${Name}) ");
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
<p class="pick">
<?php 

ob_start();
$buffer = str_repeat("\0", 4096);

echo $grade . $buffer;
ob_flush();
flush();
sleep(1);
echo $year . $buffer;
ob_flush();
flush();
sleep(1);
echo $dept . $buffer;
ob_flush();
flush();
sleep(2);
echo $num . $buffer;
ob_flush();
flush();
echo "</br>\n" . $Name;

ob_end_flush();

?>
</p>

<?php }
} ?>
<input type="hidden" name="activity" value="<?php echo $_POST['activity'] ?>">
<input type="hidden" name="picked" value="true">
</form>


<?php require("footer.php"); ?>

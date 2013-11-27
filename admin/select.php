<?php 
require("header.php"); 
?>

<form method="post" name="listActivity">
<p style="font-size: 36pt; color: black;">選擇活動：
<select size="1" name="activity" style="font-size: 24pt; width: 300px; height: 50px; align: center;">
<?php
$result = mysql_query("SELECT * from `main` WHERE 1;");
while($row = mysql_fetch_array($result)){
	echo '<option value="' . $row['AID'] . '"';
	if(isset($_POST['activity'])){ 
		if($_POST['activity'] == $row['AID'])	
			echo ' selected ';
	}
	echo '>' . $row['AName'] . '</option>' . "\n";
}
?>
</select>
<input type="submit" value="送出" >
</p>
</form>


<?php 

	if(isset($_POST['activity'])){ 
		if($_POST['activity']=='7'){
			mysql_query("TRUNCATE game_7;");
			$result = mysql_query("SELECT * from `game_2` WHERE 1;");
			while($row = mysql_fetch_array($result)){
				$cmd = "INSERT INTO `game_7` (`stuID`, `stuName`, `signIn`, `money`, `charge`, `checkIn`, `pickup`, `eat`) VALUES('{$row['stuID']}', '{$row['stuName']}',";
				if($row['signIn'])
					$cmd .= "true, ";
				else
					$cmd .= "false, ";
				if($row['money'])
					$cmd .= "true, ";
				else
					$cmd .= "false, ";
				$cmd .= "'{$row['charge']}', ";
				if($row['checkIn'])
					$cmd .= "true, ";
				else
					$cmd .= "false, ";
				$cmd .= "false, ";
				if($row['eat'])
					$cmd .= "true";
				else
					$cmd .= "false";
				$cmd .= ");"; 
				echo $cmd;
				mysql_query($cmd);
			}
		}
?>

<form action="signin.php" method="post"><input type="hidden" name="activity" value="<?php echo $_POST['activity']; ?>"><input type="submit" value="活動報名"></form>
<form action="list.php" method="post"><input type="hidden" name="activity" value="<?php echo $_POST['activity']; ?>"><input type="submit" value="報名狀況"></form>
<form action="money.php" method="post"><input type="hidden" name="activity" value="<?php echo $_POST['activity']; ?>"><input type="submit" value="繳費註記"></form>
<form action="getFood.php" method="post"><input type="hidden" name="activity" value="<?php echo $_POST['activity']; ?>"><input type="submit" value="便當領取" ></form>
<form action="payment.php" method="post"><input type="hidden" name="activity" value="<?php echo $_POST['activity']; ?>"><input type="submit" value="收支狀況"></form>
<form action="checkin.php" method="post"><input type="hidden" name="activity" value="<?php echo $_POST['activity']; ?>"><input type="submit" value="活動報到"></form>
<form action="pickup.php" method="post"><input type="hidden" name="activity" value="<?php echo $_POST['activity']; ?>"><input type="submit" value="抽獎機"></form>
<?php 
}
require("footer.php"); 
?>

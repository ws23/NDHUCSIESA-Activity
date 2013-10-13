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
?>

<form action="signin.php" method="post"><input type="hidden" name="activity" value="<?php echo $_POST['activity']; ?>"><input type="submit" value="活動報名"></form>
<form action="list.php" method="post"><input type="hidden" name="activity" value="<?php echo $_POST['activity']; ?>"><input type="submit" value="報名狀況"></form>
<form action="money.php" method="post"><input type="hidden" name="activity" value="<?php echo $_POST['activity']; ?>"><input type="submit" value="繳費註記"></form>
<form action="checkin.php" method="post"><input type="hidden" name="activity" value="<?php echo $_POST['activity']; ?>"><input type="submit" value="活動報到"></form>
<form action="pickup.php" method="post"><input type="hidden" name="activity" value="<?php echo $_POST['activity']; ?>"><input type="submit" value="抽獎機"></form>
<?php 
}
require("footer.php"); 
?>
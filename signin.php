<?php 
require("header.php"); 


?>

<?php 

if(isset($_POST['activity'])){
	$ID = $_POST['activity'];
	$result = mysql_query("SELECT * from `main` WHERE `AID` = '{$ID}';");
	$row = mysql_fetch_array($result);
	$AName = $row['AName'];
	$TName = $row['TName'];

?>

<form method="post" name="signin">
<label class="create_label" >學號</label>
<input class="create_input" type="text" name="stuID" <?php if(isset($_POST['stuID']) or isset($_POST['stuName'])) echo 'value="' . $_POST['stuID'] . '"'; ?>>
<input type="hidden" name="activity" value="<?php echo $ID; ?>">
<input type="submit" value="報名">
<?php
	if(isset($_POST['stuID'])){
		$stuID = $_POST['stuID'];
		if(isset($_POST['stuName'])){
			$stuName = $_POST['stuName'];
			$command = "INSERT INTO `{$TName}`(`stuID`, `stuName`, `signIn`, `money`, `checkIn`, `pickUp`) VALUES ('{$stuID}','{$stuName}',true,false,false,false);";
			mysql_query($command)
				or die ("<br>Error: " . mysql_error() . "<br>Command: " . $command);
			echo "<br>" . "Thank you, " . $stuName ;
			LogBook("{$TName}: {$stuName} sign in");
		}
		else{
			$stuID = $_POST['stuID'];
			$result = mysql_query("SELECT * from `stuinfo` where `stuID` = '{$stuID}';");
			$row = mysql_fetch_array($result);
			$result = mysql_query("SELECT * from `main` WHERE `TName` = '{$TName}';");
			$AInfo = mysql_fetch_array($result);
			if($row['stuID'] == $stuID){
				$stuName = $row['stuName'];
				if($row['isMember']==true)
					$charge = $AInfo['chargeMember'];
				else
					$charge = $AInfo['charge'];
				$command = "INSERT INTO `{$TName}`(`stuID`, `stuName`, `signIn`, `money`, `charge`, `checkIn`, `pickUp`) VALUES ('{$stuID}','{$stuName}', true, false, {$charge}, false,false);";
				mysql_query($command)
					or die ("<br>Error: " . mysql_error() . "<br>Command: " . $command);
				echo "<br>" . "Thank you, " . $stuName ;
				LogBook("{$TName}: {$stuName} sign in");
			}
			else{
				echo "<br>Error: {$stuID} is not exist in database.</br>\n";
				echo '
					<form method="post" name="expect">
					<label class="create_label" >姓名：</label>
					<input type="text" name="stuName" class="create_input">
					<input type="hidden" name="activity" value="' . $ID . '">
					<input type="hidden" name="stuID" value="' . $stuID . '">
					<input type="submit" value="手動報名">
				';
			}
		}
			
	}
}

require("footer.php"); 
?>

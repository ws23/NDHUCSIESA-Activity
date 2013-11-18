<?php 
require("header.php"); 

?>

<script language="JavaScript">
function chargeOrNot(input){
	if(input=="Yes"){
		document.getElementById('charge').style.display = "block";
	}
	else{
		document.getElementById('charge').style.display = "none";
	}
}

</script>
<form method="post" name="create" >
<label class="create_label">活動名稱 </label><input class="create_input" type="text" name="AName"><br /><br/>
<label class="create_label">費用需求 </label><select name="money" onchange="chargeOrNot(this.value);"><option value="Yes">Yes</option><option value="no">No</option></select><br /><br/>
<div id = "charge">
<label class="create_label">會員繳費金額 </label><input type="text" class="create_input" name="charge_Member"><br /><br/>
<label class="create_label">非會員繳費金額 </label><input type="text" class="create_input" name="charge"><br /><br/>
</div>
<input class="create" type="submit" value="送出"></br>
</form>

<?php
// check the form have data or not
if(isset($_POST['AName'])){
	$AName = $_POST['AName'];
	$TName = $_POST['TName'];
	echo $_POST['money'];
	if($_POST['money']=="Yes")
		$money = "true";
	else
		$money = "false";
	$charge = $_POST['charge'];
	$chargeM = $_POST['charge_Member'];

	// create the acitivity and store the data to database
	$TName = "tmp";
	$command = "INSERT INTO `main`(`AName`, `TName`, `Money`, `charge`, `chargeMember`) VALUES ('{$AName}','{$TName}',{$money}, '{$charge}', '{$chargeM}');";
	mysql_query($command) or die(mysql_error());
	LogBook("Create {$TName}(DB:{$AName})");
	$result = mysql_query("SELECT `AID` FROM `main` WHERE `AName` = '{$AName}';");
	$row = mysql_fetch_array($result) or die(mysql_error());
	$TName = "game_" . $row['AID'];
	mysql_query("UPDATE `main` SET `TName` = '{$TName}' WHERE `AID` = '{$row['AID']}';");
	mysql_query("
	create table " . $TName . 
	"(
	ID int(11) auto_increment NOT NULL, 
	stuID varchar(11) NOT NULL COLLATE utf8_unicode_ci, 
	stuName text NOT NULL COLLATE utf8_unicode_ci, 
	signIn boolean NOT NULL,
	money boolean NOT NULL,
	charge int(11) NOT NULL, 
	checkIn boolean NOT NULL, 
	pickUp boolean NOT NULL, 
	PRIMARY KEY (ID), 
	UNIQUE (stuID)
	) DEFAULT COLLATE utf8_unicode_ci;
	");	
}
?>




<?php
require("footer.php"); 
?>

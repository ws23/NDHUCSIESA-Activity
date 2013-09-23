<?php 
require("header.php"); 

?>

<form method="post" name="create" >
<label class="create_label">活動名稱 </label><input class="create_input" type="text" name="AName"></br>
<label class="create_label">英文名稱 </label><input class="create_input" type="text" name="TName"></br>
<label class="create_label">費用需求 </label><input type="radio" name="money" value="Yes"><label class="create_label">Yes</label><input type="radio" name="money" value="no" checked><label class="create_label">No</label></br>
<input class="create" type="submit" value="送出"></br>
</form>

<?php
// check the form have data or not
if(isset($_POST['AName'])){
	$AName = $_POST['AName'];
	$TName = $_POST['TName'];
	if($_POST['money']=="Yes")
		$money = "true";
	else
		$money = "false";


	// create the acitivity and store the data to database
	mysql_query("INSERT INTO `main`(`AName`, `TName`, `Money`) VALUES ('" . $AName . "','" . $TName . "'," . $money . ");");
	mysql_query("
	create table " . $TName . 
	"(
	ID int(11) auto_increment NOT NULL, 
	stuID varchar(11) NOT NULL COLLATE utf8_unicode_ci, 
	stuName text NOT NULL COLLATE utf8_unicode_ci, 
	signIn boolean NOT NULL,
	money boolean NOT NULL,
	checkIn boolean NOT NULL, 
	pickUp boolean NOT NULL, 
	PRIMARY KEY (ID), 
	UNIQUE (stuID)
	) DEFAULT COLLATE utf8_unicode_ci;
	");
}




require("footer.php"); 
?>
<?php  
if($_GET['key']=='ndhucsiesa@gmail.com'){
require("header.php")
?>
<form name="index" method="post">
	<input type="button" name="create" value="建立新活動" onclick="window.location='create.php';"></br>
	<input type="button" name="select" value="選擇活動" onclick="window.location='select.php';"></br>
</form>
<?php
LogBook("admin/index.php", "進入管理介面");
require("footer.php"); 
}
else{
LogBook("admin/index.php", "未持有正確key進入管理界面");
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL /Activity/admin was not found on this server.</p>
<hr>
<address>Apache/2.2.16 (Debian) Server at csiesa.csie.ndhu.edu.tw Port 80</address>
</body></html>


<?php 
}

?>

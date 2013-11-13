<?php require_once('connect.php');

        $result = mysql_query("SELECT * FROM `memberlist`");
        while($member = mysql_fetch_array($result)){
		echo $member['Name'] . "<br />\n";	
                mysql_query("UPDATE `stuinfo` SET `isMember` = true WHERE `stuinfo`.`stuName` = '{$member['Name']}';") or die(mysql_error());
        }
?>


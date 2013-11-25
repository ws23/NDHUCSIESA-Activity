<?php 
require("header.php"); 
?>

<p style="font-size: 24pt; color: blue; "><a href="index.php">報名狀況</a>&nbsp;&nbsp;&nbsp;<a href="payment.php">收支狀況</a> </p>

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

echo '<table>';
echo '<tr align="center" style="background-color: yellow;"><td width="200px">學號</td><td width="200px">姓名</td><td width="200px">應繳金額</td><td width="200px">繳費與否</td><td width="200px">報到與否</td><td width="200px">中獎與否</td>';
$result = mysql_query("SELECT `TName` FROM `main` WHERE `AID` = {$_POST['activity']};");
$TName = mysql_fetch_array($result);

$result = mysql_query("SELECT * FROM `{$TName['TName']}` ORDER BY `stuID`;");
LogBook("index.php", "List {$_POST['activity']}");
$count = $countPay = $countCheck = $payFree =  0;
while($row = mysql_fetch_array($result)){
        $count ++;
        if($row['charge']==0){
                mysql_query("UPDATE `{$TName['TName']}` SET `money` = true WHERE `stuID` = {$row['stuID']};");
                $row['money'] = true;
		$countPay--;
		$payFree++;
        }
        if($row['money'])
                $countPay++;
        if($row['checkIn'])
                $countCheck++;
        echo "<tr align=\"center\"><td>{$row['stuID']}</td><td>{$row['stuName']}</td><td>{$row['charge']}</td><td>";
        echo $row['money']?"已繳費":"<font color=\"red\">未繳費</font>";
        echo "</td><td>";
        echo $row['checkIn']?"已報到":"<font color=\"red\">未報到</font>";
        echo "</td><td>";
        echo $row['pickUp']?"有中獎":"沒中獎";
        echo "</td></tr>";
}
echo "</table>";
echo "<br><br> 共 {$count} 人報名、{$countPay} 人已繳費、{$payFree} 人免繳費、{$countCheck} 人已報到。<br />\n";

}
require("footer.php"); 
?>

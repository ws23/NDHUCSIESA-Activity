<?php 
require("header.php"); 

echo '<table>';
echo '<tr align="center" style="background-color: yellow;"><td width="200px">學號</td><td width="200px">姓名</td><td width="200px">應繳金額</td><td width="200px">繳費與否</td><td width="200px">報到與否</td><td width="200px">中獎與否</td>';
$result = mysql_query("SELECT `TName`, `charge`, `chargeMember`, `back`, `backMember` FROM `main` WHERE `AID` = {$_POST['activity']};");
$TName = mysql_fetch_array($result);

LogBook("admin/list.php", "觀看 {$_POST['activity']} 報名狀況。");
$result = mysql_query("SELECT * FROM `{$TName['TName']}` ORDER BY `stuID`;");
$count = $countPay = $countCheck = $income = $incomeM = $expenditure = $expenditureM = 0;
while($row = mysql_fetch_array($result)){
	$info = mysql_query("SELECT `isMember` FROM `stuinfo` WHERE `stuID` = '{$row['stuID']}';");
	$isMember = mysql_fetch_array($info);
	if($isMember){
		$incomeM += $TName['chargeMember'];
		$expenditureM += $TName['backMember'];
	}
	else{
		$income += $TName['charge'];
		$expenditure += $TName['back'];
	}
	$count ++;
        if($row['charge']==0){
                mysql_query("UPDATE `{$TName['TName']}` SET `money` = true WHERE `stuID` = {$row['stuID']};");
                $row['money'] = true;
        }
	if($row['money'])
		$countPay++;
	if($row['checkIn'])
		$countCheck++;
}
echo "共 {$count} 人報名、{$countPay} 人已繳費、{$countCheck} 人已報到。<br /><br /><br />\n";
?>
<table align="center" valign="middle">
<tr><th></th><th>收入</th><th>退費</th><th>小計</th></tr>
<tr><td>會員</td><td><?php echo $incomeM; ?></td><td><?php echo $expenditureM; ?></td><td><?php echo $incomeM-$expenditureM; ?></td></tr>
<tr><td>非會員</td><td><?php echo $income; ?></td><td><?php echo $expenditure; ?></td><td><?php echo $income-$expenditure; ?></td></tr>
<tr><td colspan="4">----------------------------------</td></tr>
<tr><td>總計</td><td><?php echo $incomeM+$income; ?></td><td><?php echo $expenditureM+$expenditure; ?></td><td><?php echo $incomeM+$income-$expendtitureM-$expenditure; ?></td></tr>
</table>
<?php
require("footer.php"); 
?>

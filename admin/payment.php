<?php 
require("header.php"); 

if(isset($_POST['activity'])){

$result = mysql_query("SELECT `TName`, `charge`, `chargeMember`, `back`, `backMember` FROM `main` WHERE `AID` = {$_POST['activity']};");
$TName = mysql_fetch_array($result);

LogBook("admin/payment.php", "觀看 {$_POST['activity']} 收支狀況。");
$result = mysql_query("SELECT * FROM `{$TName['TName']}` ORDER BY `stuID`;");
$count = $countPay = $countCheck = $income = $incomeM = $expenditure = $expenditureM = $getM = $get = $payfree = 0;
while($row = mysql_fetch_array($result)){
	$info = mysql_query("SELECT `isMember` FROM `stuinfo` WHERE `stuID` = '{$row['stuID']}';");
	$isMember = mysql_fetch_array($info);
	if($row['charge']==0)
		;
	else if($isMember['isMember']==1){
		$incomeM += $TName['chargeMember'];
		$expenditureM += $TName['backMember'];
		if($row['money'])
			$getM += $TName['chargeMember'];
	}
	else{
		$income += $TName['charge'];
		$expenditure += $TName['back'];
		if($row['money'])
			$get += $TName['charge'];
	}
	$count ++;
        if($row['charge']==0){
                mysql_query("UPDATE `{$TName['TName']}` SET `money` = true WHERE `stuID` = {$row['stuID']};");
                $row['money'] = true;
		$payfree++;	
        }
	else if($row['money'])
		$countPay++;
	if($row['checkIn'])
		$countCheck++;
}
echo "共 {$count} 人報名、{$countPay} 人已繳費、{$payfree} 人免繳費、{$countCheck} 人已報到。<br /><br /><br />\n";
?>
<table align="center" valign="middle" style="font-size: 24pt; ">
<tr><th width="200px"></th><th width="150px">應收</th><th width="150px">實收</th><th width="150px">退費</th><th width="150px">應收小計</th></tr>
<tr align="center"><td>會員</td><td><?php echo $incomeM; ?></td><td><?php echo $getM; ?></td><td><?php echo $expenditureM; ?></td><td><?php echo $incomeM-$expenditureM; ?></td></tr>
<tr align="center"><td>非會員</td><td><?php echo $income; ?></td><td><?php echo $get; ?></td><td><?php echo $expenditure; ?></td><td><?php echo $income-$expenditure; ?></td></tr>
<tr align="center"><td colspan="5">------------------------------------------------------------------------------</td></tr>
<tr align="center"><td>總計</td><td><?php echo $incomeM+$income; ?></td><td><?php echo $get+$getM; ?></td><td><?php echo $expenditureM+$expenditure; ?></td><td><?php echo $incomeM+$income-$expenditureM-$expenditure; ?></td></tr>
</table>
<?php
}
require("footer.php"); 
?>

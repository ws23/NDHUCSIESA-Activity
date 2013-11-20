<?php

       function GetIP(){

                if(!empty($_SERVER["REMOTE_ADDR"])){
                        $ip = $_SERVER["REMOTE_ADDR"];
                }

                if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                        $ips = explode (",", $_SERVER['HTTP_X_FORWARDED_FOR']);  
                        if ($ip) { array_unshift($ips, $ip); $ip=FALSE; }
                        for ($i=0; $i < count($ips); $i++) {
                                if (!eregi ("^(10|172.16|192.168).", $ips[$i])) {
                                        $ip=$ips[$i];
                                        break;
                                }
                        }
                }

                return $ip;
        }


	function LogBook($page, $text){
		$now = date("Y-m-d H:i:s", time());
		$IP = GetIP();
		mysql_query("INSERT INTO `log` (`logTime`, `page`, `message`, `IP`) VALUES('{$now}', '{$page}', '{$text}', '{$IP}');");
	}
	
?>

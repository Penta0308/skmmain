<?php
	$sshSession = ssh2_connect('localhost', 22);
	if (ssh2_auth_password($sshSession, 'file', 'penta0308')) {
		$tdata = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n<openttd>\n";
//		$tdata .= str_replace("@cmd", "server_info", rconsend($sshSession, "server_info"));
		$tdata .= str_replace("@cmd", "companies", rconsend($sshSession, "companies"));
		$tdata .= str_replace("@cmd", "status", rconsend($sshSession, "status"));
		$tdata .= "<command>server_info</command>\n<result cmd=\"server_info\">" . rawsend($sshSession, "/home/file/libottdadmin2-master/build/scripts-2.7/openttd-admin-test-json.py -H localhost -p skm /home/file/libottdadmin2-master/build/scripts-2.7/getcmd.json") . "</result>";
		$tdata .= "</openttd>";
		$fname = "/var/www/html/game/serverstatus/ottdstate-" . time() . ".xml";
		$fhandle = fopen($fname, "w");
		fwrite($fhandle, $tdata);
		fclose($fhandle);
	} else {
		die('Authentication Failed...');
	}
	function rconsend($sshSession, $text) {
		$sshStream = ssh2_shell($sshSession, 'vt102', null, 80, 120, SSH2_TERM_UNIT_CHARS);
		$sbuf="";
		do{
			$sbuf = $sbuf . fgetc($sshStream);
		}while(strpos($sbuf, "$") === false);
		fwrite($sshStream, "/home/file/libottdadmin2-master/build/scripts-2.7/openttd-admin-rcon.py -H localhost -p skm \"" . $text . "\"" . PHP_EOL);
		fflush($sshStream);
		$buf="";
		do{
			$buf = $buf . fgetc($sshStream);
		}while(strpos($buf, "<<<") === false);
		$buf = substr($buf, 0, -3);
		do{
			$sbuf = fgetc($sshStream);
		}while(strpos($sbuf, "$") === false);
		fclose($sshStream);
		return substr($buf, strpos($buf, $text) + strlen($text) + 1);
	}
	function rawsend($sshSession, $text) {
		$sshStream = ssh2_shell($sshSession, 'vt102', null, 80, 120, SSH2_TERM_UNIT_CHARS);
		$sbuf="";
		do{
			$sbuf = $sbuf . fgetc($sshStream);
		}while(strpos($sbuf, "$") === false);
		fwrite($sshStream, $text . PHP_EOL);
		fflush($sshStream);
		$buf="";
		do{
			$buf = $buf . fgetc($sshStream);
		}while(strpos($buf, "$") === false);
		$buf = substr($buf, 5, -16);
		fclose($sshStream);
		$buf = trim(str_replace("\"", "", $buf));
		return substr($buf, strpos($buf, $text) + strlen($text) + 1);
	}
?>

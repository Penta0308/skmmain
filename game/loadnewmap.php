	<?php
		$sshSession = ssh2_connect('localhost', 22);
		if (ssh2_auth_password($sshSession, 'root', '-1Gfq11n.]7.,LuH')) {
			echo "Authentication Successful!<br>";
			$sshStream = ssh2_shell($sshSession, 'vt102', null, 80, 24, SSH2_TERM_UNIT_CHARS);
			do{
				$b1 = fgetc($sshStream);
				if($b1 == "\r") echo "<br>"; else echo $b1;
			}while(strcmp($b1, "#") != 0);
			fwrite($sshStream, "screen -x OpenTTD" . PHP_EOL);
			sleep(1);
			fwrite($sshStream, "exit" . PHP_EOL);
			echo "sent exit command";
			do{
				$b1 = fgetc($sshStream);
				if($b1 == "\r") echo "<br>"; else echo $b1;
			}while(strcmp($b1, "#") != 0);
			$dir = "/var/www/html/page/map";
			if( strcmp($_GET['map'], "random" == 0)){
				fwrite($sshStream, "./openttd -D" . PHP_EOL);
			}else{
				fwrite($sshStream, "./openttd -D -g " . $dir . $_GET['map'] . PHP_EOL);
			}
			$buf="";
			$bc="";
			do{
				$bc = fgetc($sshStream);
				$buf .= $bc;
				if($bc == "\r") echo "<br>"; else echo $bc;
				if(strpos($bc, "ERROR") !== false) {
					echo "<br><h1>error... give talk to MEGA...</h1><br>\r";
					//die("error... give talk to MEGA...");
				}
				if(strcmp($bc, "#") == 0) {
					echo "<br><h1>error... give talk to MEGA...<br>I think that you used wrong map.</h1><br>\r";
					//die("error... give talk to MEGA...");
				}
			}while(strpos($buf, "incoming server queries") === false && strpos($buf, "#") === false );
			echo "<br><h1>resetted</h1><br>\r";
			fclose($sshStream);
			return;
		} else {
			die('Authentication Failed...');
		}
	?>
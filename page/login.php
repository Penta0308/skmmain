<!doctype html>
<html>
 
<!-- Mirrored from tcafe-server.kro.kr/game/status by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 11 Nov 2018 07:18:51 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="utf-8">
</head>
 
<body>
	<image src="/assets/image/loading34.gif"></image>
	<?php
		if(strpos($_POST['id'], "'") !== false)
		{
			echo "<script>
			window.location.replace('/page/manpage.php');
			</script>";
		}
		$FilePath	="/var/sqlite/user.db";
		$db			=new SQLite3($FilePath);
		$results 	= $db->query("SELECT pw FROM user WHERE id='".$_POST['id']."'");
		if(empty($results)){
			echo "<script>
			window.location.replace('/page/manpage.php');
			</script>";
		}
		while ($row = $results->fetchArray()) {
			if(strcmp($row[0], $_POST['pw'])==0){
				echo "<script>
				window.location.replace('/page/manpage.php?id=".$_POST['id']."');
				</script>";
			}else{
				echo "<script>
				window.location.replace('/page/manpage.php');
				</script>";
			}
		}
	?>
	</body>
</html>

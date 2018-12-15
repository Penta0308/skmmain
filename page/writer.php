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
		$FilePath	= "/var/sqlite/text.db";
		$db			= new SQLite3($FilePath);
		$idresults	= $db->query("SELECT * FROM text ORDER BY id DESC LIMIT 1");
		$id			= $idresults->fetchArray()[0];
		$id=$id+1;
		$q			= "INSERT INTO text VALUES ('".$id."', '".$_POST['title']."', '".date("Y-m-d H:i")."', '".$_POST['data']."', '".$_POST['writer']."')";
		$db->query($q);
	?>
	<script>
		 window.location.replace('/page/text.php');
	</script>
</body>
</html>
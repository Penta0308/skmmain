<!doctype html>
<html>

<!-- Mirrored from tcafe-server.kro.kr/game/status by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 11 Nov 2018 07:18:51 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="utf-8">
	<title>SKM OpenTTD Service</title>
	<link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/skm.css">
	<script src="../assets/script/jquery-3.3.1.min.js"></script>
	<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
	<div id="wrapper">
		<div class="header">
			<h1 class="skmLogo container"><a href="../index.php"><img src="../assets/image/logo.png" alt="skm"></a></h1>
			<script src="../page/titlebar.js"></script>
		</div>		<div class="container content">
			<div class="subtitle">
				<p class="text-pagetitle">서버공지</p>
			</div>
			<div class="clearfix"></div>
			<table>
			<?php
			//phpinfo();
			
			$FilePath	="/var/sqlite/text.db";
			$db			=new SQLite3($FilePath);
			$results 	= $db->query("SELECT * FROM text ORDER BY id DESC LIMIT 20");
			while ($row = $results->fetchArray()) {
			?>
				<tr>
					<td class="chartnum">
						<?php echo $row[0]; ?>
					</td>
					<td class="charttitle">
						<a href="textview.php?id=
						<?php echo $row[0]; ?>
						">
						<?php
							echo $row[1];
						?>
						</a>
					</td>
					<td class="chartdate">
						<?php echo $row[2]; ?>
					</td>
					<td class="charttitle">
						<?php
							$printstr = explode("\n", mb_substr($row[3], 0, 40));
							echo $printstr[0];
							if(mb_strlen($printstr[0])>40) {
								echo "...";
							}
						?>
					</td>
					<td class="chartwriter">
						<?php echo $row[4]; ?>
					</td>
				</tr>
			<?php } ?>
			</table>
			<div>
			</div>
			<br /><br/>
			<div class="clearfix"></div>
		</div>
		<div class="footer">
			<div class="container text-center">
				<copyright>2018 skmserver.tk</copyright>
			</div>
		</div>
	</div>
</body>

<!-- Mirrored from tcafe-server.kro.kr/game/status by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 11 Nov 2018 07:18:52 GMT -->
</html>

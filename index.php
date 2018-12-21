<!doctype html>
<html>

<!-- Mirrored from tcafe-server.kro.kr/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 11 Nov 2018 07:18:36 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="utf-8">
	<title>SKM OpenTTD Service</title>
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/skm.css">
	<link rel="stylesheet" href="assets/vendor/flexslider/flexslider.css">
	<script src="assets/script/jquery-3.3.1.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/script/modernizr-custom.js"></script>
	<script src="assets/vendor/bxslider/jquery.bxslider.min.js"></script>
	<script src="assets/vendor/flexslider/jquery.flexslider-min.js"></script>
	
</head>

<body>
	<script>
		if(!Modernizr.svg) {
			alert("이 브라우저는 SVG 이미지를 지원하지 않습니다. This browser does NOT support SVG images.");
		}
		if(!Modernizr.inlinesvg) {
			alert("이 브라우저는 인라인 SVG 이미지를 지원하지 않습니다. This browser does NOT support INLINE SVG images.");
		}
		
   
	</script>
	<div id="wrapper">
		<div class="header">
			<h1 class="skmLogo container"><a href="index.php"><img src="assets/image/logo.png" alt="skm"></a></h1>
			<script src="page/titlebar.js"></script>
		</div>		<ul class="main_banner">
			<li>
				<script>
					$(document).ready(function(){
						$('.flexslider').flexslider({
							selector: ".slideimages > li"
						});
					});
				</script>
				<div class="flexslider">
					<ul class="slideimages">
						<li><img src="assets/image/main_banner2.png" title="플레이 화면"/></li>
						<li><img src="assets/image/logo.png" title="서버 로고"/></li>
					</ul>
				</div>
			</li>
		</ul>
		<div class="container content">
			<div class="latest-skin">
				<div class="item-header">
					<span class="text-title">서버짤막안내</span>
					<span class="btn-more"><a href="/page/text.php">+</a></span>
				</div>
				<div class="clearfix"></div>
				<ul>
					<?php
			//phpinfo();
			
						$FilePath	="/var/sqlite/text.db";
						$db			=new SQLite3($FilePath);
						$results 	= $db->query("SELECT * FROM text ORDER BY id DESC LIMIT 3");
						while ($row = $results->fetchArray()) {
						echo "<li><a href=\"/page/textview.php?id=";
						echo $row[0];
						echo "\">";
						echo mb_substr($row[1], 0, 40);
						if(mb_strlen($row[1])>40) {
							echo "...";
						}
						echo "</a><span class=\"notice-date\">";
						echo $row[2];
						echo "</span></li>";
					} ?>
				</ul>
			</div>
			<div class="quick">
				<div class="item-header">
					<span class="text-title">바로가기</span>
				</div>
				<div class="clearfix"></div>
				<ul class="quickmenu">
					<li><img src="assets/image/Openttdlogo.svg"><a href="/assets/OpenTTDInstaller_25.2.1.msi">OpenTTD<br/>다운로드</a></li>
					<li><img src="assets/image/talklogo.svg"><a href="https://open.kakao.com/o/gwid9bZ"><br/>오픈채팅방</a></li>
					<li><img src="assets/image/ss.svg"><a href="game/status.html"><br/>서버<br/>운영상황</a></li>
				</ul>
			</div>
		</div>
		<div class="footer">
			<div class="container text-center">
				<copyright>2018 skmserver.tk</copyright>
			</div>
		</div>
	</div>
</body>

<!-- Mirrored from tcafe-server.kro.kr/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 11 Nov 2018 07:18:48 GMT -->
</html>

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
	<script src="../assets/vendor/ajax/jquery.form.min.js"></script>
</head>

<body>
	<div id="wrapper">
		<div class="header">
			<h1 class="skmLogo container"><a href="/index.php"><img src="../assets/image/logo.png" alt="skm"></a></h1>
			<script src="../page/titlebar.js"></script>
		</div>		<div class="container content">
		<div class="subtitle">
				<p class="text-pagetitle">관리자 페이지</p>
		</div>
		<div class="clearfix"></div>
			<?php
			if(!array_key_exists('id', $_GET)){
				echo <<<logintext
				<div>
					<h3 class="statusTitle">로그인</h3>
				</div>
				<div>
					<form action="/page/login.php" method="post">
						<div class="loginfrm">
							<label for="id" class="loginlabel">ID:</label>
							<input type="text" id="id" name="id" />
						</div>
						<div class="loginfrm">
							<label for="pw" class="loginlabel">Password:</label>
							<input type="password" id="pw" name="pw"/>
						</div>
						<div class="loginfrm">
							<input class="btn-more sbtn" width="160px" type="submit" value="로그인" />
						</div>
					</form>
				</div>
logintext;
			}else{
				?>
				<script>
				function showonly(ident) {
					$('.extendable').not(ident).slideUp();
					$(ident).slideDown();
				}
				function removeTags(string, array){
					return array ? string.split("<").filter(function(val){ return f(array, val); }).map(function(val){ return f(array, val); }).join("") : string.split("<").map(function(d){ return d.split(">").pop(); }).join("");
					function f(array, value){
						return array.map(function(d){ return value.includes(d + ">"); }).indexOf(true) != -1 ? "<" + value : value.split(">")[1];
					}
				}				
				$(function(){
					$('.extendable').hide();
					$('.infowrite').show();
					$('.infowritespan').on('click', function(){showonly('.infowrite');});
					$('.mapuploadspan').on('click', function(){showonly('.mapupload');});
					$('#quarrytext').load("http://skmttd.tk/map/?C=M;O=A", "", listparse());
					$('#reloadlist').on('click', function(){$('#quarrytext').load("http://skmttd.tk/map/?C=M;O=A", listparse());});
				});
				</script>
				<div class="manpage100">
					<div class="sstitle">
						<span class="infowritespan text-pagesstitle">공지 쓰기</span>
					</div>
					<div class="infowrite extendable" height="320px">
					<?php include("/var/www/html/page/editor.php"); ?>
					</div>
				</div>
				<div class="manpage100">
					<div class="sstitle">
						<span class="mapuploadspan text-pagesstitle">맵 관리</span>
					</div>
					<div class="mapupload extendable">
						<script>
						var dotcount = 0;
						var intervalc;
						function counting()
						{
							dotcount++;
							if(dotcount == 4) dotcount = 0;
							var resulttxt = "전송중";
							for(var c = 0 ; c <= dotcount ; c++ ) resulttxt += ".";
							resulttxt += "\n";
							$('#result').text(resulttxt);
						}
						function usemap()
						{
							if(confirm("리셋할 겁니까아아아")) {
								window.open('/game/loadnewmap.php?map='+ $('#mapselect option:selected').text(), '_blank');
							} else { return; }
						}
						$(function() {
							$('#fform').ajaxForm({
								dataType: 'json',
								beforeSend: function() {
									intervalc = setInterval(counting(), 500);
								},
								complete: function(data) {
									clearInterval(intervalc);
									var fsarr = [];
									for(var x in data.responseJSON){
										fsarr.push(data.responseJSON[x]);
									}
									if(fsarr[0] == "OK") {
										$('#result').append("전송 성공\n");
									} else {
										$('#result').append("전송 실패\n" + fsarr[1] + "\n");
									}
								}
							});
						});
						function listparse() {
							$("#mapselect").children().not("#defaultselected").remove();
							$("#mapselect").append("<option value=\"random\">random</option>");
							$("#quarrytext").find("a").each(function(a, b) {
								if(a < 6) return;
								var str = jQuery(b).attr("href");
								console.log(str);
								str = str.replace(">", "");
								$("#mapselect").append("<option value=\"" + str + "\">" + str + "</option>");
							});
						}
						</script>
						<form id='fform' action='upload_ok.php' enctype='multipart/form-data' method='post'>
							<input type="hidden" name="MAX_FILE_SIZE" value="100000000" />
							<input type='file' name='filesel'>
							<button>업로드</button>
						</form>
						<pre class="resultheight" id='result'></pre>
						<span class="btn-more" id="reloadlist">↻</span>
						<div>
							<label>맵 선택</label> 
							<select id="mapselect" name="mapselect">
								<option value="" id="defaultselected" selected>---> CLICK TO REFRESH</option>
							</select>
						</div>
						<button onclick="usemap()">맵 적용</button>
						<div height="20px"></div>
						<div id="quarrytext" >
						</div>
					</div>
				</div>
				<?php } ?>
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

<script>
function submitthis(){
	document.getElementById('editor').submit();
}
</script>

<form action="writer.php" method="post" id="editor">
	<div class="editor">
		<div class="editortitle">
			<input class="editortitle" type="text" id="title" name="title" />
		</div>
		<div>
			<input type="hidden" id="writer" name="writer" value="<?php echo $_GET['id']; ?>"/>
			<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=5elbivyq95q50skogsihutffudcyq6fceot86lc122ewonv2"></script>
			<script>tinymce.init({ selector:'textarea' });</script>
			<textarea type="text" id="data" name="data" ></textarea>
		</div>
		<a class="btn-more" href="#" onclick="submitthis();">저장</a>
	</div>
</form>
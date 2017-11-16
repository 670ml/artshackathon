<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>プレゼン資料</title>
	<link rel="stylesheet" href="assets/css/devrama-book.css">
	<script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/jquery.devrama.book.js"></script>
	<script>
		$(function(){
			$('.devrama-book').DrBook({
				width: 520, // Book width
				height: 600 // Book height
			});
		});
	</script>

	<style>
		html{
			height: 100%;
		}
		body{
			min-height: 100%;
			margin-top: 30px;
			margin-left: 50%;
		}
	</style>
</head>
<body>
	<div class="devrama-book">
		<ul class="front">
			<li class="front">
				Front Page Title
			</li>
			<li class="back">
				<!-- You can decorate the back of the front cover page. -->
			</li>
		</ul>
		<ul class="page">
			<li>
				Usually blank page.
			</li>
			<li><?php require_once("bme280.php") ?></li>
			<li>Page 2</li>
			<li>Page 3</li>
			<li>Page 4</li>
			<li>Page 5</li>
		</ul>
	</div>
</body>
</html>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script>
$(function(){
	setInterval(function(){
		$("#dsp1").load("assets/php/ajax_bme280.php #test1");
		$("#dsp2").load("assets/php/ajax_bme280.php #test2");
		$("#dsp3").load("assets/php/ajax_bme280.php #test3");
	}, 100);
});
</script>


<div>気温：<span id="dsp1"></span>℃</div>
<div>湿度：<span id="dsp2"></span>％</div>
<div>気圧：<span id="dsp3"></span>hPa</div>

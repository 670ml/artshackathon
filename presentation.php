<?php
date_default_timezone_set('Asia/Tokyo');

/*====発生エラーの理由を全て表示====================*/
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

/*================================================*/

require_once '/var/www/html/assets/php/data.php';

$year_key = $now_year;
$month_key = $now_month;
$day_key = date("d", strtotime('-20 minute'));

if(isset($_GET["year"])){
	$year_key = $_GET["year"];
}
if(isset($_GET["month"])){
	$month_key = $_GET["month"];
}
if(isset($_GET["day"])){
	$day_key = $_GET["day"];
}


$pdo = new PDO("sqlite:/var/www/html/assets/db/sqlite.db");

$str_sql =("
			SELECT
				*
			FROM
				amedas
			WHERE
				time LIKE '{$year_key}-{$month_key}-{$day_key}%'
		");
$stmt = $pdo->query($str_sql);
$i = 1;
$cnt = 0;
foreach($stmt as $row):
	$id[$i] = htmlspecialchars($row["id"]);
	$time[$i] = htmlspecialchars($row["time"]);
	$temp[$i] = htmlspecialchars($row["temp"]);
	$prec[$i] = htmlspecialchars($row["prec"]);
	$widi[$i] = htmlspecialchars($row["widi"]);
	$wisp[$i] = htmlspecialchars($row["wisp"]);
	$suns[$i] = htmlspecialchars($row["suns"]);
	$snow[$i] = htmlspecialchars($row["snow"]);
	$humi[$i] = htmlspecialchars($row["humi"]);
	$atmo[$i] = htmlspecialchars($row["atmo"]);

	if($temp[$i] == null || $temp[$i] == "" ) $temp[$i] = "0.0";
	if($prec[$i] == null || $prec[$i] == "" ) $prec[$i] = "0.0";
	if($wisp[$i] == null || $wisp[$i] == "" ) $wisp[$i] = "0.0";
	if($suns[$i] == null || $suns[$i] == "" ) $suns[$i] = "0.0";
	if($snow[$i] == null || $snow[$i] == "" ) $snow[$i] = 0;
	if($humi[$i] == null || $humi[$i] == "" ) $humi[$i] = 0;
	if($atmo[$i] == null || $atmo[$i] == "" ) $atmo[$i] = 0;

	$year[$i] = date("Y", strtotime($time[$i]));
	$month[$i] = date("m", strtotime($time[$i]));
	$day[$i] = date("d", strtotime($time[$i]));
	$hour[$i] = date("H", strtotime($time[$i]));

	$i++;
	$cnt++;
endforeach;
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>プレゼン資料</title>
	<link rel="stylesheet" href="assets/css/jquery.jqplot.min.css">
	<link rel="stylesheet" href="assets/css/devrama-book.css">

	<style>
		html{
			height: 100%;
		}
		body{
			min-height: 100%;
		}
		.menu:nth-child(2){
			margin-top: 100px;
		}
		.menu div{
			margin-top: 30px;
			margin: 0 auto;
			display: inline-block;
		}
		.devrama-book{
			margin-top: 150px;
			margin-left: 50%;
		}

	</style>

	<script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/jquery.jqplot.min.js"></script>
	<script src="assets/js/jquery.devrama.book.js"></script>


	<script>
	$(function(){
		$('.devrama-book').DrBook({
			width: 520, // Book width
			height: 600 // Book height
		});
	});
	</script>

	<script>

	$(function(){
		setInterval(function(){
			$("#dsp1").load("assets/php/ajax_bme280.php #test1");
			$("#dsp2").load("assets/php/ajax_bme280.php #test2");
			$("#dsp3").load("assets/php/ajax_bme280.php #test3");
		}, 100);
/*
		function test(){
			var result = $.ajax({
				type: 'GET',
				url: 'assets/php/ajax_temp.php',
				async: false
			}).responseText;
			return result;
		}
		var result = test();
		console.log(result);
*/
/*
		setInterval(function(){
			function test(){
				return $.ajax({
					type: 'GET',
					url: 'assets/php/ajax_temp.php'
				})
			}
			ajaxtemp = "a";
			test().done(function(result) {
				ajaxtemp = result;
			}).fail(function(result) {
				ajaxtemp = "aa";
			});
			console.log(ajaxtemp);
		}, 1000);
*/
	});

	</script>

	<script>
	$(function(){
		/*====気温========================*/
		jQuery . jqplot(
			'jqPlot-temp',
			[
				[
					<?php foreach(range(1, $cnt) as $i): ?>
						[<?=$i?>, <?=$temp[$i]?>],
					<?php endforeach; ?>
				]
			],
			{
				title: {
					text : "気温",
				},
				axes: {
					xaxis: {
						min: 1, //1時からスタート
						max: 24,
					},
				},
			}
		);

		/*================================*/


		/*====降水量======================*/
		jQuery . jqplot(
			'jqPlot-prec',
			[
				[
					<?php foreach(range(1, $cnt) as $i): ?>
						[<?=$i?>, <?=$prec[$i]?>],
					<?php endforeach; ?>
				]
			],
			{
				title: {
					text : "降水量",
				},
				axes: {
					xaxis: {
						min: 1, //1時からスタート
						max: 24,
					},
				},
			}
		);

		/*================================*/


		/*====風速========================*/
		jQuery . jqplot(
			'jqPlot-wisp',
			[
				[
					<?php foreach(range(1, $cnt) as $i): ?>
						[<?=$i?>, <?=$wisp[$i]?>],
					<?php endforeach; ?>
				]
			],
			{
				title: {
					text : "風速",
				},
				axes: {
					xaxis: {
						min: 1, //1時からスタート
						max: 24,
					},
				},
			}
		);

		/*================================*/


		/*====日照時間====================*/
		jQuery . jqplot(
			'jqPlot-suns',
			[
				[
					<?php foreach(range(1, $cnt) as $i): ?>
						[<?=$i?>, <?=$suns[$i]?>],
					<?php endforeach; ?>
				]
			],
			{
				title: {
					text : "日照時間",
				},
				axes: {
					xaxis: {
						min: 1, //1時からスタート
						max: 24,
					},
				},
			}
		);

		/*================================*/


		/*====積雪深======================*/
		jQuery . jqplot(
			'jqPlot-snow',
			[
				[
					<?php foreach(range(1, $cnt) as $i): ?>
						[<?=$i?>, <?=$snow[$i]?>],
					<?php endforeach; ?>
				]
			],
			{
				title: {
					text : "積雪深",
				},
				axes: {
					xaxis: {
						min: 1, //1時からスタート
						max: 24,
					},
				},
			}
		);

		/*================================*/


		/*====湿度========================*/
		jQuery . jqplot(
			'jqPlot-humi',
			[
				[
					<?php foreach(range(1, $cnt) as $i): ?>
						[<?=$i?>, <?=$humi[$i]?>],
					<?php endforeach; ?>
				]
			],
			{
				title: {
					text : "湿度",
				},
				axes: {
					xaxis: {
						min: 1, //1時からスタート
						max: 24,
					},
				},
			}
		);

		/*================================*/


		/*====気圧========================*/
		jQuery . jqplot(
			'jqPlot-atmo',
			[
				[
					<?php foreach(range(1, $cnt) as $i): ?>
						[<?=$i?>, <?=$atmo[$i]?>],
					<?php endforeach; ?>
				]
			],
			{
				title: {
					text : "気圧",
				},
				axes: {
					xaxis: {
						min: 1, //1時からスタート
						max: 24,
					},
				},
			}
		);

		/*================================*/





		/*================================*/
		jQuery . jqplot(
			'jqPlot-ajax_temp',
			[
				[
					<?php require_once '/var/www/html/assets/php/ajax_temp.php'; ?>

				]
			],
			{
				title: {
					text : "現在の気温",
				},
				axes: {
					xaxis: {
						min: 1,
						max: 10,
					},
				},
			}
		);

		/*================================*/


		/*================================*/
		jQuery . jqplot(
			'jqPlot-ajax_hum',
			[
				[
					<?php require_once '/var/www/html/assets/php/ajax_hum.php'; ?>

				]
			],
			{
				title: {
					text : "現在の湿度",
				},
				axes: {
					xaxis: {
						min: 1,
						max: 10,
					},
				},
			}
		);

		/*================================*/


		/*================================*/
		jQuery . jqplot(
			'jqPlot-ajax_pressure',
			[
				[
					<?php require_once '/var/www/html/assets/php/ajax_pressure.php'; ?>

				]
			],
			{
				title: {
					text : "現在の気圧",
				},
				axes: {
					xaxis: {
						min: 1,
						max: 10,
					},
				},
			}
		);

		/*================================*/

	});
	</script>

</head>
<body>

	<div class="menu">
		<h1 align="center">横浜市の天気情報</h1>
		<div id="jqPlot-temp" style="height: 200px; width: 300px;"></div>
		<div id="jqPlot-prec" style="height: 200px; width: 300px;"></div>
		<div id="jqPlot-wisp" style="height: 200px; width: 300px;"></div>
		<div id="jqPlot-suns" style="height: 200px; width: 300px;"></div>
		<div id="jqPlot-snow" style="height: 200px; width: 300px;"></div>
		<div id="jqPlot-humi" style="height: 200px; width: 300px;"></div>
		<div id="jqPlot-atmo" style="height: 200px; width: 300px;"></div>
	</div>
	<div class="menu">
		<div id="jqPlot-ajax_temp" style="height: 200px; width: 300px;"></div>
		<div id="jqPlot-ajax_hum" style="height: 200px; width: 300px;"></div>
		<div id="jqPlot-ajax_pressure" style="height: 200px; width: 300px;"></div>
	</div>

	<div class="devrama-book">
		<ul class="front">
			<li class="front">
				<h2>螺湮城教本</h2>
			</li>
			<li class="back">
				<p>・このノートに名前を書かれた人間は死ぬ｡
					・書く人物の顔が頭に入っていないと効果はない｡ゆえに同姓同名の人物に一遍に効果は得られない｡
					・名前の後に人間界単位で40秒以内に死因を書くと、その通りになる。
					・死因を書かなければ全てが心臓麻痺となる。
					・死因を書くと更に6分40秒、詳しい死の状況を記載する時間が与えられる。
					・このノートは人間界の地に着いた時点から人間界の物となる。
					・所有者はノートの元の持ち主である死神の姿や声を認知する事ができる。
					・このノートを使った人間は天国にも地獄にも行けない。
					・死因に心臓麻痺と書いた後、40秒以内に死亡時刻を書けば、心臓麻痺であっても死の時間を操れ、その時刻は名前を書いてからの40秒以内でも可能である。
					・デスノートに触った人間には、そのノートの所有者でなくとも、元持ち主の死神の姿や声が認知できる。
					・デスノートの所有者となった人間は、自分の残された寿命の半分と交換に、人間の顔を見るとその人間の名前と寿命の見える死神の眼球をもらう事ができる。
					・書き入れる死の状況は、その人間が物理的に可能な事、その人間がやってもおかしくない範囲の行動でなければ実現しない。
					・死神の目の取引をした者は、所有権を失うと、ノートの記憶と共に目の能力を失う。その際、半分になった余命は元には戻らない。
					・所有権は自分のまま、人にデスノートを貸す事は可能である。又貸しも構わない。
					・デスノートを借りた者の方に死神は憑いてこない。死神はあくまでも所有者に憑く。また、借りた者には死神の目の取引はできない。
					・デスノートを貸している時に所有者が死んだ場合、所有権は、その時、手にしている者に移る。
					・死神は特定の人間に好意を持ち、その人間の寿命を延ばす為にデスノートを使い、人間を殺すと死ぬ。
					・人間界でデスノートを持った人間同士でも、相手のデスノートに触らなければ、相手に憑いている死神の姿や声は認知できない。
					・デスノートの所有権を失った人間は自分がデスノートを使用した事等の記憶が一切なくなる。
					しかし、ノートを持ってから失うまでの全ての記憶を喪失するのではなく、自分のしてきた行動はデスノートの所有者であった事が絡まない形で残る。
					・二冊以上のデスノートの所有権を得た人間は、一冊の所有権を失うとその失ったノートに憑いていた死神の姿は認知できなくなり死神も離れるが、一冊でも所有している限り、関わった全てのデスノートの記憶は消えない。
					・所有権をなくしたノートの所有権を得れば、そのノートに関する記憶が戻る。万が一、他にも関わったノートがあれば、関わった全てのノートに関する記憶が戻る。
					・また、所有権を得なくとも、ノートに触れていれば、触れている間のみ記憶は戻る。</p>
			</li>
		</ul>
		<ul class="page">
			<li>
				Usually blank page.
			</li>
			<li>
				<div style="font-size: 4em;">気温：<span id="dsp1"></span>℃</div>
				<div style="font-size: 4em;">湿度：<span id="dsp2"></span>％</div>
				<div style="font-size: 4em;">気圧：<span id="dsp3"></span>hPa</div>
			</li>
			<li><a href="3graph.php">気温グラフ</a></li>
			<li><a href="2graph.php">湿度グラフ</a></li>
			<li><a href="1graph.php">気圧グラフ</a></li>
			<li>

			</li>
		</ul>
	</div>

</body>
</html>
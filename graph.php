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
<meta charset="utf-8">
<title>グラフ</title>
<link rel="stylesheet" href="assets/css/jquery.jqplot.min.css">
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/jquery.jqplot.min.js"></script>

<script>
jQuery( function() {
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

} );
</script>

<div id="jqPlot-temp" style="height: 200px; width: 300px;"></div>
<div id="jqPlot-prec" style="height: 200px; width: 300px;"></div>
<div id="jqPlot-wisp" style="height: 200px; width: 300px;"></div>
<div id="jqPlot-suns" style="height: 200px; width: 300px;"></div>
<div id="jqPlot-snow" style="height: 200px; width: 300px;"></div>
<div id="jqPlot-humi" style="height: 200px; width: 300px;"></div>
<div id="jqPlot-atmo" style="height: 200px; width: 300px;"></div>

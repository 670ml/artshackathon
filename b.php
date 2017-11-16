<?php
date_default_timezone_set('Asia/Tokyo');

/*====発生エラーの理由を全て表示====================*/
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

/*================================================*/

require_once 'assets/php/data.php';

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


$pdo = new PDO("sqlite:assets/db/sqlite.db");

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

	$year[$i] = date("Y", strtotime($time[$i]));
	$month[$i] = date("m", strtotime($time[$i]));
	$day[$i] = date("d", strtotime($time[$i]));
	$hour[$i] = date("H", strtotime($time[$i]));

	$i++;
	$cnt++;
endforeach;
?>
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

} );
</script>
<div id="jqPlot-temp" style="height: 200px; width: 300px;"></div>
<div id="jqPlot-prec" style="height: 200px; width: 300px;"></div>
<div id="jqPlot-wisp" style="height: 200px; width: 300px;"></div>
<div id="jqPlot-suns" style="height: 200px; width: 300px;"></div>
<div id="jqPlot-snow" style="height: 200px; width: 300px;"></div>
<div id="jqPlot-humi" style="height: 200px; width: 300px;"></div>
<div id="jqPlot-atmo" style="height: 200px; width: 300px;"></div>




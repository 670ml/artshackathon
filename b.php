<?php
date_default_timezone_set('Asia/Tokyo');

/*====発生エラーの理由を全て表示====================*/
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

/*================================================*/

$pdo = new PDO("sqlite:assets/db/sqlite.db");

$str_sql =("
			SELECT
				*
			FROM
				amedas
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
				}
			},
		}
	);

	/*================================*/

	/*====降水量======================*/
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
				text : "降水量",
			},
			axes: {
				xaxis: {
					min: 1, //1時からスタート
					max: 24,
				}
			},
		}
	);

	/*================================*/

} );
</script>
<div id="jqPlot-temp" style="height: 200px; width: 300px;"></div>
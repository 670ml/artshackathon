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


<script src="assets/js/jquery-3.2.1.min.js"></script>

<script src="assets/js/loader.js"></script>

<script>
google.charts.load('current', {packages: ['corechart', 'controls', 'table']});
google.charts.setOnLoadCallback(controlsAndDashboards);

function controlsAndDashboards() {
	var data = new google.visualization.DataTable();
	data.addColumn('date', '時');
	data.addColumn('number', 'Temperature');
	data.addColumn('number', 'Precipitation');
	data.addColumn('number', 'Wind speed');


	<?php foreach(range(1, $cnt) as $i): ?>
		var date = new Date(0, 0, <?=$i?>);
		data.addRow([
			date,
			<?=$temp[$i]?>,
			<?=$prec[$i]?>,
			<?=$wisp[$i]?>,
		]);
	<?php endforeach; ?>
//	}

	var dashboard = new google.visualization.Dashboard(document.getElementById('dashboard_div'));

	var chartRangeFilter = new google.visualization.ControlWrapper({
		controlType: 'ChartRangeFilter',
		containerId: 'filter_div',
		options: {
			filterColumnIndex: 0,
			ui: {
				chartType: 'ComboChart',
				chartOptions: {
					colors: [
						'rgb(255, 99, 132)',
						'rgb(54, 162, 235)',
						'rgb(255, 206, 86)'
					],
					height: 70
				}
			}
		}
	});

	var Temperature = new google.visualization.ChartWrapper({
		chartType: 'AreaChart',
		containerId: 'chart1_div',
		options: {
			height: 80,
			hAxis: {
				textPosition: 'none'
			},
			vAxis: {
				title: 'Temperature',
			},
			colors: ['rgb(255, 99, 132)'],
			tooltip: {
				trigger: 'selection'
			},
			axisTitlesPosition: 'in'
		},
		view: {
			columns: [0, 1]
		}
	});

	var Precipitation = new google.visualization.ChartWrapper({
		chartType: 'AreaChart',
		containerId: 'chart2_div',
		options: {
			height: 80,
			hAxis: {
				textPosition: 'none'
			},
			vAxis: {
				title: 'Precipitation'
			},
			colors: ['rgb(54, 162, 235)'],
			tooltip: {
				trigger: 'selection'
			},
			axisTitlesPosition: 'in'
		},
		view: {
			columns: [0, 2]
		}
	});

	var Windspeed = new google.visualization.ChartWrapper({
		chartType: 'AreaChart',
		containerId: 'chart3_div',
		options: {
			height: 80,
			vAxis: {
				title: 'Windspeed'
			},
			colors: ['rgb(255, 206, 86)'],
			tooltip: {
				trigger: 'selection'
			},
			axisTitlesPosition: 'in'
		},
		view: {
			columns: [0, 3]
		}
	});

	dashboard.bind(chartRangeFilter, [Temperature, Precipitation, Windspeed]);

	dashboard.draw(data);

}
</script>
<div id="dashboard_div">
  <div id="chart1_div"></div>
  <div id="chart2_div"></div>
  <div id="chart3_div"></div>
  <div id="filter_div"></div>
</div>

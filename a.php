<?php
/*====発生エラーの理由を全て表示====================*/
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

/*================================================*/

	require_once 'phpquery.php'; //ロード時、一度だけ外部php読み込み
?>


<script src="assets/js/jquery-3.2.1.min.js"></script>

<script src="assets/js/loader.js"></script>

<script>
google.charts.load('current', {packages: ['corechart', 'controls', 'table']});
google.charts.setOnLoadCallback(controlsAndDashboards);

function controlsAndDashboards() {
	var data = new google.visualization.DataTable();
	data.addColumn('date', '日');
	data.addColumn('number', 'Temperature');
	data.addColumn('number', 'Precipitation');
	data.addColumn('number', 'Wind speed');

	function getRandomInt(min, max) {
		return Math.floor( Math.random() * (max - min + 1) ) + min;
	}
//	for (var day = 1; day < 30; ++day) {
	<?php foreach(range(1, 10) as $i): ?>
		date = new Date(2015, 0 , <?=$i?>);
		data.addRow([
			date,
			<?=$temp[$i + 2]?>,
			<?=$prec[$i + 2]?>,
			<?=$wisp[$i + 2]?>,
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
				title: 'Temperature'
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

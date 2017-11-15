

<script src="assets/js/jquery-3.2.1.min.js"></script>

<script src="assets/js/loader.js"></script>

<script>
google.charts.load('current', {packages: ['corechart', 'controls', 'table']});
google.charts.setOnLoadCallback(controlsAndDashboards);

function controlsAndDashboards() {
	var data = new google.visualization.DataTable();
	data.addColumn('date', '日');
	data.addColumn('number', 'Dogs');
	data.addColumn('number', 'Cats');
	data.addColumn('number', 'Rabbits');

	function getRandomInt(min, max) {
		return Math.floor( Math.random() * (max - min + 1) ) + min;
	}
	for (var day = 1; day < 30; ++day) {
		var date = new Date(2015, 0 ,day);
		data.addRow([
			date,
			getRandomInt(0, 200),
			getRandomInt(0, 200),
			getRandomInt(0, 200),
		]);
	}

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

	var dogs = new google.visualization.ChartWrapper({
		chartType: 'AreaChart',
		containerId: 'chart1_div',
		options: {
			height: 80,
			hAxis: {
				textPosition: 'none'
			},
			vAxis: {
				title: 'dogs'
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

	var cats = new google.visualization.ChartWrapper({
		chartType: 'AreaChart',
		containerId: 'chart2_div',
		options: {
			height: 80,
			hAxis: {
				textPosition: 'none'
			},
			vAxis: {
				title: 'cats'
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

	var rabbits = new google.visualization.ChartWrapper({
		chartType: 'AreaChart',
		containerId: 'chart3_div',
		options: {
			height: 80,
			vAxis: {
				title: 'rabbits'
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

	dashboard.bind(chartRangeFilter, [dogs, cats, rabbits]);

	dashboard.draw(data);

}
</script>
<div id="dashboard_div">
  <div id="chart1_div"></div>
  <div id="chart2_div"></div>
  <div id="chart3_div"></div>
  <div id="filter_div"></div>
</div>

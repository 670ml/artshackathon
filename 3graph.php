<?php
$pdo = new PDO("sqlite:assets/db/sqlite.db");

$str_sql =("
			SELECT
				*
			FROM
				bme280
		");
$stmt = $pdo->query($str_sql);
$i = 1;
$cnt = 0;
foreach($stmt as $row):
	$id[$i] = htmlspecialchars($row["id"]);
	$date[$i] = htmlspecialchars($row["date"]);
	$temp[$i] = htmlspecialchars($row["temp"]);
	$hum[$i] = htmlspecialchars($row["hum"]);
	$pressure[$i] = htmlspecialchars($row["pressure"]);
	$i++;
	$cnt++;
endforeach;
?>

<!--
<table border="1">
	<?php foreach(range(1, 10) as $i): ?>
		<tr>
			<td><?=$date[$i]?></td>
			<td><?=$temp[$i]?></td>
			<td><?=$hum[$i]?></td>
			<td><?=$pressure[$i]?></td>
		</tr>
	<?php endforeach; ?>
</table>
-->

<!doctype html>
<html>
  <head>
    <meta charset="utf-8" content="">
    <title>google-charts 横軸が日時なグラフ</title>
 
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript" ></script>
    <script src="https://www.google.com/jsapi"></script>
    
    <!-- スクリプト部分 -->
    <script>
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
 
      function drawChart() {
      var dataTable= new google.visualization.DataTable();
dataTable.addColumn('datetime','日時');
		dataTable.addColumn('number', 'temperature');

      dataTable.addRows([
          [new Date(2017,11,16,4,0,3),<?=$temp[1]?>],
          [new Date(2017,11,16,4,0,6),<?=$temp[2]?>],
          [new Date(2017,11,16,4,0,9),<?=$temp[3]?>],
          [new Date(2017,11,16,4,0,12),<?=$temp[4]?>],
          [new Date(2017,11,16,4,0,15),<?=$temp[5]?>],
          [new Date(2017,11,16,4,0,18),<?=$temp[6]?>],
          [new Date(2017,11,16,4,0,21),<?=$temp[7]?>],
          [new Date(2017,11,16,4,0,24),<?=$temp[8]?>],
          [new Date(2017,11,16,4,0,27),<?=$temp[9]?>],
          [new Date(2017,11,16,4,0,30),<?=$temp[10]?>]


	]);
		options = {
			width: 700,
			height: 700,
			title: '現在地の気温変化'
		};
          var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
          chart.draw(dataTable, options);
      }
    </script> 
  </head>
  
  <!-- HTML部分 -->
  <body>
    
    <div id="chart_div" style="height: 1000px;"></div>
 
  </body>
</html>
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
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    
    <!-- スクリプト部分 -->
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
 
      function drawChart() {
      var dataTable= new google.visualization.DataTable();
dataTable.addColumn('datetime','日時');
		dataTable.addColumn('number', 'Humidity');

      dataTable.addRows([
          [new Date(2017,11,16,4,0,3),<?=$hum[1]?>],
          [new Date(2017,11,16,4,0,6),<?=$hum[2]?>],
          [new Date(2017,11,16,4,0,9),<?=$hum[3]?>],
          [new Date(2017,11,16,4,0,12),<?=$hum[4]?>],
          [new Date(2017,11,16,4,0,15),<?=$hum[5]?>],
          [new Date(2017,11,16,4,0,18),<?=$hum[6]?>],
          [new Date(2017,11,16,4,0,21),<?=$hum[7]?>],
          [new Date(2017,11,16,4,0,24),<?=$hum[8]?>],
          [new Date(2017,11,16,4,0,27),<?=$hum[9]?>],
          [new Date(2017,11,16,4,0,30),<?=$hum[10]?>]


      ]);              
      var options = {title: '現在地の湿度変化'};
          var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
          chart.draw(dataTable, options);
      }
    </script> 
  </head>
  
  <!-- HTML部分 -->
  <body>
    
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
 
  </body>
</html>
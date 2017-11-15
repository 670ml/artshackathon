<?php
	require_once("../phpquery.php");
?>
<html>
  <head>

    <!-- AJAX API のロード -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Visualization API と折れ線グラフ用のパッケージのロード
      google.load("visualization", "1", {packages:["corechart"]});

      // Google Visualization API ロード時のコールバック関数の設定
      google.setOnLoadCallback(drawChart);

      // グラフ作成用のコールバック関数
      function drawChart() {

        // データテーブルの作成
        var data = google.visualization.arrayToDataTable([
          ['時刻', '風速'],

<?php foreach(range(3, $cnt) as $i): ?>
			[
				<?=$time[$i]?>,
				<?=$wisp[$i]?>,
			],
<?php endforeach; ?>
		]);

        // グラフのオプションを設定
        var options = {
          title: '風速'
        };

        // LineChart のオブジェクトの作成
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        // データテーブルとオプションを渡して、グラフを描画
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <!-- グラフを描く div 要素 -->
    <div id="chart_div" style="width: 80%; height: 400px;"></div>
  </body>
</html>
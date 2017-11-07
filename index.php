<?php
/*====フォルダ階層自動取得======================*/
$path = "";
$folderPath = $_SERVER["REQUEST_URI"];
$folderPathCnt = preg_match_all("%\/%", $folderPath);
for($i = 3; $i <= $folderPathCnt; $i++):
	$path .= "../";
endfor;
/*==============================================*/

	require_once "{$path}assets/php/Feed.php";
	$feed = new Feed;
	$url = "http://weather.livedoor.com/forecast/rss/area/140010.xml";
	$rss = $feed->loadRss($url);

	$i = 1;
	$cnt = 0;
	foreach($rss->item as $item):
		// 各エントリーの処理
		$title[$i] = $item->title; // タイトル
		$link[$i] = $item->link; // リンク
		$timestamp[$i] = strtotime( $item->pubDate ); // 更新日時のUNIX TIMESTAMP
		$description[$i] = $item->description ; // 詳細

		$i++;
		$cnt++;
	endforeach;
?>


<?php foreach(range(1, $cnt) as $i): ?>
	<a href="<?=$link[$i]?>"><?=$title[$i]?></a><?=date("Y/m/d H:i", $timestamp[$i])?><br>
<?php endforeach; ?>

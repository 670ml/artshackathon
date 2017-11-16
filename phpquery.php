<?php
/*====発生エラーの理由を全て表示====================*/
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

/*================================================*/

require_once 'assets/php/data.php'; //ロード時、一度だけ外部php読み込み

?>
	<?php
	echo date("Y年m月d日")."<br />"; // 現在時刻を表示します①
	?>



<?php
require_once("assets/php/phpQuery-onefile.php");
$doc = phpQuery::newDocumentFile("http://www.jma.go.jp/jp/amedas_h/today-46106.html");

$i = 1;
$cnt = 0;
foreach($doc["table:eq(5) tr"] as $row)
{
    //各要素取得
    $time[$i] = pq($row)->find("td:eq(0)")->text();
    $temp[$i] = pq($row)->find("td:eq(1)")->text();
    $prec[$i] = pq($row)->find("td:eq(2)")->text();
    $widi[$i] = pq($row)->find("td:eq(3)")->text();
    $wisp[$i] = pq($row)->find("td:eq(4)")->text();
    $suns[$i] = pq($row)->find("td:eq(5)")->text();
    $snow[$i] = pq($row)->find("td:eq(6)")->text();
    $humi[$i] = pq($row)->find("td:eq(7)")->text();
    $atmo[$i] = pq($row)->find("td:eq(8)")->text();


	$i++;
	$cnt++;
}

?>





<table border="1">
	<?php foreach(range(3, $cnt) as $i): ?>
		<tr>
			<td><?=$time[$i]?></td>
			<td><?=$temp[$i]?></td>
			<td><?=$prec[$i]?></td>
			<td><?=$widi[$i]?></td>
			<td><?=$wisp[$i]?></td>
			<td><?=$suns[$i]?></td>
			<td><?=$snow[$i]?></td>
			<td><?=$humi[$i]?></td>
			<td><?=$atmo[$i]?></td>
		</tr>
	<?php endforeach; ?>
</table>

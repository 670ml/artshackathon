<?php
require_once("phpQuery-onefile.php");
$doc = phpQuery::newDocumentFile("http://www.jma.go.jp/jp/amedas_h/today-46106.html?areaCode=&groupCode=");

$i = 1;
$cnt = 0;
foreach($doc["table:eq(5) tr"] as $row)
{
    //Še—v‘fŽæ“¾
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
	<?php foreach(range(1, $cnt) as $i): ?>
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
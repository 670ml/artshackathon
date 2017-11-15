<?php
require_once("phpQuery-onefile.php");
$doc = phpQuery::newDocumentFile("http://www.jma.go.jp/jp/amedas_h/today-46106.html?areaCode=&groupCode=");

$i = 1;
$cnt = 0;
foreach($doc["table:eq(5) tr"] as $row)
{
    //Še—v‘fŽæ“¾
    $key[$i] = pq($row)->find("td:eq(0)")->text();
    $aaa[$i] = pq($row)->find("td:eq(1)")->text();

	$i++;
	$cnt++;
}

?>





<table border="1">
	<?php foreach(range(1, $cnt) as $i): ?>
		<tr>
			<td><?=$key[$i]?></td>
			<td><?=$aaa[$i]?></td>
		</tr>
	<?php endforeach; ?>
</table>
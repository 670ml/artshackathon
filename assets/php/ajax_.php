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

<table border="1">
	<?php foreach(range(1, $cnt) as $i): ?>
		<tr>
			<td><?=$date[$i]?></td>
			<td><?=$temp[$i]?></td>
			<td><?=$hum[$i]?></td>
			<td><?=$pressure[$i]?></td>
		</tr>
	<?php endforeach; ?>
</table>
<?php
/*====発生エラーの理由を全て表示====================*/
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

/*================================================*/

$pdo = new PDO("sqlite:assets/db/sqlite.db");

$str_sql =("
			SELECT
				*
			FROM
				amedas
		");
$stmt = $pdo->query($str_sql);
$i = 1;
$cnt = 0;
foreach($stmt as $row):
	$id[$i] = htmlspecialchars($row["id"]);
	$time[$i] = htmlspecialchars($row["time"]);
	$temp[$i] = htmlspecialchars($row["temp"]);
	$prec[$i] = htmlspecialchars($row["prec"]);
	$widi[$i] = htmlspecialchars($row["widi"]);
	$wisp[$i] = htmlspecialchars($row["wisp"]);
	$suns[$i] = htmlspecialchars($row["suns"]);
	$snow[$i] = htmlspecialchars($row["snow"]);
	$humi[$i] = htmlspecialchars($row["humi"]);
	$atmo[$i] = htmlspecialchars($row["atmo"]);
	$i++;
	$cnt++;
endforeach;


?>

<table border="1">
	<?php foreach(range(1, $cnt) as $i): ?>
		<tr>
			<td><?=$id[$i]?></td>
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
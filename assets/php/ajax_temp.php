<?php
$pdo = new PDO("sqlite:/var/www/html/assets/db/sqlite.db");

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
	$date[$i] = htmlspecialchars($row["date"]);
	$temp[$i] = htmlspecialchars($row["temp"]);
	$i++;
	$cnt++;
endforeach;
?>

<?php foreach(range(1, $cnt) as $i): ?>
		[<?=$i?>, <?=$temp[$i]?>],
<?php endforeach; ?>

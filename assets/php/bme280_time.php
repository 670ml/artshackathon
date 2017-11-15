<?php
//50分置きに自動実行

/*====発生エラーの理由を全て表示====================*/
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

/*================================================*/



date_default_timezone_set('Asia/Tokyo');
$pdo = new PDO("sqlite:/var/www/html/assets/db/sqlite.db");



/*====================================*/
$temp_text = file_get_contents("/var/www/html/assets/text/temp.txt");
$hum_text = file_get_contents("/var/www/html/assets/text/hum.txt");
$pressure_text = file_get_contents("/var/www/html/assets/text/pressure.txt");
$date_text = date("H:i:s");

/*====================================*/


/*====================================*/
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
	$hum[$i] = htmlspecialchars($row["hum"]);
	$pressure[$i] = htmlspecialchars($row["pressure"]);
	$i++;
	$cnt++;
endforeach;

/*====================================*/


/*====================================*/
foreach(range(1, 9) as $i):
	$str_sql =("
				UPDATE
					bme280
				SET
					date = ?,
					temp = ?,
					hum = ?,
					pressure = ?
				WHERE
					id = ?
			");
	$stmt = $pdo->prepare($str_sql);
	$stmt->bindValue(1, $date[$i + 1], PDO::PARAM_STR);
	$stmt->bindValue(2, $temp[$i + 1], PDO::PARAM_STR);
	$stmt->bindValue(3, $hum[$i + 1], PDO::PARAM_STR);
	$stmt->bindValue(4, $pressure[$i + 1], PDO::PARAM_STR);
	$stmt->bindValue(5, $i, PDO::PARAM_STR);
	$stmt->execute();
endforeach;

/*====================================*/


/*====================================*/
$str_sql =("
			UPDATE
				bme280
			SET
				date = ?,
				temp = ?,
				hum = ?,
				pressure = ?
			WHERE
				id = 10
		");
$stmt = $pdo->prepare($str_sql);

$stmt->bindValue(1, $date_text, PDO::PARAM_STR);
$stmt->bindValue(2, $temp_text, PDO::PARAM_STR);
$stmt->bindValue(3, $hum_text, PDO::PARAM_STR);
$stmt->bindValue(4, $pressure_text, PDO::PARAM_STR);

$stmt->execute();

/*====================================*/


/*====================================*/
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
	$hum[$i] = htmlspecialchars($row["hum"]);
	$pressure[$i] = htmlspecialchars($row["pressure"]);
	$i++;
	$cnt++;
endforeach;

/*====================================*/


$stmt = null;
$pdo = null;




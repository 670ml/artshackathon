<?php
//50分置きに自動実行

/*====発生エラーの理由を全て表示====================*/
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

/*================================================*/

date_default_timezone_set('Asia/Tokyo');
$pdo = new PDO("sqlite:../db/sqlite.db");

/*====================================*/
$temp_text = file_get_contents("../text/temp.txt");
$hum_text = file_get_contents("../text/hum.txt");
$pressure_text = file_get_contents("../text/pressure.txt");
$date_text = date("i:s");

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
	$id[$i] = htmlspecialchars($row["id"]);
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
$temp[10] = $temp_text;
$hum[10] = $hum_text;
$pressure[10] = $pressure_text;
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
	$stmt->bindValue(2, $temp[10], PDO::PARAM_STR);
	$stmt->bindValue(3, $hum[10], PDO::PARAM_STR);
	$stmt->bindValue(4, $pressure[10], PDO::PARAM_STR);
	$stmt->execute();

$stmt->execute();

/*====================================*/




$stmt = null;
$pdo = null;
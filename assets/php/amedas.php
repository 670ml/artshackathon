<?php
//アメダスの情報を格納

/*====発生エラーの理由を全て表示================*/
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

/*==============================================*/

date_default_timezone_set('Asia/Tokyo');
$date = date("Y-m-d H");

require_once("/var/www/html/assets/php/phpQuery-onefile.php");
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




$pdo = new PDO("sqlite:/var/www/html/assets/db/sqlite.db");


$str_sql =("
			INSERT INTO
				amedas('time', 'temp', 'prec', 'widi', 'wisp', 'suns', 'snow', 'humi', 'atmo')
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)
		");
$stmt = $pdo->prepare($str_sql);
$stmt->bindValue(1, $date, PDO::PARAM_STR);
$stmt->bindValue(2, $temp[$i + 2], PDO::PARAM_STR);
$stmt->bindValue(3, $prec[$i + 2], PDO::PARAM_STR);
$stmt->bindValue(4, $widi[$i + 2], PDO::PARAM_STR);
$stmt->bindValue(5, $wisp[$i + 2], PDO::PARAM_STR);
$stmt->bindValue(6, $suns[$i + 2], PDO::PARAM_STR);
$stmt->bindValue(7, $snow[$i + 2], PDO::PARAM_STR);
$stmt->bindValue(8, $humi[$i + 2], PDO::PARAM_STR);
$stmt->bindValue(9, $atmo[$i + 2], PDO::PARAM_STR);
$stmt->execute();


$stmt = null;
$pdo = null;
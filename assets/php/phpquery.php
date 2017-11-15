<?php
require_once("phpQuery-onefile.php");
$doc = phpQuery::newDocumentFile("http://www.jma.go.jp/jp/amedas_h/today-46106.html?areaCode=&groupCode=");
foreach($doc["table:eq(5) tr"] as $row)
{
    //各要素取得
    $key   = pq($row)->find("td:eq(0)")->text();
    $aaa   = pq($row)->find("td:eq(1)")->text();

    //表示
    echo $key . " ";
    echo $aaa . " ";
	
}
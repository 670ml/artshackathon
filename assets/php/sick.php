<?php
    $month = date('n');
?>
<?php
$spring="はしか、風疹、おたふく風邪、百日咳、インフルエンザ";
$summer="夏バテ、熱中症、食中毒";
$fall="食中毒、インフルエンザ、喘息、花粉症";
$winter="インフルエンザ、ノロウイルス、マイコプラズマ肺炎";

?>
<?=$month?>月の流行病は
<?php if($month == 1){
		echo $winter;
}
	elseif($month == 2){
		echo $winter;
}
	elseif($month == 3){
		echo $spring;
}
	elseif($month == 4){
		echo $spring;
}
	elseif($month == 5){
		echo $spring;
}
	elseif($month == 6){
		echo $summer;
}
	elseif($month == 7){
		echo $summer;
}
	elseif($month == 8){
		echo $summer;
}
	elseif($month == 9){
		echo $fall;
}
	elseif($month == 10){
		echo $fall;
}
	elseif($month == 11){
		echo $fall;
}
	elseif($month == 12){
		echo $winter;
}
?>
です



<?php
	$temp = file_get_contents("../text/temp.txt");
	$hum = file_get_contents("../text/hum.txt");
	$pressure = file_get_contents("../text/pressure.txt");

?>

<span id="test1"><?=$temp?></span>
<span id="test2"><?=$hum?></span>
<span id="test3"><?=$pressure?></span>

<?php
	$temp = file_get_contents("assets/text/temp.txt");
	$hum = file_get_contents("assets/text/hum.txt");
	$pressure = file_get_contents("assets/text/pressure.txt");
?>


<?php

	if($hum >= 60){
		exec("echo 5 > /sys/class/gpio/export");
		exec("echo out > /sys/class/gpio/gpio5/direction");
		exec("echo 1 > /sys/class/gpio/gpio5/value");
	}else{
		exec("echo 6 > /sys/class/gpio/export");
		exec("echo out > /sys/class/gpio/gpio6/direction");
		exec("echo 1 > /sys/class/gpio/gpio6/value");
	}
?>
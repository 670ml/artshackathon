<?php
	$temp = file_get_contents("/var/www/html/assets/text/temp.txt");
	$hum = file_get_contents("/var/www/html/assets/text/hum.txt");
	$pressure = file_get_contents("/var/www/html/assets/text/pressure.txt");


	require '/var/www/php-gpio/vendor/autoload.php';
	use PhpGpio\Gpio;
	$gpio = new GPIO();

	if($temp >= 18 && $temp <= 25){ //室温が18度以上＆25度以内だったら緑LEDが点灯
		$gpio->setup(5, "out");
		$gpio->output(5, 1);
	}else{
		$gpio->setup(5, "out");
		$gpio->output(5, 0);
	}

	if($hum >= 30){ //湿度が30%を上回ったら緑LEDが点灯
		$gpio->setup(6, "out");
		$gpio->output(6, 1);
	}else{
		$gpio->setup(6, "out");
		$gpio->output(6, 0);
	}

?>
<?php

	require __DIR__ . "/../vendor/autoload.php";
	
	$app = new Revelex\Application(__DIR__ . "/../config/conf.php");
	
	$app->run();

?>
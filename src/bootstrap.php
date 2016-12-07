<?php

	require __DIR__ . "/../vendor/autoload.php";
	
	global $app;
	$app = new Revelex\Application(__DIR__ . "/../config/conf.php");
	
	$app->run();

?>
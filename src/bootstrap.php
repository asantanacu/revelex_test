<?php

	require __DIR__ . "/../vendor/autoload.php";
	
	$app = new Revelex\Application(__DIR__ . "/../config/conf.php");
	
	$router = $app['route'];
	$router->get('/', 'HomeController@index');
	
	$router->get('/login', 'LoginController@get');
	$router->post('/login', 'LoginController@post');
	$router->get('/logout', 'LoginController@logout');

	$router->get('/register', 'RegisterController@get');
	$router->post('/register', 'RegisterController@post');
	
	$app->run();

?>
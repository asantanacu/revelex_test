<?php

	$router->get('/', 'HomeController@index');
	
	$router->get('/login', 'LoginController@get');
	$router->post('/login', 'LoginController@post');
	$router->get('/logout', 'LoginController@logout');

	$router->get('/register', 'RegisterController@get');
	$router->post('/register', 'RegisterController@post');
	
?>
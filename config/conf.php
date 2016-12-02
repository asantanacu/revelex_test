<?php

// routes file
$app['app.route'] = [
	'path' => __DIR__ . '/routes.php'
];

// views folder
$app['app.view'] = [
   'path'  => __DIR__ . '/../views/',
];

// database details 
$app['app.database'] = [
   'host'       => 'localhost',
   'database'   => 'revelex',
   'username'   => 'root',
   'password'   => ''
];







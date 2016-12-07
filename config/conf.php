<?php

// routes file
$config['route'] = [
	'path' => __DIR__ . '/routes.php'
];

// views folder
$config['view'] = [
   'path'  => __DIR__ . '/../views/',
];

// database details 
$config['database'] = [
   'host'       => 'localhost',
   'database'   => 'revelex',
   'username'   => 'root',
   'password'   => ''
];

// dependency injection
$config['services'] = [
	'route' => [\Revelex\Services\RouteManager::class, 
				['config']
	],
	'view' => [\Revelex\Services\Template::class, 
				['config']
	],
	'session' => [\Revelex\Services\Session::class, 
				[]
	],
	'database' => [\Revelex\Services\Database::class, 
				['config']
	]
];







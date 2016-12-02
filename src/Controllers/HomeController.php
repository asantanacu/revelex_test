<?php

namespace Revelex\Controllers;

class HomeController
{

	public function index($args, $app)
	{
		$app['view']->view('home');
	}

}

?>
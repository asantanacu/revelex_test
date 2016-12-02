<?php

namespace Revelex\Controllers;

use Revelex\Models\User;
use Revelex\Repository\UserRepository;

class LoginController
{

	public function get($args, $app)
	{
		$app['view']->view('login');
	}
	
	public function post($args, $app)
	{
		$request = $app['request'];
		$userRepository = new UserRepository($app['database']->getConnection());
		$user = $userRepository->auth($request->post('email'),md5($request->post('password')));
		if($user)
		{
			$app['session']->set('user', ['email' => $user->email, 'firstname' => $user->firstname, 'lastname' => $user->lastname]);
			$app['response']->redirect('/');
		}
		else
			$app['response']->redirect('/login');	
		
		$app['response']->render();
	}

	public function logout($args, $app)
	{
		$app['session']->destroy();
		$app['response']->redirect('/');
		$app['response']->render();
	}		

}

?>
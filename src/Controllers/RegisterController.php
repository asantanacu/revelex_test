<?php

namespace Revelex\Controllers;

use Revelex\Models\User;
use Revelex\Repository\UserRepository;

class RegisterController
{

	public function get($args, $app)
	{
		$app['view']->view('register');
	}
	
	public function post($args, $app)
	{
		$request = $app['request'];
		$response = $app['response'];
		$user = new User(
					['email'=>$request->post('email'),
					'firstname'=>$request->post('firstname'),
					'lastname'=>$request->post('lastname'),
					'birth_date'=>$request->post('birth_date'),
					'password'=>md5($request->post('password'))]
				);
		$userRepository = new UserRepository($app['database']->getConnection());
		$userRepository->save($user);
		$app['session']->set('user', ['email' => $user->email, 'firstname' => $user->firstname, 'lastname' => $user->lastname]);
		$response->redirect('/');
		$response->render();
	}	

}

?>
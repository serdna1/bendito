<?php

namespace Controllers;

use Model\User;
use MVC\Router;

class AuthController {
	
	public static function login(Router $router) {
		//If the user is logged redirect them to the editor page
		session_start();
		if (isset($_SESSION['login'])) {
			header('Location: /editor');
		}
		
		$alerts = [];

		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			$auth = new User($_POST);
			$alerts = $auth->validateLogin();

			if(empty($alerts)) {
				// Check if the user exists
				$user = User::where('email', $auth->email);

				if($user) {
					// Check if the form and database password match
					if( $user->verifyPassword($auth->password) ) {
						// Authenticate user
						session_start();

						$_SESSION['id'] = $user->id;
						$_SESSION['username'] = $user->username;
						$_SESSION['email'] = $user->email;
						$_SESSION['login'] = true;

						// Redirect to the editor page
						header('Location: /editor');
					}
				} else {
					User::setAlert('error', 'Incorrect email or password');
				}

			}
		}

		$alerts = User::getAlerts();
		
		$router->render('auth/login', [
			'alerts' => $alerts
		]);
	}

	public static function logout() {
		session_start();
		session_destroy();
		header('Location: /');
	}

	public static function create(Router $router) {
		$user = new User;

		$alerts = [];
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			$user->sincronize($_POST);
			$alerts = $user->validateNewAccount();

			// Check if there are validation errors
			if(empty($alerts)) {
				$result = $user->userExists();

				// Check if the user already exists
				if($result->num_rows) {
					$alerts = User::getAlerts();
				} else {
					$user->hashPassword();

					// Create the user
					$result = $user->save();

					if($result) {
						header('Location: /created');
					}
				}
			}
		}
		
		$router->render('auth/create-account', [
			'user' => $user,
			'alerts' => $alerts
		]);
	}

	public static function created(Router $router) {
		$router->render('auth/created', [

		]);
	}

}
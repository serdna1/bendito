<?php

namespace Controllers;

use MVC\Router;

class EditorController {
		
	public static function index(Router $router) {
			
		//If the user is logged redirect them to the login page
		session_start();
		if (!isset($_SESSION['login'])) {
			header('Location: /bendito/src/index.php');
		}
		
		$router->render('editor/index', [

		]);
	}

}
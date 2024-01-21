<?php

namespace Controllers;

use MVC\Router;

class WellcomeController {
		
	public static function index(Router $router) {
				
		$message = 'Wellcome';

		$router->render('wellcome', [
			'message' => $message
		]);
	}

}
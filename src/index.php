<?php 

require_once '../includes/app.php';

use Controllers\WellcomeController;
use MVC\Router;

$router = new Router();

// echo 'hello';

$router->get('/', [WellcomeController::class, 'index']);

// Validate routes and assign them controller functions
$router->checkRoutes();



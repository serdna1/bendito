<?php 

require_once '../includes/app.php';

use Controllers\AuthController;
use Controllers\EditorController;
use MVC\Router;

$router = new Router();

// Login
$router->get('/', [AuthController::class, 'login']);
$router->post('/', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout']);
$router->get('/created', [AuthController::class, 'created']);

// Create account
$router->get('/create-account', [AuthController::class, 'create']);
$router->post('/create-account', [AuthController::class, 'create']);

// Editor
$router->get('/editor', [EditorController::class, 'index']);

// Validate routes and assign them controller functions
$router->checkRoutes();



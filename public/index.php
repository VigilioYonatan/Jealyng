<?php
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controller\UsuarioController;

$router = new Router();


$router->get('/', [UsuarioController::class, 'inicio']);
$router->get('/productos', [UsuarioController::class, 'productos']);


$router->comprobarRutas();
<?php
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controller\UsuarioController;

$router = new Router();


$router->get('/', [UsuarioController::class, 'inicio']);
$router->get('/registrar', [UsuarioController::class, 'registrar']);
$router->post('/apiRegistrar', [UsuarioController::class, 'apiRegistrar']);
$router->get('/confirmar-cuenta', [UsuarioController::class, 'confirmarCuenta']);
$router->get('/login', [UsuarioController::class, 'login']);
$router->post('/apiLogin', [UsuarioController::class, 'apiLogin']);
$router->post('/apiRecuperar', [UsuarioController::class, 'apiRecuperar']);
$router->get('/recuperar-cuenta', [UsuarioController::class, 'recuperarCuenta']);
$router->get('/productos', [UsuarioController::class, 'productos']);


$router->comprobarRutas();
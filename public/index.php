<?php
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controller\UsuarioController;
use Controller\AdminController;
use Controller\ProductosController;

$router = new Router();


$router->get('/', [UsuarioController::class, 'inicio']);
$router->get('/salir', [UsuarioController::class, 'salir']);
$router->get('/registrar', [UsuarioController::class, 'registrar']);
$router->post('/apiRegistrar', [UsuarioController::class, 'apiRegistrar']);
$router->get('/confirmar-cuenta', [UsuarioController::class, 'confirmarCuenta']);
$router->get('/login', [UsuarioController::class, 'login']);
$router->post('/apiLogin', [UsuarioController::class, 'apiLogin']);
$router->post('/apiRecuperar', [UsuarioController::class, 'apiRecuperar']);
$router->get('/recuperar-cuenta', [UsuarioController::class, 'recuperarCuenta']);
$router->post('/recuperar-cuenta-contraseña', [UsuarioController::class, 'recuperarCuentaContraseña']);
$router->get('/perfil', [UsuarioController::class, 'perfil']);
$router->get('/apiUserPerfil', [UsuarioController::class, 'apiUserPerfil']);
$router->get('/apiUserDepartamento', [UsuarioController::class, 'apiUserDepartamento']);
$router->get('/apiUserProvincia', [UsuarioController::class, 'apiUserProvincia']);
$router->get('/apiUserDistritos', [UsuarioController::class, 'apiUserDistritos']);
$router->post('/apiPerfilDatos', [UsuarioController::class, 'apiPerfilDatos']);
$router->post('/apiPerfilImagen', [UsuarioController::class, 'apiPerfilImagen']);
$router->post('/apiPerfilWallpaper', [UsuarioController::class, 'apiPerfilWallpaper']);
$router->get('/productos', [UsuarioController::class, 'productos']);

$router->get('/admin', [UsuarioController::class, 'admin']);
$router->get('/admin/productos', [AdminController::class, 'adminProductos']);


$router->get('/apiListarProductos', [ProductosController::class, 'apiListarProductos']);
$router->post('/apiActualizarProductos', [ProductosController::class, 'apiActualizarProductos']);
$router->post('/apiAddProductos', [ProductosController::class, 'apiAddProductos']);
$router->post('/apiEliminarProductos', [ProductosController::class, 'apiEliminarProductos']);
$router->get('/apiBuscarProductos', [ProductosController::class, 'apiBuscarProductos']);
$router->post('/apiGetSubcategorias', [ProductosController::class, 'apiGetSubcategorias']);
//tienda
$router->get('/tienda', [ProductosController::class, 'tienda']);
$router->get('/apiConsultarIdProducto', [ProductosController::class, 'apiConsultarIdProducto']);

$router->comprobarRutas();
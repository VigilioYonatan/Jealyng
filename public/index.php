<?php
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controller\UsuarioController;
use Controller\AdminController;
use Controller\CarritoController;
use Controller\ComentarioController;
use Controller\FavoritoController;
use Controller\MarcaController;
use Controller\ProductosController;

$router = new Router();


$router->get('/', [UsuarioController::class, 'inicio']);

$router->get('/error', [UsuarioController::class, 'error']);

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
$router->post('/apiPerfilEnvio', [UsuarioController::class, 'apiPerfilEnvio']);
$router->post('/apiPerfilDatos', [UsuarioController::class, 'apiPerfilDatos']);
$router->get('/apiBuscadorNombreUsuario', [UsuarioController::class, 'apiBuscadorNombreUsuario']);

$router->post('/apiPerfilImagen', [UsuarioController::class, 'apiPerfilImagen']);
$router->post('/apiPerfilWallpaper', [UsuarioController::class, 'apiPerfilWallpaper']);
$router->post('/apiPerfilRol', [UsuarioController::class, 'apiPerfilRol']);
$router->post('/apiEliminarPerfil', [UsuarioController::class, 'apiEliminarPerfil']);
$router->get('/productos', [UsuarioController::class, 'productos']);

// admin 
$router->get('/admin', [UsuarioController::class, 'admin']);
$router->get('/admin/productos', [AdminController::class, 'adminProductos']);
$router->get('/admin/usuarios', [AdminController::class, 'adminUsuarios']);
$router->get('/admin/marcas', [AdminController::class, 'adminMarcas']);
$router->post('/admin/marcas', [AdminController::class, 'adminMarcas']);
$router->get('/admin/subcategorias', [AdminController::class, 'adminSubcategorias']);
$router->post('/admin/subcategorias', [AdminController::class, 'adminSubcategorias']);
$router->get('/admin/categorias', [AdminController::class, 'adminCategorias']);
$router->post('/admin/categorias', [AdminController::class, 'adminCategorias']);


$router->get('/apiListarProductos', [ProductosController::class, 'apiListarProductos']);
$router->post('/apiActualizarProductos', [ProductosController::class, 'apiActualizarProductos']);
$router->post('/apiAddProductos', [ProductosController::class, 'apiAddProductos']);
$router->post('/apiEliminarProductos', [ProductosController::class, 'apiEliminarProductos']);
$router->get('/apiBuscarProductos', [ProductosController::class, 'apiBuscarProductos']);
$router->post('/apiGetSubcategorias', [ProductosController::class, 'apiGetSubcategorias']);
$router->post('/apiActualizarMarcas', [MarcaController::class, 'apiActualizarMarcas']);
$router->post('/apiEliminarMarcas', [MarcaController::class, 'apiEliminarMarcas']);
//tienda
$router->get('/tienda', [ProductosController::class, 'tienda']);
$router->get('/producto', [ProductosController::class, 'producto']);
$router->post('/ApiComentario', [ComentarioController::class, 'ApiComentario']);
$router->post('/ApiEliminarComentario', [ComentarioController::class, 'ApiEliminarComentario']);
$router->get('/apiGetComentario', [ComentarioController::class, 'apiGetComentario']);
$router->post('/actualizarComentario', [ComentarioController::class, 'actualizarComentario']);
$router->get('/categoria', [ProductosController::class, 'categoria']);
$router->get('/apiConsultarIdProducto', [ProductosController::class, 'apiConsultarIdProducto']);
$router->get('/apiBuscadorNombreProducto', [ProductosController::class, 'apiBuscadorNombreProducto']);

// carrito

$router->get('/carrito', [CarritoController::class, 'carrito']);
$router->get('/apiListCarrito', [CarritoController::class, 'apiListCarrito']);
$router->post('/apiAddCarrito', [CarritoController::class, 'apiAddCarrito']);
$router->post('/apiAumentarQTY', [CarritoController::class, 'apiAumentarQTY']);
$router->post('/apiDisminuirQTY', [CarritoController::class, 'apiDisminuirQTY']);
$router->post('/enviarInfoPago', [CarritoController::class, 'enviarInfoPago']);
$router->get('/pedidoConfirmado', [CarritoController::class, 'pedidoConfirmado']);

// favorito
$router->post('/apiAddFavorito', [FavoritoController::class, 'apiAddFavorito']);
$router->get('/apiViewFavorito', [FavoritoController::class, 'apiViewFavorito']);
$router->post('/apiRemoveFavorito', [FavoritoController::class, 'apiRemoveFavorito']);

$router->comprobarRutas();
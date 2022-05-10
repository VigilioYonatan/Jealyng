<?php

namespace Controller;

use Classes\EmailClass;
use Model\UsuarioModel;
use MVC\Router;

use Model\CarritoModel;
use Model\CategoriaModel;
use Model\ComentariosModel;
use Model\FavoritoModel;
use Model\HistorialComprasModel;
use Model\MarcaModel;
use Model\PedidoModel;
use Model\ProductosModel;

class UsuarioController
{

    public static function inicio(Router $router)
    {
        session_start();
        $marcas = MarcaModel::whereAllLimit(10);
        $inner = 'pro INNER JOIN categoria cat on pro.id_categoria = cat.id_categoria
        INNER JOIN subcategoria sub on pro.id_subcategoria = sub.id_subcat
        INNER JOIN marca on pro.id_marca = marca.id_marca
        INNER JOIN descuento ON pro.id_descuento = descuento.id_descuento
        INNER JOIN estadoproducto on pro.id_estado = estadoproducto.id_estadoPro ORDER BY nombre_descuento DESC';
        //  
        $ofertas = ProductosModel::buscadorPageInner(0, 10, $inner);

        $categorias = CategoriaModel::all();
        $router->render('web/index', [
            "titulo" => "Jealyng",
            "marcas" => $marcas,
            "ofertas" => $ofertas,
            "categorias" => $categorias
        ]);
    }
    public static function salir(Router $router)
    {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
    public static function error(Router $router)
    {
        session_start();

        $router->render('web/error404', [
            "titulo" => "Error 404",
        ]);
    }
    public static function login(Router $router)
    {
        session_start();
        if (isset($_SESSION['login'])) header('Location: /');
        // $go = $_GET['go'] ?? null;
        // if ($go !== 'carrito') {
        //     header('Location: /');
        // }
        $router->render('web/login', [
            "titulo" => "Acceso",
        ]);
    }

    public static function apiLogin()
    {
        $_SESSION = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email_user'];
            $password = $_POST['password_user'];
            $usuario = UsuarioModel::where('email_user', $email);
            // $usuario->getId();
            if (!$usuario) {
                echo json_encode(["login" => "No se encontró este correo en el sistema, pruebe con otro"]);
            } else if ($usuario->estado_user == 0) {
                echo json_encode(["noActivado" => "Debes verificar tu cuenta mediante tu correo"]);
            } else {
                $verificarPassword = password_verify($password, $usuario->password_user);
                if (!$verificarPassword) {
                    echo json_encode(["passwordInvalido" => "Contraseña incorrecta pruebe nuevamente..."]);
                } else {
                    session_start();
                    $_SESSION['login'] = true;
                    $_SESSION['id'] = $usuario->id_user;
                    $_SESSION['nick'] = $usuario->nick_user;

                    // die;
                    if ($usuario->id_rol === '1') {

                        $_SESSION['id'] = $usuario->id_user;
                        echo json_encode(["logueado" => "Bienvenido a Jealyng $usuario->nombre_user ;3"]);
                    } else if ($usuario->id_rol === '2') {

                        $_SESSION['admin'] = true;
                        echo json_encode(["logeoAdmin" => "Bienvenido Admin $usuario->nombre_user "]);
                    }


                    if (!empty($_SESSION['carrito'])) {
                        $carrito = new CarritoModel;
                        $existeCarrito = $carrito::whereAll('id_user', $_SESSION['id']);
                        if (empty($existeCarrito)) {
                            foreach ($_SESSION['carrito'] as $value) {
                                // $carrito->getId();
                                $carrito->id_prod = $value['id_prod'];
                                $carrito->id_user = $_SESSION['id'];
                                $carrito->costoTotal_carrito = $value['costoTotal_carrito'];
                                $carrito->cantidad_carrito = $value['cantidad_carrito'];
                                $carrito->guardar();
                            }
                        }
                    }

                    $favorito = new FavoritoModel;
                    $existe = $favorito::whereAll('id_user', $_SESSION['id']);
                    if (!empty($_SESSION['favorito'])) {

                        if (empty($existe)) {
                            foreach ($_SESSION['favorito'] as $value) {
                                // $carrito->getId();
                                $favorito->id_prod  = $value['idFavorito'];
                                $favorito->id_user = $_SESSION['id'];
                                $favoritoObj = [
                                    "idFavorito" =>  $value['idFavorito']
                                ];
                                $_SESSION['favorito'] = [...$_SESSION['favorito'], $favoritoObj];
                                $favorito->guardar();
                            }
                        } else {
                            $_SESSION['favorito'] = [];
                            foreach ($existe as $value) {
                                // $carrito->getId();
                                $favoritoObj = [
                                    "idFavorito" =>  $value->id_prod
                                ];
                                $_SESSION['favorito'] = [...$_SESSION['favorito'], $favoritoObj];
                            }
                        }
                    } else {

                        if (empty($existe)) {

                            $_SESSION['favorito'] = [];
                        } else {
                            $_SESSION['favorito'] = [];
                            foreach ($existe as $value) {

                                $favoritoObj = [
                                    "idFavorito" => $value->id_prod
                                ];
                                $_SESSION['favorito'] = [...$_SESSION['favorito'], $favoritoObj];
                            }
                        }
                    }
                }
            }
        }
    }


    public static function apiRecuperar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email_user'];
            $respuesta = UsuarioModel::where('email_user', $email);
            if (!$respuesta) {
                echo json_encode(["correoInvalido" => 'No encontramos este correo Electrónico en nuestro sistema']);
            } else {
                $respuesta->getID();
                $respuesta->tokenUsuario();
                $respuesta->guardar();
                $email = new EmailClass($respuesta->email_user, $respuesta->nombre_user, $respuesta->token_user);
                $email->RecuperarPassword();
                echo json_encode(["respuesta" => "Revisa tu correo electrónico para recuperar tu cuenta..."]);
            }
        }
    }

    public static function recuperarCuenta(Router $router)
    {
        $token = htmlGet($_GET['token']);
        if (!$token) header('Location: /');
        $resultado = UsuarioModel::where('token_user', $token);

        $router->render('web/token/recuperarCuenta', ["titulo" => "Recuperar Cuenta", "resultado" => $resultado, "token" => $token]);
    }

    public static function recuperarCuentaContraseña()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['token'];
            $password = $_POST['password_user'];
            $usuario = UsuarioModel::where('token_user', $token);
            if ($usuario) {
                $usuario->getId();
                $usuario->token_user = null;
                $usuario->hashearPassword($password);
                $resultado = $usuario->guardar();
                echo json_encode(["resultado" => $resultado, "mensaje" =>  "Ya tienes una nueva contraseña $usuario->nombre_user :D"]);
            } else {
                echo json_encode(["error" => "Chistosito, hubo un error xD"]);
            }
        }
    }


    public static function registrar(Router $router)
    {
        session_start();
        if (isset($_SESSION['login'])) header('Location: /');
        $router->render('web/registrar', [
            "titulo" => "Registrar",
        ]);
    }

    public static function apiRegistrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new UsuarioModel($_POST); //lo que viene por metodo post

            $existe = $usuario->existeUsuario(); // verificar si el usuario existe
            $existeNick = $usuario->existeNick(); // verificar si el usuario existe
            if ($existe >= 1) { // si existe mandamos error 
                echo json_encode(["existe" => true, "mensaje" => "Este correo ya existe en nuestro sistema, pruebe con otro"]);
            } elseif ($existeNick >= 1) {
                echo json_encode(["existeNick" => true, "mensaje" => "Este usuario ya existe en nuestro sistema, pruebe con otro"]);
            } else {
                // no hubo error cuando se registro
                $usuario->hashPassword(); //HASH a la contraseña
                $usuario->tokenUsuario();  //añadimos token en el usuario 
                $resultado = $usuario->guardar(); // guardamos nombre,correo,password ,token
                $emailUsuario = new EmailClass($usuario->email_user, $usuario->nombre_user, $usuario->token_user); //instanciamos libreria
                $emailUsuario->enviarToken(); //enviamos correo con el token para verificar

                echo json_encode(["registrado" => $resultado, "mensaje" => "Cuenta creada Correctamente, Verifique su email.."]);
            }
        }
    }

    public static function confirmarCuenta(Router $router)
    {
        //existe token o null
        $token = htmlGet($_GET['token']);
        //si no existe directo al inicio
        if (!$token) {
            header('Location: /');
        }

        // buscamos por el token a los usuarios
        $usuario = UsuarioModel::where('token_user', $token);
        $resultado = false;
        // si lo encuentra
        if ($usuario) {
            $usuario->getId(); // verifica si el id es null o no null
            $usuario->estado_user = 1; // cambiamos su estado de 0 a 1 .(habilitamos a acceder)
            $usuario->token_user = null; // eliminamos su token
            $resultado .= $usuario->guardar(); // guardamos cambios
        }

        $router->render('web/token/confirmarCuenta', [
            "titulo" => "Confirmar cuenta",
            "resultado" => $resultado,
            "nombre" => $usuario->nombre_user ?? null
        ]);
    }

    public static function perfil(Router $router)
    {
        session_start();

        $user = $_GET['user'] ?? null;
        if (!isset($user)) {
            header("Location: /login");
        }

        $perfil = UsuarioModel::where('nick_user', $user);
        if (empty($perfil)) {
            header("Location: /");
        }
        $inner  = " his INNER JOIN productos pro ON pro.id_prod = his.id_prod INNER JOIN pedido ped ON ped.id_pedido = his.id_pedido  WHERE his.id_user = $perfil->id_user ";
        $historial = HistorialComprasModel::buscadorPageInner(0, 10, $inner);


        $router->render('web/perfil', [
            "titulo" => $perfil->nombre_user,
            "historial" => $historial,
            "perfil" => $perfil
        ]);
    }


    public static function apiPerfilDatos()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = UsuarioModel::find($_SESSION['id']);
            $usuario->getId();
            $usuario->nombre_user = $_POST['nombre_user'];
            $usuario->apellidoMaterno_user = $_POST['apellidoMaterno_user'];
            $usuario->apellidoPaterno_user = $_POST['apellidoPaterno_user'];
            $usuario->nacimiento_user = $_POST['nacimiento_user'];
            $usuario->telefono_user = $_POST['telefono_user'];
            $usuario->nacimiento_user = $_POST['nacimiento_user'];
            $resultado = $usuario->guardar();
            echo json_encode($resultado);
        }
    }
    public static function apiPerfilEnvio()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = UsuarioModel::find($_SESSION['id']);
            $usuario->getId();
            $usuario->id_departamento = $_POST['departamento'];
            $usuario->id_provincia = $_POST['provincia'];
            $usuario->id_distrito = $_POST['distrito'];
            $usuario->direccion_user = $_POST['direccion'];

            $resultado = $usuario->guardar();
            echo json_encode($resultado);
        }
    }



    public static function apiPerfilImagen()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = UsuarioModel::find($_SESSION['id']);
            $usuario->getId();
            $usuario->crearCarpeta();
            if (!empty($usuario->imagen_user)) {
                $usuario->eliminarImagen($usuario->imagen_user);
            }

            $imagen = $_FILES['imagen_user'];
            $usuario->crearNombreImagen($imagen);

       
            $usuario-> subirImagen($imagen,$usuario->imagen_user);
            $usuario->guardar();

            echo json_encode(["imagen" => $usuario->imagen_user, "nombre" => $_SESSION['nick']]);
        }
    }

    public static function apiPerfilWallpaper()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = UsuarioModel::find($_SESSION['id']);
            $usuario->getId();
            $usuario->crearCarpeta();
            if ($usuario->wallpaper_user !== 'wallpaperDefecto.jpg') {
                $usuario->eliminarImagen($usuario->wallpaper_user);
            }

            $imagen = $_FILES['wallpaper_user'];
            $usuario->crearNombrePortada($imagen);

            $usuario-> subirImagen($imagen,$usuario->imagen_user);
            $usuario->guardar();

            echo json_encode(["portada" => $usuario->wallpaper_user]);
        }
    }
    public static function apiPerfilRol()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = UsuarioModel::find($_POST['id_user']);
            $usuario->getId();
            $usuario->id_rol = $_POST['id_rol'];
            $resultado = $usuario->guardar();
            echo json_encode(["usuario" => $resultado]);
        }
    }
    public static function apiEliminarPerfil()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = UsuarioModel::find($_POST['id_user']);
            $usuario->getId();

            if (!empty($usuario->imagen_user)) {
                $usuario->eliminarImagen($usuario->imagen_user);
            }
            if (!empty($usuario->wallpaper_user)) {
                $usuario->eliminarImagen($usuario->wallpaper_user);
            }

            $resultado = $usuario->eliminar();

            echo json_encode(["eliminado" => $resultado]);
        }
    }

    public static function apiBuscadorNombreUsuario()
    {
        $nombre = htmlGet($_GET['nombre']) ?? null;

        $usuario = UsuarioModel::buscador('nick_user', $nombre);
        echo json_encode(["usuarios" => $usuario]);
    }

    public static function productos(Router $router)
    {
        session_start();
        $router->render('web/productos', [
            "titulo" => "Producto",

        ]);
    }

    public static function admin(Router $router)
    {
        session_start();
        if (!isset($_SESSION['admin'])) {
            header('Location: /');
        }

        $totalUsuario = UsuarioModel::contar(null);
        $usuarioReciente = UsuarioModel::whereAllLimit('10');
        $totalProductos = ProductosModel::contar(null);
        $inner = ' ped INNER JOIN usuario usu ON usu.id_user = ped.id_user ORDER BY ped.id_pedido DESC';
        $pedidos = PedidoModel::buscadorPageInner(0, 20, $inner);
        $comentarios = ComentariosModel::contar(null);
        $pedidosSuma = new PedidoModel;
        $suma = $pedidosSuma->sumaTotalPedidos();
        $router->render('admin/index', [
            "titulo" => "Admin-Dashboard",

            "totalUsuario" => $totalUsuario,
            "totalProductos" => $totalProductos,
            "usuarioReciente" => $usuarioReciente,
            "pedidos" => $pedidos,
            "comentarios" => $comentarios,
            "suma" => $suma
        ]);
    }
}
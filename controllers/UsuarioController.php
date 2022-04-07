<?php

namespace Controller;

use Classes\EmailClass;
use Model\UsuarioModel;
use MVC\Router;
use Classes\RenderizarImagenClass;

class UsuarioController
{

    public static function inicio(Router $router)
    {
        session_start();
        $router->render('web/index');
    }
    public static function salir(Router $router)
    {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
    public static function login(Router $router)
    {
        session_start();
        if (isset($_SESSION['login'])) header('Location: /');
        $router->render('web/login');
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
                    if ($usuario->id_rol === '1') {
                        session_start();
                        $_SESSION['login'] = true;
                        $_SESSION['id'] = $usuario->id_user;
                        echo json_encode(["logueado" => "Bienvenido a Jealyng $usuario->nombre_user ;3"]);
                    } else if ($usuario->id_rol === '2') {

                        session_start();
                        $_SESSION['login'] = true;
                        $_SESSION['id'] = $usuario->id_user;
                        $_SESSION['admin'] = true;
                        echo json_encode(["logeoAdmin" => "Bienvenido Admin $usuario->nombre_user "]);
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

        $router->render('web/token/recuperarCuenta', ["resultado" => $resultado, "token" => $token]);
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
        $router->render('web/registrar');
    }

    public static function apiRegistrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new UsuarioModel($_POST); //lo que viene por metodo post
            $usuario->getId(); //verifica si el id es null o no null
            $existe = $usuario->existeUsuario(); // verificar si el usuario existe
            if ($existe >= 1) { // si existe mandamos error 
                echo json_encode(["existe" => true, "mensaje" => "Este usuario ya existe en nuestro sistema, pruebe con otro"]);
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
            "resultado" => $resultado,
            "nombre" => $usuario->nombre_user ?? null
        ]);
    }

    public static function perfil(Router $router)
    {
        session_start();
        if (!isset($_SESSION['login'])) header('Location: /');
        $usuario = UsuarioModel::find($_SESSION['id']);

        $router->render('web/perfil', [
            "usuario" => $usuario
        ]);
    }


    public static function apiUserPerfil()
    {
        session_start();
        $usuario = UsuarioModel::find($_SESSION['id']);
        echo json_encode(["usuario" => $usuario]);
    }
    public static function apiUserProvincia()
    {
        session_start();
        $provincia = selectSql('provincia');
        echo json_encode(["provincia" => $provincia]);
    }
    public static function apiUserDistritos()
    {
        session_start();
        $distrito = selectSql('distrito');
        echo json_encode(["distrito" => $distrito]);
    }
    public static function apiUserDepartamento()
    {
        session_start();
        $departamentos = selectSql('departamentos');
        echo json_encode(["departamentos" => $departamentos]);
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
            $usuario->telefono_user = $_POST['telefono_user'];
            $usuario->nacimimiento_user = $_POST['nacimimiento_user'];
            $usuario->guardar();

            echo json_encode(["resultado" =>  "Los cambios se realizaron exitosamente"]);
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

            $imgRender = new RenderizarImagenClass($imagen);
            $imgRender->renderizar('usuarios', $usuario->imagen_user, '0.5');
            $usuario->guardar();

            echo json_encode(["imagen" => $usuario->imagen_user]);
        }
    }

    public static function apiPerfilWallpaper()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = UsuarioModel::find($_SESSION['id']);
            $usuario->getId();
            $usuario->crearCarpeta();
            if ($usuario->wallpaper_user !== 'wallpaperDefecto.jpeg') {
                $usuario->eliminarImagen($usuario->wallpaper_user);
            }

            $imagen = $_FILES['wallpaper_user'];
            $usuario->crearNombrePortada($imagen);

            $imgRender = new RenderizarImagenClass($imagen);
            $imgRender->renderizar('usuarios', $usuario->wallpaper_user, '0.8');
            $usuario->guardar();

            echo json_encode(["portada" => $usuario->wallpaper_user]);
        }
    }
    public static function productos(Router $router)
    {
        session_start();
        $router->render('web/productos');
    }

    public static function admin(Router $router)
    {
        session_start();
        if (!isset($_SESSION['admin'])) {
            header('Location: /');
        }

        $router->render('admin/index');
    }
}
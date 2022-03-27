<?php

namespace Controller;

use Classes\EmailClass;
use Model\UsuarioModel;
use MVC\Router;

class UsuarioController
{

    public static function inicio(Router $router)
    {
        $router->render('web/index');
    }
    public static function login(Router $router)
    {
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
            } else {
                $verificarPassword = password_verify($password, $usuario->password_user);
                if (!$verificarPassword) {
                    echo json_encode(["passwordInvalido" => "Contraseña incorrecta pruebe nuevamente..."]);
                } else {
                    session_start();
                    $_SESSION['login'] = true;
                    $_SESSION['id'] = $usuario->id_user;
                    echo json_encode(["logueado" => "Bienvenido a Jealyng $usuario->nombre_user ;3"]);
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
        $token = htmlGet($_GET['token']) ?? null;
        if (!$token) header('Location: /');
        $resultado = UsuarioModel::where('token_user', $token);
        if ($resultado) {
            $resultado->getID();
            $resultado->token_user = null;
            $resultado->guardar();
        }
        $router->render('web/token/recuperarCuenta', ["hola" => $resultado]);
    }


    public static function registrar(Router $router)
    {

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
        $token = $_GET['token'] ?? null;
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

    public static function productos(Router $router)
    {
        $router->render('web/productos');
    }
}
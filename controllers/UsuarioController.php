<?php

namespace Controller;

use MVC\Router;

class UsuarioController
{

    public static function inicio(Router $router)
    {
        $router->render('web/index');
    }
    public static function productos(Router $router)
    {
        $router->render('web/productos');
    }
}
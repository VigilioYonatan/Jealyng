<?php

namespace Controller;

use Model\CategoriaModel;
use Model\DescuentoModel;
use Model\EstadoProductoModel;
use Model\MarcaModel;
use MVC\Router;

class AdminController
{

    public static function adminProductos(Router $router)
    {
        session_start();
        if (!isset($_SESSION['admin'])) {
            header('Location: /');
        }
        $categorias = CategoriaModel::all();
        $estadoPro = EstadoProductoModel::all();
        $marca = MarcaModel::all();
        $descuento = DescuentoModel::all();
        $router->render('admin/productos', [
            "categorias" => $categorias,
            "estadoPro" => $estadoPro,
            "marca" => $marca,
            "descuento" => $descuento
        ]);
    }
}
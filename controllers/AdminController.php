<?php

namespace Controller;

use Model\CategoriaModel;
use Model\DescuentoModel;
use Model\EstadoProductoModel;
use Model\MarcaModel;
use Model\RolesModel;
use Model\UsuarioModel;
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
    public static function adminMarcas(Router $router)
    {
        session_start();
        if (!isset($_SESSION['admin'])) {
            header('Location: /');
        }

        $router->render('admin/productos', []);
    }
    public static function adminUsuarios(Router $router)
    {
        session_start();
        if (!isset($_SESSION['admin'])) {
            header('Location: /');
        }
        $total = $usuarios = UsuarioModel::contar();
        $porPagina = 20;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        } else {
            $pagina = $_GET['pagina'];
        }
        $desde = ($pagina - 1) * $porPagina;
        $totalPaginas = ceil($total / $porPagina);
        $usuarios = UsuarioModel::buscadorPage($desde, $porPagina);
        $roles = RolesModel::all();


        $router->render(
            'admin/usuarios',
            [
                "usuarios" => $usuarios,
                "roles" => $roles,
                "pagina" => $pagina,
                "totalPaginas" => $totalPaginas,
                "total" => $total
            ]
        );
    }
}
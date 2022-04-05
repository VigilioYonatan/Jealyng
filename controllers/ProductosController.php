<?php

namespace Controller;

use Classes\RenderizarImagenClass;
use Model\ProductosModel;
use Model\SubCategoriaModel;
use MVC\Router;

class ProductosController
{
    public static function apiListarProductos()
    {
        $productos = new ProductosModel;
        $producto = $productos->getAllInfo();
        echo json_encode(["productos" =>  $producto]);
    }
    public static  function apiGetSubcategorias()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subcategorias = SubCategoriaModel::whereAll('id_categoria', $_POST['id_categoria']);

            echo json_encode(["resultado" => $subcategorias]);
        }
    }
    public static function apiAddProductos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $producto = new ProductosModel($_POST);
            $producto->getId();
            $imagen = $_FILES['imagen_prod'];
            $imagen2 = $_FILES['imagen2_prod'];
            $producto->crearCarpeta();
            $producto->crearNombreImagen($imagen);
            $producto->crearNombreImagen2($imagen2);

            $imagen = new RenderizarImagenClass($imagen['tmp_name']);
            $imagen->renderizar('productos', $producto->imagen_prod, '0.9');
            $imagen = new RenderizarImagenClass($imagen2['tmp_name']);
            $imagen->renderizar('productos', $producto->imagen2_prod, '0.9');
            $resultado = $producto->guardar();
            $productoInfo = $producto->getAllInfo();
            echo json_encode(["productos" => $productoInfo, "now" => $resultado]);
        }
    }
    public static function apiActualizarProductos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $producto =  new ProductosModel($_POST);
            $producto->getId();
            $resultado = $producto->find($producto->id);

            // $resultado->id = $resultado->id_prod;

            if (isset($_FILES['imagen_prod'])) {
                $imagen = $_FILES['imagen_prod'];
                $resultado->eliminarImagen($resultado->imagen_prod);

                $resultado->crearCarpeta();
                $producto->crearNombreImagen($imagen);
                $imagen = new RenderizarImagenClass($imagen['tmp_name']);
                $imagen->renderizar('productos', $producto->imagen_prod, '0.9');
                $resultado = $producto->guardar();
            } else {
                // $usuario->imagen = $resultado->imagen;
                // $result = $usuario->guardar();
                $producto->imagen_prod = $resultado->imagen_prod;
                $producto->guardar();
            }

            $productoInfo = $producto->getAllInfo();
            echo json_encode(["productos" => $productoInfo]);
        }
    }

    public static function apiEliminarProductos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $imagen = $_POST['imagen'];
            $imagen2 = $_POST['imagen2'];

            $eliminar = new ProductosModel;
            $eliminar->id_prod = $id;
            $eliminar->getId();
            $eliminar->eliminarImagen($imagen);
            $eliminar->eliminarImagen($imagen2);
            $eliminado = $eliminar->eliminar($id);

            echo json_encode(["eliminado" => $eliminado, "id" => $id]);
        }
    }

    public static  function apiBuscarProductos()
    {
        $nombre = $_GET['nombre'];
        $newproducto = new ProductosModel;
        $producto = $newproducto->buscadorProducto($nombre);
        echo json_encode(["productos" =>  $producto]);
    }

    // tienda

    public static  function tienda(Router $router)
    {
        $productoGet = $_GET['producto'];

        if (!$productoGet) header('Location: /');
        $productos = new ProductosModel;
        $sub = $productos->tiendaSubcategoria($productoGet);
        // if (!$sub) header('Location: /');
        $router->render('web/tienda', [
            "subCat" => $sub,
            "get" => $productoGet
        ]);
    }


    public static function apiConsultarIdProducto()
    {
        $id = htmlGet($_GET['id']);
        $productos = new ProductosModel;

        $producto = $productos->productoId($id);
        echo json_encode(["producto" => $producto]);
    }
}
<?php

namespace Controller;

use Classes\RenderizarImagenClass;
use Model\CategoriaModel;
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

            $imagen = new RenderizarImagenClass($imagen);
            $imagen->renderizar('productos', $producto->imagen_prod, '0.9');
            $imagen = new RenderizarImagenClass($imagen2);
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
                $imagen = new RenderizarImagenClass($imagen);
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
            $producto = ProductosModel::find($id);
            $imagen = $producto->imagen_prod;
            $imagen2 = $producto->imagen2_prod;

            $producto->id_prod = $id;
            $producto->getId();
            $producto->eliminarImagen($imagen);
            $producto->eliminarImagen($imagen2);
            $eliminado = $producto->eliminar($id);

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
        session_start();
        $productoGet = htmlGet($_GET['producto'] ?? '');
        $categoriaGet = htmlGet($_GET['categoria']);
        if (!$categoriaGet) header('Location: /');
        if (!$productoGet && !$categoriaGet) header('Location: /');

        $condicion = $_GET['condicion'] ?? ''; // condicion
        $descuento = $_GET['descuento'] ?? ''; // condicion

        // paginador 
        $productos = new ProductosModel;
        $total = $productos->paginador($productoGet, $categoriaGet, $condicion, $descuento);
        $porPagina = 32;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        } else {
            $pagina = $_GET['pagina'];
        }
        $desde = ($pagina - 1) * $porPagina;
        $totalPaginas = ceil($total / $porPagina);


        $sub = $productos->tiendaSubcategoria($productoGet, $categoriaGet, $desde, $porPagina, $condicion, $descuento);
        // if (!$sub) header('Location: /');
        $router->render('web/tienda', [
            "subCat" => $sub,
            "category" => $categoriaGet,
            "get" => $productoGet,
            "pagina" => $pagina,
            "totalPaginas" => $totalPaginas,
            "total" => $total
        ]);
    }

    public static function producto(Router $router)
    {
        session_start();
        $nombre = $_GET['nombre'] ?? null;
        $newNombre = explode('-', $nombre);
        $nombreProducto = implode(' ', $newNombre);

        $producto = new ProductosModel;
        $row = $producto->nombreProducto($nombreProducto);

        $inner = " pro 
                INNER JOIN categoria cat on pro.id_categoria = cat.id_categoria
                INNER JOIN subcategoria sub on pro.id_subcategoria = sub.id_subcat
                INNER JOIN marca on pro.id_marca = marca.id_marca
                INNER JOIN descuento ON pro.id_descuento = descuento.id_descuento
                INNER JOIN estadoproducto on pro.id_estado = estadoproducto.id_estadoPro WHERE sub.nombre_subcat = '$row[nombre_subcat]' AND cat.nombre_categoria ='$row[nombre_categoria]' ";
        $relacionado = $producto->buscadorPageInner(0, 4, $inner);
        $router->render('web/producto', [
            "producto" =>  $row,
            "relacionado" => $relacionado
        ]);
    }


    public static function categoria(Router $router)
    {
        session_start();
        $categoria = $_GET['nombre'];
        $cats = CategoriaModel::where('nombre_categoria', $_GET['nombre']);
        $categorias = new SubCategoriaModel;
        $catGroup = $categorias->subcategorias($categoria);
        $productos = new ProductosModel;
        $inner = "pro INNER JOIN descuento des ON pro.id_descuento = des.id_descuento INNER JOIN categoria cat ON pro.id_categoria = cat.id_categoria WHERE cat.nombre_categoria = '$categoria' AND des.nombre_descuento > 0.0 ORDER BY des.nombre_descuento DESC ";

        $catDescuento = $productos->buscadorPageInner(0, 20, $inner);



        $router->render('web/categoria', [
            "cats" => $cats,
            "categoria" => $categoria,
            "categorias" =>  $catGroup,
            "catDescuento" => $catDescuento
        ]);
    }


    public static function apiConsultarIdProducto()
    {
        $id = htmlGet($_GET['id']);
        $productos = new ProductosModel;

        $producto = $productos->productoId($id);
        echo json_encode(["producto" => $producto]);
    }

    public static function apiBuscadorNombreProducto()
    {
        $nombre = htmlGet($_GET['nombre']);
        $productos = new ProductosModel;

        $producto = $productos->buscador('nombre_prod', $nombre);
        echo json_encode(["producto" => $producto]);
    }
}
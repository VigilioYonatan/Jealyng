<?php

namespace Controller;

use Model\CarritoModel;
use Model\CategoriaModel;
use Model\DescuentoModel;
use Model\EstadoProductoModel;
use Model\MarcaModel;
use Model\RolesModel;
use Model\SubCategoriaModel;
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
            "titulo" => "Productos",
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

        // agregando marcas
        $total =  MarcaModel::contar(null);
        $porPagina = 15;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        } else {
            $pagina = $_GET['pagina'];
        }
        $desde = ($pagina - 1) * $porPagina;
        $totalPaginas = ceil($total / $porPagina);
        $marcaList = MarcaModel::buscadorPage($desde, $porPagina);

        $errores = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $marcas = new MarcaModel($_POST);
            $marcas->getId();
            if (empty($_POST['nombre_marca'])) {
                $errores['nombreVacio'] = 'No debe estar vacio';
            }
            $imagen = $_FILES['imagen_marca'];
            if (empty($imagen['tmp_name'])) {
                $errores['imagenVacio'] = 'No debe estar vacio';
            }

            if (empty($errores)) {
                $marcas->crearCarpeta();

                $marcas->nombreMarcaImagen($imagen);
                $marcas->subirImagen($imagen,$marcas->imagen_marca);
                $marcas->guardar();
            }
        }


        $router->render('admin/marcas', [
            "titulo" => "Marcas",
            "errores" => $errores,
            "marcaList" => $marcaList,
            "pagina" => $pagina,
            "totalPaginas" => $totalPaginas,
            "total" => $total
        ]);
    }
    public static function adminUsuarios(Router $router)
    {
        session_start();
        if (!isset($_SESSION['admin'])) {
            header('Location: /');
        }
        $total = $usuarios = UsuarioModel::contar(null);
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
                "titulo" => "Usuarios",
                "usuarios" => $usuarios,
                "roles" => $roles,
                "pagina" => $pagina,
                "totalPaginas" => $totalPaginas,
                "total" => $total
            ]
        );
    }
    public static function adminSubcategorias(Router $router)
    {
        session_start();
        if (!isset($_SESSION['admin'])) {
            header('Location: /');
        }
        $categorias = CategoriaModel::all();
        $inner = "INNER JOIN categoria cat ON subcategoria.id_categoria = cat.id_categoria";
        $total =  SubCategoriaModel::contar($inner);
        $porPagina = 10;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        } else {
            $pagina = $_GET['pagina'];
        }
        $desde = ($pagina - 1) * $porPagina;
        $totalPaginas = ceil($total / $porPagina);

        $subs = SubCategoriaModel::buscadorPageInner($desde, $porPagina, $inner);
        $errores = [];



        //actualizar

        if (isset($_GET['actualizar'])) {
            $subId = SubCategoriaModel::find($_GET['actualizar']);
            $subId->getId();
            // $nombreValue =s
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $subId->id_subcat = $_GET['actualizar'];
                $subId->nombre_subcat = $_POST['nombre_subcat'];
                $subId->id_categoria = $_POST['id_categoria'];

                if (!empty($_FILES['imagen_subcat']['tmp_name'])) {
                    $imagen = $_FILES['imagen_subcat'];
                    if (!empty($subId->imagen_subcat)) {
                        $subId->eliminarImagen($subId->imagen_subcat);
                    }
                    $subId->crearCarpeta();
                    $subId->crearNombreImagen($imagen);
                    $subId->subirImagen($imagen,$subId->imagen_subcat);
                }
                $subId->guardar();
                header('Location: /admin/subcategorias');
            }
        } else {
            //agregar
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $subcategorias = new SubCategoriaModel($_POST);
                $subcategorias->getId();
                if (empty($_POST['nombre_subcat'])) {
                    $errores['nombreVacio'] = 'No debe estar vacio';
                }
                $imagen = $_FILES['imagen_subcat'];
                if (empty($imagen['tmp_name'])) {
                    $errores['imagenVacio'] = 'No debe estar vacio';
                }

                if (empty($errores)) {
                    $subcategorias->crearCarpeta();

                    $subcategorias->crearNombreImagen($imagen);
                    $subcategorias->subirImagen($imagen,$subcategorias->imagen_subcat);
                    $subcategorias->guardar();
                }
            }
        }
        $router->render(
            'admin/subcategorias',
            [
                "titulo" => "Subcategorias",
                "subs" => $subs,
                "categorias" => $categorias,
                "errores" => $errores,
                "pagina" => $pagina,
                "totalPaginas" => $totalPaginas,
                "total" => $total,
                "id" => $subId ?? null
            ]
        );
    }

    public static function adminCategorias(Router $router)
    {
        session_start();
        if (!isset($_SESSION['admin'])) {
            header('Location: /');
        }
        
        $total =  CategoriaModel::contar(null);
        $porPagina = 10;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        } else {
            $pagina = $_GET['pagina'];
        }
        $desde = ($pagina - 1) * $porPagina;
        $totalPaginas = ceil($total / $porPagina);

        $cats = CategoriaModel::buscadorPageInner($desde, $porPagina, null);

        //actualizar

        if (isset($_GET['actualizar'])) {
            $subId = CategoriaModel::find($_GET['actualizar']);
            $subId->getId();
            // $nombreValue =s
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $subId->id_categoria = $_GET['actualizar'];
                $subId->nombre_categoria = $_POST['nombre_categoria'];

                if (!empty($_FILES['imagen_categoria']['tmp_name'])) {
                    $imagen = $_FILES['imagen_categoria'];
                    if (!empty($subId->imagen_categoria)) {
                        $subId->eliminarImagen($subId->imagen_categoria);
                    }
                    $subId->crearCarpeta();
                    $subId->crearNombreImagen($imagen);
                    $subId->subirImagen($imagen,$subId->imagen_categoria);

                }
                if (!empty($_FILES['wallpaper_categoria']['tmp_name'])) {
                    $wallpaper = $_FILES['wallpaper_categoria'];
                    if (!empty($subId->wallpaper_categoria)) {
                        $subId->eliminarImagen($subId->wallpaper_categoria);
                    }
                    $subId->crearCarpeta();
                    $subId->crearNombreWallpaper($wallpaper);
                    $subId->subirImagen($wallpaper,$subId->wallpaper_categoria);

                
                }
                $subId->guardar();
                header('Location: /admin/categorias');
            }
        } else {
            //agregar
            $errores = [];
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $categorias = new CategoriaModel($_POST);
                $categorias->getId();
                if (empty($_POST['nombre_categoria'])) {
                    $errores['nombreVacio'] = 'No debe estar vacio';
                }
                $imagen = $_FILES['imagen_categoria'];
                $wallpaper = $_FILES['wallpaper_categoria'];
                if (empty($imagen['tmp_name'])) {
                    $errores['imagenVacio'] = 'Imagen no debe estar vacio';
                }
                if (empty($wallpaper['tmp_name'])) {
                    $errores['wallpaperVacio'] = 'Wallpaper no debe estar vacio';
                }

                if (empty($errores)) {
                    $categorias->crearCarpeta();

                    $categorias->crearNombreImagen($imagen);
                    $categorias->crearNombreWallpaper($wallpaper);
                    $categorias->subirImagen($imagen, $categorias->imagen_categoria);
                    $categorias->subirImagen($wallpaper,  $categorias->wallpaper_categoria);
                    $categorias->guardar();
                }
            }
        }
        $router->render('admin/categorias', [
            "titulo" => "Categorias",
            "cats" => $cats,
            "errores" => $errores ?? null,
            "pagina" => $pagina,
            "totalPaginas" => $totalPaginas,
            "total" => $total,
            "id" => $subId ?? null
        ]);
    }
}
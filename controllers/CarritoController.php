<?php

namespace Controller;

use Model\CarritoModel;
use Model\ProductosModel;
use MVC\Router;

class CarritoController
{

    public static function apiListCarrito()
    {
        session_start();
        if (isset($_SESSION['login'])) {
            $carrito = new CarritoModel;
            $result = $carrito->listarCarritoId($_SESSION['id']);
            echo json_encode(["carrito" =>  $result]);
        } else {
            echo json_encode(["carrito" => $_SESSION['carrito'] ?? []]);
        }
    }

    public static function carrito(Router $router)
    {
        session_start();
        $router->render('web/carrito', []);
    }

    public static function apiAddCarrito()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $producto = new ProductosModel;
            $pro = $producto->addCarritoProducto($_POST['id_prod']);
            if (isset($_SESSION['login'])) {
                $carrito =  new CarritoModel($_POST);
                $buscar = $carrito->buscarCarrito($carrito->id_prod, $_SESSION['id']);
                if ($buscar < 1) {
                    $carrito->id_user = $_SESSION['id'];
                    $carrito->costoTotal_carrito = ($pro['precio_prod'] - ($pro['precio_prod'] *  $pro['nombre_descuento'])) * $carrito->cantidad_carrito;
                    $carrito->guardar();
                    $result = $carrito->listarCarritoId($_SESSION['id']);
                    echo json_encode(["carrito" =>  $result]);
                }
            } else {
                if (!empty($_SESSION['carrito'])) {
                    $session_array_id = array_column($_SESSION['carrito'], "id_prod");
                    if (!in_array($_POST['id_prod'], $session_array_id)) {
                        $item = [
                            "id_prod" =>   $_POST['id_prod'],
                            "nombre_prod" => $pro['nombre_prod'],
                            "imagen_prod" => $pro['imagen_prod'],
                            "costoTotal_carrito" => ($pro['precio_prod'] - ($pro['precio_prod'] *  $pro['nombre_descuento'])) * $_POST['cantidad_carrito'],
                            "precio" => $pro['precio_prod'] - ($pro['precio_prod'] *  $pro['nombre_descuento']),
                            "stock_prod" => $pro['stock_prod'],
                            "cantidad_carrito" => $_POST['cantidad_carrito']
                        ];
                        array_push($_SESSION['carrito'], $item);
                        echo json_encode(["carrito" => $_SESSION['carrito']]);
                    } else {
                        echo json_encode(["añadido" => true]);
                    }
                } else {
                    $_SESSION['carrito'] = [];
                    $item = [
                        "id_prod" =>   $_POST['id_prod'],
                        "nombre_prod" => $pro['nombre_prod'],
                        "imagen_prod" => $pro['imagen_prod'],
                        "costoTotal_carrito" => ($pro['precio_prod'] - ($pro['precio_prod'] *  $pro['nombre_descuento'])) * $_POST['cantidad_carrito'],
                        "precio" => $pro['precio_prod'] - ($pro['precio_prod'] *  $pro['nombre_descuento']),
                        "stock_prod" => $pro['stock_prod'],
                        "cantidad_carrito" => $_POST['cantidad_carrito']
                    ];

                    array_push($_SESSION['carrito'], $item);
                    echo json_encode(["carrito" => $_SESSION['carrito']]);
                }
            }
        }
    }

    public static function apiAumentarQTY()
    {
        session_start();
        $id = $_POST['id_prod'];
        if (isset($_SESSION['login'])) {
            $producto = new ProductosModel;
            $pro = $producto->addCarritoProducto($_POST['id_prod']);
            $carrito =  new CarritoModel;
            $result = $carrito->cambiarCantidadCarrito($id, $_SESSION['id']);
            $result->getId();
            $result->cantidad_carrito = $result->cantidad_carrito + 1;
            $result->costoTotal_carrito = ($pro['precio_prod'] - ($pro['precio_prod'] *  $pro['nombre_descuento'])) * $result->cantidad_carrito;
            $result->guardar();
            echo json_encode(['cantidad' => $result]);
        } else {

            foreach ($_SESSION['carrito'] as $key => $value) {
                if ($value['id_prod'] === $id) {
                    if ($_SESSION['carrito'][$key]['cantidad_carrito'] <  $_SESSION['carrito'][$key]['stock_prod']) {
                        $_SESSION['carrito'][$key]['cantidad_carrito'] = $_SESSION['carrito'][$key]['cantidad_carrito'] + 1;
                        $_SESSION['carrito'][$key]['costoTotal_carrito'] = $_SESSION['carrito'][$key]['precio'] * $_SESSION['carrito'][$key]['cantidad_carrito'];
                        echo json_encode(['cantidad' => $_SESSION['carrito'][$key]]);
                    }
                }
            }
        }
    }
    public static function apiDisminuirQTY()
    {
        session_start();
        $id = $_POST['id_prod'];
        if (isset($_SESSION['login'])) {
            $producto = new ProductosModel;
            $pro = $producto->addCarritoProducto($_POST['id_prod']);
            $carrito =  new CarritoModel;
            $result = $carrito->cambiarCantidadCarrito($id, $_SESSION['id']);
            $result->getId();
            if ($result->cantidad_carrito > 1) {
                $result->cantidad_carrito = $result->cantidad_carrito - 1;
                $result->costoTotal_carrito = ($pro['precio_prod'] - ($pro['precio_prod'] *  $pro['nombre_descuento'])) * $result->cantidad_carrito;
                $result->guardar();
                echo json_encode(['cantidad' => $result]);
            } else {
                $result->eliminar($result->id);
                echo json_encode(['id' => $id]);
            }
        } else {
            foreach ($_SESSION['carrito'] as $key => $value) {
                if ($value['id_prod'] === $id) {
                    if ($_SESSION['carrito'][$key]['cantidad_carrito'] > 1) {
                        $_SESSION['carrito'][$key]['cantidad_carrito'] = $_SESSION['carrito'][$key]['cantidad_carrito'] - 1;
                        $_SESSION['carrito'][$key]['costoTotal_carrito'] = $_SESSION['carrito'][$key]['precio'] * $_SESSION['carrito'][$key]['cantidad_carrito'];
                        echo json_encode(['cantidad' => $_SESSION['carrito'][$key]]);
                    } else {

                        unset($_SESSION['carrito'][$key]);
                        echo json_encode(['id' => $id]);
                    }
                }
            }
        }
    }
}
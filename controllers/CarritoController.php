<?php

namespace Controller;

use Model\CarritoModel;
use Model\ProductosModel;

class CarritoController
{

    public static function apiAddCarrito()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $producto = new ProductosModel;
            $pro = $producto->addCarritoProducto($_POST['id_prod']);
            $carrito =  new CarritoModel;

            if (isset($_SESSION['login'])) {
                echo json_encode(["login" => true]);
            } else {
                // $_SESSION['carrito'] = [];
                if (!empty($_SESSION['carrito'])) {
                    $session_array_id = array_column($_SESSION['carrito'], "id_prod");
                    if (!in_array($_POST['id_prod'], $session_array_id)) {
                        $item = [
                            "id_prod" =>   $_POST['id_prod'],
                            "nombre" => $pro['nombre_prod'],
                            "imagen" => $pro['imagen_prod'],
                            "precio" => number_format($pro['precio_prod'] - ($pro['precio_prod'] *  $pro['nombre_descuento']), 2),
                            "costo" => number_format($pro['precio_prod'] - ($pro['precio_prod'] *  $pro['nombre_descuento']), 2),
                            "cantidad" => $_POST['cantidad_carrito']
                        ];
                        array_push($_SESSION['carrito'], $item);
                        echo json_encode(["carrito" => $_SESSION['carrito']]);
                    }
                } else {
                    $_SESSION['carrito'] = [];
                    $item = [
                        "id_prod" =>   $_POST['id_prod'],
                        "nombre" => $pro['nombre_prod'],
                        "imagen" => $pro['imagen_prod'],
                        "precio" => number_format($pro['precio_prod'] - ($pro['precio_prod'] *  $pro['nombre_descuento']), 2),
                        "costo" => number_format($pro['precio_prod'] - ($pro['precio_prod'] *  $pro['nombre_descuento']), 2),
                        "cantidad" => $_POST['cantidad_carrito']
                    ];
                    array_push($_SESSION['carrito'], $item);
                    echo json_encode(["carrito" => $_SESSION['carrito']]);
                }
                // echo json_encode(["login" => false]);
            }
        }
    }
}
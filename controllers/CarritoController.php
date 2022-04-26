<?php

namespace Controller;

use Classes\EmailClass;
use Classes\PdfClass;
use Model\CarritoModel;
use Model\HistorialComprasModel;
use Model\PedidoModel;
use Model\ProductosModel;
use Model\UsuarioModel;
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

        $router->render('web/carrito', [
            "titulo" => "Carrito"
        ]);
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

    public static function enviarInfoPago()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pedido = new PedidoModel;
            $pedido->id_user = $_SESSION['id'];
            $pedido->id_metodoP = 1;
            $pedido->direccionEnvio = $_POST['distrito'] . ' ' . $_POST['direccion'];
            $monto  = $_POST['monto'];
            $carrito = $_POST['carrito'];
            if (empty($_POST['datapay'])) {
            } else {
                $jsonPaypal = $_POST['datapay'];
                $objPaypal = json_decode($jsonPaypal);
                $pedido->estado = "Aprobado";

                if (is_object($objPaypal)) {
                    $pedido->datospaypal  = $jsonPaypal;
                    $transaccionId = $objPaypal->purchase_units[0]->payments->captures[0]->id;
                    $pedido->idtransaccionpaypal = $transaccionId;
                    if ($objPaypal->status == "COMPLETED") {
                        $totalPaypal = $objPaypal->purchase_units[0]->amount->value;
                        $pedido->monto =  $totalPaypal * 3.7309;
                        if ($monto == $totalPaypal) {

                            $pedido->estado = "Completo";
                        }

                        $objCarrito = json_decode($carrito);


                        $resultado = $pedido->guardar();
                        $historial = new HistorialComprasModel;
                        foreach ($objCarrito as $objCar) {


                            $historial->id_pedido = $resultado['id'];
                            $historial->id_user = $_SESSION['id'];
                            $historial->id_prod = $objCar->id_prod;
                            $historial->cantidad = $objCar->cantidad_carrito;
                            $historial->costoTotalCarrito = $objCar->costoTotal_carrito;
                            $historial->guardar();
                        }

                        $carrito = new CarritoModel;
                        $carrito->eliminarQuery('id_user', $_SESSION['id']);

                        $usuario = UsuarioModel::find($_SESSION['id']);
                        date_default_timezone_set("America/Lima");
                        $info = [
                            "nombre" => $usuario->nombre_user,
                            "apellido" => $usuario->apellidoPaterno_user . $usuario->apellidoMaterno_user,
                            "telefono" => $usuario->telefono_user,
                            "total" => number_format($totalPaypal * 3.735, 2),
                            "direccion" => $usuario->direccion_user,
                            "fecha" => date('Y-m-d H:i:s')
                        ];

                        //crear nombre de pdf y subir al correo
                        $nombre = md5(uniqid(rand(), true)) . '.pdf';


                        // datos que se subiran al session
                        $arrResponse = [
                            "status" => true,
                            "orden"  => $resultado['id'],
                            "transaccion" => $transaccionId,
                            "mensaje" => "Pedido Realizado",
                            "producto" => $objCarrito,
                            "info" => $info,
                            "nombrePDF" => $nombre,
                        ];
                        $_SESSION['dataorden'] = $arrResponse;


                        echo json_encode($resultado);
                    } else {
                        echo json_encode(["status" => false, "Pago incompleto"]);
                    }
                } else {
                    echo json_encode(["status" => false, "hubo un problema"]);
                }
            }
        }
    }

    public static function pedidoConfirmado(Router $router)
    {
        session_start();
        if (empty($_SESSION['dataorden'])) header('Location: /');

        $router->render('web/token/pedidoConfirmado', [
            "titulo" => "Confirmar pedido",
            "respuestaOrden" => $_SESSION['dataorden']
        ]);
    }
}
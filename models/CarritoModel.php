<?php

namespace Model;

class CarritoModel extends ActiveRecord
{
    protected static $tabla = 'carrito'; // nombre tabla
    protected static $idTabla = 'id_carrito'; //id producto
    public $id; //id
    //columnas de la tabla productos
    protected static $columnasDB = ['id_carrito', 'cantidad_carrito', 'costoTotal_carrito', 'id_user', 'id_prod'];

    public function __construct($args = [])
    {
        $this->id_carrito               = $args['id_carrito']           ?? null;
        $this->cantidad_carrito         = $args['cantidad_carrito']     ?? null;
        $this->costoTotal_carrito       = $args['costoTotal_carrito']   ?? null;
        $this->id_user                  = $args['id_user']              ?? null;
        $this->id_prod                  = $args['id_prod']              ?? null;
    }
    public function getId()
    {
        $this->id =  $this->id_carrito;
    }

    public function buscarCarrito($prod, $id)
    {
        $query = self::$db->query("SELECT * FROM " . self::$tabla . " WHERE id_prod = '$prod' AND id_user = '$id'");

        return $query->num_rows;
    }
    public function cambiarCantidadCarrito($prod, $id)
    {

        $query = "SELECT * FROM " . self::$tabla . " 
         WHERE id_prod = '$prod' AND id_user = '$id'";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public function listarCarritoId($id)
    {
        $query = self::$db->query("SELECT pro.id_prod, nombre_prod, imagen_prod, car.costoTotal_carrito, precio_prod, stock_prod, car.cantidad_carrito, pro.precio_prod-(pro.precio_prod * des.nombre_descuento) as precio FROM productos pro INNER JOIN carrito car ON car.id_prod = pro.id_prod INNER JOIN descuento des ON pro.id_descuento = des.id_descuento WHERE id_user = '$id'");
        $carrito = [];

        while ($row = $query->fetch_assoc()) {
            array_push($carrito, $row);
        }

        return $carrito;
    }

    public function issetIdProduct($columna, $token)
    {
        $query = "SELECT * FROM " . self::$tabla  . " WHERE ${columna} = '${token}'";
        $respuesta = self::$db->query($query);
        $resultado = $respuesta->fetch_assoc();
        return [
            "respuesta" =>      $respuesta->num_rows,
            "resultado" =>      $resultado
        ];
    }
}
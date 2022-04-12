<?php

namespace Model;

class CarritoModel extends ActiveRecord
{
    protected static $db;
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
    public function getID()
    {
        $this->id =  $this->id_carrito;
    }
}
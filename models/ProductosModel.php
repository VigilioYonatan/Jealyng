<?php

namespace Model;

class ProductosModel extends ActiveRecord
{
    protected static $db;
    protected static $tabla = 'productos'; // nombre tabla
    protected static $idTabla = 'id_prod'; //id producto
    public $id; //id
    //columnas de la tabla productos
    protected static $columnasDB = ['id_prod', 'nombre_prod', 'descripcion_prod', 'precio_prod', 'imagen_prod', 'stock_prod', 'id_categoria', 'id_marca', 'id_descuento', 'id_estado'];

    public function __construct($args = [])
    {
        $this->id_prod          = $args['id_prod']          ?? null;
        $this->nombre_prod      = $args['nombre_prod']      ?? null;
        $this->descripcion_prod = $args['descripcion_prod'] ?? null;
        $this->precio_prod      = $args['precio_prod']      ?? null;
        $this->imagen_prod      = $args['imagen_prod']      ?? null;
        $this->stock_prod       = $args['stock_prod']       ?? null;
        $this->id_categoria     = $args['id_categoria']     ?? null;
        $this->id_marca         = $args['id_marca']         ?? null;
        $this->id_descuento     = $args['id_descuento']     ?? null;
        $this->id_estado        = $args['id_estado']        ?? null;
    }
    public function getID()
    {
        $this->id =  $this->id_user;
    }
}
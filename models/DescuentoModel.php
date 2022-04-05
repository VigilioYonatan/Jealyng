<?php

namespace Model;

class DescuentoModel extends ActiveRecord
{
    protected static $db;
    protected static $tabla = 'descuento'; // nombre tabla
    protected static $idTabla = 'id_descuento'; //id producto
    public $id; //id
    //columnas de la tabla productos
    protected static $columnasDB = ['id_descuento', 'nombre_descuento'];

    public function __construct($args = [])
    {
        $this->id_descuento         = $args['id_descuento']          ?? null;
        $this->nombre_descuento     = $args['nombre_descuento']        ?? null;
    }
    public function getID()
    {
        $this->id =  $this->id_descuento;
    }
}
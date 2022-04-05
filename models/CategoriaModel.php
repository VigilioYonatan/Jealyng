<?php

namespace Model;

class CategoriaModel extends ActiveRecord
{
    protected static $db;
    protected static $tabla = 'categoria'; // nombre tabla
    protected static $idTabla = 'id_categoria'; //id producto
    public $id; //id
    //columnas de la tabla productos
    protected static $columnasDB = ['id_categoria', 'nombre_categoria'];

    public function __construct($args = [])
    {
        $this->id_categoria          = $args['id_categoria']          ?? null;
        $this->nombre_categoria      = $args['nombre_categoria']        ?? null;
    }
    public function getID()
    {
        $this->id =  $this->id_categoria;
    }
}
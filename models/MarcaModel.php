<?php

namespace Model;

class MarcaModel extends ActiveRecord
{
    protected static $db;
    protected static $tabla = 'marca'; // nombre tabla
    protected static $idTabla = 'id_marca'; //id producto
    public $id; //id
    //columnas de la tabla productos
    protected static $columnasDB = ['id_marca', 'nombre_marca'];

    public function __construct($args = [])
    {
        $this->id_marca      = $args['id_marca']          ?? null;
        $this->nombre_marca     = $args['nombre_marca']        ?? null;
    }
    public function getID()
    {
        $this->id =  $this->id_marca;
    }
}
<?php

namespace Model;

class EstadoProductoModel extends ActiveRecord
{
    protected static $db;
    protected static $tabla = 'estadoproducto'; // nombre tabla
    protected static $idTabla = 'id_estadoPro'; //id producto
    public $id; //id
    //columnas de la tabla productos
    protected static $columnasDB = ['id_estadoPro', 'nombre_estadoPro'];

    public function __construct($args = [])
    {
        $this->id_estadoPro         = $args['id_estadoPro']          ?? null;
        $this->nombre_estadoPro     = $args['nombre_estadoPro']        ?? null;
    }
    public function getID()
    {
        $this->id =  $this->id_estadoPro;
    }
}
<?php

namespace Model;

class SubCategoriaModel extends ActiveRecord
{
    protected static $db;
    protected static $tabla = 'subcategoria'; // nombre tabla
    protected static $idTabla = 'id_subcat'; //id producto
    public $id; //id
    //columnas de la tabla productos
    protected static $columnasDB = ['id_subcat', 'nombre_subcat', 'id_categoria'];

    public function __construct($args = [])
    {
        $this->id_subcat            = $args['id_subcat']          ?? null;
        $this->nombre_subcat        = $args['nombre_subcat']        ?? null;
        $this->id_categoria         = $args['id_categoria']        ?? null;
    }
    public function getID()
    {
        $this->id =  $this->id_subcat;
    }
}
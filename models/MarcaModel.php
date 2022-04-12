<?php

namespace Model;

class MarcaModel extends ActiveRecord
{
    protected static $db;
    protected static $tabla = 'marca'; // nombre tabla
    protected static $idTabla = 'id_marca'; //id producto
    protected static $carpeta = 'marcas/';
    public $id; //id
    //columnas de la tabla productos
    protected static $columnasDB = ['id_marca', 'nombre_marca', 'imagen_marca'];

    public function __construct($args = [])
    {
        $this->id_marca      = $args['id_marca']          ?? null;
        $this->nombre_marca     = $args['nombre_marca']        ?? null;
        $this->imagen_marca    = $args['imagen_marca']        ?? null;
    }
    public function getID()
    {
        $this->id =  $this->id_marca;
    }


    public function nombreMarcaImagen($imagen)
    {
        $tipoImagen = pathinfo($imagen['name'], PATHINFO_EXTENSION);
        $this->imagen_marca = md5(uniqid(rand(), true)) . ".$tipoImagen";
    }
}
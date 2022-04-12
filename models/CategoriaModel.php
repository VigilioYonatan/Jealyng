<?php

namespace Model;

class CategoriaModel extends ActiveRecord
{
    protected static $db;
    protected static $tabla = 'categoria'; // nombre tabla
    protected static $idTabla = 'id_categoria'; //id producto
    protected static $carpeta = 'categorias/';
    public $id; //id
    //columnas de la tabla productos
    protected static $columnasDB = ['id_categoria', 'nombre_categoria', 'imagen_categoria', 'wallpaper_categoria'];

    public function __construct($args = [])
    {
        $this->id_categoria          = $args['id_categoria']          ?? null;
        $this->nombre_categoria      = $args['nombre_categoria']        ?? null;
        $this->imagen_categoria     = $args['imagen_categoria']        ?? null;
        $this->wallpaper_categoria   = $args['wallpaper_categoria']        ?? null;
    }
    public function getID()
    {
        $this->id =  $this->id_categoria;
    }

    public function crearNombreImagen($imagen)
    {
        $tipoImagen = pathinfo($imagen['name'], PATHINFO_EXTENSION);
        $this->imagen_categoria      = md5(uniqid(rand(), true)) . ".$tipoImagen";
    }
    public function crearNombreWallpaper($wallpaper)
    {
        $tipoImagen = pathinfo($wallpaper['name'], PATHINFO_EXTENSION);
        $this->wallpaper_categoria    = md5(uniqid(rand(), true)) . ".$tipoImagen";
    }
}
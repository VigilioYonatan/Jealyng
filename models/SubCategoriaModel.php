<?php

namespace Model;

class SubCategoriaModel extends ActiveRecord
{
    protected static $db;
    protected static $tabla = 'subcategoria'; // nombre tabla
    protected static $idTabla = 'id_subcat'; //id producto
    protected static $carpeta = 'subcategorias/';
    public $id; //id
    //columnas de la tabla productos
    protected static $columnasDB = ['id_subcat', 'nombre_subcat', 'imagen_subcat', 'id_categoria'];

    public function __construct($args = [])
    {
        $this->id_subcat            = $args['id_subcat']          ?? null;
        $this->nombre_subcat        = $args['nombre_subcat']        ?? null;
        $this->imagen_subcat        = $args['imagen_subcat']        ?? null;
        $this->id_categoria         = $args['id_categoria']        ?? null;
    }
    public function getID()
    {
        $this->id =  $this->id_subcat;
    }
    public function crearNombreImagen($imagen)
    {
        $tipoImagen = pathinfo($imagen['name'], PATHINFO_EXTENSION);
        $this->imagen_subcat    = md5(uniqid(rand(), true)) . ".$tipoImagen";
    }
    // Busca registros por  
    public static function subcategorias($token)
    {
        $query = "SELECT * FROM " . self::$tabla . " sub INNER JOIN categoria cat on cat.id_categoria = sub.id_categoria WHERE cat.nombre_categoria= '$token'";
        $resultado = self::consultarSQL($query);

        return $resultado;
    }
}
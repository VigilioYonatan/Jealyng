<?php



namespace Model;

class FavoritoModel extends ActiveRecord
{

    protected static $tabla = 'favoritos'; // nombre tabla
    protected static $idTabla = 'idFavorito'; //id producto
    public $id; //id

    //columnas de la tabla productos
    protected static $columnasDB = ['idFavorito', 'id_user', 'id_prod'];

    public function __construct($args = [])
    {

        $this->idFavorito = $args['idFavorito'] ?? null;
        $this->id_user = $args['id_user'] ?? null;
        $this->id_prod = $args['id_prod'] ?? null;
    }

    public function getId()
    {
        $this->id =  $this->idFavorito;
    }


    public function issetFav()
    {
        $query = self::$db->query("SELECT * FROM " . self::$tabla . " WHERE id_user = $this->id_user AND id_prod = $this->id_prod");
        return  $query->num_rows;
    }

    // Eliminar un Registro por su ID
    public function eliminarFavorito()
    {
        $query = "DELETE FROM "  . static::$tabla . " WHERE id_user = $this->id_user AND id_prod =   $this->id_prod  LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }
}